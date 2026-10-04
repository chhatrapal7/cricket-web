<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/create_new_pl.js"></script>

<div class="content-page" style="background-color: #fff;" ng-controller="addnewplyerjsapicontroller">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


  <div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4 p-4">

      <h4 class="text-center fw-bold text-primary mb-4">Enter Player Detail</h4>

      <form class="form-horizontal" name="playerForm" novalidate>
        <div class="row g-4">
          <!-- Player Name -->
          <div class="col-md-6 mb-2">
            <label for="inputplayername1" class="form-label fw-semibold">Player Name</label>
            <input class="form-control form-control" type="text" id="inputplayername1" ng-model="pl_name" placeholder="Enter Player Name">
          </div>

          <!-- Player Status -->
          <div class="col-md-6 mb-2">
            <label for="playerstatus" class="form-label fw-semibold">Player Status</label>
            <select class="form-control form-select shadow-sm" id="playerstatus" ng-model="pl_status">
              <option value="">Select Status</option>
              <option value="Batter">Batter</option>
              <option value="Bowler">Bowler</option>
              <option value="Wicket-Keeper">Wicket-Keeper</option>
              <option value="All Rounder">All Rounder</option>
            </select>
          </div>

          <!-- Age -->
          <div class="col-md-6 mb-2">
            <label for="inputplayername31" class="form-label fw-semibold">Age</label>
            <input class="form-control form-control" type="number" name="pl_age" id="inputplayername31" ng-model="pl_age" placeholder="Enter Age" ng-required="true" min="5" max="90">
          </div>

          <!-- City -->
          <div class="col-md-6 mb-2">
            <label for="inputplayername4" class="form-label fw-semibold">Village / City</label>
            <input class="form-control form-control" type="text" id="inputplayername4" ng-model="pl_city" placeholder="Enter Place Name">
          </div>

          <!-- Mobile Number -->
          <div class="col-md-6 mb-2">
            <label for="inputplayername5" class="form-label fw-semibold">Mobile Number</label>
            <input class="form-control form-control" type="text" name="pl_number" id="p-number" ng-model="pl_number" placeholder="Enter 10-digit Mobile Number"
              ng-pattern="/^[0-9]{10}$/" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
          </div>
        </div>

        <div class="text-center mt-4">

          <button
            class="btn btn-success px-5 py-2 fw-semibold shadow-sm mr-2"
            style="border-radius: 10px; background: linear-gradient(90deg, #00d084, #00ff6a); border: none;"
            ng-click="submitIfValid(new_pl_slug)">
            Submit
          </button>

          <button
            class="btn btn-success px-5 py-2 fw-semibold shadow-sm"
            style="border-radius: 10px; background: linear-gradient(90deg, #fa542aff, #f81a0aff); border: none;"
            ng-click="back_buttun4()">
            Back
          </button>

        </div>

      </form>

    </div>
  </div>



  <div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4 p-4">
      <h5 class="text-center text-primary fw-bold mb-4"> Filter Players </h5>

      <div class="row g-4 align-items-end">
        <!-- Player Name -->
        <div class="col-md-5">
          <label for="playerName" class="form-label fw-semibold">Player Name</label>
          <input type="text" ng-model="pl_naam" class="form-control form-control shadow-sm"
            placeholder="Player ka naam likhiye...">
        </div>

        <!-- Player Status -->
        <div class="col-md-4">
          <label for="playerStatus" class="form-label fw-semibold">Player Status</label>
          <select ng-model="pl_sstatus" class="form-control form-select shadow-sm">
            <option value="">-- Select Status --</option>
            <option value="Batter">Batter</option>
            <option value="Bowler">Bowler</option>
            <option value="Wicket-Keeper">Wicket-Keeper</option>
            <option value="All Rounder">All Rounder</option>
          </select>
        </div>

        <!-- Buttons -->
        <div class="col-md-3 d-flex gap-3 justify-content-center">
          <button class="btn btn-success btn px-4 shadow-sm"
            style="background: linear-gradient(90deg, #00c853, #64dd17); border: none; border-radius: 7px;"
            ng-click="Check(pl_naam, pl_sstatus)">
            <!-- <i class="bi bi-search me-2"></i> -->
            Submit
          </button>

          <button class="btn btn-danger btn px-4 shadow-sm ml-4"
            style="border-radius: 7px;"
            ng-click="clearFilter()">Clear </button>
        </div>
      </div>
    </div>
  </div>




  <div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-body">
        <h4 class="text-center mb-3 fw-bold text-primary">Parameter</h4>

        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-primary text-center">
              <tr>
                <!-- <th>Title</th>
                <th>Subtitle</th> -->
                <th>Player Status</th>
                <th>Age</th>
                <th>City</th>
                <th>Number</th>
                <th>Action</th>
                <th>Delete</th>
              </tr>
            </thead>

            <tbody>
              <tr ng-repeat="ad in alldata | toArray " class="text-center">
                <!-- <td>{{}}</td>
                <td>{{}}</td> -->
                <td>{{ad.pl_status}}</td>
                <td>{{ad.pl_age}}</td>
                <td>{{ad.pl_city}}</td>
                <td>{{ad.pl_number}}</td>
                <td>
                  <button class="btn btn-outline-primary btn-sm px-3" ng-click="editPlayer(ad)">
                    <i class="bi bi-pencil-square"></i> Edit
                  </button>
                </td>
                <td>
                  <button class="btn btn-outline-danger btn-sm px-3" ng-click="deletePlayer(ad)">
                    <i class="bi bi-trash"></i> Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>




  <div class="modal fade" id="editPlayerModal" role="dialog" aria-labelledby="editPlayerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="editPlayerModalLabel">Edit Player</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancelEdit()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form class="form-horizontal">

            <div class="form-group">
              <label>Player Name</label>
              <input type="text" class="form-control" ng-model="playerToEdit.pl_name">
            </div>

            <div class="form-group">
              <label>Player Status</label>
              <select class="form-control" ng-model="playerToEdit.pl_status">
                <option value="Batter">Batter</option>
                <option value="Bowler">Bowler</option>
                <option value="Wicket-Keeper">Wicket-Keeper</option>
                <option value="All Rounder">All Rounder</option>
              </select>
            </div>

            <div class="form-group">
              <label>Age</label>
              <input type="number" class="form-control" ng-model="playerToEdit.pl_age" min="5" max="90">
            </div>

            <div class="form-group">
              <label>Village/City</label>
              <input type="text" class="form-control" ng-model="playerToEdit.pl_city">
            </div>

            <div class="form-group">
              <label>Mobile Number</label>
              <input type="text" class="form-control" ng-model="playerToEdit.pl_number" ng-pattern="/^[0-9]{10}$/" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>

          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success" ng-click="updatePlayer()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="cancelEdit()">Cancel</button>
        </div>

      </div>
    </div>
  </div>

</div>