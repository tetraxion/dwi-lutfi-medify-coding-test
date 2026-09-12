<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class MasterItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $appends = ['harga_jual', 'foto_url', 'nama_kategori_list'];

    public function kategoriItems()
    {
        return $this->belongsToMany(KategoriItem::class, 'kategori_item_master_item', 'master_item_id', 'kategori_item_id');
    }

    public function getHargaJualAttribute()
    {
        return round($this->harga_beli + ($this->harga_beli * $this->laba / 100));
    }

    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }
        return null;
    }

    public function getNamaKategoriListAttribute()
    {
        if ($this->relationLoaded('kategoriItems')) {
            return $this->kategoriItems->pluck('nama')->implode(', ');
        }
        return '';
    }
}
