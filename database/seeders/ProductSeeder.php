<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();

        $products = [
            [
                'title' => 'French Pearl Chrome Press-On Set',
                'slug' => 'french-pearl-chrome-press-on-nails',
                'tagline' => 'Haute Glazed Chrome Finish',
                'category' => 'Press-On Nails',
                'price' => 1450,
                'original_price' => 1800,
                'rating' => 4.9,
                'reviews_count' => 142,
                'is_bestseller' => true,
                'main_image' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=85',
                'images' => [
                    'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=85',
                    'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=85'
                ],
                'description' => 'Handcrafted reusable glazed pearl french tips with micro gold flakes and salon-grade gel finish.',
                'benefits' => [
                    'Reusable up to 5+ times with zero damage to natural nails',
                    '7 layers of Japanese salon gel and real pearl chrome powder',
                    'Includes full application kit with custom sizing tabs'
                ],
                'key_ingredients' => ['Japanese Gel Overlay', 'Real Pearl Pigments', 'Shatterproof PMMA Resin'],
                'how_to_use' => 'Prep natural nails with dehydrator pad, apply adhesive tab or resin, press firmly for 30 seconds.',
                'shades' => [
                    ['name' => 'Pearl Glaze', 'hex' => '#F4EAE6'],
                    ['name' => 'Blush Aura', 'hex' => '#E8B4B8'],
                    ['name' => 'Golden Champagne', 'hex' => '#E5D3B3']
                ],
                'sizes' => ['XS (Petite)', 'S (Natural)', 'M (Standard)', 'L (Wide)', 'Custom Sizing Kit']
            ],
            [
                'title' => 'BIAB™ Rose Builder Gel Reinforcement',
                'slug' => 'biab-rose-builder-gel-reinforcement',
                'tagline' => 'Salon-Strength Nail Foundation',
                'category' => 'BIAB & Builder Gels',
                'price' => 1850,
                'original_price' => 2200,
                'rating' => 4.9,
                'reviews_count' => 98,
                'is_bestseller' => true,
                'main_image' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=85',
                'images' => [
                    'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=85'
                ],
                'description' => 'Salon-strength natural nail reinforcement and 4+ week chip-free growth foundation.',
                'benefits' => [
                    'Reinforces brittle, thin, or damaged natural nails',
                    'Self-leveling high-viscosity formula with zero heat spikes',
                    'Long-wearing 4+ weeks with flawless mirror shine'
                ],
                'key_ingredients' => ['Pro-Vitamin B5', 'Plant Keratin Complex', 'Low-Heat Oligomers'],
                'how_to_use' => 'Apply base coat, brush a slip layer of BIAB, build apex and cure for 60s under LED lamp.',
                'shades' => [
                    ['name' => 'Dolly Rose Pink', 'hex' => '#E3A8AF'],
                    ['name' => 'Milky White', 'hex' => '#F8F6F0'],
                    ['name' => 'Nude Cashmere', 'hex' => '#D9B8A4']
                ],
                'sizes' => ['15ml Salon Bottle', '30ml Refill Jar', 'Pro Duo Pack']
            ],
            [
                'title' => '24K Gold Damask Rose Cuticle Elixir',
                'slug' => '24k-gold-damask-rose-cuticle-elixir',
                'tagline' => 'Restorative Botanical Therapy',
                'category' => 'Nail Care & Elixirs',
                'price' => 1250,
                'original_price' => 1500,
                'rating' => 5.0,
                'reviews_count' => 210,
                'is_bestseller' => true,
                'main_image' => 'https://images.unsplash.com/photo-1608248597359-009943f72147?auto=format&fit=crop&w=800&q=85',
                'images' => [
                    'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=85'
                ],
                'description' => 'Deeply restorative organic cuticle oil enriched with 24K gold flakes and pure cold-pressed botanical oils.',
                'benefits' => [
                    'Deeply nourishes dry cuticle beds and accelerates nail matrix healing',
                    '24K micro gold particles provide antioxidant cellular defense',
                    'Rapid absorption with intoxicating Damask Rose scent'
                ],
                'key_ingredients' => ['24K Pure Gold Leaf', 'Organic Moroccan Argan Oil', 'Damask Rose Essential Oil', 'Jojoba Oil'],
                'how_to_use' => 'Massage 1-2 drops onto cuticles and nail bed nightly before bed.',
                'shades' => [
                    ['name' => 'Damask Rose & 24K Gold', 'hex' => '#DDA7A5'],
                    ['name' => 'French Lavender Calm', 'hex' => '#B8A9C9']
                ],
                'sizes' => ['10ml Dropper Vial', '30ml Luxury Bottle']
            ],
            [
                'title' => 'Velvet Cat-Eye Magnetic Gel Polish',
                'slug' => 'velvet-cateye-magnetic-gel-polish',
                'tagline' => 'Mesmerizing 3D Dimensional Sheen',
                'category' => 'Gel Polishes',
                'price' => 950,
                'original_price' => 1200,
                'rating' => 4.8,
                'reviews_count' => 84,
                'is_bestseller' => true,
                'main_image' => 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=85',
                'images' => [
                    'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=85'
                ],
                'description' => 'High-density magnetic velvet gel polish creating mesmerizing 3D light-play and silk finishes.',
                'benefits' => [
                    'Infused with ultra-dense micro-magnetic particles for dramatic silk effects',
                    'Works seamlessly with wand and circular magnets for customizable styles',
                    'Opaque in just 1 coat, cures in 60s under LED'
                ],
                'key_ingredients' => ['Micronized Magnetic Iron Oxide', 'Pure Pigment Paste', 'High-Gloss Photo-initiators'],
                'how_to_use' => 'Apply 1 coat over black or nude base, hover magnet for 5 seconds to form aura, cure immediately.',
                'shades' => [
                    ['name' => 'Bordeaux Silk', 'hex' => '#722F37'],
                    ['name' => 'Smoky Quartz', 'hex' => '#4A3B32'],
                    ['name' => 'Moonlight Silver', 'hex' => '#C0C0C0']
                ],
                'sizes' => ['12ml Bottle + Free Magnet Stick']
            ],
            [
                'title' => 'Blush Aura Ombré Press-On Set',
                'slug' => 'blush-aura-ombre-press-on-nails',
                'tagline' => 'Airbrushed Korean Glow',
                'category' => 'Press-On Nails',
                'price' => 1350,
                'original_price' => 1650,
                'rating' => 4.9,
                'reviews_count' => 67,
                'is_bestseller' => false,
                'main_image' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=85',
                'images' => [
                    'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=85'
                ],
                'description' => 'Airbrushed gradient aura press-on nails with soft blushing center and glossy salon top coat.',
                'benefits' => [
                    'Hand-airbrushed blush gradient on translucent milky gel base',
                    'Customizable length and shape (Almond, Coffin, Oval)',
                    'Waterproof and salon-sturdy wear'
                ],
                'key_ingredients' => ['Micro-Airbrush Acrylic Inks', 'High-Gloss Top Resin', 'Flexible Fit Tabs'],
                'how_to_use' => 'Match each press-on to nail size, apply adhesive sticker, press at 45 degree angle for 30s.',
                'shades' => [
                    ['name' => 'Strawberry Aura', 'hex' => '#F4C2C2'],
                    ['name' => 'Peach Nectar', 'hex' => '#FFD1BA'],
                    ['name' => 'Lilac Glow', 'hex' => '#E6E6FA']
                ],
                'sizes' => ['XS (Petite)', 'S (Natural)', 'M (Standard)', 'L (Wide)']
            ],
            [
                'title' => 'Hailey Glaze Mirror Chrome Powder',
                'slug' => 'hailey-glaze-mirror-chrome-powder',
                'tagline' => 'Viral Glazed Donut Shine',
                'category' => 'Nail Art & Accents',
                'price' => 750,
                'original_price' => 950,
                'rating' => 4.7,
                'reviews_count' => 112,
                'is_bestseller' => false,
                'main_image' => 'https://images.unsplash.com/photo-1599305090598-fe179d501227?auto=format&fit=crop&w=800&q=85',
                'images' => [
                    'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=85'
                ],
                'description' => 'Ultra-fine micronized pearl mirror powder for the viral glazed donut manicure look.',
                'benefits' => [
                    '100% pure micronized cosmetic pearl powder',
                    'Flawless mirror chrome reflection over any base color',
                    'Zero fallout when buffed with silicone applicator'
                ],
                'key_ingredients' => ['Synthetic Fluorophlogopite', 'Titanium Dioxide', 'Tin Oxide'],
                'how_to_use' => 'Apply non-wipe top coat, cure 30s, buff powder with sponge, seal with top coat.',
                'shades' => [
                    ['name' => 'Original Glaze Pearl', 'hex' => '#FFFDF9'],
                    ['name' => 'Champagne Aurora', 'hex' => '#F7E7CE'],
                    ['name' => 'Rose Quartz Glaze', 'hex' => '#FADADD']
                ],
                'sizes' => ['2g Jar + 2 Applicator Sponges']
            ],
            [
                'title' => 'Compact UV/LED Flash Cure Mini Lamp',
                'slug' => 'compact-uv-led-flash-cure-mini-lamp',
                'tagline' => 'Hands-Free Flash Curing',
                'category' => 'Nail Tools & Kits',
                'price' => 1150,
                'original_price' => 1400,
                'rating' => 4.8,
                'reviews_count' => 53,
                'is_bestseller' => false,
                'main_image' => 'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?auto=format&fit=crop&w=800&q=85',
                'images' => [
                    'https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=800&q=85'
                ],
                'description' => 'Handheld USB-C rechargeable 12W LED flash curing lamp for precise press-on and tip application.',
                'benefits' => [
                    '365+405nm dual wavelength LED bead cures gel in 15 seconds',
                    'Weighted silicone stand for stable hands-free tip placement',
                    'Type-C fast recharge lasts 300+ flash cures per charge'
                ],
                'key_ingredients' => ['Dual Wavelength LED Bead', 'Aircraft Grade Aluminum Body', 'Silicone Base'],
                'how_to_use' => 'Turn on torch, press tip firmly against nail bed, flash cure for 15 seconds under beam.',
                'shades' => [
                    ['name' => 'Rose Gold & White', 'hex' => '#F4E7E6'],
                    ['name' => 'Midnight Matte Black', 'hex' => '#2B2B2B']
                ],
                'sizes' => ['Mini Handheld Torch + Stand']
            ],
            [
                'title' => 'Haute Salon Nail Prep & Sizing Master Kit',
                'slug' => 'haute-salon-nail-prep-sizing-master-kit',
                'tagline' => 'Long-Lasting 4-Week Prep',
                'category' => 'Nail Tools & Kits',
                'price' => 650,
                'original_price' => 850,
                'rating' => 4.9,
                'reviews_count' => 76,
                'is_bestseller' => false,
                'main_image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=800&q=85',
                'images' => [
                    'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?auto=format&fit=crop&w=800&q=85'
                ],
                'description' => 'Professional manicure preparation kit with glass etched file, dehydrator, and custom sizing card.',
                'benefits' => [
                    'Czech etched crystal glass file seals keratin edges to prevent peeling',
                    'Medical-grade alcohol prep pads remove all surface oils',
                    'Accurate millimeter sizing caliper for bespoke fit'
                ],
                'key_ingredients' => ['Czech Tempered Crystal Glass', 'Medical Isopropyl Prep', 'High-Density Foam Buffer'],
                'how_to_use' => 'Shape natural nails with glass file, gently buff shine, cleanse with prep pad, apply nails.',
                'shades' => [
                    ['name' => 'Complete Master Kit', 'hex' => '#F8F5F2']
                ],
                'sizes' => ['Full 8-Piece Prep Kit']
            ]
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
