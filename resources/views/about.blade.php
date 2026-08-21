@extends("layouts.app")
@section("title", "Heritage | Maison Eclat Paris")
@section("content")

{{-- Hero --}}
<section class="relative py-24 bg-bg overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-blush/30 blob-1 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-sand/40 blob-2 blur-2xl pointer-events-none"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8 animate-fade-up">
                <div class="section-badge">Our Story</div>
                <h1 class="font-serif text-5xl sm:text-6xl font-bold text-charcoal leading-tight">
                    Rooted in<br><span class="text-gradient italic">Parisian Alchemy</span>
                </h1>
                <p class="text-muted text-base font-light leading-relaxed">
                    Maison Eclat was born in a small atelier in Grasse, France — the perfume capital of the world. Founded by a team of Parisian botanists and beauty chemists, we blend centuries-old French formulation traditions with cutting-edge bio-active science.
                </p>
                <p class="text-muted text-sm font-light leading-relaxed">
                    Every product in our catalog is crafted in small batches, ensuring uncompromising quality, potency, and sensorial delight. We believe beauty should be intentional, transparent, and transformative.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route("products.index") }}" class="btn-primary">Shop Collection</a>
                    <a href="{{ route("contact") }}" class="btn-outline">Contact Us</a>
                </div>
            </div>
            <div class="relative hidden lg:block">
                <div class="absolute -inset-4 bg-gradient-to-br from-blush/30 to-sand/20 blob-3 -z-10"></div>
                <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=85"
                     alt="Parisian Atelier"
                     class="w-full rounded-3xl object-cover aspect-[4/5] shadow-floating">
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="py-20 bg-sand-light/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <div class="section-badge mx-auto mb-3">Our Principles</div>
            <h2 class="font-serif text-4xl font-bold text-charcoal">What We <span class="text-gradient italic">Stand For</span></h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            @foreach([
                ["icon" => "🌿", "title" => "Pure Botanicals", "desc" => "We source only certified organic botanicals from sustainable farms in Provence, ensuring each ingredient meets our strict purity standards."],
                ["icon" => "🔬", "title" => "Science-Backed", "desc" => "Our formulas combine centuries of French herbalism with modern bio-active science, validated by independent dermatology labs."],
                ["icon" => "♻️", "title" => "Sustainably Made", "desc" => "Carbon-neutral production, glass packaging, and fully recyclable materials. Beauty should not cost the planet its beauty."],
            ] as $v)
            <div class="bg-white rounded-2xl p-8 border border-sand/60 hover:shadow-luxury transition-all duration-300 text-center group">
                <div class="text-4xl mb-5">{{ $v["icon"] }}</div>
                <h3 class="font-serif text-xl font-bold text-charcoal mb-3 group-hover:text-mauve transition-colors">{{ $v["title"] }}</h3>
                <p class="text-sm text-muted font-light leading-relaxed">{{ $v["desc"] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="py-16 bg-charcoal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 text-center">
            @foreach([
                ["number" => "200+", "label" => "Formulations"],
                ["number" => "10K+", "label" => "Happy Clients"],
                ["number" => "4.9★", "label" => "Avg Rating"],
                ["number" => "5+", "label" => "Years of Excellence"],
            ] as $stat)
            <div>
                <div class="font-serif text-4xl font-bold text-gradient mb-1">{{ $stat["number"] }}</div>
                <div class="text-xs text-white/50 font-medium uppercase tracking-wider">{{ $stat["label"] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Team / Story --}}
<section class="py-20 bg-bg">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="section-badge mx-auto mb-4">The Founders</div>
        <h2 class="font-serif text-4xl font-bold text-charcoal mb-6">Made with <span class="text-gradient italic">Love & Expertise</span></h2>
        <p class="text-muted text-sm leading-relaxed mb-10 font-light">
            Our founding team of three — a master perfumer from Grasse, a Parisian cosmetic chemist, and a holistic skincare therapist — united with one vision: to create beauty that truly works, using the finest nature has to offer. Every product is their joint signature.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach([
                ["name" => "Isabelle Moreau", "role" => "Master Perfumer", "initials" => "IM"],
                ["name" => "Claude Bernard", "role" => "Lead Cosmetic Chemist", "initials" => "CB"],
                ["name" => "Sophie Laurent", "role" => "Holistic Skincare Director", "initials" => "SL"],
            ] as $member)
            <div class="bg-white rounded-2xl p-6 border border-sand/60 shadow-soft text-center hover:shadow-luxury transition-all duration-300">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blush via-mauve to-sand flex items-center justify-center text-white font-serif font-bold text-xl mx-auto mb-4">{{ $member["initials"] }}</div>
                <div class="font-serif font-bold text-charcoal">{{ $member["name"] }}</div>
                <div class="text-xs text-muted mt-1">{{ $member["role"] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
