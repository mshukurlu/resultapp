<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_team_id',
        'guest_team_id',
        'host_team_goals',
        'guest_team_goals',
        'played_at'];

    protected $dates = [
        'created_at',
        'updated_at',
        'played_at'
    ];

    public function guest_team()
    {
        return $this->belongsTo(Team::class,'guest_team_id','id');
    }

    public function host_team()
    {
        return $this->belongsTo(Team::class,'host_team_id','id');
    }
}
