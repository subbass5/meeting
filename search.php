<?php  session_start();  
error_reporting(E_ALL ^ E_DEPRECATED);
       include_once 'connect/class_crud.php';
  //  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="js/jquery.datetimepicker.css">
</head>
<body>

<?php
if (isset($_POST['submit'])) {   
    $dateSe = $_POST['datesearch']; 

      if($dateSe==""){
?>
<center>
  <form id="form1" name="form1" method="post" action=""  style="padding:10px; margin:0px auto;  width:300px; border:1px solid #ccc; background-color:#F3F3F3;">
    <p><strong><h4>ค้นหาข้อมูลการจองห้องประชุม</strong> </h4></p>
    <p><strong>ประจำวันที่ : </strong>
  <input name="datesearch" type="text" id="datesearch"  size="10" readonly="readonly"  style="text-align:center;" value="" />
    </p>
    <p>

     <button name="submit" type="submit" class="btn btn-warning " id="btnAdd"  > 
        <span  class="glyphicon glyphicon-search" aria-hidden="true">  ค้นหาข้อมูล </span> 
            </button>
    </p>
  </form>
</center>


  <?php    }else{

  $eng_date1 = $dateSe ;
 ?>
   <center>
  <form id="form1" name="form1" method="post" action=""  style="padding:10px; margin:0px auto;  width:300px; border:1px solid #ccc; background-color:#F3F3F3;">
    <p><strong><h4>ค้นหาข้อมูลการจองห้องประชุม</strong> </h4></p>
    <p><strong>ประจำวันที่ : </strong>
  <input name="datesearch" type="text" id="datesearch"  size="10" readonly="readonly"  style="text-align:center;" value="<?php echo $_POST['datesearch']; ?>" />
    </p>
    <p>

     <button name="submit" type="submit" class="btn btn-warning " id="btnAdd"  > 
        <span  class="glyphicon glyphicon-search" aria-hidden="true">  ค้นหาข้อมูล </span> 
            </button>
    </p>
  </form>
</center>
<?php
  $crud = new CRUD();
    $res=mysql_query("SELECT * FROM room");
     while($row = mysql_fetch_array($res))
 {   ?>
  <?php  $id = $row['room_id'] 
  //echo $id; ?> 
<p><strong>ห้องประชุม : <?php  echo $row['name'] ?> </strong></p><table width="100%" border="1" cellspacing="1" cellpadding="3" bgcolor="#666666">
  <tr style="text-align:center; font-weight:bold; color:#990000; height: 40px  "  >
    <td width="15%" bgcolor="#DFDFDF">เวลา</td>
    <td width="50%" bgcolor="#DFDFDF">เรื่องที่ประชุม</td>
    <td width="16%" bgcolor="#DFDFDF">ผู้จอง </td>
  </tr>
   <?php
 
?>
  <?php 
    $res1=mysql_query("SELECT meeting.title,meeting.date_time_start,meeting.date_time_end,users.name FROM meeting,users WHERE meeting.user_id = users.user_id and meeting.room_id = $id and meeting.state = 1 and meeting.date_time_start like '%$eng_date1%' 
      ORDER BY meeting.date_time_start ASC ");

     if(mysql_num_rows($res1)>0){
    while($row1 = mysql_fetch_array($res1))
  {
    ?>
  <tr F3F3F3 style=" height: 40px  "  >
    <td align="center"> <?php echo substr($row1['date_time_start'],10,6) ?> น. - <?php echo substr($row1['date_time_end'],10,6) ?> น. </td>
    <td style="text-indent: 0.8em;"> <?php  echo $row1['title']; ?>  </td>
   <td  align="center"> คุณ  <?php echo   $row1['name'];  ?>  </td>
  </tr>
  <?php } 
  }else {
  ?>
   <tr style=" height: 40px  " >
    <td style="text-indent: 0.8em; color:#990000 " colspan="3" > ***ไม่มีการจอง </td>
    
   </tr>
  <?php } ?>

</table>
<p>&nbsp;</p>

 <?php } ?>
<div style="text-align:right; padding:5px; width:180px; text-align:center; background-color:#F3F3F3; border:1px solid #999; margin:0px auto;">
<a href="report.php?date=<?php echo $eng_date1  ?>" target="_blank">  <span  class="glyphicon glyphicon-print" aria-hidden="true">   </span> <br />
พิมพ์ตารางการจอง</a></div>
<p>&nbsp;</p>
  <?php  }}else{
?>
   <center>
  <form id="form1" name="form1" method="post" action=""  style="padding:10px; margin:0px auto;  width:300px; border:1px solid #ccc; background-color:#F3F3F3;">
    <p><strong><h4>ค้นหาข้อมูลการจองห้องประชุม</strong> </h4></p>
    <p><strong>ประจำวันที่ : </strong>
  <input name="datesearch" type="text" id="datesearch"  size="10" readonly="readonly"  style="text-align:center;" value="" />
    </p>
    <p>

     <button name="submit" type="submit" class="btn btn-warning " id="btnAdd"  > 
        <span  class="glyphicon glyphicon-search" aria-hidden="true">  ค้นหาข้อมูล </span> 
            </button>
    </p>
  </form>
</center>

  <?php    } ?>
     
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
<script src="js/jquery.datetimepicker.full.js"></script>
<script type="text/javascript">   
$(function(){
     
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