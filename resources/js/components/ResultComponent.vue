<template>
    <div>
        <div class="row text-center mb-5">
            <h2> Week {{this.week}} match result</h2>
        </div>
        <div class="row">
            <div class="col-md-8">

                <div class="row">
                    <div class="col-md-6">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Teams</th>
                                <th scope="col">PTS</th>
                                <th scope="col">P</th>
                                <th scope="col">W</th>
                                <th scope="col">D</th>
                                <th scope="col">L</th>
                                <th scope="col">GD</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Chelsea</td>
                                <td>13</td>
                                <td>5</td>
                                <td>4</td>
                                <td>1</td>
                                <td>0</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td>Arsenal</td>
                                <td>13</td>
                                <td>5</td>
                                <td>4</td>
                                <td>1</td>
                                <td>0</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td>Manchester City</td>
                                <td>13</td>
                                <td>5</td>
                                <td>4</td>
                                <td>1</td>
                                <td>0</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td>Liverpool</td>
                                <td>13</td>
                                <td>5</td>
                                <td>4</td>
                                <td>1</td>
                                <td>0</td>
                                <td>14</td>
                            </tr>
                            </tbody>
                        </table>

                        <button @click="goNextWeek()" :disabled="this.nextWeekButtonDisabled">Next Week</button>
                    </div>

                    <div class="col-md-6">
                        <p style="text-align: center; font-weight: bold">{{this.week}} week Match Results</p>

                        <div style="display: flex">
                            <div style="flex: 1 0">
                                {{ this.weeklyMatch.host_team_name }}
                            </div>
                            <div style="padding: 0 5px">
                                {{this.weeklyMatch.host_team_goals}} - {{this.weeklyMatch.guest_team_goals}}
                            </div>
                            <div style="flex:1 0;text-align: right">
                                {{ this.weeklyMatch.guest_team_name }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">

                <h3>Prediction</h3>
                <table class="table">

                    <tr>
                        <td>
                            Chelsea
                        </td>
                        <td>
                            45%
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Arsenal
                        </td>
                        <td>
                            45%
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Manchester City
                        </td>
                        <td>
                            45%
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Liverpool
                        </td>
                        <td>
                            45%
                        </td>
                    </tr>
                </table>


            </div>
        </div>

    </div>
</template>
<script>
import Match from "../apis/Match";
export default {

  data()
  {
      return {
          week:1,
          weeklyMatch: {}
      }
  },
    computed:
        {
            nextWeekButtonDisabled()
            {
                if(this.week>=8)
                {
                    return true;
                }
                return false;
            }
        },
    created() {
        this.weeklyMatchCall()
    },
    methods:{
      weeklyMatchCall()
      {
          Match.getWeeksMatch(this.week).then(response=>{
           this.weeklyMatch = response.data;
          })
      },
      goNextWeek()
      {
          this.week = this.week+1;
          this.weeklyMatchCall();
      }
    }
}
</script>
