<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRestoran extends Model
{
    protected $table = 'datarestorans'; // Nama tabel di database Anda
    
    protected $fillable = [
        'user_id',
        'kategori_id',
        'menu_id',
        'order_id',
        'quantity',
        'status_pesanan',    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
