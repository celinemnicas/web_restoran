<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nama_menu', 'harga', 'deskripsi', 'kategori_id', 'gambar'];

    // Relasi Many-to-One dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
        
    }
}

