<?php

namespace App\Helpers;

class WhatsAppHelper
{
    public static function getPhoneNumber()
    {
        $num = \App\Models\SiteSetting::get('whatsapp_number', '917016266727');
        $clean = preg_replace('/[^0-9]/', '', $num);
        return $clean ?: '917016266727';
    }

    public static function getLink($productTitle, $price = null, $shade = null, $size = null, $quantity = 1, $note = null)
    {
        $message = "Hello Recolte Nails, I would like to order:\n\n";
        $message .= "• Product: " . $productTitle . "\n";
        if ($shade) $message .= "• Shade: " . $shade . "\n";
        if ($size) $message .= "• Size: " . $size . "\n";
        if ($quantity > 1) $message .= "• Quantity: " . $quantity . "\n";
        if ($price) $message .= "• Price: " . $price . "\n";
        if ($note) $message .= "• Note: " . $note . "\n";

        $message .= "\nPlease confirm availability.";
        return "https://wa.me/" . self::getPhoneNumber() . "?text=" . urlencode($message);
    }

    public static function getGeneralLink($topic = 'General Inquiry')
    {
        $message = "Hello Recolte Nails, I have an inquiry regarding: " . $topic . ".";
        return "https://wa.me/" . self::getPhoneNumber() . "?text=" . urlencode($message);
    }
}
