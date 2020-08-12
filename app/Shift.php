<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shift extends Model
{
    protected $table = 'shifts';
    protected $fillable = ['name'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function event(): HasOne
    {
        return $this->hasOne(Event::class);
    }
}
