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
            'handle' => '@recolte_gelpolish',
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

        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('about', compact('hero', 'steps', 'concierge', 'instagram', 'settings'));
    }

    public function contact()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');

        $header = PageContent::getSection('contact', 'header', [
            'badge' => 'Get in Touch',
            'title_prefix' => 'The',
            'title_highlight' => 'Concierge',
            'title_suffix' => 'Lounge',
            'subtitle' => 'Our Parisian studio specialists are ready to assist with custom nail sizing, bespoke press-on designs, and express order dispatch.',
        ]);

        $cards = PageContent::getSection('contact', 'cards', [
            'whatsapp_title' => 'WhatsApp Concierge',
            'whatsapp_desc' => 'Chat directly with our studio artists for instant sizing help and real-time guidance.',
            'whatsapp_btn_text' => 'Open Direct WhatsApp',
            'email_title' => 'Email Atelier',
            'email_desc' => 'For wholesale inquiries, press collaborations, and custom bridal suites.',
            'email' => $settings['contact_email'] ?? 'concierge@recoltenails.com',
            'address_title' => 'Paris Atelier',
            'address' => $settings['contact_address'] ?? '12 Rue de la Paix, 75001 Paris, France. By appointment only.',
            'hours_title' => 'Concierge Hours',
            'hours_tz' => 'Paris Time',
            'hours_mon_fri' => '9:00 AM – 8:00 PM',
            'hours_sat' => '10:00 AM – 6:00 PM',
            'hours_sun' => '12:00 PM – 5:00 PM',
            'hours_response_badge' => 'WhatsApp response typically under 2 minutes',
        ]);

        $defaultTopics = [
            ['id' => 'sizing', 'label' => 'Sizing & Curve Fit', 'msg' => 'Hello Récolte Nails! I need help finding my perfect nail size and curve measurements.'],
            ['id' => 'custom', 'label' => 'Custom Press-On Art', 'msg' => 'Hello Récolte Nails! I have custom design inspiration for a handcrafted press-on set.'],
            ['id' => 'care', 'label' => 'Nail Care & Top Coats', 'msg' => 'Hello Récolte Nails! I have questions about your nourishing nail care and salon finish top coats.'],
            ['id' => 'shades', 'label' => 'Gel Polish & Colors', 'msg' => 'Hello Récolte Nails! I would like shade recommendations from your color catalog.'],
            ['id' => 'order', 'label' => 'Order & Delivery', 'msg' => 'Hello Récolte Nails! I have an inquiry regarding my order or express delivery.'],
            ['id' => 'wholesale', 'label' => 'Wholesale & Salon B2B', 'msg' => 'Hello Récolte Nails! I am interested in wholesale salon orders and professional supply.'],
        ];

        $topics_widget = PageContent::getSection('contact', 'topics_widget', [
            'badge' => 'Direct Specialist Connection',
            'title_prefix' => 'Choose Your',
            'title_highlight' => 'Inquiry Topic',
            'subtitle' => 'Select the topic that best fits your needs, and our studio artists will prepare customized answers before your WhatsApp chat opens.',
            'btn_text' => 'Start WhatsApp Conversation',
            'badge1_text' => 'Direct Artists',
            'badge2_text' => '< 2-Min Reply',
            'badge3_text' => 'Zero Waiting',
            'topics' => $defaultTopics,
        ]);

        return view('contact', compact('settings', 'header', 'cards', 'topics_widget'));
    }

    public function franchise()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('franchise', compact('settings'));
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
