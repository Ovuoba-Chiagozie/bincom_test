<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lga extends Model
{
    use HasFactory;

    protected $table = 'lga';
    protected $primaryKey = 'lga_id';
    public $timestamps = false;

    public function wards()
    {
        return $this->hasMany(Ward::class, 'lga_id', 'lga_id');
    }

    public function pollingUnits()
    {
        return $this->hasMany(PollingUnit::class, 'lga_id', 'lga_id');
    }

    public function announcedResults()
    {
        return $this->hasMany(AnnouncedLgaResult::class, 'lga_id', 'lga_id');
    }
}
