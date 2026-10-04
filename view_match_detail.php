<?php
    $mt_slug = $_GET['slug'];  // php me slug liya gya
?>

<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/view_match_detail.js"></script>

<script>
    var mt_slug = "<?php echo $mt_slug; ?>"; // PHP ka variable JavaScript ke variable m_slug me chala gaya.
</script>

<div class="content-page" style="background-color: #ffffffff;" ng-controller="view_match_detail_controller">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


<button type="button" class="btn btn-outline-danger px-5 py-2 fw-semibold shadow-sm mt-5 ml-5" ng-click="back_buttun2()">Back </button>

<!-- <h5 style="text-align: center; margin-top:15px">View All Match Detail</h5> -->
 
<div class="text-center mb-4">
      <h4 class="fw-bold text-primary"> View All Match Detail </h4>
  </div>

<!-- <div class="container mt-4">

  <div class="card shadow-lg border-0 rounded-4" ng-repeat="player in inning">
    <div class="card-header bg-primary text-white text-center fs-5 fw-semibold">
       Batting Summary
    </div>
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0 ">
        <thead class="table-light text-center">
          <tr>
            <th>S.N</th>
            <th>Batsman Name</th>
            <th>Runs</th>
            <th>Balls</th>
            <th>Strike Rate</th>
            <th>4s</th>
            <th>6s</th>
            <th>Wicket</th>
            <th>Bowler</th>
            <th>Wicket By</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr ng-repeat="player in inning">
              <td>{{$index+1}}</td>
              <td>{{player.batsman}}</td>
              <td>{{player.runs}}</td>
              <td>{{player.balls}}</td>
              <td>{{player.strike_rate}}</td>
              <td>{{player.four_run}}</td>
              <td>{{player.six_run}}</td>
            
              <td>{{player.wicktype}}</td>
              <td>{{player.bowler}}</td>
              <td>{{player.wicket_by}}</td>

          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div> -->


<div class="container mt-4">

  <!--  Team 1 Batting Summary ng-if me agar 0< aayega to div show hoga  -->
  <div class="card shadow-lg border-0 rounded-4 mb-4" ng-if="inning1.length > 0"> 
    <div class="card-header bg-primary text-white text-center fs-5 fw-semibold">
      Batting Summary - Team 1
    </div>
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light text-center">
          <tr>
            <th>S.N</th>
            <th>Batsman Name</th>
            <th>Runs</th>
            <th>Balls</th>
            <th>Strike Rate</th>
            <th>4s</th>
            <th>6s</th>
            <th>Wicket</th>
            <th>Bowler</th>
            <th>Wicket By</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr ng-repeat="player in inning1">
            <td>{{$index + 1}}</td>
            <td>{{player.batsman}}</td>
            <td>{{player.runs}}</td>
            <td>{{player.balls}}</td>
            <td>{{player.strike_rate}}</td>
            <td>{{player.four_run}}</td>
            <td>{{player.six_run}}</td>
            <td>{{player.wicktype}}</td>
            <td>{{player.bowler}}</td>
            <td>{{player.wicket_by}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!--  Team 2 Batting Summary ng-if me agar 0< aayega to div show hoga -->
  <div class="card shadow-lg border-0 rounded-4" ng-if="inning2.length > 0">
    <div class="card-header bg-primary text-white text-center fs-5 fw-semibold">
      Batting Summary - Team 2
    </div>
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light text-center">
          <tr>
            <th>S.N</th>
            <th>Batsman Name</th>
            <th>Runs</th>
            <th>Balls</th>
            <th>Strike Rate</th>
            <th>4s</th>
            <th>6s</th>
            <th>Wicket</th>
            <th>Bowler</th>
            <th>Wicket By</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr ng-repeat="player in inning2">
            <td>{{$index + 1}}</td>
            <td>{{player.batsman}}</td>
            <td>{{player.runs}}</td>
            <td>{{player.balls}}</td>
            <td>{{player.strike_rate}}</td>
            <td>{{player.four_run}}</td>
            <td>{{player.six_run}}</td>
            <td>{{player.wicktype}}</td>
            <td>{{player.bowler}}</td>
            <td>{{player.wicket_by}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>



<div class="container mt-4">

  <div class="card shadow-lg border-0 rounded-4 mb-4" ng-if="b_detail1.length > 0">
    <div class="card-header bg-secondary text-white text-center fs-5 fw-semibold">
       Bowling Summary
    </div>
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light text-center">
          <tr>
            <th>S.N</th>
            <th>Bowler Name</th>
            <th>over</th>
            <th>runs</th>
            <th>wicket</th>
            <th>balls</th>
            <th>Economy</th>
            <th>Extras Runs</th>
            <th>Dot Ball</th>


          </tr>
        </thead>
        <tbody class="text-center">
          <tr ng-repeat="pl in b_detail1">
              <td>{{$index+1}}</td>
              <td>{{pl.bowler}}</td>
              <td>{{pl.over}}</td>
              <td>{{pl.runs}}</td>
              <td>{{pl.wicket}}</td>
              <td>{{pl.balls}}</td>
              <td>{{pl.economy}}</td>
              <td>{{pl.extras}}</td>
              <td>{{pl.dot_balls}}</td>

          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card shadow-lg border-0 rounded-4 mb-4" ng-if="b_detail2.length > 0">
    <div class="card-header bg-secondary text-white text-center fs-5 fw-semibold">
       Bowling Summary
    </div>
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light text-center">
          <tr>
            <th>S.N</th>
            <th>Bowler Name</th>
            <th>over</th>
            <th>runs</th>
            <th>wicket</th>
            <th>balls</th>
            <th>Economy</th>
            <th>Extras Runs</th>
            <th>Dot Ball</th>


          </tr>
        </thead>
        <tbody class="text-center">
          <tr ng-repeat="pl in b_detail2">
              <td>{{$index+1}}</td>
              <td>{{pl.bowler}}</td>
              <td>{{pl.over}}</td>
              <td>{{pl.runs}}</td>
              <td>{{pl.wicket}}</td>
              <td>{{pl.balls}}</td>
              <td>{{pl.economy}}</td>
              <td>{{pl.extras}}</td>
              <td>{{pl.dot_balls}}</td>

          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>











</div>