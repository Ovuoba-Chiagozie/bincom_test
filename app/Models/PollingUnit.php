<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    use HasFactory;

    protected $table = 'polling_unit';

    protected $attributes = [
        'polling_unit_id' => 0, // default value for polling_unit_id 
        'entered_by_user' => "CHRIS TONWE, OGUNMERU DARE", // decided to also leave it a default user
    ];

    protected $primaryKey = 'uniqueid';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'polling_unit_name',
        'polling_unit_number',
        'ward_id',
        'lga_id',
    ];

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'ward_id');
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class, 'lga_id', 'lga_id');
    }

    public function results()
    {
        return $this->hasMany(AnnouncedPuResult::class, 'polling_unit_uniqueid', 'uniqueid');
    }
}
