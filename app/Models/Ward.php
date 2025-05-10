<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'ward';
    protected $primaryKey = 'ward_id';
    public $timestamps = false;

    public function lga()
    {
        return $this->belongsTo(Lga::class, 'lga_id', 'lga_id');
    }

    public function pollingUnits()
    {
        return $this->hasMany(PollingUnit::class, 'ward_id', 'ward_id');
    }
}
