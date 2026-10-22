<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'source',
        'type',
        'metadata',
        'status',
        'admin_notes',
        'ip_address',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Human-friendly label for the inquiry source
     */
    public function getSourceLabelAttribute(): string
    {
        return match($this->source) {
            'whatsapp_product' => 'Product Order',
            'whatsapp_cart' => 'Bag Multi-Order',
            'whatsapp_contact' => 'Contact Lounge',
            'whatsapp_sizing' => 'Sizing Consultation',
            'whatsapp_artist' => 'Artist Inquiry',
            'whatsapp_franchise' => 'Franchise Partner',
            'web_form' => 'Web Form',
            default => 'WhatsApp Message',
        };
    }

    /**
     * Badge CSS classes for the inquiry source
     */
    public function getSourceBadgeAttribute(): array
    {
        return match($this->source) {
            'whatsapp_product' => [
                'icon' => '🛍️',
                'label' => 'Product Order',
                'class' => 'bg-[#FBEFE9] text-[#A33B47] border-[#A33B47]/25',
            ],
            'whatsapp_cart' => [
                'icon' => '🛒',
                'label' => 'Bag Checkout',
                'class' => 'bg-purple-50 text-purple-800 border-purple-200',
            ],
            'whatsapp_sizing' => [
                'icon' => '📏',
                'label' => 'Sizing Advice',
                'class' => 'bg-amber-50 text-amber-800 border-amber-200',
            ],
            'whatsapp_contact' => [
                'icon' => '💬',
                'label' => 'Contact Topic',
                'class' => 'bg-sky-50 text-sky-800 border-sky-200',
            ],
            'whatsapp_franchise' => [
                'icon' => '🤝',
                'label' => 'Franchise Partner',
                'class' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            ],
            'whatsapp_artist' => [
                'icon' => '🎨',
                'label' => 'Artist Inquiry',
                'class' => 'bg-rose-50 text-rose-800 border-rose-200',
            ],
            'contact_form' => [
                'icon' => '✉️',
                'label' => 'Contact Form',
                'class' => 'bg-gray-100 text-gray-800 border-gray-300',
            ],
            default => [
                'icon' => '⚡',
                'label' => 'WhatsApp Lead',
                'class' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            ],
        };
    }

    /**
     * Check if inquiry originated from WhatsApp action
     */
    public function getIsWhatsappAttribute(): bool
    {
        return str_starts_with((string) $this->source, 'whatsapp_');
    }

    /**
     * Formatted client display name
     */
    public function getClientDisplayNameAttribute(): string
    {
        if (!empty($this->name) && $this->name !== 'Customer on Web') {
            return $this->name;
        }

        if ($this->is_whatsapp) {
            return 'WhatsApp Shopper';
        }

        return 'Storefront Visitor';
    }

    /**
     * Structured product details if product inquiry
     */
    public function getProductDetailsAttribute(): ?array
    {
        if ($this->source !== 'whatsapp_product' && !isset($this->metadata['product_title'])) {
            return null;
        }

        return [
            'id' => $this->metadata['product_id'] ?? null,
            'title' => $this->metadata['product_title'] ?? null,
            'slug' => $this->metadata['product_slug'] ?? null,
            'image' => $this->metadata['product_image'] ?? null,
            'shade' => $this->metadata['shade'] ?? null,
            'size' => $this->metadata['size'] ?? null,
            'quantity' => $this->metadata['quantity'] ?? 1,
            'url' => $this->metadata['product_url'] ?? null,
        ];
    }

    /**
     * Structured cart items if bag inquiry
     */
    public function getCartItemsAttribute(): array
    {
        if ($this->source !== 'whatsapp_cart' && !isset($this->metadata['items'])) {
            return [];
        }

        return (array) ($this->metadata['items'] ?? []);
    }
}
