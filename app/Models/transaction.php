<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = [
        'register_id',
        'type',
        'amount',
        'category',
        'transaction_date'
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function register()
    {
        return $this->belongsTo(register::class);
    }
}
