<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Relação Service-Church: muitos-para-um
    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function language()
    {
        return $this->belongsTo(ServiceLanguage::class);
    }
}
