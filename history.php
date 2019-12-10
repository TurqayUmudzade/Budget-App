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
    <!-- MaterialICon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- ICON Monster -->
    <link rel="stylesheet" href="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css">
    <!-- Data-Tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/> 
    <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>  

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
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li>
                    <a href="history.php">History</a>
                </li>

            </ul>

        </nav>

    </header>

    <section id="history">
        <div class="container">
            <div class="heading">
                <h1 class="mainText">Your Transactions</h1>
                <div class="dashboard-controls">
                    <button class="mybtn search-month">This Month</button>
                    <button class="mybtn  search-annual">Annual</button>
                    <select class="mybtn" name="category" id="select-category-search">
                        <Option>Transportation</Option>
                        <Option>Entertainment</Option>
                        <Option>Rent</Option>
                        <Option>Phone</Option>
                        <Option>Food</Option>
                        <Option>Restaurant</Option>
                        <Option>Cinema</Option>
                        <Option>Salary</Option>
                        <Option>Scholarship</Option>
                        <Option>Pocket Money</Option>
                        <Option>Bills</Option>
                    </select>
                    <select class="mybtn search-select" name="paymentmethod" id="select-payment-search">
                        <Option>Cash</Option>
                        <Option>Check</Option>
                        <Option>Bank Card</Option>
                        <Option>Bank Transfer</Option>
                    </select>
                </div>
            </div>
            <div class="mytable">
                <table id="table" class="table table-striped table-bordered">
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

                 while($row = mysqli_fetch_assoc($result) )
                 {
                  $transactionName   = $row['idTransaction'];
                  $transactionAmount = $row['transactionAmount'];
                  $transactionDate   = $row['transactionDate'];                            
                  //Payment
                  $idPayment         = $row['idPayment'];
                  $paymentMethods=array("none","Cash","Check","Bank Card","Bank Transfer");
                  $paymentMethod     = $paymentMethods[$idPayment];

                  //Category
                  $IdCategory          = $row['idCategory'];
                  $categoryTypes=array("none","Transportation","Entertainment","Rent","Phone","Food","Restaurant","Cinema","Theater","Gas","Postage","Travel","Leisure","Salary","Scholarship","Pocket money");
                  $categoryType     = $categoryTypes[$IdCategory];

                if($IdCategory!=13  && $IdCategory!=14 && $IdCategory!=15){
                    $coef=-1;
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

    <footer>
        <div class="container">
            <div class="main">

                <div class="section one">
                <h5>About This Web App</h5>
                    <p>
                    This project was made as a part of my university course doing my 3rd year of education in the University of Starbourg.
                        <br>
                         This app lets you track all your money transactions helping you manage your budget with ease!
                    <br>
                    
                </div>

                <div class="section two ">
                    <h5>Helpful Links</h5>
                    <ul>

                        <li><i class="material-icons">
                                    chevron_right
                                </i>Add Transactions</li>

                        <li><i class="material-icons">
                                    chevron_right
                                </i>Dashboard</li>

                        <li><i class="material-icons">
                                    chevron_right
                                </i>History</li>

                    
                    </ul>
                </div>
                <div class="section three" id="2">
                    <h5>Support</h5>
                    <ul>

                        <li><i class="material-icons">
                                    chevron_right
                                </i>Privacy Policy</li>

                        <li><i class="material-icons">
                                    chevron_right
                                </i>Terms of Use</li>

                        <li><i class="material-icons">
                                    chevron_right
                                </i>Support Center</li>

                        <li><i class="material-icons">
                                    chevron_right
                                </i>Contact</li>

                    </ul>
                </div>
                <div class="section four" id="3">
                    <h5>Contact Us</h5>
                    <p>UFAZ main building</p>
                    <p>Kings Mountain, NC 28086</p>
                    <p>Phone: (+994) 070-300-88-12</p>
                    <p>E-Mail:turgayau@code.edu.az</p>
                    <div class="icons">
                        <i class="im im-facebook"></i>
                        <i class="im im-twitter"></i>
                        <i class="im im-linkedin"></i>
                        <i class="im im-github"></i>
                        <i class="im im-google-plus"></i>
                    </div>


                </div>
            </div>
            <div class="copyright">
                <p>© 2019 Turqay Umudzade. All Rights Reserved.</p>
            </div>
        </div>


    </footer>

   
    <script src="script.js"></script>

</body>

</html>