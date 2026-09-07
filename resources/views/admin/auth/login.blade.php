<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FAF8F5]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atelier CMS Sign In — Récolte Nails Paris</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full text-charcoal font-sans antialiased bg-[#FAF8F5] flex items-center justify-center p-4 relative overflow-hidden">
    
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-rose-dark/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-rose-light/50 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md bg-white border border-charcoal/10 rounded-3xl p-8 sm:p-10 shadow-xl relative z-10 space-y-6">
        
        <div class="text-center space-y-3">
            <div class="inline-flex px-4 py-2 rounded-2xl bg-[#FAF8F5] border border-charcoal/10 shadow-xs">
                <img src="{{ asset('images/logo.png') }}" alt="Récolte Logo" class="h-9 w-auto object-contain select-none">
            </div>
            <div>
                <h1 class="font-serif text-2xl font-bold text-charcoal tracking-wide">Récolte Nails Paris</h1>
                <p class="text-[11px] text-rose-dark font-extrabold tracking-widest uppercase">ATELIER CMS STUDIO LOGIN</p>
            </div>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf

            <div class="space-y-1.5">
                <label for="email" class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Admin Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', 'admin@recoltenails.com') }}" 
                    required 
                    autofocus
                    class="w-full px-4 py-3 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-sm focus:outline-none focus:border-rose-dark focus:bg-white focus:ring-1 focus:ring-rose-dark transition-all"
                    placeholder="admin@recoltenails.com"
                />
            </div>

            <div class="space-y-1.5">
                <label for="password" class="text-xs font-bold uppercase tracking-wider text-charcoal/70 block">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    value="RecolteAdmin2026!"
                    required 
                    class="w-full px-4 py-3 rounded-2xl bg-[#FAF8F5] border border-charcoal/15 text-charcoal text-sm focus:outline-none focus:border-rose-dark focus:bg-white focus:ring-1 focus:ring-rose-dark transition-all"
                    placeholder="••••••••••••"
                />
            </div>

            <div class="flex items-center justify-between text-xs text-charcoal/70 pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-charcoal/20 text-rose-dark focus:ring-0">
                    <span>Keep me signed in</span>
                </label>
            </div>

            <button 
                type="submit" 
                class="w-full py-3.5 px-6 rounded-2xl bg-rose-dark hover:bg-[#852C37] text-white text-sm font-bold shadow-md transition-all hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer pt-2"
                style="background-color: #A33B47; color: #FFFFFF;"
            >
                <span>Enter Atelier CMS Studio</span>
                <span>→</span>
            </button>
        </form>

        <div class="pt-2 text-center text-xs text-charcoal/60">
            <a href="{{ route('home') }}" class="hover:text-rose-dark transition-colors font-medium">← Return to Public Storefront</a>
        </div>

    </div>
</body>
</html>