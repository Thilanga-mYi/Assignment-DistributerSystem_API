<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    public static function ResponseBody(
        $status_code,
        $status_message,
        $status_color,
        $data,
    ) {
        return [
            'code' => $status_code,
            'msg' => $status_message,
            'color' => $status_color,
            'data' => $data,
        ];
    }
}
