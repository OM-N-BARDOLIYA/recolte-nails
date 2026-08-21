@extends('layouts.app')

@section('title', '404 - Page Not Found | Maison Éclat Paris')

@section('content')
<section class="py-24 bg-cream text-center">
    <div class="max-w-md mx-auto px-4 space-y-6">
        <div class="font-serif text-6xl font-bold text-rose-dark">404</div>
        <h1 class="font-serif text-2xl font-bold text-charcoal">Formulation Not Found</h1>
        <p class="text-xs text-charcoal-muted font-light">The page or product you are looking for has been moved or curated elsewhere.</p>
        <a href="{{ route('home') }}" class="inline-block px-8 py-3.5 rounded-2xl bg-rose text-white text-xs font-bold shadow-sm">Return To Home</a>
    </div>
</section>
@endsection
