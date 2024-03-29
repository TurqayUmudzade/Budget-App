<?php

 include "conn.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!-- MaterialICon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- ICON Monster -->
    <link rel="stylesheet" href="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
         <!-- Chart -->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <!-- MY CSS -->
    <link rel="stylesheet" href="style.css">

    <title>Dashboard</title>
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

    
        <section id="dashboard">

            <div class="mycontainer">
            <div class="boxes">

<!-- POPULAR CAT -->
    <div class="box">
        <div class="head">
            <h2>Popular Categories</h2>
        </div>
        <div class="body popular-box-body">
          
            <ul>
            <?php
            //?Find most popular
        // SELECT COUNT(transactions.idTransaction) as NumberOFTransactions,transactions.idCategory,categories.category ,
        // ROUND(SUM(transactions.transactionAmount),1) AS Amount
        //  FROM `transactions`,categories
        //   WHERE transactions.idCategory=categories.idCategory
        //    GROUP BY idCategory ORDER BY `Amount` DESC

        $queryCat="SELECT
                         COUNT(transactions.idTransaction) as NumberOfTransactions,transactions.idCategory,
                         categories.category as nameCat,
                         ROUND(SUM(transactions.transactionAmount),1) AS Amount
                         FROM `transactions`,categories
                         WHERE transactions.idCategory=categories.idCategory AND categories.idAccounting=2 
                         GROUP BY idCategory ORDER BY `Amount` DESC LIMIT 5";
          $resultCat=mysqli_query($link,$queryCat);  

          $PopCatArray = array("Categories");
          $AmoutCatArray = array("AmountPerCategory");

          while($row=mysqli_fetch_assoc($resultCat)){
              $countCat=$row['NumberOfTransactions'];
              $amountCat=$row['Amount'];
              $nameCat=$row['nameCat'];

              array_push($PopCatArray, $nameCat);
              array_push($AmoutCatArray, $amountCat);
              echo"<li> <i class='material-icons'>
              keyboard_arrow_right
              </i> {$nameCat} <p id='p-amountCat'>{$amountCat}$</p> <p id='p-countCat'>{$countCat}</p> </li>";

          }            

           ?>
            </ul>
        
        </div>
        <div class="box-footer">
            <div class="design" id="y-design"></div>
            <p>Transactions</p>
            <div class="design" id="r-design"></div>
            <p> Money Spent</p>
        </div>
    </div>
    <!-- STATISTICS MIDDLE 2 BOXES -->
    <div class="box parent-box">
        <div class="mini-box">
            <div class="mini-head">
                <h3>Total Expenses</h3>
            </div>
            <div class="mini-body">
            <div class="money-amount">
                <?php

                //This weeks spending
                $now=date("Y-m-d");
                $week_ago=date("Y-m-d", strtotime("-1 week"));
                $query_week="SELECT ROUND(SUM(transactionAmount),1) as sum
                FROM `transactions`
                WHERE  (transactionDate BETWEEN ' " . $week_ago ." ' AND ' " . $now. " ')";
                $result_week = mysqli_query($link, $query_week);
                $dataWeek=mysqli_fetch_assoc($result_week);
                $this_week_spent=$dataWeek['sum'];


                //this month spendings

                $now=date("Y-m-d");
                $month_ago=date("Y-m-d", strtotime("-1 month"));
                $query_month="SELECT ROUND(SUM(transactionAmount),1) as sum
                FROM `transactions`
                WHERE  (transactionDate BETWEEN ' " . $month_ago ." ' AND ' " . $now. " ')";
                $result_mouth = mysqli_query($link, $query_month);
                $data_month=mysqli_fetch_assoc($result_mouth);
                $this_month_spent=$data_month['sum'];
                ?>
               
                  
                    <h2> <i class="material-icons">
                attach_money
                  </i> <?php echo $this_week_spent; ?> </h2>
                    
                    <h2> <i id="icon-no-left"class="material-icons">
                attach_money
                  </i><?php echo $this_month_spent; ?></h2>
                </div>
                <div class="time-span">
                    <h5>This Week</h5>
                    <h5>This Month</h5>
                </div>
            </div>
            
        </div>
        <div class="mini-box">
            <div class="mini-head">
                <h3>Total Transactions</h3>
            </div>
            <div class="mini-body">
            <div class="money-amount">
                <?php

                //!This week's transactions
                $now=date("Y-m-d");
                $week_ago=date("Y-m-d", strtotime("-1 week"));
                $query_week="SELECT COUNT(idTransaction) as count
                FROM `transactions`
                WHERE  (transactionDate BETWEEN ' " . $week_ago ." ' AND ' " . $now. " ')";
                $result_week = mysqli_query($link, $query_week);
                $dataWeek=mysqli_fetch_assoc($result_week);
                $this_week_transaction_count=$dataWeek['count'];


                //!This month's transactions

                $now=date("Y-m-d");
                $month_ago=date("Y-m-d", strtotime("-1 month"));
                $query_month="SELECT COUNT(idTransaction) as count
                FROM `transactions`
                WHERE  (transactionDate BETWEEN ' " . $month_ago ." ' AND ' " . $now. " ')";
                $result_mouth = mysqli_query($link, $query_month);
                $data_month=mysqli_fetch_assoc($result_mouth);
                $this_month_transaction_count=$data_month['count'];
                ?>
               
                  
                    <h2> <?php echo $this_week_transaction_count; ?> </h2>
                    
                    <h2> <?php echo $this_month_transaction_count; ?></h2>
                </div>
                <div class="time-span">
                    <h5>This Week</h5>
                    <h5>This Month</h5>
                </div>
            </div>
        </div>
    </div>
        <!-- POPULAR PAYMENT OPTIONS -->
    <div class="box">
        <div class="head">
            <h2>Popular Transactions</h2>
        </div>
        <div class="body popular-box-body">
                    

            <ul>
                <li> 
                
                <i class="material-icons">
                    keyboard_arrow_right
                    </i>Cash
                   
                    <?php 
                     //!Sends a query for negative sum and positive sum
                     $query="SELECT ROUND(SUM(transactionAmount),1) as sumCash
                      FROM `transactions`,categories
                       WHERE categories.idCategory=transactions.idCategory AND idPayment=1 AND categories.idAccounting=1 
                       UNION
                        SELECT ROUND(SUM(transactionAmount),1) 
                        FROM `transactions`,categories
                         WHERE categories.idCategory=transactions.idCategory AND idPayment=1 AND categories.idAccounting=2";
                     $result=mysqli_query($link,$query);
                     $i=1;
                     while($row=mysqli_fetch_assoc($result))
                     {
                     $sumCash=$row['sumCash'];
                     echo "<p id = 'p$i'>{$sumCash}$</p>";
                     $i=2;
                     }
                    ?>
                    </li>
                <li><i class="material-icons">
                    keyboard_arrow_right
                    </i> Check
                    <?php 
                     $query="SELECT ROUND(SUM(transactionAmount),1) as sumCash
                      FROM `transactions`,categories
                       WHERE categories.idCategory=transactions.idCategory AND idPayment=2 AND categories.idAccounting=1 
                       UNION
                        SELECT ROUND(SUM(transactionAmount),1) 
                        FROM `transactions`,categories
                         WHERE categories.idCategory=transactions.idCategory AND idPayment=2 AND categories.idAccounting=2";
                     $result=mysqli_query($link,$query);
                     $i=1;
                     while($row=mysqli_fetch_assoc($result))
                     {
                         
                     
                     $sumCash=$row['sumCash'];
                     
                     echo "<p id = 'p$i'>{$sumCash}$</p>";
                     $i=2;
                     }
                    ?></li>
                <li> <i class="material-icons">
                    keyboard_arrow_right
                    </i> Bank Card
                    <?php 
                     $query="SELECT ROUND(SUM(transactionAmount),1) as sumCash
                      FROM `transactions`,categories
                       WHERE categories.idCategory=transactions.idCategory AND idPayment=3 AND categories.idAccounting=1 
                       UNION
                        SELECT ROUND(SUM(transactionAmount),1) 
                        FROM `transactions`,categories
                         WHERE categories.idCategory=transactions.idCategory AND idPayment=3 AND categories.idAccounting=2";
                     $result=mysqli_query($link,$query);
                     $i=1;
                     while($row=mysqli_fetch_assoc($result))
                     {
                         
                     
                     $sumCash=$row['sumCash'];
                     
                     echo "<p id = 'p$i'>{$sumCash}$</p>";
                     $i=2;
                     }
                    ?></li>
                <li><i class="material-icons">
                    keyboard_arrow_right
                    </i> Bank Transfer
                     <?php 
                     $query="SELECT ROUND(SUM(transactionAmount),1) as sumCash
                      FROM `transactions`,categories
                       WHERE categories.idCategory=transactions.idCategory AND idPayment=4 AND categories.idAccounting=1 
                       UNION
                        SELECT ROUND(SUM(transactionAmount),1) 
                        FROM `transactions`,categories
                         WHERE categories.idCategory=transactions.idCategory AND idPayment=4 AND categories.idAccounting=2";
                     $result=mysqli_query($link,$query);
                     $i=1;
                     while($row=mysqli_fetch_assoc($result))
                     {
                         
                     
                     $sumCash=$row['sumCash'];
                     
                     echo " <p id = 'p$i'>{$sumCash}$</p>";
                     $i=2;
                     }
                    ?></li>
                <li> <i class="material-icons">
                    keyboard_arrow_right
                    </i>Other<p class="money-per-cat"></p></li>
            </ul>
        </div>
        <div class="box-footer">
        <div class="design" id="r-design"></div>
            <p> Money Spent</p>
            <div class="design" id="g-design"></div>
            <p>Money Recieved</p>
            
        </div>
    </div>
</div>
            </div>
        </section>
      

    

   <section id="chart"> 
       <div class="mycontainer">
        <canvas id="myChart"></canvas>
    </div>
</section>

<?php
echo"
<script>
let myChart = document.getElementById('myChart').getContext('2d');

// Global Options

Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.defaultFontColor = '#000000';

let massPopChart = new Chart(myChart, {
    type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
    data: {
        labels: ['$PopCatArray[1]', '$PopCatArray[2]', '$PopCatArray[3]', '$PopCatArray[4]', '$PopCatArray[5]'],
        datasets: [{
            label: 'Money',
            data: [
                $AmoutCatArray[1],
                $AmoutCatArray[2],
                $AmoutCatArray[3],
                $AmoutCatArray[4],
                $AmoutCatArray[5],
               
            ],
            
            backgroundColor: [
                'rgba(225, 43, 56,0.8)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.6)',
                
            ],
            borderWidth: 1,
            borderColor: '#777',
            hoverBorderWidth: 3,
            hoverBorderColor: '#000'
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Your Top 5 Spendings ',
            fontSize: 25
        },
        legend: {
            display: true,
            position: 'right',
            labels: {
                fontColor: '#000'
            }
        },
        layout: {
            padding: {
                left: 50,
                right: 0,
                bottom: 0,
                top: 0
            }
        },
        tooltips: {
            enabled: true
        }
    }
});</script>";
?>
   

    <footer>
        <div class="container">
            <div class="main">

                <div class="section one">
                    <h5>About This Web App</h5>
                    <p>
                        This project was made as a part of my university course doing my 3rd year of education in the University of Starbourg.
                        <br> This app lets you track all your money transactions helping you manage your budget with ease!
                        <br>

                </div>

                <div class="section two ">
                    <h5>Helpful Links</h5>
                    <ul>

                        <li><a href="home.html"><i class="material-icons">
                                        chevron_right
                                    </i></a> Add Transactions</li>

                        <li><a href="dashboard.php"><i class="material-icons">
                                        chevron_right
                                    </i></a>Dashboard</li>

                        <li><a href="history.php"><i class="material-icons">
                                        chevron_right
                                    </i></a>History</li>


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

                        <li> <i class="material-icons">
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
                        <a href="https://www.facebook.com/turqay.umudzade" target="_blank"><i class="im im-facebook"></i></a>
                        <i class="im im-twitter"></i>
                        <a href="https://www.linkedin.com/in/turqay-umudzade-05b779157/" target="_blank"><i class="im im-linkedin"></i></a>
                        <a href="https://github.com/TurqayUmudzade" target="_blank"><i class="im im-github"></i></a>
                        <i class="im im-google-plus"></i>
                    </div>


                </div>
            </div>
            <div class="copyright">
                <p>© 2019 Turqay Umudzade. All Rights Reserved.</p>
            </div>
        </div>


    </footer>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="Loader.js"></script>


</body>

</html>