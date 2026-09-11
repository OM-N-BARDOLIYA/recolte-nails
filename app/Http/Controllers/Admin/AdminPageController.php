<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function home()
    {
        $hero = PageContent::getSection('home', 'hero', [
            'bg_image' => asset('images/banners/recolte-hd-hero-bg.jpg'),
            'brand_title' => 'Recolte',
            'brand_trademark' => '®',
            'sub_descriptor' => 'NAILS • BEAUTY • YOU',
            'script_line' => 'Create • Express • Shine',
            'subtitle' => 'Premium Nail Products for Professionals & Enthusiasts',
            'cta_text' => 'SHOP NOW',
            'cta_url' => '/products',
        ]);

        $trust_strip = PageContent::getSection('home', 'trust_strip', [
            'items' => [
                ['title' => 'Premium Quality', 'sub' => 'Products', 'icon' => 'diamond'],
                ['title' => 'Safe & Skin Friendly', 'sub' => 'Formulas', 'icon' => 'shield'],
                ['title' => 'Fast & Reliable', 'sub' => 'Shipping', 'icon' => 'truck'],
                ['title' => 'Expert Support', 'sub' => 'Always', 'icon' => 'support'],
                ['title' => 'Trusted by', 'sub' => 'Professionals', 'icon' => 'star'],
            ]
        ]);

        $categories_section = PageContent::getSection('home', 'categories_section', [
            'title' => 'Shop by Category',
            'subtitle' => 'Everything you need for perfect nails',
            'categories' => [
                ['title' => 'Gel Polish', 'btn_text' => 'Shop Now', 'link' => '/products?category=Gel+Polishes', 'image' => asset('images/products/recolte-cat-gel-polish.jpg')],
                ['title' => 'Top Coat', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Care+%26+Elixirs', 'image' => asset('images/products/recolte-cat-top-coat.jpg')],
                ['title' => 'Painting Gel', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Art+%26+Accents', 'image' => asset('images/products/recolte-cat-painting-gel.jpg')],
                ['title' => 'Sets & Kits', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Tools+%26+Kits', 'image' => asset('images/products/recolte-cat-nail-kits.jpg')],
            ]
        ]);

        $showcase = PageContent::getSection('home', 'showcase', [
            'title_line1' => 'Colors that',
            'title_line2' => 'cultivate confidence',
            'description' => 'Dedicated to salon-grade perfection, Japanese gel formulas, and effortless everyday elegance.',
            'btn_text' => 'Find more',
            'btn_url' => '/products',
            'image' => asset('images/banners/recolte-colors-showcase.jpg'),
        ]);

        $instagram = PageContent::getSection('home', 'instagram', [
            'badge' => 'Atelier Community',
            'title' => 'Join Our Nail Community',
            'subtitle' => 'Follow @recolte_gelpolish for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.',
            'handle' => '@recolte_gelpolish',
            'profile_url' => 'https://www.instagram.com/recolte_gelpolish/',
            'btn_text' => 'Follow @recolte_gelpolish',
            'posts' => [
                ['image' => asset('images/products/recolte-cat-gel-polish.jpg'), 'alt' => 'Récolte Gel Polish Collection', 'link' => 'https://www.instagram.com/recolte_gelpolish/'],
                ['image' => asset('images/banners/recolte-acrylic-banner.jpg'), 'alt' => 'Récolte Haute Acrylic & Gel Couture', 'link' => 'https://www.instagram.com/recolte_gelpolish/'],
                ['image' => asset('images/products/recolte-cat-top-coat.jpg'), 'alt' => 'Récolte Rose Gold Finish', 'link' => 'https://www.instagram.com/recolte_gelpolish/'],
                ['image' => asset('images/products/recolte-cat-painting-gel.jpg'), 'alt' => 'Récolte Painting Gel Glitter', 'link' => 'https://www.instagram.com/recolte_gelpolish/'],
                ['image' => asset('images/products/recolte-cat-nail-kits.jpg'), 'alt' => 'Récolte Atelier Arch Sets', 'link' => 'https://www.instagram.com/recolte_gelpolish/'],
            ]
        ]);

        return view('admin.pages.home', compact('hero', 'trust_strip', 'categories_section', 'showcase', 'instagram'));
    }

    public function updateHome(Request $request)
    {
        // 1. Hero Banner
        $existingHero = PageContent::getSection('home', 'hero', []);
        $heroBg = $request->input('hero_bg_image', $existingHero['bg_image'] ?? asset('images/banners/recolte-hd-hero-bg.jpg'));
        if ($request->hasFile('hero_bg_image_file')) {
            $f = $request->file('hero_bg_image_file');
            $fn = 'home_hero_bg_' . time() . '.' . $f->getClientOriginalExtension();
            $f->move(public_path('uploads/pages'), $fn);
            $heroBg = asset('uploads/pages/' . $fn);
        }

        PageContent::setSection('home', 'hero', [
            'bg_image' => $heroBg,
            'brand_title' => $request->input('hero_brand_title', 'Recolte'),
            'brand_trademark' => $request->input('hero_brand_trademark', '®'),
            'sub_descriptor' => $request->input('hero_sub_descriptor', 'NAILS • BEAUTY • YOU'),
            'script_line' => $request->input('hero_script_line', 'Create • Express • Shine'),
            'subtitle' => $request->input('hero_subtitle', 'Premium Nail Products for Professionals & Enthusiasts'),
            'cta_text' => $request->input('hero_cta_text', 'SHOP NOW'),
            'cta_url' => $request->input('hero_cta_url', '/products'),
        ]);

        // 2. Trust Proposition Strip
        $existingTrust = PageContent::getSection('home', 'trust_strip', []);
        $defaultTrust = [
            ['title' => 'Premium Quality', 'sub' => 'Products', 'icon' => 'diamond'],
            ['title' => 'Safe & Skin Friendly', 'sub' => 'Formulas', 'icon' => 'shield'],
            ['title' => 'Fast & Reliable', 'sub' => 'Shipping', 'icon' => 'truck'],
            ['title' => 'Expert Support', 'sub' => 'Always', 'icon' => 'support'],
            ['title' => 'Trusted by', 'sub' => 'Professionals', 'icon' => 'star'],
        ];
        $trustItems = [];
        $defaultIcons = ['diamond', 'shield', 'truck', 'support', 'star'];
        for ($i = 0; $i < 5; $i++) {
            $prevTitle = $existingTrust['items'][$i]['title'] ?? ($defaultTrust[$i]['title'] ?? '');
            $prevSub = $existingTrust['items'][$i]['sub'] ?? ($defaultTrust[$i]['sub'] ?? '');
            $inputTitle = $request->input("trust_{$i}_title");
            $inputSub = $request->input("trust_{$i}_sub");

            $trustItems[] = [
                'title' => ($inputTitle !== null && trim($inputTitle) !== '') ? $inputTitle : $prevTitle,
                'sub' => ($inputSub !== null && trim($inputSub) !== '') ? $inputSub : $prevSub,
                'icon' => $defaultIcons[$i] ?? 'star',
            ];
        }
        PageContent::setSection('home', 'trust_strip', ['items' => $trustItems]);

        // 3. Shop by Category (4 Clean Cards)
        $existingCats = PageContent::getSection('home', 'categories_section', []);
        $defaultCats = [
            ['title' => 'Gel Polish', 'btn_text' => 'Shop Now', 'link' => '/products?category=Gel+Polishes', 'image' => asset('images/products/recolte-cat-gel-polish.jpg')],
            ['title' => 'Top Coat', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Care+%26+Elixirs', 'image' => asset('images/products/recolte-cat-top-coat.jpg')],
            ['title' => 'Painting Gel', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Art+%26+Accents', 'image' => asset('images/products/recolte-cat-painting-gel.jpg')],
            ['title' => 'Sets & Kits', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Tools+%26+Kits', 'image' => asset('images/products/recolte-cat-nail-kits.jpg')],
        ];
        $cats = [];
        for ($i = 0; $i < 4; $i++) {
            $prevCat = $existingCats['categories'][$i] ?? ($defaultCats[$i] ?? []);
            $catImg = $request->input("cat_{$i}_image", $prevCat['image'] ?? '');
            if ($request->hasFile("cat_{$i}_image_file")) {
                $f = $request->file("cat_{$i}_image_file");
                $fn = "home_cat_{$i}_" . time() . '.' . $f->getClientOriginalExtension();
                $f->move(public_path('uploads/pages'), $fn);
                $catImg = asset('uploads/pages/' . $fn);
            }

            $inputTitle = $request->input("cat_{$i}_title");
            $inputBtn = $request->input("cat_{$i}_btn_text");
            $inputLink = $request->input("cat_{$i}_link");

            $cats[] = [
                'title' => ($inputTitle !== null && trim($inputTitle) !== '') ? $inputTitle : ($prevCat['title'] ?? 'Category'),
                'btn_text' => ($inputBtn !== null && trim($inputBtn) !== '') ? $inputBtn : ($prevCat['btn_text'] ?? 'Shop Now'),
                'link' => ($inputLink !== null && trim($inputLink) !== '') ? $inputLink : ($prevCat['link'] ?? '/products'),
                'image' => $catImg ?: ($prevCat['image'] ?? ''),
            ];
        }

        PageContent::setSection('home', 'categories_section', [
            'title' => $request->input('categories_title', $existingCats['title'] ?? 'Shop by Category'),
            'subtitle' => $request->input('categories_subtitle', $existingCats['subtitle'] ?? 'Everything you need for perfect nails'),
            'categories' => $cats,
        ]);

        // 4. Colors Showcase Banner
        $existingShowcase = PageContent::getSection('home', 'showcase', []);
        $showcaseImg = $request->input('showcase_image', $existingShowcase['image'] ?? asset('images/banners/recolte-colors-showcase.jpg'));
        if ($request->hasFile('showcase_image_file')) {
            $f = $request->file('showcase_image_file');
            $fn = 'home_showcase_' . time() . '.' . $f->getClientOriginalExtension();
            $f->move(public_path('uploads/pages'), $fn);
            $showcaseImg = asset('uploads/pages/' . $fn);
        }

        PageContent::setSection('home', 'showcase', [
            'title_line1' => $request->input('showcase_title_line1', 'Colors that'),
            'title_line2' => $request->input('showcase_title_line2', 'cultivate confidence'),
            'description' => $request->input('showcase_description', ''),
            'btn_text' => $request->input('showcase_btn_text', 'Find more'),
            'btn_url' => $request->input('showcase_btn_url', '/products'),
            'image' => $showcaseImg,
        ]);

        // 5. Instagram Community
        $existingInsta = PageContent::getSection('home', 'instagram', []);
        $posts = [];
        for ($i = 0; $i < 5; $i++) {
            $postImg = $request->input("insta_{$i}_image", $existingInsta['posts'][$i]['image'] ?? '');
            if ($request->hasFile("insta_{$i}_image_file")) {
                $f = $request->file("insta_{$i}_image_file");
                $fn = "home_insta_{$i}_" . time() . '.' . $f->getClientOriginalExtension();
                $f->move(public_path('uploads/pages'), $fn);
                $postImg = asset('uploads/pages/' . $fn);
            }

            $posts[] = [
                'image' => $postImg,
                'alt' => $request->input("insta_{$i}_alt", "Récolte Instagram Post {$i}"),
                'link' => $request->input("insta_{$i}_link", 'https://www.instagram.com/recolte_gelpolish/'),
            ];
        }

        PageContent::setSection('home', 'instagram', [
            'badge' => $request->input('insta_badge', 'Atelier Community'),
            'title' => $request->input('insta_title', 'Join Our Nail Community'),
            'subtitle' => $request->input('insta_subtitle', ''),
            'handle' => $request->input('insta_handle', '@recolte_gelpolish'),
            'profile_url' => $request->input('insta_profile_url', 'https://www.instagram.com/recolte_gelpolish/'),
            'btn_text' => $request->input('insta_btn_text', 'Follow @recolte_gelpolish'),
            'posts' => $posts,
        ]);

        return back()->with('success', 'All Homepage sections and content updated successfully in sync with live storefront!');
    }

    public function about()
    {
        $hero = PageContent::getSection('about', 'hero', [
            'stories' => [
                [
                    'badge' => '✦ HAUTE NAIL ATELIER & CRAFTSMANSHIP',
                    'title' => 'Crafted for Beauty. <br /><span class="font-serif italic font-normal text-[#A33B47]">Engineered for Nail Health.</span>',
                    'p1' => 'Born from a passion for runway aesthetics and damage-free natural nail care, <strong>Récolte Nails</strong> redefines modern manicures. We bridge the gap between instant, reusable luxury press-on art and professional-grade Japanese salon gel therapy.',
                    'p2' => 'Every press-on set in our atelier is meticulously built with 7 layers of premium Japanese salon gel, hand-buffed with genuine pearl chrome, and shaped to your exact millimeter nail curve for a seamless 4-week wear that looks 100% salon-sculpted.',
                    'img' => asset('images/banners/recolte-colors-showcase.jpg'),
                ],
                [
                    'badge' => '✦ 7-LAYER GEL ARCHITECTURE',
                    'title' => 'Seven Optical Layers. <br /><span class="font-serif italic font-normal text-[#A33B47]">Zero salon waiting time.</span>',
                    'p1' => 'Unlike cheap factory plastics that snap and pop off, Récolte nail suites are built with the same multi-stage UV gel curing process used in Tokyo and Parisian high-end nail salons.',
                    'p2' => 'The result is a glass-smooth apex with ultra-thin, flexible cuticle borders that mold invisibly against your nail bed with zero pinching or lifting.',
                    'img' => asset('images/banners/recolte-acrylic-banner.jpg'),
                ],
                [
                    'badge' => '✦ 24K BOTANICAL NOURISHMENT',
                    'title' => 'Pure Damask Rose. <br /><span class="font-serif italic font-normal text-[#A33B47]">Infused with 24K Gold.</span>',
                    'p1' => 'We believe cuticle care is skincare. Our signature elixirs are cold-pressed in small batches, infusing pure Moroccan Argan and Damask Rose essential oils with suspended 24K cosmetic gold flakes.',
                    'p2' => 'Deeply hydrates nail matrices, heals cracked skin, and stimulates rapid natural nail growth without greasy residue.',
                    'img' => asset('images/products/recolte-cat-top-coat.jpg'),
                ],
                [
                    'badge' => '✦ BESPOKE SIZING CONCIERGE',
                    'title' => '100% Guaranteed Fit. <br /><span class="font-serif italic font-normal text-[#A33B47]">Or we remake it free.</span>',
                    'p1' => 'Finding your size should never be stressful. Send a quick photo of your hand next to a coin over WhatsApp, and our studio artists map your exact millimeter measurements in 2 minutes.',
                    'p2' => 'Every order includes our salon prep suite: dual-grit etched buffer, medical adhesive tabs, liquid salon resin, and prep wipes in a keepsake velvet presentation box.',
                    'img' => asset('images/products/recolte-cat-nail-kits.jpg'),
                ],
            ],
            'card_badge' => '100% Damage-Free',
            'card_stat_num' => '+120,000',
            'card_stat_label' => 'CUSTOM SETS DELIVERED',
            'btn1_text' => 'Explore Nail Catalog',
            'btn1_url' => '/products',
            'btn2_text' => 'WhatsApp Sizing Help',
            'btn2_url' => 'https://wa.me/917016266727',
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

        $instagram = PageContent::getSection('about', 'instagram', [
            'tag' => 'Atelier Community',
            'title' => 'Join Our Nail Community',
            'subtitle' => 'Follow @recolte_gelpolish for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.',
            'handle' => '@recolte_gelpolish',
            'profile_url' => 'https://www.instagram.com/recolte_gelpolish/',
            'btn_text' => 'Follow @recolte_gelpolish',
            'img1' => asset('images/products/recolte-cat-gel-polish.jpg'),
            'img2' => asset('images/banners/recolte-acrylic-banner.jpg'),
            'img3' => asset('images/products/recolte-cat-top-coat.jpg'),
            'img4' => asset('images/products/recolte-cat-painting-gel.jpg'),
            'img5' => asset('images/products/recolte-cat-nail-kits.jpg'),
        ]);

        $concierge = PageContent::getSection('about', 'concierge', [
            'badge' => 'Private Atelier Service',
            'title' => 'Your Dream Manicure, Curated in Real-Time.',
            'desc' => 'Have custom design inspiration or unique nail dimensions? Connect directly with our Parisian studio specialists on WhatsApp for 1-on-1 sizing guidance, shape matching, and express atelier crafting.',
            'f1_title' => '⚡ 2-Min Sizing',
            'f1_desc' => 'Millimeter curve fit',
            'f2_title' => '🎨 Custom Inspo',
            'f2_desc' => 'Send Pinterest & photos',
            'f3_title' => '📦 Haute Box',
            'f3_desc' => 'Full prep & glue kit',
            'btn1_text' => 'Order Bespoke Nails on WhatsApp',
            'btn1_url' => 'https://wa.me/917016266727?text=Hello%20R%C3%A9colte%20Nails!%20I%20would%20like%20to%20order%20a%20bespoke%20nail%20set.',
            'btn2_text' => 'Explore Ready-to-Wear Catalog',
            'btn2_url' => '/products',
            'img1' => asset('images/products/recolte-cat-gel-polish.jpg'),
            'img2' => asset('images/products/recolte-cat-top-coat.jpg'),
            'img3' => asset('images/products/recolte-cat-painting-gel.jpg'),
        ]);

        return view('admin.pages.about', compact('hero', 'steps', 'instagram', 'concierge'));
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
            'card_stat_num' => $request->input('card_stat_num', '+120,000'),
            'card_stat_label' => $request->input('card_stat_label', 'CUSTOM SETS DELIVERED'),
            'btn1_text' => $request->input('hero_btn1_text', 'Explore Nail Catalog'),
            'btn1_url' => $request->input('hero_btn1_url', '/products'),
            'btn2_text' => $request->input('hero_btn2_text', 'WhatsApp Sizing Help'),
            'btn2_url' => $request->input('hero_btn2_url', 'https://wa.me/917016266727'),
        ]);

        // 2. Steps Timeline
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

        // 3. Instagram Community Gallery (5 Photos)
        $existingInsta = PageContent::getSection('about', 'instagram', []);
        $instaImgs = [];
        for ($i = 1; $i <= 5; $i++) {
            $imgKey = "img{$i}";
            $imgVal = $request->input("insta_img{$i}", $existingInsta[$imgKey] ?? '');
            if ($request->hasFile("insta_img{$i}_file")) {
                $f = $request->file("insta_img{$i}_file");
                $fn = "about_insta{$i}_" . time() . '.' . $f->getClientOriginalExtension();
                $f->move(public_path('uploads/pages'), $fn);
                $imgVal = asset('uploads/pages/' . $fn);
            }
            $instaImgs[$imgKey] = $imgVal;
        }

        PageContent::setSection('about', 'instagram', [
            'tag' => $request->input('insta_tag', 'Atelier Community'),
            'title' => $request->input('insta_title', 'Join Our Nail Community'),
            'subtitle' => $request->input('insta_subtitle', 'Follow @recolte_gelpolish for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.'),
            'handle' => $request->input('insta_handle', '@recolte_gelpolish'),
            'profile_url' => $request->input('insta_profile_url', 'https://www.instagram.com/recolte_gelpolish/'),
            'btn_text' => $request->input('insta_btn_text', 'Follow @recolte_gelpolish'),
            'img1' => $instaImgs['img1'],
            'img2' => $instaImgs['img2'],
            'img3' => $instaImgs['img3'],
            'img4' => $instaImgs['img4'],
            'img5' => $instaImgs['img5'],
        ]);

        // 4. Haute VIP Concierge Banner & 3 Showcase Photos
        $existingConcierge = PageContent::getSection('about', 'concierge', []);
        $conciergeImgs = [];
        for ($i = 1; $i <= 3; $i++) {
            $imgKey = "img{$i}";
            $imgVal = $request->input("concierge_img{$i}", $existingConcierge[$imgKey] ?? '');
            if ($request->hasFile("concierge_img{$i}_file")) {
                $f = $request->file("concierge_img{$i}_file");
                $fn = "about_concierge{$i}_" . time() . '.' . $f->getClientOriginalExtension();
                $f->move(public_path('uploads/pages'), $fn);
                $imgVal = asset('uploads/pages/' . $fn);
            }
            $conciergeImgs[$imgKey] = $imgVal;
        }

        PageContent::setSection('about', 'concierge', [
            'badge' => $request->input('concierge_badge', 'Private Atelier Service'),
            'title' => $request->input('concierge_title', 'Your Dream Manicure, Curated in Real-Time.'),
            'desc' => $request->input('concierge_desc', ''),
            'f1_title' => $request->input('f1_title', '⚡ 2-Min Sizing'),
            'f1_desc' => $request->input('f1_desc', 'Millimeter curve fit'),
            'f2_title' => $request->input('f2_title', '🎨 Custom Inspo'),
            'f2_desc' => $request->input('f2_desc', 'Send Pinterest & photos'),
            'f3_title' => $request->input('f3_title', '📦 Haute Box'),
            'f3_desc' => $request->input('f3_desc', 'Full prep & glue kit'),
            'btn1_text' => $request->input('concierge_btn1_text', 'Order Bespoke Nails on WhatsApp'),
            'btn1_url' => $request->input('concierge_btn1_url', 'https://wa.me/917016266727'),
            'btn2_text' => $request->input('concierge_btn2_text', 'Explore Ready-to-Wear Catalog'),
            'btn2_url' => $request->input('concierge_btn2_url', '/products'),
            'img1' => $conciergeImgs['img1'],
            'img2' => $conciergeImgs['img2'],
            'img3' => $conciergeImgs['img3'],
        ]);

        return back()->with('success', 'All About Atelier sections, hero slides, creation journey, VIP concierge, and Instagram gallery updated successfully!');
    }
}
