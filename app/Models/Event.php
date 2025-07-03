<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event_data';
    protected $primaryKey = 'idevent_data';

    protected $fillable = [
        'idevent_data',
        'event_name',
        'event_date',
        'event_locatie',
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_has_event_data', 'users_id', 'event_data_idevent_data');
    }
}
