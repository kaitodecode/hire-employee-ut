<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class HiredStudent extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $incrementing = false, $keyType = "string";
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function score():HasOne
    {
        return $this->hasOne(StudentScores::class);
    }
    public function specialization():HasOne
    {
        return $this->hasOne(UnitSpecialization::class);
    }
    public function ojt():HasOne
    {
        return $this->hasOne(OjtExperienceStudents::class);
    }
}
