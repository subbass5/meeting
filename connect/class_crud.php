<?php  include 'dbconfig.php';

class CRUD
{
   function __construct()
   {
       $db = new DB_con();

   }
   public function create($strdataTable,$strdataValue)
    {
     return mysql_query("INSERT INTO ".$strdataTable./*users(first_name,last_name,user_city)*/
                                        " VALUES".$strdataValue);   //"('$fname','$lname','$city')");
    }
 
   public function read($strTableName,$strCondition)
   {
    $strQurey = "SELECT  * FROM ".$strTableName." ".$strCondition." ";
     return  mysql_query($strQurey) or die(mysql_error());
   
   }
   public function update($strQureyUpdate)
   {
    return mysql_query($strQureyUpdate);
   }

   public function deleteData($strTableName,$strColID,$strId)
   {
   return mysql_query("DELETE FROM ".$strTableName." WHERE ".$strColID."=".$strId);  
   }

   public function ElseCondition($str)
   {
     return mysql_query($str);
   }

}
?>