<?php

 include "conn.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
     <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
     
    <title>Document</title>
</head>

<body>

    <div class="loader-wrapper">
        <span class="loader">
                <span class="loader-inner"></span>
        </span>
    </div>

    <header>
        <nav>
            <ul>
                <li>
                    <a href="home.html">Home</a>
                </li>
                <li>
                    <a href="dashboard.html">Dashboard</a>
                </li>
                <li>
                    <a href="history.html">History</a>
                </li>

            </ul>

        </nav>

    </header>

    <section id="dashboard">
        <div class="container">
            <div class="heading">
                <h1 class="mainText">Your Transactions</h1>
                <div class="dashboard-controls">
                    <button class="mybtn">This Month</button>
                    <button class="mybtn">Annual</button>
                    <select name="category" id="category">
                        <Option>Salary</Option>
                        <Option>Scholarship</Option>
                        <Option>Food</Option>
                        <Option>Entertainment</Option>
                        <Option>Bills</Option>
                    </select>
                    <select name="paymentmethod">
                        <Option>Cash</Option>
                        <Option>CreditCardd</Option>
                        <Option>Check</Option>
                    </select>
                </div>
            </div>
            <div class="mytable">
                <table class="table table-sm col-md-8">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Category</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM transactions";
                        $result = mysqli_query($link, $query);

                        while($row = mysqli_fetch_assoc($result) ){
                            $transactionName   = $row['idTransaction'];
                            $transactionAmount = $row['transactionAmount'];
                            $transactionDate   = $row['transactionDate'];
                            
                            
                  
                            //Payment
                  $idPayment         = $row['idPayment'];
                  $query_payment     = "SELECT paymentMethod FROM payments WHERE idPayment = '{$idPayment}'";
                  $result_payment    = mysqli_query($link, $query_payment);
                  $data_payment      = mysqli_fetch_assoc($result_payment);
                  $paymentMethod     = $data_payment['paymentMethod'];


                  //Category
                  $IdCategory          = $row['idCategory'];
                  $query_category="SELECT category FROM `categories` WHERE idCategory='{$IdCategory}'";
                  $result_category    = mysqli_query($link, $query_category);
                  $data_category      = mysqli_fetch_assoc($result_category);
                  $categoryType     = $data_category  ['category'];


                            //Accounting

                  $query_idAc="SELECT idAccounting FROM `categories` WHERE idCategory='{$IdCategory}'";
                  $result_idAc    = mysqli_query($link, $query_idAc);
                  $data_idac      = mysqli_fetch_assoc($result_idAc);

                  $idAccounting      = $data_idac['idAccounting'];
                  $query_accounting  = "SELECT * FROM accounting WHERE idAccounting = '{$idAccounting}'";
                  $result_accounting = mysqli_query($link, $query_accounting);
                  $data_accounting   = mysqli_fetch_assoc($result_accounting);
                  $accountingType    = $data_accounting['accountingType'];
                  $coef              = $data_accounting['multiplierCoefficient'];
                  if($coef == -1){
                    $transactionAmount=$coef*$transactionAmount;
                  }

                  echo "<tr>";
                 
                  echo "<td>{$transactionName}</td>";
                  echo "<td> {$transactionAmount}</td>";
                  echo "<td>{$categoryType }</td>";
                  echo "<td>{$paymentMethod}</td>";
                  echo "<td>{$transactionDate}</td>";
                  echo "</tr>";

                        }
                        ?>
                        
                        
                    </tbody>
                </table>
            </div>


        </div>


    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>

</html>