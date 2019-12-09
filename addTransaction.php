<?php

 include "conn.php"; 

 $date = date('Y-m-d', strtotime($_POST['date']));
 

$query= "INSERT INTO transactions (transactionAmount,transactionDate,idCategory,idPayment)
 VALUES (".$_POST["amount"].",'" .$date."' ,".$_POST["category"].",".$_POST["payment"].")";


  if ($link->query($query) === TRUE) {
   //   echo "New record created successfully";
     header( 'Location: http://localhost/dashboard/HW/home.html');
  } else {
    echo "Error: " . $query . "<br>" . $link->error;
 }

$link->close();

?>



