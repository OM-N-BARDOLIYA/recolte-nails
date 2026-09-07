@extends('admin.layouts.admin')

@section('title', 'Customer Inquiries & Leads')

@section('content')
<div class="space-y-6">
    
    <div>
        <div class="text-[11px] font-extrabold uppercase tracking-widest text-rose-dark">Studio Inbox</div>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-charcoal">Customer Inquiries</h1>
        <p class="text-xs text-charcoal/70">Direct client messages, custom sizing requests, and inquiries submitted through the contact form.</p>
    </div>

    <div class="rounded-3xl bg-white border border-charcoal/10 overflow-hidden shadow-2xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-[#FAF8F5] border-b border-charcoal/10 text-charcoal/60 uppercase text-[10px] tracking-wider font-bold">
                        <th class="py-4 px-5">Client</th>
                        <th class="py-4 px-3">Subject</th>
                        <th class="py-4 px-3">Message</th>
                        <th class="py-4 px-3">Date</th>
                        <th class="py-4 px-3">Status</th>
                        <th class="py-4 px-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-charcoal/5">
                    @forelse($inquiries as $inq)
                        <tr class="hover:bg-[#FAF8F5]/60 transition-colors">
                            <td class="py-4 px-5">
                                <div class="font-bold text-charcoal text-sm">{{ $inq->name }}</div>
                                <div class="text-[10px] text-rose-dark font-medium">{{ $inq->email }}</div>
                                @if($inq->phone)
                                    <div class="text-[10px] text-charcoal/60">{{ $inq->phone }}</div>
                                @endif
                            </td>

                            <td class="py-4 px-3 font-semibold text-charcoal">
                                {{ $inq->subject ?? 'General Inquiry' }}
                            </td>

                            <td class="py-4 px-3 max-w-sm">
                                <p class="text-xs text-charcoal/70 line-clamp-2 leading-relaxed">{{ $inq->message }}</p>
                            </td>

                            <td class="py-4 px-3 text-charcoal/50 whitespace-nowrap">
                                {{ $inq->created_at->format('M d, Y') }}
                            </td>

                            <td class="py-4 px-3">
                                <form method="POST" action="{{ route('admin.inquiries.update-status', $inq->id) }}">
                                    @csrf
                                    <select 
                                        name="status" 
                                        onchange="this.form.submit()" 
                                        class="py-1 px-2.5 rounded-xl text-[10px] font-bold bg-[#FAF8F5] border border-charcoal/15 text-charcoal focus:outline-none"
                                    >
                                        <option value="new" {{ $inq->status === 'new' ? 'selected' : '' }}>🟢 New</option>
                                        <option value="contacted" {{ $inq->status === 'contacted' ? 'selected' : '' }}>🟡 Contacted</option>
                                        <option value="resolved" {{ $inq->status === 'resolved' ? 'selected' : '' }}>⚪ Resolved</option>
                                    </select>
                                </form>
                            </td>

                            <td class="py-4 px-5 text-right">
                                <form method="POST" action="{{ route('admin.inquiries.destroy', $inq->id) }}" onsubmit="return confirm('Delete this inquiry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-800 transition-colors border border-rose-200">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-xs text-charcoal/50">
                                No client inquiries logged yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
            <div class="p-4 border-t border-charcoal/10 bg-[#FAF8F5]">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>

</div>
@endsection