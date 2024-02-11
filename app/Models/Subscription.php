<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    // Relação Subscription-User: muitos-para-um
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação Subscription-Plan: muitos-para-um
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
