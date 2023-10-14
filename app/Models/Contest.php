<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function rounds() {
        return $this->hasMany('App\Models\Round');
    }

    public function judges()
    {
        return $this->hasMany(Judge::class);
    }
}
