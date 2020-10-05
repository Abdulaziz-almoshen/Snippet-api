<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Snippet extends Model
{
    protected $fillable = ['title', 'uuid'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
    protected static function booted()
    {
        static::creating(function ($snippet){
            $snippet->uuid = Str::uuid();
        });
        static::created(function ($snippet) {
            $snippet->steps()->create([
                'order' => 1
            ]);
        });

    }

    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy(['order', 'asc']);
    }


}
