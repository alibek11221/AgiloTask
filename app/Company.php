<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
