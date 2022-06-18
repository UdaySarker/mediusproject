<?php

use App\Models\Variant;

class Helper
{

    public static function getVariant()
    {
        return Variant::all();
    }
}
