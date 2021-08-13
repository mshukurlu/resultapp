<template>
    <div>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-8">
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

                        <button>Next Week</button>
                    </div>

                    <div class="col-md-4">
                        {{this.week}} Match Results
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
export default {

  data()
  {
      return {
          week:0
      }
  }
}
</script>
