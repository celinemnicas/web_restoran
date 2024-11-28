<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'Carts';

    // Kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'menu_id',
        'quantity',
    ];

    /**
     * Relasi ke model Menu
     * Setiap item di keranjang berkaitan dengan satu menu
     */
    public function menu()
{
    return $this->belongsTo(Menu::class);  // Pastikan relasi ini sesuai dengan struktur tabel
}

    /**
     * Relasi ke model User
     * Setiap keranjang terkait dengan satu pengguna
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getItems()
    {
        return $this->hasMany(CartItem::class); // or your custom relation
    }
}
