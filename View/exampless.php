<script type="text/javascript" src="<?php echo $baseurl; ?>jscontroller/exmpless.js"></script>
<div class="content-page" style="background-color: #fff;" ng-controller="examplejsapicontroller">

  <center>
    <h3> Enter Your Data </h3>
  </center>


  <div class="container mt-3">
    <div class="card p-3">


      <div class="row">


        <div class="col-md-6 mb-3">
          <label for="Client_name">Client Name</label>
          <select class="form-control form-select shadow-sm" ng-model="Client_name"  ng-pattern="/^[a-zA-Z\s]*$/" required>
            <option value="" disabled>Select Devision </option>
            <option value="LIFECARE BHILAI">LIFECARE BHILAI</option>
            <option value="LIFECARE DURG">LIFECARE DURG</option>
            <option value="LIFECARE RAIPUR">LIFECARE RAIPUR</option>

          </select>
        </div>

        


        <div class="col-md-6 mb-3">
          <label for="pt_name">Pt Name</label>
          <input class="form-control" ng-model="pt_name" placeholder="Pt Name">
        </div>

      </div>


      <div class="row">

        <div class="col-6">
          <label for="Client_name"> Ref Doctor</label></label>

          <select class="form-control form-select shadow-sm" ng-model="refdoctor">
            <option value="" disabled>Select Doctor </option>
            <option value="Dr.Chhatrapal">DR. Chhatrapal</option>
            <option value="Dr.Manish">DR. Manish</option>
            <option value="Dr.Rajendra">Dr.Rajendra</option>

          </select>

          <!-- <input class="form-control" ng-model="refdoctor" placeholder="Client Name"> -->
        </div>

        <div class="col-6">
          <label for="DOB">Birth Date</label>
          <input class="form-control" type="date" ng-model="DOB" placeholder="Date of Birth">
        </div>

      </div>

      <div class="row">

        <div class="col-6">
          <label for="Client_name">Bill No</label>
          <input class="form-control" ng-model="bill_number" placeholder="Bill Number">
        </div>

        <div class="col-6">
          <label for="Client_name">Bill Date Time</label>
          <input class="form-control" ng-model="bill_date_time" placeholder="Bill Date/Time">
        </div>
      </div>

      <div class="row">

        <div class="col-6">
          <label for="Client_name">Mobile No.</label>
          <input class="form-control" type="number" ng-model="mobile" ng-pattern="/^[0-9]{10}$/"  maxlength="10"
           minlength="10" placeholder="Mobile No" required>
          
        </div>

        <div class="col-6">
          <label for="Client_name">Receipt Number</label>
          <input class="form-control" ng-model="Receipt" placeholder="Receipt Number">
        </div>

      </div>

      <div class="row">


        <div class="col-6">
          <label for="Test_name">Test Name</label>
          <select class="form-control form-select shadow-sm form-check" ng-model="Test_name" multiple>

            <option value="" disabled>Test select </option>
            <option value="PATHOLOGY test 1">PATHOLOGY test 1</option>
            <option value="PATHOLOGY test 2">PATHOLOGY test 2</option>
   
            <option value="X-ray test 1">X-RAY test 1 </option>
            <option value="X-ray test 2">X-RAY test 2 </option>

            <option value="Blood Test test 1">Blood TEST test 1</option>
            <option value="Blood Test test 2">Blood TEST test 2</option>

          </select>

        </div>

      </div>

      <button class="btn btn-success" style="border-radius: 5px; width: 150px;" ng-click="submit(Client_name,pt_name,refdoctor,DOB,bill_number,bill_date_time,mobile,Receipt,Test_name)"> Submit </button>

    </div>
  </div>


  <div class="container">
    <div class="card shadow-lg">

      <center>
        <h4> BILL DETAIL</h4>
      </center>
      <div class="table">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th> Client Name</th>
              <th> Pt Name</th>
              <th> Ref Doctor</th>
              <th> Age</th>
              <th> Bill No</th>
              <th> Bill Date Time</th>
              <th> Mobile No.</th>
              <th> Receipt Number</th>
              <th> PDF</th>

            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="srial in bill | toArray" class="text-center">
              <td>{{srial.Client_name}}</td>
              <td>{{srial.pt_name}}</td>
              <td>{{srial.refdoctor}}</td>
              <td>{{srial.DOB}}</td>
              <td>{{srial.bill_number}}</td>
              <td>{{srial.bill_date_time}}</td>
              <td>{{srial.mobile}}</td>
              <td>{{srial.Receipt}}</td>

              <!-- <td>     <button class="btn btn-primary" style="border-radius: 5px; width: 100px;" ng-click="pdf_downlod(srial.submit_slug)"> PDF </button>     </td>      -->
              <td> <button type="button" class="btn btn-primary" style="border-radius: 5px; width: 100px;" ng-click="pdf_downlod(srial.submit_slug)"> PDF </button> </td>
              <!-- <button type="button" class="btn btn-primary" ng-click="p_add()"> Click For Add player</button> -->



            </tr>
          </tbody>

        </table>
      </div>




    </div>
  </div>





</div>