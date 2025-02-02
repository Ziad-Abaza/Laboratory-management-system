<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'unit',
        'duration',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(TestCategory::class, 'category_id');
    }

    public function referenceRanges()
    {
        return $this->hasMany(ReferenceRange::class, 'lab_tests_id');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_has_lab_tests')
            ->withPivot('result', 'result_date')
            ->withTimestamps();
    }
}
