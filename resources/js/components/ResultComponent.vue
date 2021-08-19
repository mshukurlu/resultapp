<template>
    <div>
       <div v-if="this.week===0">
           <div class="row">
               <div class="col-md-12">

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

                       <tr v-for="team in this.teams">
                           <td>{{ team.name }}</td>
                           <td>0</td>
                           <td>0</td>
                           <td>0</td>
                           <td>0</td>
                           <td>0</td>
                           <td>0</td>
                       </tr>
                       </tbody>
                   </table>

                   <button @click="startSimulation()" :disabled="this.nextWeekButtonDisabled">Start Simulation</button>
               </div>
       </div>
       </div>
 <div v-else>
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

                            <tr v-for="item in this.results">
                                <td>{{ item.team }}</td>
                                <td>{{item.pts}}</td>
                                <td>{{item.p}}</td>
                                <td>{{item.w}}</td>
                                <td>{{item.d}}</td>
                                <td>{{item.l}}</td>
                                <td>{{item.gd}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <button @click="goNextWeek()" :disabled="this.nextWeekButtonDisabled">Next Week</button>
                    </div>

                    <div class="col-md-6 pt-2" style="border: 1px solid;">
                        <p style="text-align: center; font-weight: bold">{{this.week}} week Match Results</p>

                        <div v-for="match in this.weeklyMatch" style="display: flex">
                            <div style="flex: 1 0">
                                {{ match.host_team_name }}
                            </div>
                            <div style="padding: 0 5px">
                                {{match.host_team_goals}} - {{match.guest_team_goals}}
                            </div>
                            <div style="flex:1 0;text-align: right">
                                {{ match.guest_team_name }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">

                <h3>Prediction</h3>
                <table class="table">

                    <tr v-for="predection in this.predectionResult">
                        <td>
                            {{teamIdToName(predection.team_id)}}
                        </td>
                        <td>
                            {{predection.percentage}} %
                        </td>
                    </tr>
                </table>


            </div>
        </div>
 </div>
    </div>
</template>
<script>
import Match from "../apis/Match";
import Statistic from "../apis/Statistic";
import Team from "../apis/Team";
import Predection from "../apis/Predection";
export default {

  data()
  {
      return {
          week:0,
          weeklyMatch: [],
          results:[],
          teams:[],
          predectionResult:[]
      }
  },
    computed:
        {
            nextWeekButtonDisabled()
            {
                if(this.week>=6)
                {
                    return true;
                }
                return false;
            }
        },
    created() {
       Team.all().then(result=>{
           this.teams = result.data;
       });
    },
    methods:{
      weeklyMatchCall()
      {
          Match.getWeeksMatch(this.week).then(response=>{
           this.weeklyMatch = response.data.data;
            Statistic.getTable().then(result=>{
               this.results = result.data;
               Predection.getPrediction().then(predectionResult=>{
                   this.predectionResult = predectionResult.data;
               })
            })
          })
      },
        teamIdToName(teamId)
        {
           const team = this.teams.find(item=>{
                return item.id === teamId
            })

            return team.name;
        },
      goNextWeek()
      {
          this.week = this.week+1;
          this.weeklyMatchCall();
      },
        startSimulation()
        {
            this.week = 1;
            this.weeklyMatchCall();
        }
    }
}
</script>
