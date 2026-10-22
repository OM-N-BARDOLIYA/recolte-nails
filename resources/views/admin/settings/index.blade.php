@extends('admin.layouts.admin')

@section('title', $activeTab === 'security' ? 'Admin Access & Password Settings' : 'Studio & WhatsApp Settings')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    
    <div>
        <div class="inline-flex items-center gap-1.5 text-[10.5px] font-semibold uppercase tracking-[0.22em] text-[#8C7A6B] mb-1">
            <span class="text-[#A33B47]">✦</span>
            <span>Global Configuration &amp; Security</span>
        </div>
        <h1 class="font-serif text-3xl sm:text-4xl font-medium text-[#171412] tracking-tight">
            {{ $activeTab === 'security' ? 'Admin Access & ' : 'Studio & ' }}<span class="text-[#A33B47] italic">{{ $activeTab === 'security' ? 'Credentials' : 'WhatsApp Settings' }}</span>
        </h1>
        <p class="text-xs sm:text-sm text-[#6A625A] font-light">
            {{ $activeTab === 'security' 
                ? 'Manage the username, email address, and security password used to sign in to the Atelier CMS.' 
                : 'Configure your active WhatsApp ordering number, Instagram handle, and studio concierge info.' }}
        </p>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex items-center gap-2 border-b border-[#ECE6DE] pb-px">
        <a 
            href="{{ route('admin.settings.index', ['tab' => 'studio']) }}"
            class="px-5 py-3 text-xs font-bold uppercase tracking-wider transition-all flex items-center gap-2 border-b-2 {{ $activeTab !== 'security' ? 'border-[#A33B47] text-[#A33B47] bg-white shadow-2xs' : 'border-transparent text-[#8C7A6B] hover:text-[#171412] hover:bg-[#FAF8F5]' }}"
        >
            <span>⚙️</span>
            <span>Studio &amp; WhatsApp Info</span>
        </a>

        <a 
            href="{{ route('admin.settings.index', ['tab' => 'security']) }}"
            class="px-5 py-3 text-xs font-bold uppercase tracking-wider transition-all flex items-center gap-2 border-b-2 {{ $activeTab === 'security' ? 'border-[#A33B47] text-[#A33B47] bg-white shadow-2xs' : 'border-transparent text-[#8C7A6B] hover:text-[#171412] hover:bg-[#FAF8F5]' }}"
        >
            <span>🔐</span>
            <span>Admin Access &amp; Password</span>
        </a>
    </div>

    <!-- Feedback Alerts -->
    @if(session('success'))
        <div class="p-4 rounded-none bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-semibold flex items-center gap-2">
            <span>✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="p-4 rounded-none bg-rose-50 border border-rose-200 text-[#A33B47] text-xs font-semibold space-y-1">
            <div class="font-bold flex items-center gap-1.5">
                <span>✕</span>
                <span>Please correct the errors below:</span>
            </div>
            <ul class="list-disc list-inside text-[11px] font-normal space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ── TAB 1: STUDIO & WHATSAPP CONFIGURATION ── -->
    @if($activeTab !== 'security')
        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
            @csrf

            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <h2 class="font-serif text-xl font-bold text-[#171412] border-b border-[#ECE6DE] pb-3">WhatsApp &amp; Ordering Channels</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">WhatsApp Number (Numeric with country code) *</label>
                        <input 
                            type="text" 
                            name="whatsapp_number" 
                            value="{{ old('whatsapp_number', \App\Models\SiteSetting::get('whatsapp_number', '917016266727')) }}" 
                            required 
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-sm font-mono font-bold focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                        <p class="text-[10px] text-[#8C7A6B]">Used for all 1-Click WhatsApp buy links &amp; Bag checkout (e.g. 917016266727).</p>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Display Phone Number</label>
                        <input 
                            type="text" 
                            name="phone" 
                            value="{{ old('phone', \App\Models\SiteSetting::get('phone', '+91 7016266727')) }}" 
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Instagram Profile URL</label>
                        <input 
                            type="text" 
                            name="instagram_url" 
                            value="{{ old('instagram_url', \App\Models\SiteSetting::get('instagram_url', 'https://www.instagram.com/recolte_gelpolish/')) }}" 
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Instagram Handle</label>
                        <input 
                            type="text" 
                            name="instagram_handle" 
                            value="{{ old('instagram_handle', \App\Models\SiteSetting::get('instagram_handle', '@recolte_gelpolish')) }}" 
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                    </div>

                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Consultation Hours</label>
                        <input 
                            type="text" 
                            name="consultation_hours" 
                            value="{{ old('consultation_hours', \App\Models\SiteSetting::get('consultation_hours', '9:00 AM – 6:30 PM (Mon – Sat)')) }}" 
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                    </div>

                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Top Announcement Bar Text</label>
                        <input 
                            type="text" 
                            name="announcement_bar" 
                            value="{{ old('announcement_bar', \App\Models\SiteSetting::get('announcement_bar', '✨ Complimentary Luxury Sizing Prep Kit with Every Order • Handcrafted in Paris & Studio Express Direct')) }}" 
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="px-8 py-3.5 rounded-none bg-[#A33B47] hover:bg-[#882F3A] text-white text-xs font-bold uppercase tracking-[0.18em] shadow-xs hover:shadow-md transition-all cursor-pointer border border-[#A33B47]"
                >
                    Save Studio Settings →
                </button>
            </div>
        </form>
    @endif

    <!-- ── TAB 2: ADMIN ACCESS & PASSWORD SETTINGS ── -->
    @if($activeTab === 'security')
        <form method="POST" action="{{ route('admin.settings.security.update') }}" class="space-y-6">
            @csrf

            <!-- Information Callout -->
            <div class="p-4 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-xs text-[#6A625A] space-y-1">
                <div class="font-bold text-[#171412] flex items-center gap-1.5">
                    <span>🛡️</span>
                    <span>Admin Panel Access Security</span>
                </div>
                <p>
                    These credentials control administrator access to the Recolte Nails Atelier CMS. You can sign in using either your <strong>Username</strong> or your <strong>Email Address</strong>.
                </p>
            </div>

            <!-- Identity & Username Card -->
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <h2 class="font-serif text-xl font-bold text-[#171412] border-b border-[#ECE6DE] pb-3">Administrator Identity &amp; Login Details</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Admin Username -->
                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">
                            Admin Username *
                        </label>
                        <input 
                            type="text" 
                            name="username" 
                            value="{{ old('username', $user->username ?? 'admin') }}" 
                            required 
                            placeholder="e.g. admin"
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-sm font-mono font-bold focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                        <p class="text-[10px] text-[#8C7A6B]">You can type this username directly on the CMS login screen.</p>
                    </div>

                    <!-- Administrator Display Name -->
                    <div class="space-y-1.5">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">
                            Administrator Display Name *
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $user->name ?? 'Recolte Atelier Admin') }}" 
                            required 
                            placeholder="e.g. Recolte Atelier Admin"
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-semibold focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                        <p class="text-[10px] text-[#8C7A6B]">Displayed in the admin sidebar and dashboard greetings.</p>
                    </div>

                    <!-- Admin Email Address -->
                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">
                            Admin Email Address *
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $user->email ?? 'admin@recoltenails.com') }}" 
                            required 
                            placeholder="admin@recoltenails.com"
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                        <p class="text-[10px] text-[#8C7A6B]">Alternative sign-in credential and destination for system notifications.</p>
                    </div>
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="p-6 sm:p-8 rounded-none bg-white border border-[#ECE6DE] space-y-6 shadow-2xs">
                <div class="border-b border-[#ECE6DE] pb-3 space-y-1">
                    <h2 class="font-serif text-xl font-bold text-[#171412]">Change Admin Password</h2>
                    <p class="text-[11px] text-[#8C7A6B]">Leave the password fields blank if you do not want to change your current password.</p>
                </div>

                <div class="space-y-4">
                    <!-- Current Password -->
                    <div class="space-y-1.5 max-w-md">
                        <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">
                            Current Password
                        </label>
                        <input 
                            type="password" 
                            name="current_password" 
                            placeholder="Required only when changing password"
                            class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                        />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <!-- New Password -->
                        <div class="space-y-1.5">
                            <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">
                                New Password
                            </label>
                            <input 
                                type="password" 
                                name="new_password" 
                                placeholder="Minimum 6 characters"
                                class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                            />
                        </div>

                        <!-- Confirm New Password -->
                        <div class="space-y-1.5">
                            <label class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">
                                Confirm New Password
                            </label>
                            <input 
                                type="password" 
                                name="new_password_confirmation" 
                                placeholder="Re-enter new password"
                                class="w-full px-4 py-2.5 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="px-8 py-3.5 rounded-none bg-[#A33B47] hover:bg-[#882F3A] text-white text-xs font-bold uppercase tracking-[0.18em] shadow-xs hover:shadow-md transition-all cursor-pointer border border-[#A33B47]"
                >
                    Update Admin Credentials →
                </button>
            </div>
        </form>
    @endif

</div>
@endsection