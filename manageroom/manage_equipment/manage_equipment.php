<html>
<head>
              	<meta charset="utf-8">
              	<title></title>
              	 <!-- Bootstrap CSS -->
              <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
               <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
               <style type="text/css" media="screen">
               	.scroll {
  					width: 100%;
  					height: 600px;
  					overflow-y: scroll;
  

  					 margin: 30px;
 					 border: 0px solid #FFFFFF;
  					
  					border-radius: 2px;
  					box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
                    -webkit-overflow-scrolling: touch;
  					padding: 20px;
					}

					::-webkit-scrollbar {
  					background: lighten(#21BB9A, 45);
  					border-radius: 4px;
 					height: 8px;
  					width: 8px;
					}

					::-webkit-scrollbar-thumb {
  					background: #21BB9A;
  					border-radius: 4px;
					}
               </style>
</head>
<body>
           		<?php   
				include '../../connect/class_crud.php';
				$id = "";
                 if(isset($_REQUEST['id']))
                   {
		             $id = intval($_REQUEST['id']);

                    //echo $id;
                    $crud = new CRUD();
                    $strQuery =  "SELECT * FROM room WHERE room_id=".$id."";
                    $res = $crud->ElseCondition($strQuery);
                    $obj = mysql_fetch_assoc($res);
                    echo "<h3>".$obj['name']."</h3>";
                     }
                    if($id==""){
                         
                    	?>
                   <div class="scroll" style="width:100%;">
				      <form action="manageroom/manage_equipment/add_equipment.php" method="POST">
						<div id='TextBoxesGroup'>    
							<div id="TextBoxDiv1">
								<label>ชื่ออุปกรณ์ที่ 1 </label>&nbsp;&nbsp;&nbsp;
								<input type='text'  name='equipment1' id='textbox1'> &nbsp;&nbsp;&nbsp;
								<label>คำอธิบาย</label>&nbsp;<input type="text" name="des1" id="text">
								<label>จำนวน</label>
								<input type="number"  min='1' max ='20' name="numberEquipment1" required> &nbsp;<label>ชิ้น </label>
							</div>
					     </div>
					        <br>
							<input type='button' value='เพิ่มอุปกรณ์' id='addButton' class="btn btn-info">
							<input type='button' value='ลบอุปกรณ์' id='removeButton' class="btn btn-danger">
							<!--input type='button' value='ดูค่าอุปกรณ์' id='getButtonValue' class="btn btn-warning"-->
							<input type="hidden"  name="numberCount" id="numberCount" value="1" />
							<input type="hidden" name="chk" value="1">
							<input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
							<select name="roomid">
							    <?php
							     $strQuery2 =  "SELECT * FROM room";
                                  $ress = $crud->ElseCondition($strQuery2);
                                  if(mysql_num_rows($ress)>0){
                                  	while($obj = mysql_fetch_assoc($ress)){
                                  		?>
                                  		<option value="<?=$obj['room_id']?>"><?php echo $obj['name'];?></option>
                                  		<?php
                                  	}
                                  }
							    ?>
								
							</select>
						</form>
                   </div>
                    	<?php
                      
                    }else{
?>        
				<div class="scroll" style="width:100%;">
				      <form action="manageroom/manage_equipment/add_equipment.php" method="POST">
						<div id='TextBoxesGroup'>    
							<div id="TextBoxDiv1">
								<label>ชื่ออุปกรณ์ที่ 1 </label>&nbsp;&nbsp;&nbsp;
								<input type='text'  name='equipment1' id='textbox1' required> &nbsp;&nbsp;&nbsp;
								<label>คำอธิบาย</label>&nbsp;<input type="text" name="des1" id="text" required>
								<label>จำนวน</label>
								<input type="number"  min='1' max ='20' name="numberEquipment1" required> &nbsp;<label>ชิ้น </label>
							</div>
					     </div>
					        <br>
							<input type='button' value='เพิ่มอุปกรณ์' id='addButton' class="btn btn-info">
							<input type='button' value='ลบอุปกรณ์' id='removeButton' class="btn btn-danger">
							<!--input type='button' value='ดูค่าอุปกรณ์' id='getButtonValue' class="btn btn-warning"-->
							<input type="hidden"  name="numberCount" id="numberCount" value="1" />
							<input type="hidden"  name="roomid" id="numberCount"  value="<?=$id?>" />
							<input type="submit" value="บันทึกข้อมูล" class="btn btn-success">
						</form>

                </div>
                <?php
                 }  //else 
				?>
				<script type="text/javascript" src="//code.jquery.com/jquery-1.3.2.js"></script>
				<script type="text/javascript">

				$(document).ready(function(){

				    var counter = 2;


				    $("#addButton").click(function () {

					if(counter>10){
				            alert("Only 10 textboxes allow");
				            return false;
					}

					var newTextBoxDiv = $(document.createElement('div'))
					     .attr("id", 'TextBoxDiv' + counter );

					newTextBoxDiv.after().html('<label>ชื่ออุปกรณ์ที่ '+ counter + '  </label>&nbsp;&nbsp;&nbsp;&nbsp;' +
					      '<input type="text"  name="equipment' + counter +
					      '" id="textbox' + counter + '" required> &nbsp;&nbsp;&nbsp;&nbsp;<label>คำอธิบาย </label> <input type="text" name="des'+counter+'" required>&nbsp;<label>จำนวน </label> <input type="number" max="20" min = "1"  name="numberEquipment'+counter+'"'+
					      ' id ="numberEquipment'+counter+'" required>&nbsp;&nbsp;<label>ชิ้น</label>');
                       $("#numberCount").val(counter);
					   newTextBoxDiv.appendTo("#TextBoxesGroup");
					   // console.log(counter)
                        
					counter++;
				     });
                     
				     $("#removeButton").click(function () {
				     	
					    if(counter==2){
					    	// console.log(counter)
				            alert("No more textbox to remove");
				             return false;
				           }else if(counter<0){
                              counter=1;
				           }else{
				           	 counter-=1;
				           	 $("#TextBoxDiv" + counter).remove();
				              // console.log(counter)
				           }
				       
				     });

				     $("#getButtonValue").click(function () {
                     
					var msg = '';
					var msg2 = '';
					for(i=1; i<counter; i++){
				   	  msg += "\n จำนวนอุปกรณ์" + i + " : " + $('#textbox' + i).val();
				   	  msg2 += "\n counter = "+$("#numberCount").val();
					}
				    	  alert(msg);
				     });

				  });
				</script>
</body>
</html>

				