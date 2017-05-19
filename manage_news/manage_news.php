<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
	<div class="containr" style="width: 100%;">
	<?php   include './connect/class_crud.php';
	        include 'daymoth_thai.php';

	             $crud = new CRUD();
                 $strQuery = "SELECT * FROM public_relations";
                 //echo $strQuery;
                 $res  =$crud->ElseCondition($strQuery);
                  if(mysql_num_rows($res))
                  {?>
                     <table class="table">
	           	       <tr class="success">
	           	 	     <th><center>ลำดับที่</center></th>
	           	 	     <th><center>เนื้อหาข่าว</center></th>
	           	 	     <th><center>เวลาเริ่มต้น</center></th>
	           	 	     <th><center>เวลาเริ่มสิ้นสุด</center></th>
	           	 	     <th><center>แก้ไข</center></th>
	           	 	     <th><center>ลบ</center></th>
	           	       </tr>
                   <?php
                   $countRows = 1;
                  	while ($objNews = mysql_fetch_assoc($res)) 
                  	{?>
                        <tr>
		         			<td><center><?=$countRows ?></center></td>
		         			<td><center><?=$objNews['description'] ?></center></td>
		         			<td><center><?php echo DateThai($objNews['date_time_start']); ?></center></td>
		         			<td><center><?php echo DateThai($objNews['date_time_end']); ?></center></td>
		         			<td><center>
		         			        <a href="#" onclick="load_data('<?=$objNews['public_relations_id']?>')" data-toggle="modal" data-target=".bs-example-modal-table" > 
		         			    		    <button class="btn btn-info" >
		         			    				   <span class="glyphicon glyphicon-edit" style="size: 15px;">
		         			    				   </span> 
		         			    			</button>
		         			        </a>
		         			    </center>
		         			</td>
		         			<td><center>
                               <a href="manage_news/delete_news.php?idnews=<?=$objNews['public_relations_id']?>"
                                  class="ask-custom">
                                       <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" style="size: 15px;"></span> </button>
                                   </a>
		         			      
		         			    </center>
		         			</td>
		         	    </tr>
                  		<?php 	$countRows++;	
                  	} 
                  	echo '</table>';
                  }else{
                  	echo "<h4 style='color:red' class='text-center'> ไม่มีข้อมูล </h4>";
                  }
	              ?>
	            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">
		         			        <span class="glyphicon glyphicon-plus-sign" style="size: 15px;">
		         			        </span> &nbsp; เพิ่ม
		         			     </button>    

 		</div>
 		     <!-- pop up-->
  			<div class="modal fade" id="myModal" role="dialog">
  			  <div class="modal-dialog">
    
      			<!-- Modal content-->
     			 <div class="modal-content">
      			  <div class="modal-header">
        			  <button type="button" class="close" data-dismiss="modal">&times;</button>
         			<h4 class="modal-title">เพิ่มข้อมูลข่าวประชาสัมพันธ์</h4>
        			</div>
        			<div class="modal-body">
        			   <form method="POST" class="form-grup" action="manage_news/add_news.php">
        			      <p>เนื้อหาข่าว</p>
        			      <p>​
        			      <input type="txtarea" name="description" class="form-control" rows="10" cols="70" required></p> 
        			      <p>วัน,เวลา เริ่มต้น </p>
        			      <p><input type="datetime" name="datetime_strart" id="testdate5" class="form-control" required></p> 
        			      <p>วัน,เวลา สิ้นสุด</p>
        			      <p><input type="datetime" name="datetime_stop" id="testdate6" class="form-control" required/></p> 
        			</div>
        			<div class="modal-footer">
         				 <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
         				 <input type="submit" name="submit" class="btn btn-success" value="ตกลง">
        			</div>
        			</form>
      				</div>
      
    			</div>
  				</div>
  				<!--out pop up-->
  		<!--start edit data-->
  		<div class="modal fade bs-example-modal-table" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="modal-title">แก้ไขข้อมูลข่าวสาร</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body no-padding">
                        <div class="table-responsive" style="  height:450px; ">
                            <div id="divDataview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>ปิด</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!--out edit data-->
    		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 	
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript" src="js/dtpk.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('.ask-custom').jConfirmAction({question : "คูณต้องการลบข้อมูลหรือไม่", yesAnswer : "ใช่", cancelAnswer : "ยกเลิก"});
         });
            function load_data(idInput)
            {
		     	var sdata = {
		     		id:idInput
		     	}
		     	$('#divDataview').load('manage_news/edit_news.php',sdata);
		     }
        	
        </script>
  				

	</body>
</html>