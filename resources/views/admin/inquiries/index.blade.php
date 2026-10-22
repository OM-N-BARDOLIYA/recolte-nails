@extends('admin.layouts.admin')

@section('title', 'Customer Inquiries & WhatsApp Orders — Atelier CMS')

@section('content')
<div class="space-y-6" x-data="{
    activeModal: null,
    modalData: {},
    copied: false,
    openDetail(item) {
        this.modalData = item;
        this.activeModal = 'detail';
        this.copied = false;
    },
    copyText(text) {
        navigator.clipboard.writeText(text).then(() => {
            this.copied = true;
            setTimeout(() => { this.copied = false; }, 2500);
        });
    }
}">

    <!-- ── 1. PAGE HEADER ── -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 bg-[#FBEFE9] text-[#A33B47] text-[10.5px] font-bold tracking-[0.18em] uppercase border border-[#A33B47]/20 mb-2">
                <span>✦</span>
                <span>Studio Client Inbox</span>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-semibold text-[#171412] tracking-tight">
                Customer Inquiries &amp; <span class="text-[#A33B47] italic">WhatsApp Leads</span>
            </h1>
            <p class="text-xs sm:text-sm text-[#736B63] mt-1 font-light">
                Real-time structured feed of customer WhatsApp orders, bespoke sizing consultations, bag checkouts, and contact lounge inquiries.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a 
                href="{{ route('admin.inquiries.index') }}" 
                class="px-3 py-2 bg-white border border-[#ECE6DE] text-xs font-semibold text-[#171412] hover:border-[#A33B47] transition-all flex items-center gap-1.5 shadow-2xs"
            >
                <svg class="w-3.5 h-3.5 text-[#8C7A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>Refresh Inbox</span>
            </a>
        </div>
    </div>

    <!-- ── 2. QUICK STATS KPI CARDS ── -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
        <!-- All Inquiries -->
        <a 
            href="{{ route('admin.inquiries.index', array_merge(request()->except(['source', 'page']))) }}"
            class="p-4 bg-white border transition-all duration-200 block shadow-2xs hover:shadow-xs {{ !request('source') ? 'border-[#A33B47] ring-1 ring-[#A33B47]/20 bg-[#FBEFE9]/25' : 'border-[#ECE6DE] hover:border-[#A33B47]/40' }}"
        >
            <div class="flex items-center justify-between">
                <span class="text-[10.5px] font-bold uppercase tracking-wider {{ !request('source') ? 'text-[#A33B47]' : 'text-[#736B63]' }}">All Inquiries</span>
                <span class="w-2 h-2 rounded-full {{ !request('source') ? 'bg-[#A33B47]' : 'bg-[#171412]' }}"></span>
            </div>
            <div class="mt-2 text-2xl font-serif font-bold text-[#171412] tabular-nums">
                {{ $stats['total'] }}
            </div>
            <div class="mt-1 text-[10px] text-[#8C7A6B]">Total Recorded</div>
        </a>

        <!-- New Actionable -->
        <a 
            href="{{ route('admin.inquiries.index', array_merge(request()->except(['status', 'page']), ['status' => 'new'])) }}"
            class="p-4 bg-white border transition-all duration-200 block shadow-2xs hover:shadow-xs {{ request('status') === 'new' ? 'border-emerald-600/70 bg-emerald-50/20 ring-1 ring-emerald-500/20' : 'border-[#ECE6DE] hover:border-emerald-500/50' }}"
        >
            <div class="flex items-center justify-between">
                <span class="text-[10.5px] font-bold uppercase tracking-wider text-emerald-800">Unread / New</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            </div>
            <div class="mt-2 text-2xl font-serif font-bold text-emerald-900 tabular-nums">
                {{ $stats['new'] }}
            </div>
            <div class="mt-1 text-[10px] text-emerald-700/80">Pending Follow-up</div>
        </a>

        <!-- Product & Bag Orders -->
        <a 
            href="{{ route('admin.inquiries.index', array_merge(request()->except(['source', 'page']), ['source' => 'orders'])) }}"
            class="p-4 bg-white border transition-all duration-200 block shadow-2xs hover:shadow-xs {{ request('source') === 'orders' ? 'border-[#A33B47] bg-[#FBEFE9]/30 ring-1 ring-[#A33B47]/20' : 'border-[#ECE6DE] hover:border-[#A33B47]/40' }}"
        >
            <div class="flex items-center justify-between">
                <span class="text-[10.5px] font-bold uppercase tracking-wider text-[#A33B47]">🛍️ WhatsApp Orders</span>
                <span class="text-xs font-semibold text-[#A33B47]">Cart &amp; Buy</span>
            </div>
            <div class="mt-2 text-2xl font-serif font-bold text-[#171412] tabular-nums">
                {{ $stats['orders'] }}
            </div>
            <div class="mt-1 text-[10px] text-[#8C7A6B]">Product &amp; Bag Leads</div>
        </a>

        <!-- Sizing Inquiries -->
        <a 
            href="{{ route('admin.inquiries.index', array_merge(request()->except(['source', 'page']), ['source' => 'whatsapp_sizing'])) }}"
            class="p-4 bg-white border transition-all duration-200 block shadow-2xs hover:shadow-xs {{ request('source') === 'whatsapp_sizing' ? 'border-amber-500/70 bg-amber-50/30 ring-1 ring-amber-500/20' : 'border-[#ECE6DE] hover:border-amber-400' }}"
        >
            <div class="flex items-center justify-between">
                <span class="text-[10.5px] font-bold uppercase tracking-wider text-amber-800">📏 Sizing Consults</span>
                <span class="text-xs">📐</span>
            </div>
            <div class="mt-2 text-2xl font-serif font-bold text-amber-900 tabular-nums">
                {{ $stats['sizing'] }}
            </div>
            <div class="mt-1 text-[10px] text-amber-700/80">Bespoke Fit Requests</div>
        </a>

        <!-- Contact Lounge & Forms -->
        <a 
            href="{{ route('admin.inquiries.index', array_merge(request()->except(['source', 'page']), ['source' => 'form'])) }}"
            class="p-4 bg-white border transition-all duration-200 block shadow-2xs hover:shadow-xs {{ request('source') === 'form' ? 'border-sky-500/70 bg-sky-50/30 ring-1 ring-sky-500/20' : 'border-[#ECE6DE] hover:border-sky-400' }}"
        >
            <div class="flex items-center justify-between">
                <span class="text-[10.5px] font-bold uppercase tracking-wider text-sky-800">💬 Contact &amp; Forms</span>
                <span class="text-xs">✉️</span>
            </div>
            <div class="mt-2 text-2xl font-serif font-bold text-sky-900 tabular-nums">
                {{ $stats['contact'] }}
            </div>
            <div class="mt-1 text-[10px] text-sky-700/80">Lounge &amp; Web Leads</div>
        </a>
    </div>

    <!-- ── 3. FILTER & SEARCH TOOLBAR ── -->
    <div class="bg-white p-4 border border-[#ECE6DE] shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-4">
        <!-- Source Filter Tabs -->
        <div class="flex items-center gap-1.5 flex-wrap">
            <a 
                href="{{ route('admin.inquiries.index', request()->except(['source', 'page'])) }}" 
                class="px-3 py-1.5 text-xs font-semibold rounded-none transition-colors {{ !request('source') ? 'bg-[#171412] text-white' : 'bg-[#FAF8F5] text-[#736B63] hover:text-[#171412] border border-[#ECE6DE]' }}"
            >
                All Sources
            </a>
            <a 
                href="{{ route('admin.inquiries.index', array_merge(request()->except(['source', 'page']), ['source' => 'orders'])) }}" 
                class="px-3 py-1.5 text-xs font-semibold rounded-none transition-colors flex items-center gap-1.5 {{ request('source') === 'orders' ? 'bg-[#A33B47] text-white' : 'bg-[#FAF8F5] text-[#736B63] hover:text-[#171412] border border-[#ECE6DE]' }}"
            >
                <span>🛍️</span>
                <span>WhatsApp Orders</span>
            </a>
            <a 
                href="{{ route('admin.inquiries.index', array_merge(request()->except(['source', 'page']), ['source' => 'whatsapp_sizing'])) }}" 
                class="px-3 py-1.5 text-xs font-semibold rounded-none transition-colors flex items-center gap-1.5 {{ request('source') === 'whatsapp_sizing' ? 'bg-amber-800 text-white' : 'bg-[#FAF8F5] text-[#736B63] hover:text-[#171412] border border-[#ECE6DE]' }}"
            >
                <span>📏</span>
                <span>Sizing</span>
            </a>
            <a 
                href="{{ route('admin.inquiries.index', array_merge(request()->except(['source', 'page']), ['source' => 'whatsapp_contact'])) }}" 
                class="px-3 py-1.5 text-xs font-semibold rounded-none transition-colors flex items-center gap-1.5 {{ request('source') === 'whatsapp_contact' ? 'bg-sky-800 text-white' : 'bg-[#FAF8F5] text-[#736B63] hover:text-[#171412] border border-[#ECE6DE]' }}"
            >
                <span>💬</span>
                <span>Contact Lounge</span>
            </a>
            <a 
                href="{{ route('admin.inquiries.index', array_merge(request()->except(['source', 'page']), ['source' => 'whatsapp_franchise'])) }}" 
                class="px-3 py-1.5 text-xs font-semibold rounded-none transition-colors flex items-center gap-1.5 {{ request('source') === 'whatsapp_franchise' ? 'bg-emerald-800 text-white' : 'bg-[#FAF8F5] text-[#736B63] hover:text-[#171412] border border-[#ECE6DE]' }}"
            >
                <span>🤝</span>
                <span>Franchise</span>
            </a>
            <a 
                href="{{ route('admin.inquiries.index', array_merge(request()->except(['source', 'page']), ['source' => 'form'])) }}" 
                class="px-3 py-1.5 text-xs font-semibold rounded-none transition-colors flex items-center gap-1.5 {{ request('source') === 'form' ? 'bg-gray-800 text-white' : 'bg-[#FAF8F5] text-[#736B63] hover:text-[#171412] border border-[#ECE6DE]' }}"
            >
                <span>✉️</span>
                <span>Forms</span>
            </a>
        </div>

        <!-- Search Form & Status Filter -->
        <form method="GET" action="{{ route('admin.inquiries.index') }}" class="flex items-center gap-2">
            @if(request('source'))
                <input type="hidden" name="source" value="{{ request('source') }}">
            @endif

            <!-- Status Dropdown -->
            <select 
                name="status" 
                onchange="this.form.submit()" 
                class="py-1.5 px-2.5 rounded-none text-xs font-medium bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] focus:border-[#A33B47] focus:outline-none"
            >
                <option value="">All Statuses</option>
                <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>🟢 Unread / New</option>
                <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>🟡 Contacted</option>
                <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>⚪ Resolved</option>
            </select>

            <!-- Search Field -->
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search client, message, product..." 
                    class="py-1.5 pl-8 pr-3 w-56 sm:w-64 rounded-none text-xs bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] focus:border-[#A33B47] focus:outline-none"
                >
                <svg class="w-3.5 h-3.5 text-[#8C7A6B] absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            @if(request('search') || request('status') || request('source'))
                <a 
                    href="{{ route('admin.inquiries.index') }}" 
                    class="p-1.5 text-[#8C7A6B] hover:text-[#A33B47] text-xs font-semibold"
                    title="Clear Filters"
                >
                    ✕
                </a>
            @endif
        </form>
    </div>

    <!-- ── 4. INQUIRIES DATA TABLE ── -->
    <div class="rounded-none bg-white border border-[#ECE6DE] overflow-hidden shadow-2xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-[#FAF8F5] border-b border-[#ECE6DE] text-[#8C7A6B] uppercase text-[10px] tracking-[0.16em] font-bold">
                        <th class="py-4 px-4 sm:px-5">Source &amp; Channel</th>
                        <th class="py-4 px-3">Client / Contact</th>
                        <th class="py-4 px-3 min-w-[280px]">Structured Inquiry / Items</th>
                        <th class="py-4 px-3">Date &amp; Time</th>
                        <th class="py-4 px-3">Status</th>
                        <th class="py-4 px-4 sm:px-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#ECE6DE]/60">
                    @forelse($inquiries as $inq)
                        @php
                            $badge = $inq->source_badge;
                            $prod = $inq->product_details;
                            $cartItems = $inq->cart_items;
                        @endphp
                        <tr class="hover:bg-[#FAF8F5]/80 transition-colors {{ $inq->status === 'new' ? 'bg-[#FFFDFB]' : '' }}">
                            
                            <!-- Source Badge -->
                            <td class="py-4 px-4 sm:px-5 align-top whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10.5px] font-bold uppercase tracking-wider border rounded-none {{ $badge['class'] }}">
                                    <span>{{ $badge['icon'] }}</span>
                                    <span>{{ $badge['label'] }}</span>
                                </span>
                                @if($inq->is_whatsapp)
                                    <div class="mt-1 text-[9.5px] text-[#25D366] font-semibold flex items-center gap-1">
                                        <span>●</span>
                                        <span>Web WhatsApp Action</span>
                                    </div>
                                @else
                                    <div class="mt-1 text-[9.5px] text-[#8C7A6B] font-medium flex items-center gap-1">
                                        <span>●</span>
                                        <span>Contact Form</span>
                                    </div>
                                @endif
                            </td>

                            <!-- Client / Contact -->
                            <td class="py-4 px-3 align-top">
                                <div class="font-bold text-[#171412] text-sm">
                                    {{ $inq->client_display_name }}
                                </div>
                                @if($inq->email)
                                    <a href="mailto:{{ $inq->email }}" class="text-[11px] text-[#A33B47] hover:underline font-medium block">
                                        {{ $inq->email }}
                                    </a>
                                @endif
                                @if($inq->phone)
                                    <div class="mt-0.5 flex items-center gap-1.5">
                                        <a 
                                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->phone) }}" 
                                            target="_blank" 
                                            rel="noopener noreferrer"
                                            class="text-[10.5px] text-[#25D366] hover:underline font-semibold flex items-center gap-1"
                                            title="Chat with client on WhatsApp"
                                        >
                                            <span>💬</span>
                                            <span>{{ $inq->phone }}</span>
                                        </a>
                                    </div>
                                @endif
                                @if($inq->ip_address)
                                    <div class="text-[9.5px] text-[#8C7A6B] mt-1 font-mono">
                                        IP: {{ $inq->ip_address }}
                                    </div>
                                @endif
                            </td>

                            <!-- Structured Inquiry / Items -->
                            <td class="py-4 px-3 align-top space-y-2">
                                <div class="font-semibold text-[#171412] text-xs flex items-center gap-2">
                                    <span>{{ $inq->subject ?? 'General Customer Inquiry' }}</span>
                                </div>

                                <!-- 🛍️ Product Order Structured Card -->
                                @if($prod && !empty($prod['title']))
                                    <div class="p-2.5 bg-[#FAF8F5] border border-[#ECE6DE] flex items-center gap-3 max-w-md">
                                        @if(!empty($prod['image']))
                                            <img src="{{ $prod['image'] }}" alt="{{ $prod['title'] }}" class="w-10 h-10 object-cover border border-[#ECE6DE] shrink-0 bg-white">
                                        @else
                                            <div class="w-10 h-10 bg-[#FBEFE9] text-[#A33B47] flex items-center justify-center font-bold text-xs shrink-0 border border-[#A33B47]/20">
                                                💅
                                            </div>
                                        @endif
                                        <div class="min-w-0 flex-1">
                                            <a 
                                                href="{{ $prod['url'] ?? '#' }}" 
                                                target="_blank" 
                                                class="text-xs font-bold text-[#171412] hover:text-[#A33B47] line-clamp-1 transition-colors"
                                            >
                                                {{ $prod['title'] }} ↗
                                            </a>
                                            <div class="flex items-center gap-2 mt-1 flex-wrap">
                                                @if(!empty($prod['shade']))
                                                    <span class="inline-block px-1.5 py-0.5 bg-white border border-[#ECE6DE] text-[9.5px] text-[#6A625A] font-medium">
                                                        Shade: <strong>{{ $prod['shade'] }}</strong>
                                                    </span>
                                                @endif
                                                @if(!empty($prod['size']))
                                                    <span class="inline-block px-1.5 py-0.5 bg-white border border-[#ECE6DE] text-[9.5px] text-[#6A625A] font-medium">
                                                        Size: <strong>{{ $prod['size'] }}</strong>
                                                    </span>
                                                @endif
                                                <span class="inline-block px-1.5 py-0.5 bg-white border border-[#ECE6DE] text-[9.5px] text-[#A33B47] font-bold">
                                                    Qty: {{ $prod['quantity'] ?? 1 }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- 🛒 Multi-Item Bag Structured Card -->
                                @if(!empty($cartItems))
                                    <div class="p-2.5 bg-[#FAF8F5] border border-purple-200/60 max-w-md space-y-1.5">
                                        <div class="flex items-center justify-between text-[10px] font-bold uppercase tracking-wider text-purple-900 border-b border-purple-100 pb-1">
                                            <span>Cart Items ({{ count($cartItems) }})</span>
                                            <span>Total Value: ₹{{ number_format((float)($inq->metadata['subtotal'] ?? 0)) }}</span>
                                        </div>
                                        <div class="space-y-1 max-h-24 overflow-y-auto pr-1">
                                            @foreach($cartItems as $cItem)
                                                <div class="text-[10.5px] text-[#171412] flex items-center justify-between bg-white px-2 py-1 border border-gray-100">
                                                    <span class="font-medium truncate max-w-[180px]">
                                                        {{ $cItem['title'] ?? 'Product' }}
                                                        @if(!empty($cItem['shade'])) • {{ $cItem['shade'] }} @endif
                                                        @if(!empty($cItem['size'])) ({{ $cItem['size'] }}) @endif
                                                    </span>
                                                    <span class="font-bold text-[#A33B47] shrink-0">
                                                        ×{{ $cItem['qty'] ?? 1 }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- WhatsApp Message Text Preview -->
                                <div class="bg-white p-2 border border-dashed border-[#ECE6DE] text-[11px] text-[#6A625A] font-mono leading-relaxed line-clamp-2 max-w-md">
                                    {{ $inq->message }}
                                </div>
                            </td>

                            <!-- Date & Time -->
                            <td class="py-4 px-3 align-top text-[#8C7A6B] whitespace-nowrap text-xs font-medium">
                                <div class="text-[#171412] font-semibold">{{ $inq->created_at->format('M d, Y') }}</div>
                                <div class="text-[10px] text-[#8C7A6B]">{{ $inq->created_at->format('h:i A') }}</div>
                                <div class="text-[9.5px] text-[#A33B47] font-semibold mt-0.5">{{ $inq->created_at->diffForHumans() }}</div>
                            </td>

                            <!-- Status Dropdown -->
                            <td class="py-4 px-3 align-top whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.inquiries.update-status', $inq->id) }}">
                                    @csrf
                                    <select 
                                        name="status" 
                                        onchange="this.form.submit()" 
                                        class="py-1 px-2 text-[10px] font-bold uppercase tracking-wider rounded-none border focus:outline-none cursor-pointer transition-colors {{ 
                                            $inq->status === 'new' ? 'bg-emerald-50 text-emerald-800 border-emerald-300' : 
                                            ($inq->status === 'contacted' ? 'bg-amber-50 text-amber-800 border-amber-300' : 'bg-gray-100 text-gray-700 border-gray-300') 
                                        }}"
                                    >
                                        <option value="new" {{ $inq->status === 'new' ? 'selected' : '' }}>🟢 Unread / New</option>
                                        <option value="contacted" {{ $inq->status === 'contacted' ? 'selected' : '' }}>🟡 Contacted</option>
                                        <option value="resolved" {{ $inq->status === 'resolved' ? 'selected' : '' }}>⚪ Resolved</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-4 sm:px-5 align-top text-right whitespace-nowrap space-x-1">
                                <!-- View Details Modal Trigger -->
                                <button 
                                    type="button" 
                                    @click="openDetail({
                                        id: {{ $inq->id }},
                                        name: '{{ addslashes($inq->client_display_name) }}',
                                        email: '{{ addslashes($inq->email ?? '') }}',
                                        phone: '{{ addslashes($inq->phone ?? '') }}',
                                        subject: '{{ addslashes($inq->subject ?? 'General Inquiry') }}',
                                        source_label: '{{ addslashes($badge['label']) }}',
                                        source_icon: '{{ $badge['icon'] }}',
                                        message: {{ json_encode($inq->message) }},
                                        metadata: {{ json_encode($inq->metadata ?? []) }},
                                        created_at: '{{ $inq->created_at->format('M d, Y h:i A') }}',
                                        status: '{{ $inq->status }}'
                                    })"
                                    class="px-2.5 py-1.5 bg-[#FAF8F5] hover:bg-[#FBEFE9] text-[#171412] hover:text-[#A33B47] text-[10.5px] font-bold border border-[#ECE6DE] transition-colors inline-flex items-center gap-1 cursor-pointer"
                                    title="View Full WhatsApp Message and Details"
                                >
                                    <span>👁️</span>
                                    <span>View</span>
                                </button>

                                <!-- Delete Inquiry -->
                                <form method="POST" action="{{ route('admin.inquiries.destroy', $inq->id) }}" class="inline-block" data-confirm="Permanently delete inquiry from &quot;{{ addslashes($inq->client_display_name) }}&quot;?" data-confirm-title="Delete Inquiry">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="p-1.5 bg-rose-50 hover:bg-rose-100 text-[#A33B47] border border-rose-200 transition-colors cursor-pointer"
                                        title="Delete Inquiry"
                                    >
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-16 text-center text-xs text-[#8C7A6B]">
                                <div class="max-w-xs mx-auto space-y-2">
                                    <div class="text-3xl">📭</div>
                                    <div class="font-serif font-bold text-base text-[#171412]">No inquiries found</div>
                                    <p class="text-xs text-[#736B63] font-light">
                                        Customer interactions and WhatsApp product orders will automatically appear here in structured format.
                                    </p>
                                    @if(request('search') || request('source') || request('status'))
                                        <div class="pt-2">
                                            <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-bold text-[#A33B47] underline">
                                                Clear all filters
                                            </a>
                                        </div>
                                    @endif
                                </div>
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

    <!-- ── 5. STRUCTURED INQUIRY DETAIL MODAL ── -->
    <div 
        x-show="activeModal === 'detail'" 
        x-cloak 
        class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-4"
        @keydown.escape.window="activeModal = null"
    >
        <div 
            class="bg-white w-full max-w-2xl border border-[#ECE6DE] shadow-2xl relative"
            @click.away="activeModal = null"
        >
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-[#ECE6DE] bg-[#FAF8F5] flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-xl" x-text="modalData.source_icon"></span>
                    <div>
                        <h3 class="font-serif font-bold text-base text-[#171412]" x-text="modalData.subject || 'Customer Inquiry'"></h3>
                        <div class="text-[10px] text-[#8C7A6B] flex items-center gap-2 mt-0.5">
                            <span x-text="modalData.source_label"></span>
                            <span>•</span>
                            <span x-text="modalData.created_at"></span>
                        </div>
                    </div>
                </div>
                <button 
                    type="button" 
                    @click="activeModal = null" 
                    class="w-7 h-7 rounded-none bg-white border border-[#ECE6DE] text-gray-500 hover:text-black hover:border-black flex items-center justify-center text-sm font-bold transition-all cursor-pointer"
                >
                    ✕
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6 space-y-5 max-h-[75vh] overflow-y-auto text-xs">
                
                <!-- Client Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 bg-[#FAF8F5] p-3.5 border border-[#ECE6DE]">
                    <div>
                        <span class="text-[10px] uppercase tracking-wider text-[#8C7A6B] font-bold block mb-0.5">Client</span>
                        <span class="font-bold text-[#171412] text-sm" x-text="modalData.name || 'Storefront Visitor'"></span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-wider text-[#8C7A6B] font-bold block mb-0.5">Email</span>
                        <span class="font-mono text-[#A33B47]" x-text="modalData.email || '—'"></span>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase tracking-wider text-[#8C7A6B] font-bold block mb-0.5">Phone / WhatsApp</span>
                        <span class="font-semibold text-[#171412]" x-text="modalData.phone || '—'"></span>
                    </div>
                </div>

                <!-- Product Snapshot (if any) -->
                <template x-if="modalData.metadata && modalData.metadata.product_title">
                    <div class="p-3.5 bg-[#FAF8F5] border border-[#A33B47]/20 space-y-2">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-[#A33B47]">Product Order Details</div>
                        <div class="flex items-center gap-3">
                            <template x-if="modalData.metadata.product_image">
                                <img :src="modalData.metadata.product_image" class="w-12 h-12 object-cover border border-[#ECE6DE] bg-white">
                            </template>
                            <div class="flex-1">
                                <a :href="modalData.metadata.product_url || '#'" target="_blank" class="font-bold text-[#171412] text-sm hover:text-[#A33B47]">
                                    <span x-text="modalData.metadata.product_title"></span> ↗
                                </a>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="px-2 py-0.5 bg-white border border-[#ECE6DE] text-[10px]" x-show="modalData.metadata.shade">
                                        Shade: <strong x-text="modalData.metadata.shade"></strong>
                                    </span>
                                    <span class="px-2 py-0.5 bg-white border border-[#ECE6DE] text-[10px]" x-show="modalData.metadata.size">
                                        Size: <strong x-text="modalData.metadata.size"></strong>
                                    </span>
                                    <span class="px-2 py-0.5 bg-white border border-[#ECE6DE] text-[10px]" x-show="modalData.metadata.quantity">
                                        Qty: <strong x-text="modalData.metadata.quantity"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Verbatim Message Box -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="text-[10px] font-bold uppercase tracking-wider text-[#8C7A6B]">
                            Exact WhatsApp Message Generated
                        </label>
                        <button 
                            type="button" 
                            @click="copyText(modalData.message)" 
                            class="text-[10px] font-bold text-[#A33B47] hover:underline flex items-center gap-1 cursor-pointer"
                        >
                            <span x-show="!copied">📋 Copy Message</span>
                            <span x-show="copied" class="text-emerald-700 font-bold">✓ Copied to clipboard!</span>
                        </button>
                    </div>
                    <div class="bg-[#171412] text-[#FAF8F5] p-4 rounded-none font-mono text-xs whitespace-pre-wrap leading-relaxed max-h-60 overflow-y-auto border border-black selection:bg-[#A33B47] selection:text-white" x-text="modalData.message">
                    </div>
                </div>

                <!-- Structured Technical Metadata (Expandable) -->
                <div class="pt-2 border-t border-[#ECE6DE]" x-data="{ showRaw: false }">
                    <button 
                        type="button" 
                        @click="showRaw = !showRaw" 
                        class="text-[10px] font-bold uppercase tracking-wider text-[#8C7A6B] hover:text-[#171412] flex items-center gap-1 cursor-pointer"
                    >
                        <span>Technical Metadata Payload</span>
                        <span x-text="showRaw ? '▲' : '▼'"></span>
                    </button>
                    <div x-show="showRaw" class="mt-2">
                        <pre class="bg-gray-100 p-3 rounded-none text-[10px] font-mono text-gray-800 overflow-x-auto max-h-40" x-text="JSON.stringify(modalData.metadata, null, 2)"></pre>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-3.5 border-t border-[#ECE6DE] bg-[#FAF8F5] flex items-center justify-between">
                <button 
                    type="button" 
                    @click="activeModal = null" 
                    class="px-4 py-2 bg-white border border-[#ECE6DE] text-xs font-semibold text-[#171412] hover:bg-gray-50 cursor-pointer"
                >
                    Close
                </button>
                <div class="flex items-center gap-2">
                    <button 
                        type="button" 
                        @click="copyText(modalData.message)" 
                        class="px-4 py-2 bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition-colors shadow-2xs cursor-pointer"
                    >
                        <span x-show="!copied">Copy Full Text</span>
                        <span x-show="copied">✓ Copied!</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection