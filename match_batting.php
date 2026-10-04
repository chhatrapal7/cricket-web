<?php
$m_slug = $_GET['slug'];  // php me slug liya gya
?>



<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/create_new_team.js"></script>

<script>
  var m_slug = "<?php echo $m_slug; ?>"; // PHP ka variable JavaScript ke variable m_slug me chala gaya.
</script>


<div class="content-page" style="background-color: #fff;" ng-controller="createamjsapicontroller">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


     <div class="text-center mb-4 ">
       <h4 class="fw-bold text-primary"> Match Name {{mtitle}}</h4>
      </div>

  <!-- <button class="btn btn-danger ml-5" ng-click="back_buttun()">Back</button> -->
  <!-- <button class="btn btn-success mt-3 ml-3" ng-click="every_over_ball()" id="Start_First_Inning">Start First Inning</button> -->


  <div class="container">
    <div class="row justify-content-center">


      <!-- Team Card 1 -->
      <div class="col-md-5 card shadow-lg mb-4 p-3 mt-5" style="border-left:5px solid #1584faff">
       
      <div class="text-center mb-4 ">
       <h4 class="fw-bold text-primary">Create Team Name</h4>
      </div>
      
        <input class="form-control " type="text" id="idsa" ng-model="team_name_a" ng-disabled="submit_click_count >= 2" placeholder="Enter Team Name"> <br>
        <input class="form-control" type="number" min="5" max="11" placeholder="Players" ng-model="playerCount" ng-disabled="playerCountLocked" />
        <div class="player-list">
          <div class="table mt-4 bg-light rounded p-3 pl-4">
            <table class="table text-center mx-auto">
              <thead>
                <tr>
                  <th class="text-primary ">Player Name</th>
                  <th class="text-primary ">Status</th>
                  <th class="text-primary ">Mark</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="ad in alldata | toArray">
                  <td>{{ad.pl_name}}</td>
                  <td>{{ad.pl_status}}</td>
                  <td>
                    <input type="checkbox" name="items" class="form-check-input m-auto item" ng-disabled="disable_mark_players.includes(ad.new_pl_slug)">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- List player cards here -->
        </div>
        <button class="btn btn-primary w-100 mt-3" ng-click="team_a_detail()" ng-disabled="submit_click_count >= 2">Save Team</button>
      </div>


      <!-- Team Card 2 -->
      <div class="col-md-5 card shadow-lg mb-4 p-3 mt-5" style="border-left:5px solid #ff5050ff">
          <div class="table mt-4 bg-light rounded p-3 pl-4">
        <div class="text-center mb-4 ">
       <h5 class="fw-bold text-primary"> Selected Player Name</h5>
       </div>

        <!-- <table> -->
          <table class="table text-center mx-auto">
          <thead>
            <tr>
              <th class="text-primary">Team Name</th>
              <th class="text-primary">Player Name</th>
            </tr>
          </thead>
          <tbody>

            <tr ng-repeat="ad in teamname | toArray">
              <td>{{ad.team_name_a}}</td>
              <td>{{ad.item_pl_checked}}</td>

            </tr>
          </tbody>
        </table>
        <button class="btn btn-success mt-3 ml-3" ng-click="every_over_ball()" id="Start_First_Inning">Start First Inning</button>
        <button class="btn btn-danger ml-5 mt-3" ng-click="back_buttun()">Back</button>
       
        <!-- <button class="btn btn-success mt-3 ml-3" ng-click="every_over_ball()" id="Start_First_Inning" disabled>Start First Inning</button> -->
      </div>


    </div>
  </div>

</div>
