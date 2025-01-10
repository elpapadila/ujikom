<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi';

    protected $fillable = ['id_outlet',	'kode_invoice',	'id_member', 'tgl', 'batas_waktu', 'tgl_bayar', 'biaya_tambahan', 'diskon', 'pajak', 'status', 'dibayar', 'id_user'];

    public function outlet() {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }
    public function customer() {
        return $this->belongsTo(Customer::class, 'id_member');
    }
}
