<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnouncedLgaResult extends Model
{
    use HasFactory;

    protected $table = 'announced_lga_results';
    public $timestamps = false;

    public function lga()
    {
        return $this->belongsTo(Lga::class, 'lga_id', 'lga_id');
    }
}
