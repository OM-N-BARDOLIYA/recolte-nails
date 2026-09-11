<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FAF8F5]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atelier CMS Sign In — Récolte Nails Paris</title>
    
    <!-- Google Fonts: Display Serifs & Refined Sans (100% matched to Storefront) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v={{ time() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full text-[#171412] font-sans antialiased bg-[#FAF8F5] flex items-center justify-center p-4 relative overflow-hidden selection:bg-[#FBEFE9] selection:text-[#A33B47]">
    
    <!-- Atmospheric Luxury Gradients -->
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-[#C5A880]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-[#A33B47]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md bg-white border border-[#ECE6DE] rounded-none p-8 sm:p-10 shadow-xs relative z-10 space-y-6">
        
        <div class="text-center space-y-3">
            <div class="inline-flex px-4 py-2 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] shadow-2xs">
                <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Récolte Logo" class="h-10 w-auto object-contain select-none">
            </div>
            <div>
                <h1 class="font-serif text-2xl font-bold text-[#171412] tracking-wide">Récolte Nails Paris</h1>
                <p class="text-[10px] text-[#8C7A6B] font-semibold tracking-[0.22em] uppercase">ATELIER CMS STUDIO LOGIN</p>
            </div>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-none bg-rose-50 border border-rose-200 text-[#A33B47] text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="p-3.5 rounded-none bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf

            <div class="space-y-1.5">
                <label for="email" class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Admin Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', 'admin@recoltenails.com') }}" 
                    required 
                    autofocus
                    class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs sm:text-sm font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15 transition-all"
                    placeholder="admin@recoltenails.com"
                />
            </div>

            <div class="space-y-1.5">
                <label for="password" class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    value="RecolteAdmin2026!"
                    required 
                    class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs sm:text-sm font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15 transition-all"
                    placeholder="••••••••••••"
                />
            </div>

            <div class="flex items-center justify-between text-xs text-[#736B63] pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded-none border-[#ECE6DE] text-[#171412] focus:ring-0">
                    <span>Keep me signed in</span>
                </label>
            </div>

            <button 
                type="submit" 
                class="w-full py-3.5 px-6 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] shadow-xs hover:shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer pt-2"
            >
                <span>Enter Atelier CMS Studio</span>
                <span>→</span>
            </button>
        </form>

        <div class="pt-2 text-center text-xs text-[#736B63]">
            <a href="{{ route('home') }}" class="hover:text-[#A33B47] transition-colors font-medium">← Return to Public Storefront</a>
        </div>

    </div>
</body>
</html>