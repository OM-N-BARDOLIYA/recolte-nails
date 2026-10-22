@extends('admin.layouts.admin')

@section('title', 'Customer Inquiries & Leads')

@section('content')
    <div class="space-y-6">

        <div>
            <div
                class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
                <span class="text-[#A33B47]">✦</span>
                <span>Studio Inbox</span>
            </div>
            <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">Customer <span
                    class="text-[#A33B47] italic">Inquiries</span></h1>
            <p class="text-xs sm:text-sm text-[#6A625A] font-light">Direct client messages, custom sizing requests, and
                inquiries submitted through the contact form.</p>
        </div>

        <div class="rounded-none bg-white border border-[#ECE6DE] overflow-hidden shadow-2xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr
                            class="bg-[#FAF8F5] border-b border-[#ECE6DE] text-[#8C7A6B] uppercase text-[10px] tracking-[0.16em] font-bold">
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
                                    <p class="text-xs text-[#6A625A] line-clamp-2 leading-relaxed font-light">
                                        {{ $inq->message }}</p>
                                </td>

                                <td class="py-4 px-3 text-[#8C7A6B] whitespace-nowrap font-medium">
                                    {{ $inq->created_at->format('M d, Y') }}
                                </td>

                                <td class="py-4 px-3">
                                    <form method="POST" action="{{ route('admin.inquiries.update-status', $inq->id) }}" id="status-form-{{ $inq->id }}">
                                        @csrf
                                        <input type="hidden" name="status" id="status-input-{{ $inq->id }}" value="{{ $inq->status }}">
                                        <div class="relative inline-block text-left" x-data="{ statusOpen: false }" @click.outside="statusOpen = false" @keydown.escape.window="statusOpen = false">
                                            <button type="button" @click="statusOpen = !statusOpen"
                                                class="py-1.5 pl-3 pr-7 rounded-none text-[10.5px] font-bold uppercase tracking-wider bg-[#FAF8F5] hover:bg-white border border-[#ECE6DE] hover:border-[#A33B47] text-[#171412] focus:border-[#A33B47] focus:ring-1 focus:ring-[#A33B47]/20 focus:outline-none cursor-pointer transition-all shadow-2xs flex items-center justify-between gap-2 group">
                                                <span>
                                                    @if($inq->status === 'new') 🟢 New
                                                    @elseif($inq->status === 'contacted') 🟡 Contacted
                                                    @else ⚪ Resolved
                                                    @endif
                                                </span>
                                                <svg class="w-3 h-3 text-[#8C7A6B] group-hover:text-[#A33B47] transition-transform duration-200 pointer-events-none" :class="statusOpen ? 'rotate-180 text-[#A33B47]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                            
                                            <!-- Custom Dropdown Menu -->
                                            <div x-show="statusOpen" x-cloak
                                                x-transition:enter="transition ease-out duration-100"
                                                x-transition:enter-start="opacity-0 scale-95"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                class="absolute left-0 z-30 mt-1 min-w-[140px] bg-white border border-[#ECE6DE] shadow-xl py-1 divide-y divide-[#ECE6DE]/30">
                                                <button type="button" @click="document.getElementById('status-input-{{ $inq->id }}').value = 'new'; document.getElementById('status-form-{{ $inq->id }}').submit();"
                                                    class="w-full px-3 py-2 text-left text-[11px] font-semibold flex items-center justify-between hover:bg-[#FAF8F5] cursor-pointer {{ $inq->status === 'new' ? 'text-[#A33B47] bg-[#FBEFE9] font-bold' : 'text-[#171412]' }}">
                                                    <span>🟢 New</span>
                                                    @if($inq->status === 'new')<span class="text-xs font-bold text-[#A33B47]">✓</span>@endif
                                                </button>
                                                <button type="button" @click="document.getElementById('status-input-{{ $inq->id }}').value = 'contacted'; document.getElementById('status-form-{{ $inq->id }}').submit();"
                                                    class="w-full px-3 py-2 text-left text-[11px] font-semibold flex items-center justify-between hover:bg-[#FAF8F5] cursor-pointer {{ $inq->status === 'contacted' ? 'text-[#A33B47] bg-[#FBEFE9] font-bold' : 'text-[#171412]' }}">
                                                    <span>🟡 Contacted</span>
                                                    @if($inq->status === 'contacted')<span class="text-xs font-bold text-[#A33B47]">✓</span>@endif
                                                </button>
                                                <button type="button" @click="document.getElementById('status-input-{{ $inq->id }}').value = 'resolved'; document.getElementById('status-form-{{ $inq->id }}').submit();"
                                                    class="w-full px-3 py-2 text-left text-[11px] font-semibold flex items-center justify-between hover:bg-[#FAF8F5] cursor-pointer {{ $inq->status === 'resolved' ? 'text-[#A33B47] bg-[#FBEFE9] font-bold' : 'text-[#171412]' }}">
                                                    <span>⚪ Resolved</span>
                                                    @if($inq->status === 'resolved')<span class="text-xs font-bold text-[#A33B47]">✓</span>@endif
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </td>

                                <td class="py-4 px-5 text-right">
                                    <form method="POST" action="{{ route('admin.inquiries.destroy', $inq->id) }}"
                                        data-confirm="Permanently delete inquiry from &quot;{{ addslashes($inq->name) }}&quot;?"
                                        data-confirm-title="Delete Inquiry">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 rounded-none bg-rose-50 hover:bg-rose-100 text-[#A33B47] transition-colors border border-rose-200 cursor-pointer">
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
                    {{ $inquiries->links('admin.components.pagination') }}
                </div>
            @endif
        </div>

    </div>
@endsection