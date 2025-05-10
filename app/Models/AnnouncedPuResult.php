<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnouncedPuResult extends Model
{
    use HasFactory;

    protected $table = 'announced_pu_results';

    protected $attributes = [
        'entered_by_user' => "CHRIS TONWE, OGUNMERU DARE", // default value for user since creating an auth flow wasn't part of the assessment 
    ];

    public $timestamps = false;


    protected $fillable = [
        'polling_unit_uniqueid',
        'party_abbreviation',
        'party_score',
        'date_entered',
        'user_ip_address'
    ];

    public function pollingUnit()
    {
        return $this->belongsTo(PollingUnit::class, 'polling_unit_uniqueid', 'uniqueid');
    }
}
