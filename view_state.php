<?php 
     include  'connect/class_crud.php';
     $crud = new CRUD();
     $strQuery = "SELECT * FROM meeting WHERE state=0";
     $res = $crud->ElseCondition($strQuery);
     $num_rows = mysql_num_rows($res);
     
        echo $num_rows;


 ?>