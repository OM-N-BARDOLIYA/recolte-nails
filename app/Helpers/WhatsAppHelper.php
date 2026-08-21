<?php

namespace App\Helpers;

class WhatsAppHelper
{
    public static $phoneNumber = '917016266727';

    public static function getLink($productTitle, $price, $shade = null, $size = null, $quantity = 1, $note = null)
    {
        $message = "Hello Maison Éclat Paris Concierge! 🌸\n\nI would like to inquire / order:\n";
        $message .= "• Product: " . $productTitle . "\n";
        $message .= "• Price: " . $price . "\n";
        
        if ($shade) $message .= "• Shade: " . $shade . "\n";
        if ($size) $message .= "• Volume: " . $size . "\n";
        $message .= "• Quantity: " . $quantity . "\n";
        if ($note) $message .= "• Note: " . $note . "\n";

        $message .= "\nPlease confirm availability & priority express delivery options.";
        return "https://wa.me/" . self::$phoneNumber . "?text=" . urlencode($message);
    }

    public static function getGeneralLink($topic = 'General Concierge Consultation')
    {
        $message = "Hello Maison Éclat Paris Concierge! 🌸\n\nI would like a VIP consultation regarding: " . $topic;
        return "https://wa.me/" . self::$phoneNumber . "?text=" . urlencode($message);
    }
}
