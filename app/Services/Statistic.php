<?php


namespace App\Services;


use Illuminate\Support\Facades\DB;

class Statistic
{
    public function getTable()
    {
            return DB::select('SELECT
      name AS team, Sum(P) AS p,Sum(W) AS w,Sum(D) AS d,Sum(L) AS l,
      SUM(GD) AS gd,SUM(Pts) AS pts
    FROM(
      SELECT
        host_team_id Team,
        1 P,
        IF(host_team_goals > guest_team_goals,1,0) W,
        IF(host_team_goals = guest_team_goals,1,0) D,
        IF(host_team_goals < guest_team_goals,1,0) L,
        host_team_goals-guest_team_goals GD,
        CASE WHEN host_team_goals > guest_team_goals THEN 3 WHEN host_team_goals = guest_team_goals THEN 1 ELSE 0 END PTS
      FROM matches
      UNION ALL
      SELECT
        guest_team_id,
        1,
        IF(host_team_goals < guest_team_goals,1,0),
        IF(host_team_goals = guest_team_goals,1,0),
        IF(host_team_goals > guest_team_goals,1,0),
        guest_team_goals-host_team_goals GD,
        CASE WHEN host_team_goals < guest_team_goals THEN 3 WHEN host_team_goals = guest_team_goals THEN 1 ELSE 0 END
      FROM matches
    ) as match_team
    JOIN teams t ON match_team.Team=t.id
    GROUP BY Team
    ORDER BY SUM(Pts) DESC');
    }
}
