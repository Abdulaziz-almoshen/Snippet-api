<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Step;


class Snippet extends Model
{
    protected $fillable = ['title', 'uuid', 'is_public'];

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

    public function isPublic()
    {
        return $this->is_public;
    }

    public function scopePublic(Builder $builder)
    {
        return $builder->where('is_public',true);
    }

    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy('order', 'asc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
