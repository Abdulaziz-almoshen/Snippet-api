<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Step extends Model
{
    protected $fillable = ['title', 'uuid','body','order'];

    protected static function booted()
    {
        static::creating(function ($step){
            $step->uuid = Str::uuid();
        });
    }

    public function snippet()
    {
        return $this->belongsToMany(Snippet::class);
    }

}
