<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'tb_member';

    protected $fillable = ['nama', 'alamat', 'jenis_kelamin', 'telp'];

    public function transaksi() {
        return $this->hasMany(Transaksi::class);
    }
}
