<?php  session_start();  
error_reporting(E_ALL ^ E_DEPRECATED);
       include_once 'connect/class_crud.php';
	//	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
	</style>
</head>
<?php
$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$thai_month_arr=array(
    "0"=>"",
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน", 
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"                 
);
function thai_date($time){
    global $thai_day_arr,$thai_month_arr;
  //  $thai_date_return="วัน".$thai_day_arr[date("w",$time)];
    $thai_date_return = "วันที่ ".date("j",$time);
    $thai_date_return.=" เดือน ".$thai_month_arr[date("n",$time)];
    $thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
    return $thai_date_return;
}
?>
<body >

 <h4>รายการจองห้องประชุมประจำ 
  <?php	
  $date = $_POST['sdata'];
   //echo $id,$var1;
    $eng_date1 = $date; 
  														// แสดงวันที่ปัจจุบัน
   echo thai_date(strtotime($eng_date1));  ?> </h3></center>
   
<p>&nbsp;</p>
 <?php
	$crud = new CRUD();
 		$res=mysql_query("SELECT * FROM room");
 		 while($row = mysql_fetch_array($res))
 {	 ?>
	<?php  $id = $row['room_id'] 
	//echo $id; ?> 
<p><strong>ห้องประชุม : <?php  echo $row['name'] ?> </strong></p><table width="100%" border="1" cellspacing="1" cellpadding="3" bgcolor="#666666">
  <tr style="text-align:center; font-weight:bold; color:#990000; height: 40px  "  >
    <td width="15%" bgcolor="#DFDFDF">เวลา</td>
    <td width="50%" bgcolor="#DFDFDF">เรื่องที่ประชุม</td>
    <td width="16%" bgcolor="#DFDFDF">ผู้จอง </td>
    <td width="16%" bgcolor="#DFDFDF">สถานะ </td>
  </tr>
   <?php
  //$date = date("Y-m-d");
 // 
  $date = substr($eng_date1,0,10);
    //echo($date);
?>
	<?php 
    $sql ="SELECT meeting.title,meeting.date_time_start,meeting.date_time_end,users.name FROM meeting,users WHERE meeting.user_id = users.user_id and meeting.room_id = $id and meeting.state = 0 and meeting.date_time_start like '%$date%' 
      ORDER BY meeting.date_time_start ASC ";
    //  echo $sql;
		$res1=mysql_query($sql);

 		 if(mysql_num_rows($res1)>0){
 		while($row1 = mysql_fetch_array($res1))
 	{
	  ?>
  <tr F3F3F3 style=" height: 40px  "  >
    <td align="center"> <?php echo substr($row1['date_time_start'],10,6) ?> น. - <?php echo substr($row1['date_time_end'],10,6) ?> น. </td>
    <td style="text-indent: 0.8em;"> <?php  echo $row1['title']; ?>  </td>
 	 <td  align="center"> คุณ  <?php echo   $row1['name'];  ?>  </td>
   <td  align="center" style="color:#1515ed" > รออนุมัติ  </td>
  </tr>
	<?php } 
	}else {
	?>
	 <tr style=" height: 40px  " >
	 	<td style="text-indent: 0.8em; color:#990000 " colspan="3" > ***ไม่มีการจอง </td>
	 	<td bgcolor="383630" ></td>
	 </tr>
	<?php } ?>


</table>
<p>&nbsp;</p>

 <?php } ?>

<div style="text-align:right; padding:5px; width:180px; text-align:center; background-color:#F3F3F3; border:1px solid #999; margin:0px auto;">
<a href="reportApp.php?date=<?php echo $date ?>" target="_blank">  <span  class="glyphicon glyphicon-print" aria-hidden="true" style="font-size: 20px" ></span> <br />
พิมพ์ตารางการจอง</a></div>
<p>&nbsp;</p>


</center>
</body>
</html>