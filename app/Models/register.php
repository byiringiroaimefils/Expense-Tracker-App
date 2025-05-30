<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class register extends Model
{
    protected $table = 'register';
    protected $fillable=['username','email','password'];
    public function transaction()
    {
        return $this->hasMany(transaction::class,'register_id');
    }
}
