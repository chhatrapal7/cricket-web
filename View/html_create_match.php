<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/create_match.js"></script>

<div class="content-page " style="background-color: #fff;" ng-controller="creatematchjsapicontroller">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">




  <div class="container mt-4">
    <!-- Page Title -->
    <div class="text-center mb-4 ">
      <h2 class="fw-bold text-primary"> Create Match</h2>
    </div>

    <!-- Card -->
    <div class="card shadow-lg border-0 rounded-4 p-4">
      <form class="form-horizontal">
        <div class="row g-4">
          <!-- Match Name -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">Match Name</label>
            <input type="text" class="form-control form-control" ng-model="mtch_name"
              placeholder="Enter Match Name">
          </div>

          <!-- Select Over -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">Select Over</label>
            <input type="number" class="form-control form-control" ng-model="mtch_over"
              placeholder="Enter Overs (1-90)" min="1" max="90">
          </div>

          <!-- Match Place -->
          <div class="col-md-6">
            <label class="form-label fw-semibold">Match Place</label>
            <input type="text" class="form-control form-control" ng-model="mtch_place"
              placeholder="Enter Match Place">
          </div>

          <!-- Date -->
          <!-- <div class="col-md-6">
            <label class="form-label fw-semibold">Match Date</label>
            <input type="date" class="form-control form-control" ng-model="mtch_date">
          </div>
        </div> -->

        <!-- Buttons -->
        <div class="text-center mt-5 d-flex flex-wrap justify-content-center gap-3">

          <button type="button"
            class="btn btn-outline-danger px-5 py-2 fw-semibold shadow-sm"
            ng-click="back_buttun5()">Back
          </button>

          <button type="button"
            class="btn btn-success px-5 py-2 fw-semibold shadow-sm ml-4"
            ng-click="create_new_match(mtch_name,mtch_over,mtch_place)">Submit
          </button>

        </div>
      </form>
    </div>
  </div>

  <!-- Card wrapper -->
  <div class="card shadow-lg border-0 rounded-4 p-4 m-2">

    <!-- Responsive table wrapper -->
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
            <thead class="table-primary text-center">

          <tr>
            <th scope="col">S. Nu</th>
            <th scope="col">Match Name</th>
            <th scope="col">Place</th>
            <th scope="col">Date</th>
            <th scope="col">Over</th>

            <th scope="col" class="text-center">Next</th>
            <th scope="col" class="text-center">View</th>
            <th scope="col" class="text-center">Delete</th>
          </tr>
        </thead>

        <tbody>
          <!-- AngularJS loop (जैसा आपने था) -->
          <tr ng-repeat="add in matchdata | toArray">
            <td>{{$index + 1 }}</td>
            <td>{{ add.mtch_name }}</td>
            <td>{{ add.mtch_place }}</td>
            <td>{{ add.mtch_date }}</td>
            <td>{{ add.mtch_over }}</td>


            <!-- Next: use btn-warning and make text bold via fw-bold -->
            <td class="text-center">
              <button
                class="btn btn-primary btn-sm text-white fw-bold"
                ng-click="go_buttun(add.mtch_slug)"
                ng-hide="add.m_status == 'complete'"
                aria-label="Go to match {{ add.mtch_name }}">
                Go
              </button>
            </td>

            <!-- View -->
            <td class="text-center">
              <button
                class="btn btn-success btn-sm text-white fw-bold"
                ng-click="view_buttun(add.mtch_slug)"
                aria-label="View match {{ add.mtch_name }}">
                View
              </button>
            </td>

            <!-- Delete -->
            <td class="text-center">
              <button
                class="btn btn-danger btn-sm text-white fw-bold"
                ng-click="mtch_delete(add.mtch_slug)"
                aria-label="Delete match {{ add.mtch_name }}">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>