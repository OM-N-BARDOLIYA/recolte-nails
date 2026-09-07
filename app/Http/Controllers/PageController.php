<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\PageContent;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
            public function about()
    {
        $hero = PageContent::getSection('about', 'hero', [
            'stories' => [
                [
                    'badge' => '✦ HAUTE NAIL ATELIER & CRAFTSMANSHIP',
                    'title' => 'Crafted for Beauty. <br /><span class="font-serif italic font-normal text-rose-dark">Engineered for Nail Health.</span>',
                    'p1' => 'Born from a passion for runway aesthetics and damage-free natural nail care, <strong>Récolte Nails</strong> redefines modern manicures. We bridge the gap between instant, reusable luxury press-on art and professional-grade BIAB builder gel therapy.',
                    'p2' => 'Every press-on set in our atelier is meticulously built with 7 layers of premium Japanese salon gel, hand-buffed with genuine pearl chrome, and shaped to your exact millimeter nail curve for a seamless 4-week wear that looks 100% salon-sculpted.',
                    'img' => 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=1000&q=85',
                ],
                [
                    'badge' => '✦ 7-LAYER GEL ARCHITECTURE',
                    'title' => 'Seven Optical Layers. <br /><span class="font-serif italic font-normal text-rose-dark">Zero salon waiting time.</span>',
                    'p1' => 'Unlike cheap factory plastics that snap and pop off, Récolte nail suites are built with the same multi-stage UV gel curing process used in Tokyo and Parisian high-end nail salons.',
                    'p2' => 'The result is a glass-smooth apex with ultra-thin, flexible cuticle borders that mold invisibly against your nail bed with zero pinching or lifting.',
                    'img' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=1000&q=85',
                ],
                [
                    'badge' => '✦ 24K BOTANICAL NOURISHMENT',
                    'title' => 'Pure Damask Rose. <br /><span class="font-serif italic font-normal text-rose-dark">Infused with 24K Gold.</span>',
                    'p1' => 'We believe cuticle care is skincare. Our signature elixirs are cold-pressed in small batches, infusing pure Moroccan Argan and Damask Rose essential oils with suspended 24K cosmetic gold flakes.',
                    'p2' => 'Deeply hydrates nail matrices, heals cracked skin, and stimulates rapid natural nail growth without greasy residue.',
                    'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1000&q=85',
                ],
                [
                    'badge' => '✦ BESPOKE SIZING CONCIERGE',
                    'title' => '100% Guaranteed Fit. <br /><span class="font-serif italic font-normal text-rose-dark">Or we remake it free.</span>',
                    'p1' => 'Finding your size should never be stressful. Send a quick photo of your hand next to a coin over WhatsApp, and our studio artists map your exact millimeter measurements in 2 minutes.',
                    'p2' => 'Every order includes our salon prep suite: dual-grit etched buffer, medical adhesive tabs, liquid salon resin, and prep wipes in a keepsake velvet presentation box.',
                    'img' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            'card_badge' => '100% Damage-Free',
            'card_badge_sub' => 'Natural Nail Safe',
            'card_stat_num' => '+120,000',
            'card_stat_label' => 'CUSTOM SETS DELIVERED',
            'btn1_text' => 'Explore Nail Catalog ↗',
            'btn1_url' => '/products',
            'btn2_text' => 'WhatsApp Sizing Help 💬',
            'btn2_url' => 'https://wa.me/917016266727',
        ]);

        $pillars = PageContent::getSection('about', 'pillars', [
            'header_tag' => 'The Récolte Standard',
            'header_title' => 'Why Discerning Clients Choose Récolte Nails',
            'header_desc' => 'We believe true nail luxury is an art form. Our formulas and handmade press-on architecture are engineered with zero compromises.',
            'p1_icon' => '💎',
            'p1_title' => '7-Layer Japanese Gel',
            'p1_desc' => 'Each press-on set features 7 distinct UV-cured layers of Japanese salon gel polish, giving it unmatched thickness, strength, and glass-like gloss.',
            'p1_tag' => 'Reusable 5+ Times',
            'p2_icon' => '✨',
            'p2_title' => 'BIAB™ Reinforcement',
            'p2_desc' => 'Our soak-off builder gels protect damaged, bending, or paper-thin natural nails. Formulated with Pro-Vitamin B5 for natural 4+ week growth.',
            'p2_tag' => 'Zero Heat Spikes',
            'p3_icon' => '🌿',
            'p3_title' => '24K Damask Rose Elixir',
            'p3_desc' => 'Pure cold-pressed Moroccan Argan and Damask Rose essential oils infused with suspended 24K gold flakes to rapidly heal cuticles and strengthen nail roots.',
            'p3_tag' => '100% Organic Botanical',
            'p4_icon' => '📏',
            'p4_title' => 'Bespoke Caliper Sizing',
            'p4_desc' => 'Never worry about ill-fitting press-on nails. Our WhatsApp nail concierges guide you with coin-comparison sizing or bespoke sizing kits in 2 minutes.',
            'p4_tag' => '100% Guaranteed Fit',
        ]);

        $steps = PageContent::getSection('about', 'steps', [
            'header_tag' => 'FROM PARISIAN SKETCH TO YOUR DOORSTEP',
            'header_title' => 'The 4-Step Atelier Creation Journey',
            'header_desc' => 'Every suite of Récolte Nails press-on couture is individually handcrafted and quality-inspected by certified salon artists before leaving our studio.',
            'step1_num' => '01',
            'step1_tag' => 'CONSULTATION',
            'step1_title' => 'WhatsApp Sizing & Curve Mapping',
            'step1_desc' => 'Send a quick photo of your hand or your millimeter kit measurements. Our artists review your nail bed width and curvature to ensure perfect cuticle alignment.',
            'step2_num' => '02',
            'step2_tag' => 'SCULPTING',
            'step2_title' => '7-Layer Gel Architecture',
            'step2_desc' => 'Our master nail couturiers apply 7 UV-cured coats of authentic Japanese salon gel over flexible apex tips for chip-proof durability and natural flex.',
            'step3_num' => '03',
            'step3_tag' => 'EMBELLISHMENT',
            'step3_title' => 'Hand-Painted Haute Art',
            'step3_desc' => 'Chrome glazed powders, micro gold leafing, 3D textured cat-eye magnetic beams, and Swarovski crystals are meticulously hand-detailed by senior artists.',
            'step4_num' => '04',
            'step4_tag' => 'PACKAGING',
            'step4_title' => 'Bespoke Keepsake Velvet Box',
            'step4_desc' => 'Sealed in our signature rose gold Parisian keepsake box with dual-grit buffer, 24 salon adhesive tabs, liquid resin, cuticle wood stick, and prep pads.',
        ]);

        $concierge = PageContent::getSection('about', 'concierge', [
            'badge' => '✦ Private Atelier Service',
            'title' => 'Your Dream Manicure, Curated in Real-Time.',
            'desc' => 'Have custom design inspiration or unique nail dimensions? Connect directly with our Parisian studio specialists on WhatsApp for 1-on-1 sizing guidance, shape matching, and express atelier crafting.',
            'f1_title' => '⚡ 2-Min Sizing',
            'f1_desc' => 'Millimeter curve fit',
            'f2_title' => '🎨 Custom Inspo',
            'f2_desc' => 'Send Pinterest & photos',
            'f3_title' => '📦 Haute Box',
            'f3_desc' => 'Full prep & glue kit',
            'status_text' => 'Master Artists Online Now • Direct WhatsApp Response',
            'btn1_text' => 'Order Bespoke Nails on WhatsApp 💬',
            'btn1_url' => 'https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20would%20like%20to%20order%20a%20bespoke%20nail%20set.',
            'btn2_text' => 'Explore Ready-to-Wear Catalog ↗',
            'btn2_url' => '/products',
        ]);

        $instagram = PageContent::getSection('about', 'instagram', [
            'tag' => 'THE RÉCOLTE COMMUNITY',
            'title' => 'As Seen on Discerning Hands Worldwide',
            'handle' => '@recoltenails.paris',
            'img1' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80',
            'img2' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=600&q=80',
            'img3' => 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80',
            'img4' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80',
        ]);

        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('about', compact('hero', 'pillars', 'steps', 'concierge', 'instagram', 'settings'));
    }

    public function contact()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('contact', compact('settings'));
    }

    public function submitInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Inquiry::create($validated);

        return back()->with('success', 'Thank you! Your message has been received by our studio concierge.');
    }
}
