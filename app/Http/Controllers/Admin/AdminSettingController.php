<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminSettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = SiteSetting::all()->groupBy('group');
        $user = Auth::user();
        $activeTab = $request->query('tab', 'studio');

        return view('admin.settings.index', compact('settings', 'user', 'activeTab'));
    }

    public function security()
    {
        return redirect()->route('admin.settings.index', ['tab' => 'security']);
    }

    public function update(Request $request)
    {
        $inputs = $request->except(['_token', '_method']);

        if (!empty($inputs['whatsapp_number'])) {
            $inputs['whatsapp_number'] = preg_replace('/[^0-9]/', '', $inputs['whatsapp_number']);
        }

        foreach ($inputs as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Automatically synchronize all stored PageContent records if WhatsApp number changed
        if (!empty($inputs['whatsapp_number'])) {
            $newWa = $inputs['whatsapp_number'];
            $allPages = \App\Models\PageContent::all();
            foreach ($allPages as $pc) {
                $rawContent = json_encode($pc->content);
                if (str_contains($rawContent, 'wa.me/')) {
                    $updatedJson = preg_replace('/wa\.me\/[0-9]+/', 'wa.me/' . $newWa, $rawContent);
                    $pc->content = json_decode($updatedJson, true);
                    $pc->save();
                }
            }
        }

        return redirect()->route('admin.settings.index', ['tab' => 'studio'])
            ->with('success', 'Studio & WhatsApp settings updated successfully! All storefront ordering and inquiry links are now routed to +' . ($inputs['whatsapp_number'] ?? ''));
    }

    public function updateSecurity(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['nullable', 'string'],
            'new_password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        // If new password is provided, verify current password
        if ($request->filled('new_password')) {
            if (!$request->filled('current_password')) {
                return redirect()->route('admin.settings.index', ['tab' => 'security'])
                    ->withErrors(['current_password' => 'Please provide your current password to set a new password.'])
                    ->withInput();
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->route('admin.settings.index', ['tab' => 'security'])
                    ->withErrors(['current_password' => 'Current password does not match our records.'])
                    ->withInput();
            }

            $user->password = Hash::make($request->new_password);
        }

        $user->username = trim($request->input('username'));
        $user->name = trim($request->input('name'));
        $user->email = trim($request->input('email'));
        $user->save();

        return redirect()->route('admin.settings.index', ['tab' => 'security'])
            ->with('success', 'Admin access credentials (username & password) updated successfully!');
    }
}
