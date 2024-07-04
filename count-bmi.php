<?php
    include('connection.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food List and BMI Calculator</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/s1.css"> -->
    <style type="text/css">
       
body {
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
  color: #333; 
}

h1, h2 {
  color: orange; 
}
h4 {
  color: white; 

}

a {
  color: white; 
  text-decoration: none;

}

a:hover {
  color: #007bff; 
}

#header {
  background-color: orange; 
  color: #fff; 
  padding: 10px;
  text-align: center;
}

#footer {
  background-color: orange; 
  border-top: 1px solid #ccc; 
  padding: 10px;
  text-align: center;
}

#form {
  background-color: #fff;
  border: 1px solid #ccc; 
  padding: 20px;
  border-radius: 5px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="number"], button {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}

button {
  background-color: #4495d1; 
  color: #fff; 
  cursor: pointer;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 10px;
  border: 1px solid #ccc;
  text-align: center;
}

th {
  background-color: #f0f0f0; 
}


tr:nth-child(even) {
  background-color: #f5f5f5;
}

    </style>
</head>

<body>
    <div id="full">
        <div id="inner_full">
            <div id="header"><h2><a href="user-home.php">Diet Buddy</a></h2></div>
            <div id="body">
                <br>
                <?php
                    $un = $_SESSION['un'];
                    if (!$un) {
                        header("Location:index.php");
                    }
                ?>
                <h1>Food List</h1><br>
                <center>
                    <div id="form">
                        
                      <form id="bmi-form" method="POST" action="count-bmi.php">
                            <h2>BMI Calculator</h2>
                            <label for="height">Height (cm):</label>
                            <input type="number" id="height" name="height" required>
                            
                            <label for="weight">Weight (kg):</label>
                            <input type="number" id="weight" name="weight" required>

                            <button type="submit" name="calculate-bmi">Calculate BMI</button>
                        </form>

                        <?php
                            if (isset($_POST['calculate-bmi'])) {
                                $height = $_POST['height'];
                                $weight = $_POST['weight'];

                                if ($height > 0 && $weight > 0) {
                                    $heightInMeters = $height / 100; 
                                    $bmi = $weight / ($heightInMeters * $heightInMeters);
                                    $_SESSION['bmi'] = number_format($bmi, 2);
                                    echo "<p>Your BMI is: " . number_format($bmi, 2) . "</p>";
                                    ?>  
                                    <table>
                                        <tr>
                                            <td><center><b><font color="blue">BMI</font></b></center></td>
                                            <td><center><b><font color="blue">Breakfast</font></b></center></td>
                                            <td><center><b><font color="blue">MidMeal</font></b></center></td>
                                            <td><center><b><font color="blue">Lunch</font></b></center></td>
                                            <td><center><b><font color="blue">Evening</font></b></center></td>
                                            <td><center><b><font color="blue">Dinner</font></b></center></td>
                                            <td><center><b><font color="blue">Buy</font></b></center></td> <!-- New column for Buy option -->
                                        </tr>
                                        
                                        <?php
                                            if (isset($_POST['calculate-bmi'])) {
                                                $fname =$_SESSION['bmi'];
                                                $q = $db->prepare("SELECT * FROM diet_plan WHERE dpbmi LIKE :fname");
                                                $q->bindValue(':fname', '%' . $fname . '%', PDO::PARAM_STR);
                                                $q->execute();
            
                                                if ($q->rowCount() > 0) {
                                                    while ($r1 = $q->fetch(PDO::FETCH_OBJ)) {
                                                        ?>
                                                        <tr>
                                                            <td><center><?= $r1->dpbmi; ?></center></td>
                                                            <td><center><?= $r1->dpbreakfast; ?></center></td>
                                                            <td><center><?= $r1->dpmidmeal; ?></center></td>
                                                            <td><center><?= $r1->dplunch; ?></center></td>
                                                            <td><center><?= $r1->dpevening; ?></center></td>
                                                            <td><center><?= $r1->dpdinner; ?></center></td>
                                                            <td>
                                                            <center> <a href="buy-diet-plan.php?id=<?= $r1->dpid; ?>">Buy</a></center>
                                                           </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    echo "<script>alert('No matching food found. Please try again.');</script>";
                                                }
                                            }
                                        ?>
                                    </table>


                                <?php

                                } else {
                                    echo "<p>Please enter valid height and weight values.</p>";
                                }
                            }
                        ?>
                    
                    
                    <br><br><br>
                    </div>
                </center>

                <div id="footer" height='70px'>
                    <h4 align="center"> Copyright Diet Buddy</h4>
                    <p align="center"> <a href="index.php" >Logout </a> </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
