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
        return $this->belongsTo(Snippet::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function afterStep()
    {
        $adjacent = self::where('order','>', $this->order)
            ->orderBy('order','asc')
            ->first();
        if (!$adjacent) {
            return self::orderBy('order','desc')->first()->order + 1 ;
        }

        return $adjacent->order + $this->order / 2;
    }
    public function beforeStep()
    {
        $adjacent = self::where('order','<', $this->order)
            ->orderBy('order','asc')
            ->first();
        if (!$adjacent) {
            return self::orderBy('order','asc')->first()->order - 1 ;
        }
        return $adjacent->order + $this->order / 2;
    }
}
