<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'client_id',
        'user_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function labTests()
    {
        return $this->belongsToMany(LabTest::class, 'order_has_lab_tests')
            ->withPivot('result', 'result_date')
            ->withTimestamps();
    }

}
