<?php
$toss_slug = $_GET['slug'];  // php me slug liya gya
?>

<script>
  var toss_slug = "<?php echo $toss_slug; ?>"; // PHP ka variable JavaScript ke variable m_slug me chala gaya.
</script>

<?php
$mt_slug = $_GET['slug'];  // php me slug liya gya
?>

<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/every_ball.js"></script>

<script>
  var mt_slug = "<?php echo $mt_slug; ?>"; // PHP ka variable JavaScript ke variable m_slug me chala gaya.
</script>




<div class="content-page" style="background-color: #fff;" ng-controller="everyballjsapicontroller">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <div class="p-3">
    
    <div class="text-center mb-4">
      <h3> Match Update</h3>
      <!-- <h4 class="fw-bold text-primary" ng-if="((vie_ball >= 1 && vie_ball <= 6) && (vie_ball != 'WD' && vie_ball != 'NB' ) && (vie_wicketyp != 'Run out' && vie_wicketyp != 'C' && vie_wicketyp != 'St' && vie_wicketyp != 'B' && vie_wicketyp != 'Lbw' && vie_wicketyp != 'Hit wk' ) )">{{vi_batt_name}} ne {{vi_bowl_name}} ki Ball par {{vie_ball}} Run liya</h4>
      <h4 class="fw-bold text-primary" ng-if="vie_ball == 'WD'">{{vie_bowlwername}} Bowler WD feka</h4>
      <h4 class="fw-bold text-primary" ng-if="vie_ball == 'NB'">{{vie_bowlwername}} Bowler No Ball Feka Next Ball Free Hit Hoga</h4>
      <h4 class="fw-bold text-primary" ng-if="vie_wicketyp == 'C' || vie_wicketyp == 'Lbw' || vie_wicketyp == 'Hit wk' || vie_wicketyp == 'B' || vie_wicketyp == 'Run out' || vie_wicketyp == 'St' ">{{vie_bowlwername}} ne Wicket Liya</h4> -->
    </div>


    <div class="text-center mb-4 ">
      <h4 class="fw-bold text-primary">{{batting_teamss}} Vs {{bowling_teamss}}</h4>
    </div>


    <div>

      <div class="row mt-4">

        <div class="col-4">
          <div class="form-group d-flex align-items-center">
            <label for="tossSelect">Toss Win:</label>
            <select class="form-control" id="tossSelect" ng-model="selected_toss" ng-disabled="inining_disable">
              <option ng-disabled="true" value="">-- Select Team --</option>
              <option ng-repeat="ad in toss" value="{{ad.team_name_a}}"> {{ad.team_name_a}} </option>
              <!-- Toss Win aur Batting Team: ko fetch_toss_win controller se laya hai -->
            </select>
          </div>
        </div>

        <div class="col-3">
          <div class="form-group d-flex align-items-center">
            <label for="Batting_team_y">Batting Team:</label>
            <select class="form-control" id="Batting_team" ng-model="batting_team" ng-change="select_batting()" ng-disabled="inining_disable">
              <!-- ng-disabled="inining_disable" -->
              <option ng-disabled="true" value="">-- Batting Team --</option>
              <option ng-repeat="ad in toss" value="{{ad.team_name_a}}"> {{ad.team_name_a}} </option>
            </select>

          </div>
        </div>

        <div class="col-3">
          <div class="form-group d-flex align-items-center">
            <label>Inining:</label>
            <select class="form-control ml-2" ng-model="mtch_inining" ng-disabled="inining_disable">

              <!-- ng-disabled="inining_disable" -->
              <!-- <option ng-repeat="adf in inning" value="{{adf.in_ining}}"> {{adf.in_ining}} </option> -->

              <option ng-disabled="true" value="">--Select Inining--</option>
              <option value=1>1</option>
              <option value=2>2</option>
            </select>
          </div>
        </div>

        <div class="col-2">
          <div class="form-group d-flex align-items-center">
            <p><b>Totle Runs: {{ team_run }}</b></p>
          </div>
        </div>


      </div>


      <div class="row mt-4">

        <div class="col-4">

          <div class="form-group d-flex align-items-center">
            <label class="mr-2 mb-0">Striker:</label>
            <!-- ng-disabled="isStrikerDisabled" -->
            <ui-select id="striker" ng-model="selected_stricker.selected" theme="select2" ng-disabled="isStrikerDisabled">
              <ui-select-match placeholder="Select Striker">{{selected_stricker.selected.item_pl_checked}}</ui-select-match>
              <!-- <ui-select-choices repeat="allc in NOT_OUT_Player | toArray | filter: $select.search" ng-if="allc.pl_slug != selected_non_stricker.selected.pl_slug"> -->
              <ui-select-choices repeat="allc in NOT_OUT_Player | toArray | filter: $select.search | filter: exclude_Striker">
                <div ng-bind-html="allc.item_pl_checked | highlight: $select.search"></div>
              </ui-select-choices>
            </ui-select>

          </div>
        </div>

        <div class="col-4">
          <div class="form-group d-flex align-items-center">
            <label class="mr-2 mb-0">Non-Striker:</label>
            <!-- ng-disabled="isStrikerDisabled" -->
            <ui-select id="nonStriker" ng-model="selected_non_stricker.selected" theme="select2" ng-disabled="isStrikerDisabled">
              <ui-select-match placeholder="Select Non-Striker">{{selected_non_stricker.selected.item_pl_checked}}</ui-select-match>
              <ui-select-choices repeat="allc in NOT_OUT_Player | toArray | filter: $select.search | filter: exclude_non_Striker ">
                <div ng-bind-html="allc.item_pl_checked | highlight: $select.search"></div>
              </ui-select-choices>
            </ui-select>

          </div>
        </div>

        <div class="col-4">
          <div class="form-group d-flex align-items-center">
            <label class="mr-2 mb-0">Bowler Name</label>

            <ui-select ng-model="selected_bowler.selected" theme="select2" ng-disabled="isStrikerDisabled">
              <ui-select-match placeholder="Select Bowler">{{selected_bowler.selected.item_pl_checked}}</ui-select-match>
              <ui-select-choices repeat="allc in bowling_players | toArray | filter: $select.search">
                <div ng-bind-html="allc.item_pl_checked | highlight: $select.search"></div>
              </ui-select-choices>
            </ui-select>

            <button class="btn btn-success ml-3" ng-click="Done_inning_info(selected_toss,batting_team,selected_stricker.selected.pl_slug,selected_non_stricker.selected.pl_slug,selected_bowler.selected.pl_slug,mtch_inining)" ng-hide="hidedoneBtn">Done </button>

          </div>
          <!-- <tbody id="scoreTable">
          </tbody> -->
        </div>

      </div>



      <div class="row">

        <div class="col-md-6">

          <!-- <table class="table table-bordered text-center w-25 mt-4">
            <thead>
              <tr>
                <th>Ball</th>
                <th>Run</th>
                <th>Batsman</th>
              </tr>
            </thead>
            <tbody id="scoreTable">
            </tbody>
          </table> -->

          <table class="table table-bordered text-center w-25 mt-4">
            <thead>
              <tr>
                <th style="background:#007bff; color:white; font-weight:bold;">Ball</th>
                <th style="background:#007bff; color:white; font-weight:bold;">Run</th>
                <th style="background:#007bff; color:white; font-weight:bold;">Batsman</th>
              </tr>
            </thead>
            <tbody id="scoreTable">
              <!-- dynamic rows -->
            </tbody>
          </table>


          <div class="col-md-5 p-0 ml-1">
            <div class="form-group d-flex align-items-center w-100">
              <select id="runSelect" ng-model="runvalue" class="form-control" style="width: 200px;">
                <option ng-disabled="true" value="">Select Run</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="W">W</option>
                <option value="NB">NB</option>
                <option value="WD">WD</option>
              </select>

              <button class="btn btn-primary ml-3" ng-click="addBall(runvalue,mtch_inining,selected_stricker.selected.pl_slug,selected_non_stricker.selected.pl_slug,selected_bowler.selected.pl_slug,selected_stricker.selected.item_pl_checked)" ng-hide="hide_add_btn">Add</button>

            </div>
          </div>

        </div>


        <div class="mt-4" style="width: 300px;">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="background:#007bff; color:white; font-weight:bold;">Batsman Name</th>
                <th style="background:#007bff; color:white; font-weight:bold;">Runs</th>
                <th style="background:#007bff; color:white; font-weight:bold;">wicket</th>

              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="pl_rr in batsman track by $index">
                <td>{{pl_rr.batsman_name}}</td>
                <td>{{pl_rr.batsman_runs}}</td>
                <td>{{pl_rr.batsman_check}}</td>

              </tr>
            </tbody>
          </table>
        </div>

      </div>

    </div>

  </div>


  <div class="row ml-4">

    <div class="col-6">
      <table class="table table-bordered text-center w-100 mt-4">
        <thead>
          <tr> 
             <th colspan="3" style="background:#ff7f27; color:white;">1st Inining Batting </th>
             <th colspan="3" style="background:#ff7f27; color:white;">Totle Runs = {{team_A_run}}</th>
          </tr>
          <tr>
           <th style="background:#343a40; color:white;">Inning</th>
           <th style="background:#343a40;; color:white;">Over</th>
           <th style="background:#343a40;; color:white;">Ball</th>
           <th style="background:#343a40;; color:white;">Run</th>
           <th style="background:#343a40; color:white;">Batsman</th>
           <th style="background:#343a40; color:white;">Wicket</th>
          </tr>
        </thead>
        <tr ng-repeat="adb in balldata |toArray">
          <td>{{adb.mtch_inining}}</td>
          <td>{{adb.current_over}}</td>
          <td>{{adb.ball}}</td>
          <td>{{adb.run}}</td>
          <td>{{adb.batsman}}</td>
          <td>{{adb.wicket_type}}</td>
        </tr>
      </table>
    </div>

    <div class="col-6">
      <table class="table table-bordered text-center w-100 mt-4">
        <thead>

          <tr> 
          <!-- <th style="background:#3cb44b; color:white; width:100%;">{{bowling_teamss}}</th> -->
          <th colspan="3" style="background:#007bff; color:white; text-align:center;">
          2nd Inining Batting
           </th>
          <th colspan="3" style="background:#007bff; color:white; text-align:center;">Totle Runs = {{team_B_run}}</th>
          </tr>

          <tr>
          <th style="background:#343a40; color:white;">Inning</th>
          <th style="background:#343a40; color:white;">Over</th>
          <th style="background:#343a40; color:white;">Ball</th>
          <th style="background:#343a40; color:white;">Run</th>
          <th style="background:#343a40; color:white;">Batsman</th>
          <th style="background:#343a40; color:white;">Wicket</th>
          </tr>
        </thead>
        <tr ng-repeat="adb in ball_data |toArray" ng-class="{'even-row': $index % 2 === 0, 'odd-row': $index % 2 !== 0}">
          <td>{{adb.mtch_inining}}</td>
          <td>{{adb.current_over}}</td>
          <td>{{adb.ball}}</td>
          <td>{{adb.run}}</td>
          <td>{{adb.batsman}}</td>
          <td>{{adb.wicket_type}}</td>
        </tr>
      </table>
    </div>

  </div>


  <!-- *********************************************************************************************** -->



  <!-- WICKET HONE PAR MODAL OPEN HOGA -->
  <div class="modal fade" id="NBout_Filder_select_Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">--WICKET--</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>

        <!-- ng-disabled="lbw_bowler_disable=='true'" -->
        <!-- ng-disabled="disable_Select" -->
        <!-- ng-disabled="disable_Select=='true' -->
        <!-- ng-show="wicket_type=='wicktype'" -->

        <div class="col-12 mt-2" ng-show="wicket_type=='wicktype'">
          <label for="wicket_by">kisane run out/Catch {{wicket_by}}</label>
          <select class="form-control" ng-model="wicket_by">
            <option ng-disabled="true" value="">--Who did OUT--</option>
            <option ng-repeat="plb in bowling_players" value="{{plb.pl_slug}}"> {{plb.item_pl_checked}}</option>
          </select>
        </div>

        <!-- ng-disabled="who_pl_out=='true'" -->
        <!-- ng-disabled="who_pl_out=='true'" -->
        <div class="col-12 mt-2">
          <label for="">Kaun OUT Huwa</label>
          <select class="form-control" ng-model="out_batsman" ng-change="update_striker_val(out_batsman,selected_stricker.selected.pl_slug,selected_non_stricker.selected.pl_slug)">
            <option ng-disabled="true" value="">-- Batter Name --</option>
            <option ng-repeat="ad in batting_players" ng-if="ad.pl_slug==selected_stricker.selected.pl_slug || ad.pl_slug==selected_non_stricker.selected.pl_slug" value="{{ad.pl_slug}}"> {{ad.item_pl_checked}}
              <span ng-if="ad.pl_slug==selected_stricker.selected.pl_slug"> - Striker </span>
              <span ng-if="ad.pl_slug==selected_non_stricker.selected.pl_slug"> - Non Striker </span>
            </option>
          </select>
        </div>

        <div class="col-12 mt-2">
          <label for="">New Batsman</label>
          <select class="form-control" ng-model="neww_batsman">
            <option ng-disabled="true" value="">-- Select Striker --</option>
            <option ng-repeat="player in NOT_OUT_Player" ng-if="player.pl_slug != selected_stricker.selected.pl_slug && player.pl_slug != selected_non_stricker.selected.pl_slug" value="{{player.pl_slug}}"
              ng-disabled="player.pl_slug == selected_non_stricker.selected.pl_slug">
              {{player.item_pl_checked}}
            </option>
          </select>
        </div>

        <!-- ng-if="showStrikeSelect=='yes'" -->
        <div class="col-12 mt-2" ng-show="showStrikeSelect=='yes'">
          <label for="">New Player Take Strike or Non_Strike</label>
          <select class="form-control" ng-model="stker_non_striker">
            <option value="Strike_liya">Strike</option>
            <option value="non_strike_liya">Non-strike</option>
          </select>
        </div>

        <button class="btn btn-primary ml-5 mr-5 mt-3 mb-3" ng-click="send_wicket_detail(wicket_by,out_batsman,neww_batsman,stker_non_striker,st_val)">Confirm</button>

      </div>
    </div>
  </div>


  <!-- NEXT BOWLER MODAL -->
  <div class="modal fade" id="who_next_bowler_Modal" tabindex="-1" role="dialog" aria-labelledby="nextBowlerLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <!-- MODAL HEADER -->
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="nextBowlerLabel">Next Bowler Selection</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>

        <!-- MODAL BODY -->
        <div class="modal-body">
          <label for="nextBowlerSelect" class="font-weight-bold">Select Bowler</label>
          <ui-select ng-model="selected_bowler_c.selected" theme="select2" style="width:100%;">
            <ui-select-match placeholder="Select Bowler">
              {{selected_bowler_c.selected.item_pl_checked}}
            </ui-select-match>
            <ui-select-choices repeat="allc_b in bowling_players | toArray | filter: $select.search | filter: exclude_bowler">
              <div ng-bind-html="allc_b.item_pl_checked | highlight: $select.search"></div>
            </ui-select-choices>
          </ui-select>
        </div>

        <!-- MODAL FOOTER -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cancel
          </button>
          <button class="btn btn-success ml-3" ng-click="send_next_bowler(selected_bowler_c.selected.pl_slug)">Confirm Bowler </button>
        </div>

      </div>
    </div>
  </div>


  <!-- NB run select modal -->
  <div class="modal fade" id="nbModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please Select Run for NB</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">
          <div id="nbRunButtons" class="d-flex flex-wrap justify-content-center">
            <!-- buttons dynamically add honge -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- NB Out ka select run modal -->
  <div class="modal fade" id="nboutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please Select Run</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">
          <div id="nboutButtons" class="d-flex flex-wrap justify-content-center">
            <!-- buttons dynamically add honge -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- NB run select modal ke baad out kisane kiya -->
  <div class="modal fade" id="nbout_filder" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please Select Run for NB</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">
          <div id="nbout_filder_btn" class="d-flex flex-wrap justify-content-center">
            <!-- buttons dynamically add honge -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- NB/WC Out ka select run ke baad out koun hoga modal -->
  <div class="modal fade" id="nboutplnameModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Who will be run out </h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">
          <div id="nboutplButtons" class="d-flex flex-wrap justify-content-center">
            <!-- buttons dynamically add honge -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- NB ke run out par plyer select -->
  <div class="modal fade" id="nb_out_pl_select_Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please Select For Batting</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">

          <div id="nb_out_pl_select_Buttons" class="d-flex flex-wrap justify-content-center">
            <!-- buttons dynamically add honge -->
            <button class="btn btn-success ml-3" ng-click="">Done </button>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- <div class="modal fade" id="who_next_bowler_Modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">--WICKET--</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="col-12 mt-2"><label for="">Next bowler</label>

              <ui-select ng-model="selected_bowler_c.selected" theme="select2">
                  <ui-select-match placeholder="Select Bowler" >{{selected_bowler_c.selected}}</ui-select-match>
                  <ui-select-choices repeat="allc_b in bowling_players | toArray | filter: $select.search" >
                      <div ng-bind-html="allc_b.item_pl_checked | highlight: $select.search"></div>
                  </ui-select-choices>
              </ui-select>

              <button class="btn btn-success ml-3" ng-click="send_next_bowler(selected_bowler_c.selected.pl_slug)">Next </button>

          </div>

        </div>
      </div>
    </div> -->








  <!-- Strike select ofter out -->
  <div class="modal fade" id="strike_confirm_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please Select New Batter for Batting</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">

          <div id="strike_confirm_modal_btn" class="d-flex flex-wrap justify-content-center">
            <!-- buttons dynamically add honge -->
            <button class="btn btn-success ml-3" ng-click="">Done </button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- WD run select modal -->
  <div class="modal fade" id="WDModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please Select Run or Wicket</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">
          <div id="WDRunButtons" class="d-flex flex-wrap justify-content-center">
            <!-- <div ng-click="createWDButtons()" class="d-flex flex-wrap justify-content-center"> -->
            <!-- <div ng-click="WDRunButtons()" class="d-flex flex-wrap justify-content-center"> -->
            <!-- buttons dynamically add honge -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- WD run select modal -->
  <div class="modal fade" id="WDModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please Choose run for WD</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">
          <div id="WDRunButtons2" class="d-flex flex-wrap justify-content-center">
            <!-- buttons dynamically add honge -->
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- WD st out modal -->
  <div class="modal fade" id="WD_st_Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please Select Batter for Batting </h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">
          <div id="WD_st_buttons" class="d-flex flex-wrap justify-content-center">
            <!-- buttons dynamically add honge -->
          </div>
        </div>
      </div>
    </div>
  </div>





  <!-- W select modal -->
  <div class="modal fade" id="WModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Select Wicket</h5>
          <!-- <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button> -->
        </div>
        <div class="modal-body text-center">
          <div id="WRunButtons" class="d-flex flex-wrap justify-content-center">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- WC select modal not work -->
  <div class="modal fade" id="cout_Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Who took the catch ?</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">
          <!-- <div class="d-flex flex-wrap justify-content-center">
              <span ng-repeat="player in bowling_players">{{player.item_pl_checked}}</span>
            </div> -->


          <div class="row">

            <!-- <div class="col-12"><label for="">Catch kisane liya</label>
                <select class="form-control" id="bowlerName_b" ng-model="catcher_name">
          
                  <option ng-disabled="true" value="">--Who took the catch--</option>
                  <option ng-repeat="player in bowling_players" value="{{player.pl_slug}}"> {{player.item_pl_checked}}
                  </option>
                </select>
              </div> -->



            <!-- <div class="col-12 mt-3 ml-3"><label for="">Catch kisane liya</label>
                <select class="form-control" id="bowlerName_k" ng-model="catcher_name">
                  <option ng-disabled="true" value="">--Catch kisane liya--</option>
                  <option ng-repeat="player in bowling_players" value="{{player.pl_slug}}"> {{player.item_pl_checked}}
                  </option>
                </select>
              </div> -->

            <!-- <div class="col-12" ng-if="batsmansidforshow"> <label for="">Out kaun huwa</label>
                <select class="form-control" id="bowlerName" ng-model="batsman_out">
                  <option ng-disabled="true" value="">-- Out kaun huwa --</option>
                
                  <option ng-repeat="player in batting_players" value="{{player.pl_slug}}"
                  ng-disabled="player.pl_slug == non_striker">
                  {{player.item_pl_checked}}
                </option>
                </select>
              </div> -->

            <!-- <div class="col-12"><label for="">New Batsman</label>
            
                <select class="form-control" id="bowlerName_c" ng-model="new_batsman_name">
                  <option ng-disabled="true" value="">--Select New batsman--</option>
                  <option ng-repeat="player in bowling_players" value="{{player.pl_slug}}"> {{player.item_pl_checked}}
                  </option>
                </select>
              </div> -->


            <!-- <button class="btn btn-primary ml-3 mt-3" ng-click="send_wicket_detail()">Confirm</button> -->




          </div>


        </div>
      </div>
    </div>
  </div>

  <!-- bowler name select modal -->
  <div class="modal fade" id="bowlwe_name_Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bowler Name</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body text-center">
          <div id="bowlwe_name_Modal_btn" class="d-flex flex-wrap justify-content-center">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- WC bowler name  modal -->
  <!-- <div class="modal fade" id="cout_bowler_Modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Select Catch player2</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body text-center">
            <div id="cout_bowler_Modalbtn" class="d-flex flex-wrap justify-content-center">
            </div>
          </div>
        </div>
      </div>
    </div> -->

  <!-- WC bowler name  modal
    <div class="modal fade" id="WC_Bowler_NameModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Select Catch player3</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body text-center">
            <div id="WC_Bowler_NameModal_btn" class="d-flex flex-wrap justify-content-center">
            </div>
          </div>
        </div>
      </div>
    </div> -->

  <!-- WC bowler name  modal -->
  <!-- <div class="modal fade" id="B_out_Modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">b,me batsman kaun hai</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body text-center">
            <div id="B_out_Modal_btn" class="d-flex flex-wrap justify-content-center">
            </div>
          </div>
        </div>
      </div>
    </div> -->

  <!--bowler name -->
  <div class="modal fade" id="Bowler_Name_Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please select next batter</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>

        <!-- <div class="col-12 mt-2">
                <select class="form-control" id="striker_hh" ng-model="neww_batsmans">
                  <option ng-disabled="true" value="">-- Select Striker --</option>
                  <option ng-repeat="player in batting_players"value="{{player.pl_slug}}"
                  ng-disabled="player.pl_slug == non_striker">
                  {{player.item_pl_checked}}
                  </option>
                </select>
          </div> -->

        <div class="col-12 mt-2"><label for="">New Batsman</label>
          <select class="form-control" id="striker_hhh" ng-model="neww_batsmannn">
            <option ng-disabled="true" value="">-- Select Striker --</option>
            <option ng-repeat="player in batting_players" ng-if="player.pl_slug != selected_stricker.selected.pl_slug && player.pl_slug != selected_non_stricker.selected.pl_slug" value="{{player.pl_slug}}"
              ng-disabled="player.pl_slug == selected_non_stricker.selected.pl_slug">
              {{player.item_pl_checked}}
            </option>
          </select>
        </div>

        <div class="modal-body text-center">
          <div id="Bowler_NameModal_btn" class="d-flex flex-wrap justify-content-center">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>