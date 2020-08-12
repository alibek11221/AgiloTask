<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shift extends Model
{
    protected $table = 'shifts';
    protected $fillable = ['name'];


    public function event(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
