<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = ['name', 'cost', 'type'];
    public $timestamps = false;
    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
