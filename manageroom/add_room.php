<?php  include '../connect/class_crud.php';
$crud = new CRUD();
		
		if(isset($_POST['submitAdd']))
		{
			$name_room = $_POST['namemeetingroom']; 
			$description_room = $_POST['descriptions'];
			$peple_number = $_POST['number_peple'];
			$Parts = @$_FILES["partpicture"]["name"];

			    $target_dir = "../uploads/";
					$target_file = $target_dir . basename(@$_FILES["partpicture"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
					
   						 $check = getimagesize(@$_FILES["partpicture"]["tmp_name"]);
  						  if(@$check !== false) {
        					//echo "File is an image - " . $check["mime"] . ".";
        					$uploadOk = 1;
    					   } else {
        					//echo "File is not an image.";
       						$uploadOk = 0;
    								}
							
							// Check if file already exists
							if (file_exists($target_file)) {
   								 echo "<span style='color: red;'>Sorry, file already exists.</span>";
   								 $uploadOk = 0;
								}
					// Check file size
					if (@$_FILES["partpicture"]["size"] > 500000) {
    					//echo "Sorry, your file is too large.";
   						 $uploadOk = 0;
							}
									// Allow certain file formats
				    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    					$uploadOk = 0;
              header('location:../admin.php?Page=manageMeetingroom');
					}
						// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
    						echo "Sorry, your file was not uploaded.";
                header('location:../admin.php?Page=manageMeetingroom');
							// if everything is ok, try to upload file
					} else {
    						if (move_uploaded_file($_FILES["partpicture"]["tmp_name"], $target_file)) {
    							$photo = $_FILES["partpicture"]["name"];
    							$idImg =  
    							$folder = "uploads";
    							$ext = explode('.', $photo);
    							$ext = end($ext);
                                $strdataTable = "room(name,description,path_photo,number)";
                                $strdataValue = "('$name_room','$description_room','$Parts','$peple_number')";
                                	 if($res = $crud->create($strdataTable,$strdataValue))
                                	 {
                                         header('location:../admin.php?Page=manageMeetingroom');
                                     }else
                                     {
                                	     echo 'add Fail....';
                                     }

       						// echo "<span style='color: green;'>อัพโหลดไปยัง  ".$target_dir.basename( $_FILES["partpicture"]["name"]). " ทำการอัพโหลดไฟล์เสร็จสมบูรณ์</span>";
                                  
   							   } else{
      							  echo "<span style='color: red;'>ไม่สามารถอัพโหลดไฟล์ได้</span>";
   				              }
		                    }
		        

			//   echo "name room :".$name_room."   ;  รายละเอียด:".$description_room."   ; จำนวนคน :".$peple_number."  ;  ชื่อไฟล์".$Parts;

        }else{
          echo "อยู่นี่";
        }

?>