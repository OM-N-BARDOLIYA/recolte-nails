<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function home()
    {
        $hero = PageContent::getSection('home', 'hero', []);
        $pillars = PageContent::getSection('home', 'pillars', []);
        $rituals = PageContent::getSection('home', 'rituals', []);
        $philosophy = PageContent::getSection('home', 'philosophy', []);
        $instagram = PageContent::getSection('home', 'instagram', []);

        return view('admin.pages.home', compact('hero', 'pillars', 'rituals', 'philosophy', 'instagram'));
    }

        public function updateHome(Request $request)
    {
        $hero = PageContent::getSection('home', 'hero', []);

        // Handle image file uploads if provided
        $leftImg = $hero['left_card_image'] ?? 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80';
        if ($request->hasFile('hero_left_card_image_file')) {
            $file = $request->file('hero_left_card_image_file');
            $name = 'hero_left_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $name);
            $leftImg = asset('uploads/pages/' . $name);
        } elseif ($request->filled('hero_left_card_image')) {
            $leftImg = $request->input('hero_left_card_image');
        }

        $topRightImg = $hero['top_right_image'] ?? 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80';
        if ($request->hasFile('hero_top_right_image_file')) {
            $file = $request->file('hero_top_right_image_file');
            $name = 'hero_topright_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $name);
            $topRightImg = asset('uploads/pages/' . $name);
        } elseif ($request->filled('hero_top_right_image')) {
            $topRightImg = $request->input('hero_top_right_image');
        }

        $miniBannerImg = $hero['mini_banner_image'] ?? 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80';
        if ($request->hasFile('hero_mini_banner_image_file')) {
            $file = $request->file('hero_mini_banner_image_file');
            $name = 'hero_banner_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $name);
            $miniBannerImg = asset('uploads/pages/' . $name);
        } elseif ($request->filled('hero_mini_banner_image')) {
            $miniBannerImg = $request->input('hero_mini_banner_image');
        }

        // 1. Hero
        PageContent::setSection('home', 'hero', [
            'badge' => $request->input('hero_badge'),
            'title' => $request->input('hero_title'),
            'subtitle' => $request->input('hero_subtitle'),
            'cta_text' => $request->input('hero_cta_text', 'Explore Nail Collection ↗'),
            'cta_url' => $request->input('hero_cta_url', '/products'),
            'left_card_tag' => $request->input('hero_left_card_tag'),
            'left_card_title' => $request->input('hero_left_card_title'),
            'left_card_image' => $leftImg,
            'left_card_link' => $request->input('hero_left_card_link', '/products'),
            'top_right_image' => $topRightImg,
            'top_right_link' => $request->input('hero_top_right_link', '/products'),
            'mini_banner_image' => $miniBannerImg,
            'mini_banner_title' => $request->input('hero_mini_banner_title'),
            'mini_banner_desc' => $request->input('hero_mini_banner_desc'),
            'mini_banner_btn' => $request->input('hero_mini_banner_btn'),
            'mini_banner_url' => $request->input('hero_mini_banner_url'),
            'metric_number' => $request->input('hero_metric_number'),
            'metric_title' => $request->input('hero_metric_title'),
            'metric_text' => $request->input('hero_metric_text'),
        ]);

        // 2. Dual Showcase Section ("Unlock Your Best Nails")
        PageContent::setSection('home', 'pillars', [
            'title_line1' => $request->input('title_line1', 'Unlock Your Best'),
            'title_line2' => $request->input('title_line2', 'Nails:'),
            'title_line3' => $request->input('title_line3', 'Trusted by'),
            'title_line4' => $request->input('title_line4', 'Nail Enthusiasts'),
            'proof_title' => $request->input('proof_title', 'Shop with Confidence'),
            'proof_sub' => $request->input('proof_sub', '10K+ Happy Custom Sets'),
            'cta_text' => $request->input('pillars_cta_text', 'Shop Nail Bestsellers'),
            'cta_url' => $request->input('pillars_cta_url', '/products'),
            'card1_image' => $request->input('card1_image'),
            'card1_link' => $request->input('card1_link', '/products/french-pearl-chrome-press-on-set'),
            'card1_tag1' => $request->input('card1_tag1', '#HandmadePressOns'),
            'card1_tag2' => $request->input('card1_tag2', '#GlazedNails'),
            'card2_image' => $request->input('card2_image'),
            'card2_link' => $request->input('card2_link', '/products/velvet-cat-eye-magnetic-gel-polish'),
            'card2_tag1' => $request->input('card2_tag1', '#VelvetNails'),
            'card2_tag2' => $request->input('card2_tag2', '#CatEyeGel'),
        ]);

        // 3. Rituals
        PageContent::setSection('home', 'rituals', [
            'badge' => $request->input('rituals_badge'),
            'title' => $request->input('rituals_title'),
            'subtitle' => $request->input('rituals_subtitle'),
            'card1_title' => $request->input('ritual1_title'),
            'card1_sub' => $request->input('ritual1_sub'),
            'card1_img' => $request->input('ritual1_img'),
            'card2_title' => $request->input('ritual2_title'),
            'card2_sub' => $request->input('ritual2_sub'),
            'card2_img' => $request->input('ritual2_img'),
            'card3_title' => $request->input('ritual3_title'),
            'card3_sub' => $request->input('ritual3_sub'),
            'card3_img' => $request->input('ritual3_img'),
            'card4_title' => $request->input('ritual4_title'),
            'card4_sub' => $request->input('ritual4_sub'),
            'card4_img' => $request->input('ritual4_img'),
            'editorial_quote' => $request->input('editorial_quote'),
            'editorial_desc' => $request->input('editorial_desc'),
        ]);

        // 4. Philosophy
        PageContent::setSection('home', 'philosophy', [
            'badge' => $request->input('phil_badge'),
            'title' => $request->input('phil_title'),
            'p1_title' => $request->input('phil_p1_title'),
            'p1_desc' => $request->input('phil_p1_desc'),
            'p2_title' => $request->input('phil_p2_title'),
            'p2_desc' => $request->input('phil_p2_desc'),
            'p3_title' => $request->input('phil_p3_title'),
            'p3_desc' => $request->input('phil_p3_desc'),
        ]);

        // 5. Instagram
        PageContent::setSection('home', 'instagram', [
            'badge' => $request->input('insta_badge'),
            'title' => $request->input('insta_title'),
            'subtitle' => $request->input('insta_subtitle'),
            'btn_text' => $request->input('insta_btn_text'),
            'btn_url' => $request->input('insta_btn_url'),
        ]);

        return back()->with('success', 'All Homepage sections and content updated successfully!');
    }

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

        return view('admin.pages.about', compact('hero', 'pillars', 'steps', 'concierge', 'instagram'));
    }

    public function updateAbout(Request $request)
    {
        // 1. Hero Stories & Showcase Card
        $existingHero = PageContent::getSection('about', 'hero', []);
        $stories = [];
        for ($i = 0; $i < 4; $i++) {
            $storyImg = $request->input("story_{$i}_img", $existingHero['stories'][$i]['img'] ?? '');
            if ($request->hasFile("story_{$i}_img_file")) {
                $f = $request->file("story_{$i}_img_file");
                $fn = "about_hero_{$i}_" . time() . '.' . $f->getClientOriginalExtension();
                $f->move(public_path('uploads/pages'), $fn);
                $storyImg = asset('uploads/pages/' . $fn);
            }

            $stories[] = [
                'badge' => $request->input("story_{$i}_badge", '✦ HAUTE NAIL ATELIER & CRAFTSMANSHIP'),
                'title' => $request->input("story_{$i}_title", 'Crafted for Beauty.'),
                'p1' => $request->input("story_{$i}_p1", ''),
                'p2' => $request->input("story_{$i}_p2", ''),
                'img' => $storyImg,
            ];
        }

        PageContent::setSection('about', 'hero', [
            'stories' => $stories,
            'card_badge' => $request->input('card_badge', '100% Damage-Free'),
            'card_badge_sub' => $request->input('card_badge_sub', 'Natural Nail Safe'),
            'card_stat_num' => $request->input('card_stat_num', '+120,000'),
            'card_stat_label' => $request->input('card_stat_label', 'CUSTOM SETS DELIVERED'),
            'btn1_text' => $request->input('hero_btn1_text', 'Explore Nail Catalog ↗'),
            'btn1_url' => $request->input('hero_btn1_url', '/products'),
            'btn2_text' => $request->input('hero_btn2_text', 'WhatsApp Sizing Help 💬'),
            'btn2_url' => $request->input('hero_btn2_url', 'https://wa.me/917016266727'),
        ]);

        // 2. Pillars
        PageContent::setSection('about', 'pillars', [
            'header_tag' => $request->input('pillars_header_tag', 'The Récolte Standard'),
            'header_title' => $request->input('pillars_header_title', 'Why Discerning Clients Choose Récolte Nails'),
            'header_desc' => $request->input('pillars_header_desc', ''),
            'p1_icon' => $request->input('p1_icon', '💎'),
            'p1_title' => $request->input('p1_title', '7-Layer Japanese Gel'),
            'p1_desc' => $request->input('p1_desc', ''),
            'p1_tag' => $request->input('p1_tag', 'Reusable 5+ Times'),
            'p2_icon' => $request->input('p2_icon', '✨'),
            'p2_title' => $request->input('p2_title', 'BIAB™ Reinforcement'),
            'p2_desc' => $request->input('p2_desc', ''),
            'p2_tag' => $request->input('p2_tag', 'Zero Heat Spikes'),
            'p3_icon' => $request->input('p3_icon', '🌿'),
            'p3_title' => $request->input('p3_title', '24K Damask Rose Elixir'),
            'p3_desc' => $request->input('p3_desc', ''),
            'p3_tag' => $request->input('p3_tag', '100% Organic Botanical'),
            'p4_icon' => $request->input('p4_icon', '📏'),
            'p4_title' => $request->input('p4_title', 'Bespoke Caliper Sizing'),
            'p4_desc' => $request->input('p4_desc', ''),
            'p4_tag' => $request->input('p4_tag', '100% Guaranteed Fit'),
        ]);

        // 3. Steps Timeline
        PageContent::setSection('about', 'steps', [
            'header_tag' => $request->input('steps_header_tag', 'FROM PARISIAN SKETCH TO YOUR DOORSTEP'),
            'header_title' => $request->input('steps_header_title', 'The 4-Step Atelier Creation Journey'),
            'header_desc' => $request->input('steps_header_desc', ''),
            'step1_num' => $request->input('step1_num', '01'),
            'step1_tag' => $request->input('step1_tag', 'CONSULTATION'),
            'step1_title' => $request->input('step1_title', 'WhatsApp Sizing & Curve Mapping'),
            'step1_desc' => $request->input('step1_desc', ''),
            'step2_num' => $request->input('step2_num', '02'),
            'step2_tag' => $request->input('step2_tag', 'SCULPTING'),
            'step2_title' => $request->input('step2_title', '7-Layer Gel Architecture'),
            'step2_desc' => $request->input('step2_desc', ''),
            'step3_num' => $request->input('step3_num', '03'),
            'step3_tag' => $request->input('step3_tag', 'EMBELLISHMENT'),
            'step3_title' => $request->input('step3_title', 'Hand-Painted Haute Art'),
            'step3_desc' => $request->input('step3_desc', ''),
            'step4_num' => $request->input('step4_num', '04'),
            'step4_tag' => $request->input('step4_tag', 'PACKAGING'),
            'step4_title' => $request->input('step4_title', 'Bespoke Keepsake Velvet Box'),
            'step4_desc' => $request->input('step4_desc', ''),
        ]);

        // 4. Haute VIP Concierge Banner
        PageContent::setSection('about', 'concierge', [
            'badge' => $request->input('concierge_badge', '✦ Private Atelier Service'),
            'title' => $request->input('concierge_title', 'Your Dream Manicure, Curated in Real-Time.'),
            'desc' => $request->input('concierge_desc', ''),
            'f1_title' => $request->input('f1_title', '⚡ 2-Min Sizing'),
            'f1_desc' => $request->input('f1_desc', 'Millimeter curve fit'),
            'f2_title' => $request->input('f2_title', '🎨 Custom Inspo'),
            'f2_desc' => $request->input('f2_desc', 'Send Pinterest & photos'),
            'f3_title' => $request->input('f3_title', '📦 Haute Box'),
            'f3_desc' => $request->input('f3_desc', 'Full prep & glue kit'),
            'status_text' => $request->input('status_text', 'Master Artists Online Now • Direct WhatsApp Response'),
            'btn1_text' => $request->input('concierge_btn1_text', 'Order Bespoke Nails on WhatsApp 💬'),
            'btn1_url' => $request->input('concierge_btn1_url', 'https://wa.me/917016266727'),
            'btn2_text' => $request->input('concierge_btn2_text', 'Explore Ready-to-Wear Catalog ↗'),
            'btn2_url' => $request->input('concierge_btn2_url', '/products'),
        ]);

        // 5. Instagram Community Gallery
        $existingInsta = PageContent::getSection('about', 'instagram', []);
        $img1 = $request->input('insta_img1', $existingInsta['img1'] ?? '');
        if ($request->hasFile('insta_img1_file')) {
            $f = $request->file('insta_img1_file');
            $fn = 'about_insta1_' . time() . '.' . $f->getClientOriginalExtension();
            $f->move(public_path('uploads/pages'), $fn);
            $img1 = asset('uploads/pages/' . $fn);
        }
        $img2 = $request->input('insta_img2', $existingInsta['img2'] ?? '');
        if ($request->hasFile('insta_img2_file')) {
            $f = $request->file('insta_img2_file');
            $fn = 'about_insta2_' . time() . '.' . $f->getClientOriginalExtension();
            $f->move(public_path('uploads/pages'), $fn);
            $img2 = asset('uploads/pages/' . $fn);
        }
        $img3 = $request->input('insta_img3', $existingInsta['img3'] ?? '');
        if ($request->hasFile('insta_img3_file')) {
            $f = $request->file('insta_img3_file');
            $fn = 'about_insta3_' . time() . '.' . $f->getClientOriginalExtension();
            $f->move(public_path('uploads/pages'), $fn);
            $img3 = asset('uploads/pages/' . $fn);
        }
        $img4 = $request->input('insta_img4', $existingInsta['img4'] ?? '');
        if ($request->hasFile('insta_img4_file')) {
            $f = $request->file('insta_img4_file');
            $fn = 'about_insta4_' . time() . '.' . $f->getClientOriginalExtension();
            $f->move(public_path('uploads/pages'), $fn);
            $img4 = asset('uploads/pages/' . $fn);
        }

        PageContent::setSection('about', 'instagram', [
            'tag' => $request->input('insta_tag', 'THE RÉCOLTE COMMUNITY'),
            'title' => $request->input('insta_title', 'As Seen on Discerning Hands Worldwide'),
            'handle' => $request->input('insta_handle', '@recoltenails.paris'),
            'img1' => $img1,
            'img2' => $img2,
            'img3' => $img3,
            'img4' => $img4,
        ]);

        return back()->with('success', 'All About Atelier sections, hero slides, pillars, timeline, VIP concierge, and Instagram gallery updated successfully!');
    }
}
