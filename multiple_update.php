
<?php

//multiple_update.php

include('database_connection.php');

if(isset($_POST['hidden_id']))
{
 $status = $_POST['status'];
 for($count = 0; $count < count($id); $count++)
 {
  $data = array(
   ':status'  => $status[$count],
   ':id'   => $id[$count]
  );
  $query = "
  UPDATE registration 
  SET  status = :status
  WHERE id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
 }
}

?>