<?php


 include "conn.php"; 

 $date = date('Y-m-d', strtotime($_POST['date']));
 
//TODO Sends to DataBase
$query= "INSERT INTO transactions (transactionAmount,transactionDate,idCategory,idPayment)
 VALUES (".$_POST["amount"].",'" .$date."' ,".$_POST["category"].",".$_POST["payment"].")";


  if ($link->query($query) === TRUE) //?If record was Created
   {
     header( 'Location: http://localhost/dashboard/HW/home.html');
  } else {
    echo "Error: " . $query . "<br>" . $link->error;
 }

$link->close();

?>



