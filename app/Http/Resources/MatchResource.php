<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'host_team_id'=>$this->host_team_id,
          'guest_team_id'=>$this->guest_team_id,
          'week'=>$this->week,
          'guest_team_goals'=>$this->guest_team_goals,
          'host_team_goals'=>$this->host_team_goals,
          'guest_team_name'=>$this->guest_team->name,
          'host_team_name'=>$this->host_team->name
        ];
    }
}
