<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender',
        'age_min',
        'age_max',
        'min_value',
        'max_value',
        'lab_tests_id',
    ];
    public function labTest()
    {
        return $this->belongsTo(LabTest::class, 'lab_tests_id');
    }
}
