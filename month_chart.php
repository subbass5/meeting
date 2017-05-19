<?php  session_start();  
       error_reporting(E_ALL ^ E_DEPRECATED);
       include_once 'connect/class_crud.php';
      // $crud = new CRUD();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

</head>
<body bgcolor="#fff" >

	<?php
if (isset($_POST['submit'])) {   
    $date = $_POST['fromYear']; 
    $date_Y = $date-543;
    $month1 =  $_POST['Month'];
    $room  = $_POST['room'];
    if($month1<10){
    	$month1 = "0".$month1;

    }
   // echo $month1;

   $m_y= "" . $date_Y . "-".$month1."" ;

 //  echo  $m_y,$room;
?>
    
<form id="form1" name="form1" method="post" action="" >
<div class="row"  >
    <div  align="center">    <br> </div>
    <div class="col-xs-3" align="center" >
  <select name="room" class="form-control" > 
   <?php
     $crud = new CRUD(); 

      $strSQL="SELECT * FROM room ORDER BY room_id ASC";
       
      $objQuery = mysql_query($strSQL);

       $strSQL1="SELECT * FROM room WHERE room_id = $room";

        $objQuery1 = mysql_query($strSQL1);

      ?>
    <?php
      while($objResuut1 = mysql_fetch_array($objQuery1))
      {
      ?>   
      <option value="<?php echo $objResuut1["room_id"];?>"><?php echo $objResuut1["name"];?></option>
      <?php
      }
      ?>
      <?php
      while($objResuut = mysql_fetch_array($objQuery))
      {
      ?>   
      <option value="<?php echo $objResuut["room_id"];?>"><?php echo $objResuut["name"];?></option>
      <?php
      }
      ?>
      </select>
    </div>
 <div class="col-xs-1" align="center" >
   <h4>  เดือน </h4>
    </div>
  <div class="col-xs-3">
	  <?php 
	    $m = $_POST['Month'];
	    $month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน", 
	     "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
	?> 
	<select name="Month" class="form-control" > 
	    <option>เดือน</option> 
	  <?php 
echo $month1;
	  foreach ($month as $key=>$val) { ?> 
	  <option value="<?=$key+1?>" <?=($key == $m-1) ? 'selected="selected"' : '' ?>><?=$val?></option> 
	  <?php } ?> 
	</select> 
  </div>

 <div class="col-xs-1" align="center" >
   <h4> พ.ศ. </h4>
    </div>

    <div class="col-xs-2">
       <select name="fromYear" class="form-control"  >
 <?php   
 $starting_year  =$date_Y+533;
 $ending_year = $date_Y+553;
 $current_year = $date_Y+543;
 for($starting_year; $starting_year <= $ending_year; $starting_year++) {
     echo '<option value="'.$starting_year.'"';
     if( $starting_year ==  $current_year ) {
            echo ' selected="selected"';
     }
     echo ' >'.$starting_year.'</option>';
 }     ?>          

 </select>

    </div>
<div class="col-xs-2"  >
   <button name="submit" type="submit" class="btn btn-danger " id="btnAdd"  > 
        <span  class="glyphicon glyphicon-search" aria-hidden="true">  ค้นหา </span> 
            </button>
    </div>

  </div>
  </form>  

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
   <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            

            <?php
        
               $date = date("Y-m");
    
             $strSQL="SELECT * FROM room ORDER BY room_id = $room";
            $objQuery = mysql_query($strSQL);

            while($objResuut = mysql_fetch_array($objQuery)){
                $name  = $objResuut['name'];    
               $id   = $objResuut['room_id'];       
}
           
  $sql1="SELECT date_time_start, COUNT(*) as number FROM meeting WHERE room_id = $id AND date_time_start like '%$m_y%' GROUP BY CAST(date_time_start AS DATE)";
                

            //  echo $sql1;
              $objQuery = mysql_query($sql1);
              $num =mysql_num_rows($objQuery);
            if ($num==0) {
   //   echo " ['',  ' '],
//['',  0],
  //   ?>         
       
           

         <?php   }else{ 

          echo " ['day',  ' $name'],";
          while($row = mysql_fetch_array($objQuery)) {  
               echo "['วันที่ ".  substr($row["date_time_start"],8,2)."', ".$row["number"]."],";  
           
                 }
             } ?>  
      ]);
            
    var options = {
        annotations: {
        // remove annotation stem and push to middle of chart
        stem: {
          color: 'transparent',
          length: 120
        },
        textStyle: {
          color: '#9E9E9E',
          fontSize: 30
        }
      },
      animation: {
                duration: 1500,
                startup: true
            },
     
        title: 'สถิติการใช้ห้อง '+'<?php echo  $name; ?>'  ,
        titleTextStyle: {
        fontSize: 20, // 12, 18 whatever you want (don't specify px)
        bold: true,    // true or false
 // true of false
     legend:'left'
    }, 
      vAxis: {title: 'จำนวนการใช้ห้องประขุม (ครั้ง)'},
      hAxis: {title: 'เดือน'},
      seriesType: 'bars',
     // series: {5: {type: 'line'}}
    };

 function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }    
    
    options.series={};
    for(var i = 0;i < data.getNumberOfRows();i++){
        options.series[i]={color:getRandomColor()}
    }
 var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    // if no data add row for annotation -- No Data Copy
    if (data.getNumberOfRows() === 0) {
    data.addColumn('string', '');
  data.addColumn('number', '');
  data.addColumn({type: 'string', role: 'annotation'});
          
       data.addRows([
    
    ['', 0, 'ไม่มีข้อมูล']
  ]);
    }

   

    chart.draw(data, options);

    
  }


</script>

 <div id="chart_div" style="width: 100%; height: 600px;">
    <!--   <?php  if($num==0){ 
  //  echo   "<div> ไม่มีข้อมูล </div>";
}
?> -->
    
 </div>

 <?php 
        }else { ?>

<form id="form1" name="form1" method="post" action="" >
<div class="row"  >
    <div  align="center">    <br> </div>
    <div class="col-xs-3" align="center" >
  <select name="room" class="form-control" > 
   <?php
     $crud = new CRUD(); 

      $strSQL="SELECT * FROM room ORDER BY room_id ASC";
      
      $objQuery = mysql_query($strSQL);
      while($objResuut = mysql_fetch_array($objQuery))
      {
      ?>   
      <option value="<?php echo $objResuut["room_id"];?>"><?php echo $objResuut["name"];?></option>
      <?php
      }
      ?>
      </select>
    </div>
 <div class="col-xs-1" align="center" >
   <h4>  เดือน </h4>
    </div>
  <div class="col-xs-3">
	  <?php 
	    $m = date('m'); 
	    $month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน", 
	     "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"); 
	?> 
	<select name="Month" class="form-control" > 
	    <option>เดือน</option> 
	  <?php foreach ($month as $key=>$val) { ?> 
	  <option value="<?=$key+1?>" <?=($key == $m-1) ? 'selected="selected"' : '' ?>><?=$val?></option> 
	  <?php } ?> 
	</select> 
  </div>

 <div class="col-xs-1" align="center" >
   <h4> พ.ศ. </h4>
    </div>

    <div class="col-xs-2">
       <select name="fromYear" class="form-control"  >
 <?php   
 $starting_year  =date('Y', strtotime('-10 year'))+543;
 $ending_year = date('Y', strtotime('+10 year'))+542;
 $current_year = date('Y')+543;
 for($starting_year; $starting_year <= $ending_year; $starting_year++) {
     echo '<option value="'.$starting_year.'"';
     if( $starting_year ==  $current_year ) {
            echo ' selected="selected"';
     }
     echo ' >'.$starting_year.'</option>';
 }     ?>          

 </select>

    </div>
<div class="col-xs-2"  >
   <button name="submit" type="submit" class="btn btn-danger " id="btnAdd"  > 
        <span  class="glyphicon glyphicon-search" aria-hidden="true">  ค้นหา </span> 
            </button>
    </div>

      
           
     
  </div>
  </form>  

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
   <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            <?php
        
               $date = date("Y-m");
    
             $strSQL="SELECT * FROM room ORDER BY room_id ASC limit 1";
            $objQuery = mysql_query($strSQL);

            while($objResuut = mysql_fetch_array($objQuery)){
                $name  = $objResuut['name'];    
               $id   = $objResuut['room_id'];       
}
            ?>   

         ['day',  '<?php echo $name?> '],

          <?php

              $sql1="SELECT date_time_start, COUNT(*) as number FROM meeting WHERE room_id = $id AND date_time_start like '%$date%' GROUP BY CAST(date_time_start AS DATE)";
                   $sql="SELECT date_time_start FROM meeting  WHERE room_id = $id AND date_time_start like '%$date%' ";
              $objQuery = mysql_query($sql1);

          while($row = mysql_fetch_array($objQuery)) {  
               echo "['วันที่ ".  substr($row["date_time_start"],8,2)."', ".$row["number"]."],";  
           
               }  
             ?>  
      ]);
           

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));



     <?php  include 'data_month.php'  ?>
    var options = {
        title: 'สถิติการใช้ห้อง '+'<?php echo  $name; ?>'  ,
        titleTextStyle: {
        fontSize: 20, // 12, 18 whatever you want (don't specify px)
        bold: true,    // true or false
 // true of false
     legend:'left'
    }, 
      vAxis: {title: 'จำนวนการใช้ห้องประขุม (ครั้ง)'},
      hAxis: {title: 'เดือน ' },
      seriesType: 'bars',
     // series: {5: {type: 'line'}}
  animation: {
                duration: 1500,
                startup: true
            },
  
    };
  
        function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }    
    
    options.series={};
    for(var i = 0;i < data.getNumberOfRows();i++){
        options.series[i]={color:getRandomColor()}
    }

    chart.draw(data, options);

      
}
  


<?php } ?>

</script>
 <div id="chart_div" style="width: 100%; height: 600px;"></div>


</body>
</html>