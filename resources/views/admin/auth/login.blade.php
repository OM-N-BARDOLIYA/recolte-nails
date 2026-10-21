<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FAF8F5]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atelier CMS Sign In — Recolte Nails Paris</title>
    
    <!-- Clean, Highly Legible & Professional Admin Typography: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v={{ time() }}">
    @vite(['resources/css/app.css'])

    <style>
        :root {
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --font-serif: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }
        html, body {
            height: 100vh !important;
            height: 100dvh !important;
            overflow: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        body, input, button, p, span, div, label, .font-sans {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
            letter-spacing: -0.011em;
        }
        .font-serif, h1, h2, h3, .font-display {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
            letter-spacing: -0.025em;
        }
        .tracking-\[0\.22em\], .tracking-\[0\.18em\], .tracking-\[0\.16em\], .tracking-widest {
            letter-spacing: 0.06em !important;
        }
    </style>
</head>

<body class="h-screen h-[100dvh] w-full text-[#171412] font-sans antialiased bg-[#FAF8F5] flex items-center justify-center p-4 relative overflow-hidden selection:bg-[#FBEFE9] selection:text-[#A33B47]">
    
    <!-- Atmospheric Luxury Gradients (constrained) -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-[#C5A880]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-[#A33B47]/5 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md bg-white border border-[#ECE6DE] rounded-none p-8 sm:p-10 shadow-xs relative z-10 space-y-6">
        
        <div class="text-center space-y-3">
            <div class="flex justify-center">
                <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Recolte Logo" class="h-11 w-auto object-contain select-none">
            </div>
            <div>
                <h1 class="font-serif text-2xl font-bold text-[#171412] tracking-wide">Recolte Nails Paris</h1>
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
                <label for="login" class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Username or Email Address</label>
                <input 
                    type="text" 
                    id="login" 
                    name="login" 
                    value="{{ old('login') }}" 
                    required 
                    autofocus
                    autocomplete="username"
                    class="w-full px-4 py-3 rounded-none bg-[#FAF8F5] border border-[#ECE6DE] text-[#171412] text-xs sm:text-sm font-medium focus:outline-none focus:border-[#171412] focus:bg-white focus:ring-1 focus:ring-[#171412]/15 transition-all"
                    placeholder="Enter your username or email"
                />
            </div>

            <div class="space-y-1.5">
                <label for="password" class="text-[10.5px] font-semibold uppercase tracking-[0.16em] text-[#6A625A] block">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    autocomplete="current-password"
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
                class="w-full h-12 px-6 rounded-none bg-[#171412] hover:bg-black text-white text-xs font-bold uppercase tracking-[0.18em] transition-colors flex items-center justify-center gap-2 cursor-pointer select-none"
            >
                <span>Enter Atelier CMS Studio</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>

        <div class="pt-2 text-center text-xs text-[#736B63]">
            <a href="{{ route('home') }}" class="hover:text-[#A33B47] transition-colors font-medium">← Return to Public Storefront</a>
        </div>

    </div>
</body>
</html>