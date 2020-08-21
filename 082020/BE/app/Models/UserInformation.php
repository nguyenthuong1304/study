<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $fillable = [
        'user_id', 'price', 'hidden_price', 'address', 'bio', 'nickname', 'avatar', 'socials',
    ];

    protected $casts = [
        'socials' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
