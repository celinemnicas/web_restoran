<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Order extends Model
{
    use HasFactory;

    // Menambahkan menu_id dan kolom lain yang diizinkan untuk mass assignment
    protected $fillable = [
        'menu_id',
        'status',
        'jenis_pesanan',
        'nomor_meja',
        'jam_pengambilan',
        'informasi_pembeli',
        'price',
        'quantity',
    ];

    // Menambahkan konstanta enum untuk status
    const STATUS_PENDING = 'Pending';
    const STATUS_PROSES = 'Proses';
    const STATUS_SIAP_SAJI = 'Siap Saji';

    // Menentukan kolom status agar dapat diterjemahkan dengan enum
    protected $casts = [
        'status' => 'string',
    ];

    // Relasi ke tabel Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
        // 'user_id' adalah foreign key di tabel orders, 'id' adalah primary key di tabel users
    }
    // Mendapatkan status enum yang valid
    public static function getValidStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_PROSES,
            self::STATUS_SIAP_SAJI,
        ];
    }

    // Mutator untuk memvalidasi status yang diinputkan
    public function setStatusAttribute($value)
{
    Log::info("Setting status: {$value}");
    $validStatuses = self::getValidStatuses();

    if (!in_array($value, $validStatuses)) {
        Log::warning("Invalid status '{$value}' attempted to be set.");
        $this->attributes['status'] = self::STATUS_PENDING; // Menetapkan status default
    } else {
        $this->attributes['status'] = $value;
    }
}

public function carts()
{
    return $this->hasMany(Cart::class);  // Pastikan relasi ini sesuai dengan struktur tabel
}

    // Akses status
    public function getStatusAttribute($value)
    {
        return strtoupper($value); // Menampilkan status dalam huruf kapital
    }
}
