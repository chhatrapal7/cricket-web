tdipllp.controller("examplejsapicontroller", [
  "$window",
  "$scope",
  "$http",
  "Upload",
  "$timeout",
  function ($window, $scope, $http, Upload, $timeout) {

    $scope.submit = function (
      Client_name,
      pt_name,
      refdoctor,
      DOB,
      bill_number,
      bill_date_time,
      mobile,
      Receipt,
      Test_name
    ) {
      alert("="+Test_name+"="+pt_name+refdoctor+ DOB+
      bill_number+
      bill_date_time+
      mobile+
      Receipt+ "="+Test_name)

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          Client_name: Client_name,
          pt_name: pt_name,
          refdoctor: refdoctor,
          DOB: DOB,
          bill_number: bill_number,
          bill_date_time: bill_date_time,
          mobile: mobile,
          Receipt: Receipt,
          Test_name: Test_name,
          action: "submit"

        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = " database me nhi gya hai ";
        } else {
          $scope.message = data.scalar;
          if ($scope.message == "Success") {
            $scope.fetch_bill();
            $scope.Client_name = "";
            $scope.pt_name = "";
            $scope.refdoctor = "";
            $scope.DOB = "";
            $scope.bill_number = "";
            $scope.bill_date_time = "";
            $scope.mobile = "";
            $scope.bill_number = "";
            $scope.Receipt = "";
            // $scope.Department_dises = "";
            $scope.Test_name = "";


            // $scope.fetch_data();
            alert("Saved");
          } else {
            alert($scope.message);
          }
        }
      });
    };




  	$scope.fetch_bill= function(){
        $http.get(ApiUrl+"api_signin.php?action=fetch_bill")
        .success(function(bill){
            if (bill=="null" || bill==undefined || bill=="Invalid request" || bill=="Error"){
	             $scope.bill="";
	         } 
	         else{
	            $scope.bill= bill;
	        }
	    })
    }
    $scope.fetch_bill();




    // $scope.pdf_downlod = function (pdf_slug) {
    //   $window.location.href = "example_page/"+pdf_slug;
    // };


    $scope.pdf_downlod = function (pdf_slug) {
      $window.location.href = "pdf_page/"+pdf_slug;
    };










    //niche
  },
]);
