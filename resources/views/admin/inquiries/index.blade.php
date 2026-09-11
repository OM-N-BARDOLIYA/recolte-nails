@extends('admin.layouts.admin')

@section('title', 'Customer Inquiries & Leads')

@section('content')
<div class="space-y-6">
    
    <div>
        <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
            <span class="text-[#A33B47]">✦</span>
            <span>Studio Inbox</span>
        </div>
        <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">Customer Inquiries</h1>
        <p class="text-xs sm:text-sm text-[#6A625A] font-light">Direct client messages, custom sizing requests, and inquiries submitted through the contact form.</p>
    </div>

    <div class="rounded-none bg-white border border-[#ECE6DE] overflow-hidden shadow-2xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-[#FAF8F5] border-b border-[#ECE6DE] text-[#8C7A6B] uppercase text-[10px] tracking-[0.16em] font-bold">
                        <th class="py-4 px-5">Client</th>
                        <th class="py-4 px-3">Subject</th>
                        <th class="py-4 px-3">Message</th>
                        <th class="py-4 px-3">Date</th>
                        <th class="py-4 px-3">Status</th>
                        <th class="py-4 px-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#ECE6DE]/60">
                    @forelse($inquiries as $inq)
                        <tr class="hover:bg-[#FAF8F5]/80 transition-colors">
                            <td class="py-4 px-5">
                                <div class="font-bold text-[#171412] text-sm">{{ $inq->name }}</div>
                                <div class="text-[10px] text-[#A33B47] font-semibold">{{ $inq->email }}</div>
                                @if($inq->phone)
                                    <div class="text-[10px] text-[#8C7A6B]">{{ $inq->phone }}</div>
                                @endif
                            </td>

                            <td class="py-4 px-3 font-semibold text-[#171412]">
                                {{ $inq->subject ?? 'General Inquiry' }}
                            </td>

                            <td class="py-4 px-3 max-w-sm">
                                <p class="text-xs text-[#6A625A] line-clamp-2 leading-relaxed font-light">{{ $inq->message }}</p>
                            </td>

                            <td class="py-4 px-3 text-[#8C7A6B] whitespace-nowrap font-medium">
                                {{ $inq->created_at->format('M d, Y') }}
                            </td>

                            <td class="py-4 px-3">
                                <form method="POST" action="{{ route('admin.inquiries.update-status', $inq->id) }}">
                                    @csrf
                                    <select 
                                        name="status" 
                                        onchange="this.form.submit()" 
                                        class="py-1 px-2.5 rounded-none text-[10px] font-bold uppercase tracking-wider bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] focus:outline-none cursor-pointer"
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
                                    <button type="submit" class="p-1.5 rounded-none bg-rose-50 hover:bg-rose-100 text-[#A33B47] transition-colors border border-rose-200 cursor-pointer">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-xs text-[#8C7A6B]">
                                No client inquiries logged yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
            <div class="p-4 border-t border-[#ECE6DE] bg-[#FAF8F5]">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>

</div>
@endsection