<?php   include '../connect/class_crud.php';
if(isset($_POST['submitRoom'])){
	       $crud = new CRUD();
		   	    $roomid = $_POST['idroom'];
		        $name = $_POST['nameroom'];
		        $description = $_POST['description'];
           
            $numberuse = $_POST['number']; 

                $strQuery = "UPDATE room SET";
                $strQuery .= " room_id= ".$roomid."";
                $strQuery .= ",name= '".$name."'";
                $strQuery .= ",description='".$description."'";
                $strQuery .= ",number='".$numberuse."'";
                $strQuery .= " WHERE room_id =".$roomid."";

                  if($res = $crud->update($strQuery)){
				             header('location:../admin.php?Page=manageMeetingroom');
                  }else{
                  	echo "fail !!!";
                  }
                  	
                  

		   }

		
		


       
?>