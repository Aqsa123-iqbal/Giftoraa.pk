<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    // Kyunki aapke table mein primary key 'order_id' hai
    protected $primaryKey = 'order_id';

    // Sirf woh fields jo aapke phpMyAdmin table structure mein saaf nazar aa rahi hain
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'contact',
    ];
}