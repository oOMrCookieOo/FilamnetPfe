<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
