<?php
namespace App\Helpers;

use Hashids\Hashids;

class Hasher
{
    public static function encode(...$args)
    {
        $hashid = new Hashids(env('HASHIDS_SALT'), 10);

        return $hashid->encode(...$args);
    }
    public static function decode($enc)
    {

        // dd($enc);

        if (is_numeric($enc)) {
            return $enc;
        }

        $hashid = new Hashids(env('HASHIDS_SALT'), 10);

        return $hashid->decode($enc)[0];
    }
}
