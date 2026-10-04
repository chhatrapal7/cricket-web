	<?php
    include_once '../td_includes.php';
  	$_POST = json_decode(file_get_contents('php://input'), true);
    
              //  print_r($_POST) ;die;

    if($_POST['action']=="Sstc_SomeInfo"){

        //   echo "firate_";

		$Event_name = $_POST['Event_name'];
		$Proposed_ng = $_POST['Proposed_ng'];
		$Particular_ng = $_POST['Particular_ng'];
		$Doctor_sstc_ng = $_POST['Doctor_sstc_ng'];
		$Banificiary_ng = $_POST['Banificiary_ng'];

        // echo "hiie_".$Event_name;die;

		$data=$sstc_obj->Sstc_SomeInfo($Event_name,$Proposed_ng,$Particular_ng,$Doctor_sstc_ng,$Banificiary_ng);
        	 
		if ($data) {
			if($data=="Invalid Userid or Password"){
				$message = "Invalid Userid or Password.";
			}
			else {
				$message = "Success";
			}
		}
		else{
			$message = "Your Data Not Save in Database Error";
		}
		$message= (object) $message;
        $json = json_encode($message);
        echo $json; 
     
	}


    ?>