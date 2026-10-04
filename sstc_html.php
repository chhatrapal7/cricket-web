<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/sstc_js.js"></script>

<div class="content-page" style="background-color: #fff;" ng-controller="addsstcinfo">

   <div class="col-12 mt-3">
      <div class="col-xl-6">
         <div class="card">
            <div class="card-body">
               <h4 class="mb-3 header-title mt-0">Department Activities </h4>

               <form class="form-horizontal" name="department" novalidate>

                  <div class="form-group row mb-3">
                     <label for="Event1" class="col-3 col-form-label">Event</label>
                     <div class="col-9">
                        <input class="form-control" type="text" name="Event1" ng-model="Event_name" placeholder="">
                     </div>
                  </div>


                  <div class="form-group row mb-3">
                     <label for="Proposed_sstc" class="col-3 col-form-label">Proposed Dates(s)</label>
                     <div class="col-9">
                        <input class="form-control" type="text" name="Proposed"
                           name="Proposed_sstc" ng-model="Proposed_ng" placeholder="" ng-required="true" min="5" max="90">
                     </div>
                  </div>

                  <div class="form-group row mb-3">
                     <label for="Particular_sstc" class="col-3 col-form-label">Particular/Disciption</label>
                     <div class="col-9">
                        <input class="form-control" type="text" name="Particular_sstc" ng-model="Particular_ng" placeholder="">

                     </div>
                  </div>

                  <div class="form-group row mb-3">
                     <label for="Doctor_sstc" class="col-3 col-form-label">Doctor name</label>
                     <div class="col-9">
                        <input class="form-control" type="text" name="Doctor_sstc" ng-model="Doctor_sstc_ng" placeholder="">
                     </div>
                  </div>


                  <div class="form-group row mb-3">
                     <label for="Banificiary_sstc" class="col-3 col-form-label">Banificiary</label>
                     <div class="col-9">
                        <input class="form-control" type="text" name="Banificiary_sstc" ng-model="Banificiary_ng" placeholder="">
                     </div>
                  </div>

                  <button
                     class="btn-submit-player-detail p-2 pl-3 pr-3"
                     style="background-color:rgba(0, 255, 60, 0.64); color: black; border: 2px solid rgb(223, 223, 223); border-radius: 6px;"
                     ng-click="Submit_Sstc()"> Submit
                  </button>

               </form>













            </div>
         </div>
      </div>
   </div>




</div>