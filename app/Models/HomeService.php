<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HomeService extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'age',
        'gender',
        'phone',
        'address',
        'description',
        'status',
    ];
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('prescriptions')->singleFile();
    }

    public function addPrescriptionImage($file)
    {
        $this->addMedia($file)
            ->toMediaCollection('prescriptions');
    }
}
