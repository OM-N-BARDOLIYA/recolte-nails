<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class AdminInquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(15);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,resolved',
            'admin_notes' => 'nullable|string',
        ]);

        $inquiry->update($validated);
        return back()->with('success', 'Inquiry status updated.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return back()->with('success', 'Inquiry deleted.');
    }
}
