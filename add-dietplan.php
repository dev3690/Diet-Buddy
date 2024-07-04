<?php
    include('connection.php');
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Home</title>
    <link rel="stylesheet" type="text/css" href="css/s1.css">
    
</head>

<body>

    <div id="full">

        <div id="sidebar">
            <h2><a href="admin-home.php" style="color: #ecf0f1;">Diet Buddy</a></h2>
            <a href="user-home.php">Go to User Home</a>
            <?php
                $un = $_SESSION['un'];
                if (!$un) {
                    header("Location:index.php");
                }
            ?>
            <a href="user-list.php">User List</a>
            <a href="add-dietplan.php">Add Diet Plan</a>
            <a href="dietplan-list.php">Diet Plan List</a>
            <a href="doctor-registration.php">Doctor Registration</a>
            <a href="add-food.php">Add Food and Calorie</a>
            <a href="add-exercise.php">Add Exercise</a>
            <a href="doctor-list.php">Doctor List</a>
            <a href="food-list.php">Food and Calorie List</a>
            <a href="exercise-list.php">Exercise List</a>
            <a href="userpremiumlist.php">User Premium List</a>
        </div>

        <div id="content">
            <div id="header">
                <h2><a href="admin-home.php">Diet Buddy</a></h2>
                <a href="user-home.php">Go to User Home</a>
            </div>

            <div id="body">
                <h1>Welcome Home Admin</h1>
                <!-- Your content goes here -->
                
                <center>
                    <div id="form">
                        <form action="" method="post">     
                            <table>
                                <tr>
                                    <td>Enter dietplan BMI</td>
                                    <td><input type="text" name="dpbmi" placeholder="Enter dietplan BMI"></td>
                                    <td>Food Breakfast</td>
                                    <td><input type="text" name="dpbreakfast" placeholder="Add Food Breakfast"></td>
                                </tr>
                                <tr>
                                    <td>Food Mid Meal</td>
                                    <td><input type="text" name="dpmidmeal" placeholder="Enter Food Mid Meal"></td>
                                    <td>Food Lunch</td>
                                    <td><input type="text" name="dplunch" placeholder="Enter Food Lunch"></td>
                                </tr>
                                <tr>
                                    <td>Food Evening</td>
                                    <td><input type="text" name="dpevening" placeholder="Enter Food Evening"></td>
                                    <td>Food Dinner</td>
                                    <td><input type="text" name="dpdinner" placeholder="Enter Food Dinner"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="sub" value="Save"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                            if(isset($_POST['sub']))
                            {
                                $dpbmi=$_POST['dpbmi'];
                                $dpbreakfast=$_POST['dpbreakfast'];
                                $dpmidmeal=$_POST['dpmidmeal'];
                                $dplunch=$_POST['dplunch'];
                                $dpevening=$_POST['dpevening'];
                                $dpdinner=$_POST['dpdinner'];
                                $q=$db->prepare("INSERT INTO diet_plan (dpbmi,dpbreakfast,dpmidmeal,dplunch,dpevening,dpdinner) VALUES (:dpbmi,:dpbreakfast,:dpmidmeal,:dplunch,:dpevening,:dpdinner)");
                                $q->bindValue('dpbmi',$dpbmi);
                                $q->bindValue('dpbreakfast',$dpbreakfast);    
                                $q->bindValue('dpmidmeal',$dpmidmeal);    
                                $q->bindValue('dplunch',$dplunch);    
                                $q->bindValue('dpevening',$dpevening); 
                                $q->bindValue('dpdinner',$dpdinner);          
                                if($q->execute())
                                {
                                    echo "<script>alert('User Registration Successful')</script>";
                                }
                                else{
                                    echo "<script>alert('User Registration fail')</script>";
                                }
                            }
                        ?>
                    </div>
                </center>

            </div>

            <div id="footer">
                <h4>Copyright Diet Buddy</h4>
                <p><a href="index.php">Logout</a></p>
            </div>
        </div>

        <div id="toggle-btn" onclick="toggleSidebar()">☰</div>

        <script>
            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('closed');
            }
        </script>

    </div>

</body>

</html>
