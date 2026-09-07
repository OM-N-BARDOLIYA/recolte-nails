<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PageContent;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. SUPER ADMIN USER ──
        User::updateOrCreate(
            ['email' => 'admin@recoltenails.com'],
            [
                'name' => 'Récolte Atelier Admin',
                'password' => Hash::make('RecolteAdmin2026!'),
                'is_admin' => true,
            ]
        );

        // ── 2. SITE SETTINGS ──
        $settings = [
            'site_name' => 'Récolte Nails Paris',
            'tagline' => 'Paris • Haute Nail Couture & Organic Care',
            'whatsapp_number' => '917016266727',
            'phone' => '+91 7016266727',
            'email' => 'atelier@recoltenails.com',
            'address' => '24 Rue du Faubourg Saint-Honoré, 75008 Paris, France',
            'consultation_hours' => '9:00 AM – 6:30 PM (Mon – Sat)',
            'announcement_bar' => '✨ Complimentary Luxury Sizing Prep Kit with Every Order • Handcrafted in Paris & Express Studio Delivery',
            'instagram_url' => 'https://www.instagram.com/recolte_gelpolish/',
            'instagram_handle' => '@recolte_gelpolish',
            'tiktok_url' => 'https://tiktok.com/@recoltenails',
            'pinterest_url' => 'https://pinterest.com/recoltenails',
            'footer_bio' => 'Récolte Nails is a Parisian haute nail couture house specializing in handcrafted reusable press-on sets, strengthening BIAB builder gels, and 24K organic damask rose cuticle elixirs for salon luxury at home.',
            'copyright' => '© 2026 Récolte Nails Paris. All rights reserved. Handcrafted with Japanese salon gels.'
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $val]);
        }

        // ── 3. CATEGORIES ──
        $categories = [
            [
                'name' => 'Press-On Sets',
                'slug' => 'press-on-nails',
                'icon_emoji' => '💅',
                'description' => 'Handcrafted reusable salon gel press-on nails with Japanese gel layering.',
                'sort_order' => 1,
            ],
            [
                'name' => 'BIAB & Builder Gels',
                'slug' => 'biab-builder-gels',
                'icon_emoji' => '✨',
                'description' => 'Strengthening Builder in a Bottle systems for natural nail growth.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Gel Polishes',
                'slug' => 'gel-polishes',
                'icon_emoji' => '🎨',
                'description' => 'Cat-eye magnetic, glazed donut, and optical chrome formulations.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Nail Care & Elixirs',
                'slug' => 'nail-care-elixirs',
                'icon_emoji' => '🌿',
                'description' => '24K gold infused damask rose and jojoba cuticle recovery oils.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Nail Art & Accents',
                'slug' => 'nail-art-accents',
                'icon_emoji' => '💎',
                'description' => 'Mirror top coats, chrome pigments, and celestial crystal charms.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Nail Tools & Kits',
                'slug' => 'nail-tools-kits',
                'icon_emoji' => '⚡',
                'description' => 'Artisan prep kits, LED curing mini lamps, and adhesive tabs.',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // ── 4. PRODUCTS ──
        $products = [
            [
                'title' => 'French Pearl Chrome Press-On Set',
                'slug' => 'french-pearl-chrome-press-on-set',
                'category' => 'Press-On Sets',
                'category_id' => 1,
                'price' => 1450.00,
                'original_price' => 1800.00,
                'rating' => 4.9,
                'reviews_count' => 142,
                'is_bestseller' => true,
                'is_active' => true,
                'tagline' => 'Handcrafted reusable glazed pearl french tips with micro gold flakes.',
                'description' => 'Inspired by the luminous salons of Paris, this bespoke 24-piece press-on suite features optical pearl glaze layered over milky rose tones. Finished with chip-resistant Japanese salon gel and hand-embellished chrome tips that guarantee 4+ weeks of radiant wear.',
                'key_ingredients' => '7-Layer Japanese Salon Gel Resin, Optical Chrome Pearl Pigment, Flexible Cuticle Curve Base',
                'how_to_use' => '1. Cleanse natural nail with prep pad. 2. Select matching size. 3. Apply adhesive tab or resin. 4. Press firmly for 30 seconds at a 45-degree angle.',
                'main_image' => 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80',
                ],
                'shades' => [
                    ['name' => 'Pearl Glaze', 'hex' => '#F4EAE6'],
                    ['name' => 'Blush Aura', 'hex' => '#E8B4B8'],
                    ['name' => 'Golden Champagne', 'hex' => '#D4AF37'],
                ],
                'sizes' => ['XS (Petite)', 'S (Natural)', 'M (Standard)', 'L (Wide)', 'Custom Sizing Kit'],
                'benefits' => ['4+ Weeks Chip-Free Wear', '100% Reusable Up to 5 Times', 'Zero Natural Nail Damage', 'Instant 5-Minute Application'],
                'sort_order' => 1,
            ],
            [
                'title' => 'BIAB™ Rose Builder Gel Reinforcement',
                'slug' => 'biab-rose-builder-gel-reinforcement',
                'category' => 'BIAB & Builder Gels',
                'category_id' => 2,
                'price' => 1850.00,
                'original_price' => 2200.00,
                'rating' => 4.9,
                'reviews_count' => 98,
                'is_bestseller' => true,
                'is_active' => true,
                'tagline' => 'High-viscosity builder in a bottle for natural nail reinforcement & length.',
                'description' => 'Our cult-favorite BIAB (Builder in a Bottle) formula creates an unbreakable glass-like shield over fragile or peeling natural nails. Self-leveling with zero heat spike under LED/UV lamps, promoting strong natural nail growth.',
                'key_ingredients' => 'Oligomer Cross-Linked Gel, Hydrolyzed Keratin, Vitamin E, Damask Rose Mineral Extract',
                'how_to_use' => 'Apply thin base layer, cure for 60s under LED. Build apex with bead of BIAB, invert hand for self-leveling, cure for 60s. Finish with top coat.',
                'main_image' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80',
                ],
                'shades' => [
                    ['name' => 'Soft Rose Quartz', 'hex' => '#E8B4B8'],
                    ['name' => 'Milky Marshmallow', 'hex' => '#F4EAE6'],
                    ['name' => 'Clear Diamond Glass', 'hex' => '#FFFFFF'],
                ],
                'sizes' => ['15ml Studio Bottle', '30ml Pro Refill', '50ml Salon Tub'],
                'benefits' => ['Eliminates Nail Breakage', 'No Heat-Spike LED Curing', 'Self-Leveling Apex Control', 'Lasts 4+ Weeks'],
                'sort_order' => 2,
            ],
            [
                'title' => '24K Gold Damask Rose Cuticle Elixir',
                'slug' => '24k-gold-damask-rose-cuticle-elixir',
                'category' => 'Nail Care & Elixirs',
                'category_id' => 4,
                'price' => 1250.00,
                'original_price' => 1500.00,
                'rating' => 5.0,
                'reviews_count' => 210,
                'is_bestseller' => true,
                'is_active' => true,
                'tagline' => 'Pure cold-pressed organic jojoba, damask rose, and genuine 24K gold flakes.',
                'description' => 'A deeply regenerative botanical nectar formulated in Grasse, France. Suspended with genuine 24K gold flakes, pure French Damask rose essential oil, and cold-pressed cold-filtered jojoba seed extract to instantly heal dry cuticles and hydrate nail beds.',
                'key_ingredients' => '24K Colloidal Gold, Organic Rosa Damascena Flower Oil, Golden Jojoba Oil, Squalane, Vitamin E',
                'how_to_use' => 'Dispense 1-2 drops onto the base of each cuticle. Gently massage in circular motions until absorbed. Use twice daily.',
                'main_image' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80',
                ],
                'shades' => [
                    ['name' => '24K Rose Gold', 'hex' => '#E8B4B8'],
                    ['name' => 'Botanical Amber', 'hex' => '#D4AF37'],
                ],
                'sizes' => ['15ml Dropper Bottle', '30ml Atelier Luxury Size'],
                'benefits' => ['Instantly Softens Cuticles', '100% Organic & Cold-Pressed', 'Suspended Real 24K Gold Flakes', 'Non-Greasy Rapid Absorption'],
                'sort_order' => 3,
            ],
            [
                'title' => 'Velvet Cat-Eye Magnetic Gel Polish',
                'slug' => 'velvet-cat-eye-magnetic-gel-polish',
                'category' => 'Gel Polishes',
                'category_id' => 3,
                'price' => 1650.00,
                'original_price' => 1950.00,
                'rating' => 4.8,
                'reviews_count' => 84,
                'is_bestseller' => false,
                'is_active' => true,
                'tagline' => 'Multi-dimensional optical magnetic particles for velvet aura illusions.',
                'description' => 'Formulated with ultra-fine magnetic shimmer that reacts dynamically to our dual-ended wand to create celestial cat-eye stripes, velvet cloud transitions, and liquid silk finishes.',
                'key_ingredients' => 'Micro Magnetic Titanium Powder, Premium Gel Resin, Cosmetic Grade Mica',
                'how_to_use' => 'Apply 1 coat over dark or sheer base. Hold magnet 2mm above wet nail for 5 seconds to create light beam. Cure 60s.',
                'main_image' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80',
                ],
                'shades' => [
                    ['name' => 'Emerald Velvet', 'hex' => '#1B4D3E'],
                    ['name' => 'Bordeaux Silk', 'hex' => '#58111A'],
                    ['name' => 'Opal Starlight', 'hex' => '#E8DDD4'],
                ],
                'sizes' => ['15ml Bottle with Precision Brush'],
                'benefits' => ['Mesmerizing Velvet Effect', 'Includes Dual-End Magnet Tool', '4+ Weeks High Gloss', 'Non-Yellowing'],
                'sort_order' => 4,
            ],
            [
                'title' => 'Haute Artisan Nail Prep & Sizing Master Kit',
                'slug' => 'haute-artisan-nail-prep-sizing-kit',
                'category' => 'Nail Tools & Kits',
                'category_id' => 6,
                'price' => 850.00,
                'original_price' => 1100.00,
                'rating' => 4.9,
                'reviews_count' => 156,
                'is_bestseller' => false,
                'is_active' => true,
                'tagline' => 'Everything required for seamless, flawless press-on application and removal.',
                'description' => 'The complete salon prep kit developed by our Paris master nail artists. Includes 48 medical-grade adhesive tabs, 1 bottle brush-on resin, 2 crystal glass files, cuticle pusher, and prep wipes.',
                'key_ingredients' => 'Bohemian Crystal Glass, Surgical Steel, Medical Hypoallergenic Adhesive Tabs',
                'how_to_use' => 'Follow the step-by-step master card included inside the velvet pouch for 5-minute salon application.',
                'main_image' => 'https://images.unsplash.com/photo-1599458356314-91ca8ca575c5?auto=format&fit=crop&w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1599458356314-91ca8ca575c5?auto=format&fit=crop&w=800&q=80',
                ],
                'shades' => [
                    ['name' => 'Rose Atelier Pouch', 'hex' => '#E8B4B8'],
                ],
                'sizes' => ['Standard 48-Tab Kit'],
                'benefits' => ['Medical-Grade Hold', '2x Bohemian Glass Files', 'Zero Natural Nail Peeling', 'Travel Velvet Pouch'],
                'sort_order' => 5,
            ],
            [
                'title' => 'Diamond Top Coat Mirror Finish No-Wipe',
                'slug' => 'diamond-top-coat-mirror-finish',
                'category' => 'Nail Art & Accents',
                'category_id' => 5,
                'price' => 1350.00,
                'original_price' => 1600.00,
                'rating' => 4.9,
                'reviews_count' => 67,
                'is_bestseller' => false,
                'is_active' => true,
                'tagline' => 'Scratch-resistant ultra high-shine top coat with zero sticky residue.',
                'description' => 'A non-cleansing, crystal-clear gel top coat that locks in pigment, chrome powder, and 3D charms with diamond-like reflectivity. Will not yellow over light colors.',
                'key_ingredients' => 'UV Blockers, Scratch-Resistant Urethane Acrylate, High Refraction Polymers',
                'how_to_use' => 'Apply 1 thin layer over cured gel polish or chrome. Cure 60s under LED lamp. No alcohol wipe needed.',
                'main_image' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?auto=format&fit=crop&w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?auto=format&fit=crop&w=800&q=80',
                ],
                'shades' => [
                    ['name' => 'High Glass Clear', 'hex' => '#FFFFFF'],
                ],
                'sizes' => ['15ml Bottle', '30ml Refill'],
                'benefits' => ['No-Wipe Sticky Residue', 'Diamond Scratch Resistance', 'UV Yellowing Protection', 'Wet-Look Gloss'],
                'sort_order' => 6,
            ],
        ];

        foreach ($products as $prod) {
            Product::updateOrCreate(['slug' => $prod['slug']], $prod);
        }

        // ── 5. PAGE CONTENTS (HOMEPAGE FULL DYNAMIC SECTIONS) ──
        $homeHero = [
            'badge' => 'Nails by Récolte • Paris',
            'title' => 'Beautiful Nails, Made Personal.',
            'subtitle' => 'Reusable salon-quality press-on sets, strengthening BIAB builder gels, and 24K gold cuticle elixirs crafted for instant, damage-free luxury manicures.',
            'cta_text' => 'Explore Nail Collection ↗',
            'cta_url' => '/products',
            'left_card_tag' => 'HANDCRAFTED PRESS-ONS',
            'left_card_title' => 'Make Your Nails Look Gorgeous!',
            'left_card_image' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80',
            'top_right_image' => 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80',
            'mini_banner_title' => 'BIAB™ Builder Gel Systems',
            'mini_banner_desc' => 'Salon-strength natural nail reinforcement and 4+ week chip-free growth.',
            'mini_banner_btn' => 'See All Gel Products ↗',
            'mini_banner_url' => '/products?category=biab-builder-gels',
            'metric_number' => '+120K',
            'metric_title' => 'CUSTOM NAIL SETS DELIVERED',
            'metric_text' => 'Your Nails Deserve the Best. Explore our Handcrafted Salon Formulations Today!',
        ];
        PageContent::setSection('home', 'hero', $homeHero);

        $homePillars = [
            'badge' => 'Nails by Récolte • Paris',
            'title' => 'Unlock Your Best Nails: Trusted by Nail Enthusiasts',
            'card1_num' => '01 / ATELIER FORMULATION',
            'card1_title' => 'Japanese Gel Craftsmanship',
            'card1_desc' => 'Every set is hand-layered with 7 distinct coats of salon-grade Japanese gel resin, guaranteeing true-to-life luster, optical chrome effects, and chip-free durability that withstands daily life.',
            'card1_image' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=600&q=80',
            'card2_num' => '02 / GENTLE HEALTH',
            'card2_title' => 'Zero Natural Nail Damage',
            'card2_desc' => 'Engineered for effortless 2-minute soak-off removal without harsh drills or acetone damage. Reusable up to 5 times while preserving your natural nail keratin bed intact.',
            'card2_image' => 'https://images.unsplash.com/photo-1599458356314-91ca8ca575c5?auto=format&fit=crop&w=600&q=80',
        ];
        PageContent::setSection('home', 'pillars', $homePillars);

        $homeRituals = [
            'badge' => 'RADIANT NAIL RITUALS',
            'title' => 'The Art of Parisian Nail Care',
            'subtitle' => 'Explore our complete suite of handcrafted luxury manicures, strengthening builder systems, and organic botanical care.',
            'card1_title' => 'Press-On Couture',
            'card1_sub' => 'Instant 4-week salon wear',
            'card1_img' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80',
            'card2_title' => 'BIAB Reinforcement',
            'card2_sub' => 'Builder in a Bottle growth',
            'card2_img' => 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=600&q=80',
            'card3_title' => 'Organic Damask Rose',
            'card3_sub' => '24K Gold cuticle elixirs',
            'card3_img' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=600&q=80',
            'card4_title' => 'Artisan Prep Kits',
            'card4_sub' => 'Flawless application tools',
            'card4_img' => 'https://images.unsplash.com/photo-1599458356314-91ca8ca575c5?auto=format&fit=crop&w=600&q=80',
            'editorial_quote' => 'Nails are the period at the end of the sentence. They complete the look.',
            'editorial_desc' => 'True beauty begins with nail health. Our dual-phase approach combines reusable haute couture sets with strengthening BIAB therapy to deliver salon-perfect results without compromise.',
        ];
        PageContent::setSection('home', 'rituals', $homeRituals);

        $homePhilosophy = [
            'badge' => 'HAUTE ATELIER PHILOSOPHY',
            'title' => 'Timeless Nail Care. Ageless Beauty Starts Here.',
            'p1_title' => '100% Non-Toxic & HEMA-Free',
            'p1_desc' => 'Pure formulas free from harsh allergens, formaldehyde, and toluene to preserve natural nail bed vitality.',
            'p2_title' => 'Reusable Up to 5+ Times',
            'p2_desc' => 'Crafted with premium salon resins and Japanese gels for multi-wear longevity with simple adhesive refresh tabs.',
            'p3_title' => 'Bespoke Sizing Precision',
            'p3_desc' => 'Available in 5 tailored size curves (XS to L) plus custom photo-consultation sizing for zero overhang.',
        ];
        PageContent::setSection('home', 'philosophy', $homePhilosophy);

        $homeInstagram = [
            'badge' => 'PARISIAN NAIL COMMUNITY',
            'title' => 'Join Our Global Atelier Gallery',
            'subtitle' => 'Tag @recolte_gelpolish on Instagram with your Récolte manicures to be featured.',
            'btn_text' => 'Follow @recolte_gelpolish on Instagram ↗',
            'btn_url' => 'https://www.instagram.com/recolte_gelpolish/',
        ];
        PageContent::setSection('home', 'instagram', $homeInstagram);

        // ── 6. PAGE CONTENTS (ABOUT PAGE FULL DYNAMIC SECTIONS) ──
        $aboutStory = [
            'badge' => 'OUR ATELIER HERITAGE & VISION',
            'title' => 'Where Parisian Haute Couture Meets Organic Nail Science',
            'paragraphs' => [
                'Founded in Paris, Récolte Nails was born from a singular atelier obsession: creating salon-grade, bespoke press-on couture and organic nail elixirs that enhance your elegance without ever compromising the health of your natural nail bed.',
                'Every press-on set in our archives is meticulously layered by master nail artists using Japanese salon gels, optical chrome pigments, and hand-painted artistry to guarantee 4+ weeks of chip-free, luminous wear.',
                'Our philosophy bridges the world of runway aesthetics with pure botanical care. From our 24K gold damask rose elixirs formulated in Grasse to our revolutionary HEMA-free BIAB builder gels, we ensure that salon glamour and natural nail wellness coexist seamlessly.'
            ],
            'stat1_num' => '4+ Weeks',
            'stat1_label' => 'Chip-Free Salon Wear',
            'stat2_num' => '100%',
            'stat2_label' => 'Organic & Non-Toxic Formulas',
            'stat3_num' => '120K+',
            'stat3_label' => 'Bespoke Sets Delivered Worldwide',
            'stat4_num' => '0%',
            'stat4_label' => 'Natural Nail Damage Guarantee',
        ];
        PageContent::setSection('about', 'story', $aboutStory);

        $aboutPillars = [
            'p1_icon' => '🎨',
            'p1_title' => '7-Layer Gel Craftsmanship',
            'p1_desc' => 'Each press-on tip is built with 7 individual layers of Japanese salon gel, optical chrome, and high-refraction top coats for unmatched depth and strength.',
            'p2_icon' => '🌿',
            'p2_title' => '100% Non-Toxic & HEMA-Free',
            'p2_desc' => 'We reject harmful chemicals. Our formulations prioritize skin-friendly, hypoallergenic ingredients that protect your natural nail bed.',
            'p3_icon' => '✨',
            'p3_title' => 'Zero Damage Soak-Off',
            'p3_desc' => 'No harsh drills or acetone baths. Our medical-grade adhesive tabs allow gentle 2-minute removal, leaving your natural nails intact.',
            'p4_icon' => '📐',
            'p4_title' => 'Bespoke Sizing Precision',
            'p4_desc' => 'We offer 5 standard sizing curves plus custom 2-minute photo sizing consultations via WhatsApp to guarantee a seamless, flush fit.',
        ];
        PageContent::setSection('about', 'pillars', $aboutPillars);

        $aboutSteps = [
            'step1_num' => '01',
            'step1_title' => 'Precision Nail Sizing & Consultation',
            'step1_desc' => 'Every order begins with accurate sizing matching using our prep kit or rapid WhatsApp photo consultation.',
            'step2_num' => '02',
            'step2_title' => '7-Layer Gel & Pigment Infusion',
            'step2_desc' => 'Master nail artists hand-paint and cure Japanese gel pigments in our Paris atelier for rich color vibrancy.',
            'step3_num' => '03',
            'step3_title' => 'Optical Chrome & Gem Setting',
            'step3_desc' => 'Glazed pearl dust and Austrian crystals are hand-set before sealing under high-gloss diamond top coat.',
            'step4_num' => '04',
            'step4_title' => 'Atelier Inspection & Express Dispatch',
            'step4_desc' => 'Each set undergoes strict quality control and is packaged in a luxury keepsake box with complete prep tools.',
        ];
        PageContent::setSection('about', 'steps', $aboutSteps);
    }
}
