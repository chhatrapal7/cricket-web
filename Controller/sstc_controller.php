<?php

    class sstcController
    {

        private $db;

        public function __construct($db)
        {
        $this->db = $db;
        }

     	public function Sstc_SomeInfo($Event_name,$Proposed_ng,$Particular_ng,$Doctor_sstc_ng,$Banificiary_ng){

             $query =  mysqli_query($this->db,"INSERT INTO td_sstc_info (Event_name,Proposed_ng, Particular_ng, Doctor_sstc_ng,Banificiary_ng) VALUES ('$Event_name', '$Proposed_ng', '$Particular_ng', '$Doctor_sstc_ng','$Banificiary_ng')")or die(mysqli_error($this->db));
 
			 if ($query) {
               return "Success";
              } else {
                  return "Failed";
              }

        }


     }
?>