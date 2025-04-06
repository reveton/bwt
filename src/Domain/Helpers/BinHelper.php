<?php

namespace App\Domain\Helpers;

class BinHelper
{
    public static function isEu(string $countryCode) : bool
    {
        return in_array($countryCode, [
            'AT','BE','BG','CY','CZ','DE','DK','EE','ES','FI','FR','GR',
            'HR','HU','IE','IT','LT','LU','LV','MT','NL','PO','PT','RO',
            'SE','SI','SK'
        ]);
    }
}