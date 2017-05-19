<?php  session_start();  
 ob_start(); 
 error_reporting(E_ALL ^ E_DEPRECATED);
 	 	include 'data_month.php';
       	include_once 'connect/class_crud.php';
       $crud = new CRUD();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	 <!-- datepicker -->
	 <link rel="stylesheet" href="js/jquery.datetimepicker.css">
	 <!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="js/jquery.datetimepicker.full.js"></script>
	
<!-- //////////d///////////////////////// -->
  <!-- dddddddddddddddddddddddddddddddddddddddddddddddddddddddd -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" conten
		="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>index meeting</title>
		<!-- Bootstrap CSS -->	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/scroll.css">

<?php error_reporting(E_ALL & ~E_NOTICE); 
$file=$_GET["page"]; 
?>
<style type="text/css" media="screen">
.boxmenu {
	-webkit-border-top-left-radius:10px;
	-moz-border-radius-topleft:10px;
	border-top-left-radius:10px;
	-webkit-border-top-right-radius:10px;
	-moz-border-radius-topright:10px;
	border-top-right-radius:10px;
	-webkit-border-bottom-right-radius:10px;
	-moz-border-radius-bottomright:10px;
	border-bottom-right-radius:10px;
	-webkit-border-bottom-left-radius:10px;
	-moz-border-radius-bottomleft:10px;
	border-bottom-left-radius:10px;
	border:1px solid #666;
	background-color:#F3F3F3;
}
.bartitle{
	background-color:#B6B0BB; 
	padding:3px;
	border:1px solid #CCC;
	margin:0px;
	text-align:center;

	-webkit-border-top-left-radius:10px;
	-moz-border-radius-topleft:10px;
	border-top-left-radius:10px;
	-webkit-border-top-right-radius:10px;
	-moz-border-radius-topright:10px;
	border-top-right-radius:10px;

	
}



	body ul li{
	line-height:35px; list-style:url(img/arrow.png);
}
</style>
	</head>
	<body style=" background-color: #F3F3F3">

			<div class="container">
			
				<table align="center">
					<tr>
						<td align="center">
						 <img src="img/header1.png" style="width: 100%; height: 250px;">
						</td>
					</tr>
					<tr valign="top">
						<td valign="top">
						<TABLE style="width: 100%; " border="0" valign="center" >
						<tr valign="top" >
					
							<!-- Manu -->
							<td width="250">
								<table border="1" width="250">
									<!-- Manu1 -->
								<div >
							<div class="boxmenu">
						        <h3 class="bartitle">รายการจองห้องประชุม</h3>
						        <ul>
								<h5>
						        	<li><a href="index.php">หน้าแรก</a></li>
						  	
						            <li><a href="?page=login">จองห้องประชุม</a></li>
						            <li><a href="?page=today">ตารางการใช้ห้องประชุมวันนี้</a></li>
						    		<li><a href="?page=search">ค้นหาข้อมูลการจอง/พิมพ์</a></li>
						            
						        </ul>
						</div>
								<br><br>

		<!-- Manu2 -->
		<div class="boxmenu">
        <h3 class="bartitle">เกี่ยวกับห้องประชุม</h3>
        <ul>  
        <h5>
            <li><a href="?page=room">รายละเอียดห้องประชุม</a></li>
            <li><a href="?page=month_chart">สถิติการใช้ห้องประชุมรายเดือน</a></li>
            <li><a href="?page=year_chart">สถิติการใช้ห้องประชุมรายปี</a></li>    
  
        </ul>
		</div>
			<br><br>						     
				<!-- Manu3 -->
														     
					<div class="boxmenu">
					        <h3 class="bartitle">ติดต่อเรา</h3>
					<div style="padding:5px; text-align:center;">มหาวิทยาลัยเทคโนโลยี<br />
					ราชมงคลล้านนา ตาก<br />
					  41/1 หมู่ 7 ถนนพหลโยธิน ตำบลไม้งาม
					    <br />
					    อำเภอเมือง จังหวัดตาก 63000 <br />
						โทรศัพท์ : 0 5551 5900 <br /> โทรสาร : 0 5551 1833 
					    </div>
					</div>
								</table>
							</td>
				<!-- Content -->
				<td valign="top" align="center" bgcolor="#CCC" width="95%" >
				<div class="scroll" style="height: 1300px;">
					<table class="table-ss" width="95%" style="padding:5px;""  >
					<!-- ตัวหนัววิ่ง -->			
					
						<tr> 
							<td colspan="" rowspan="" headers=""> <Br></td>
						</tr>
						<?php
						if($file=="")
						{ ?>
						
					<!-- Contest include1 -->
						<tr  > 
							<td> 
							 <?php 
								// header('include:new.php');
								 	include 'new.php';
								 ?>
							</td>
						</tr>
						<tr> 
							<td> 
							 					
							<Br></td>
						</tr>
							<!-- Contest include2 -->
						<tr> 
							<td > 	
						 <?php 
						       
								 	include 'calendar.php';
							     
								
								 ?>
					   		</td>
						</tr>
						<?php
						}else {
						 ?>
						<tr> 
							<td > 
							<?php
							     
					   	         include $file.".php";  
					   	}?>
      						</td>
						</tr>
						
						  
					
					</table>




				</td>
				</div>

						
						</tr>

						</TABLE>
						</td>
					</tr>
				
				<tr >
				</table>
			</div>

<?php include 'footer.php';?>
       
		
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <!-- <script type="text/javascript" src="js/script.js"></script> -->

<script src="js/jquery.datetimepicker.full.js"></script>
<script type="text/javascript">   
 $(document).ready(function() {
     	$.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
     
 
    // กรณีใช้แบบ input
    $("#datesearch").datetimepicker({
        timepicker:false,
        format:'Y-m-d',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        onSelectDate:function(dp,$input){
            var yearT=new Date(dp).getFullYear()-0;  
            var yearTH=yearT+543;
            var fulldate=$input.val();
          //  var fulldateTH=fulldate.replace(yearT,yearTH);
            $input.val(fulldate);
        },
    });     
 });
</script>
</body>
</html>
<? ob_end_flush() ?>