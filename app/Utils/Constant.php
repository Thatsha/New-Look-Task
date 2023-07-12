<?php
namespace App\Utils;

use phpDocumentor\Reflection\Types\This;

class Constant
{

    // Shop status
    public static $shopStatuses = [
        ['key' => 1, 'value' => 'Active'],
        ['key' => 2, 'value' => 'Locked'],
    ];

    // Shop Document Types
    public static $shopDocumentTypes = [
        ['key' => 1, 'value' => 'DOCS'],
    ];

    // Promo status
    public static $promoStatuses = [
        ['key' => 1, 'value' => 'Active'],
        ['key' => 2, 'value' => 'Scheduled'],
        ['key' => 3, 'value' => 'Expired'],
    ];

    // Promo Types
    public static $promoTypes = [
        ['key' => 1, 'value' => 'Percentage'],
        ['key' => 2, 'value' => 'Fixed Amount'],
        ['key' => 3, 'value' => 'Buy One Get One'],
    ];
}
