<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Carbon\Carbon;

class Grafik extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = "grafiks";
    protected $primarykey = "id";
    protected $fillable = [
        'id','NTU', 'status_kekeruhan','kadar_ph','status_ph','created_at',
    ];
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('H:i:s');
    }
    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('d-m-Y H:i');
    }
    public function getUpdatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('d-m-Y H:i');
    }
}
