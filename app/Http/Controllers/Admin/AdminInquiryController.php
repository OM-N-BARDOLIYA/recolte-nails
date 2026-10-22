<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class AdminInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::query();

        // Filter by source / category
        if ($source = $request->input('source')) {
            if ($source === 'orders') {
                $query->whereIn('source', ['whatsapp_product', 'whatsapp_cart']);
            } elseif ($source === 'whatsapp') {
                $query->where('source', 'LIKE', 'whatsapp_%');
            } elseif ($source === 'form') {
                $query->where('source', 'contact_form');
            } else {
                $query->where('source', $source);
            }
        }

        // Filter by status
        if ($status = $request->input('status')) {
            if (in_array($status, ['new', 'contacted', 'resolved'])) {
                $query->where('status', $status);
            }
        }

        // Search term
        if ($search = trim($request->input('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('subject', 'LIKE', "%{$search}%")
                  ->orWhere('message', 'LIKE', "%{$search}%")
                  ->orWhereRaw("CAST(metadata AS CHAR) LIKE ?", ["%{$search}%"]);
            });
        }

        $inquiries = $query->latest()->paginate(20)->withQueryString();

        $stats = [
            'total' => Inquiry::count(),
            'new' => Inquiry::where('status', 'new')->count(),
            'orders' => Inquiry::whereIn('source', ['whatsapp_product', 'whatsapp_cart'])->count(),
            'sizing' => Inquiry::where('source', 'whatsapp_sizing')->count(),
            'contact' => Inquiry::whereIn('source', ['contact_form', 'whatsapp_contact', 'whatsapp_franchise'])->count(),
        ];

        return view('admin.inquiries.index', compact('inquiries', 'stats'));
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
