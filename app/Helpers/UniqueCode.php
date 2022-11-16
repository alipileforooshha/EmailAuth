<?php
namespace App\Helpers;

use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

class UniqueCode
{
    public static function generate($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
