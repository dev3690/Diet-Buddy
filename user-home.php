<?php
    include('connection.php');
    session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/s1.css"> -->
    
    
<style>
  body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffcc80; 
        }

        #full {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        #inner_full {
            width: 90%;
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        #header {
            text-align: center;
            padding: 30px;
            border-bottom: 2px solid #ff8c00;
            background-color: #fff;
        }

        #header h2 {
            margin: 0;
            font-size: 36px;
            color: #333;
        }

        #header a {
            text-decoration: none;
            color: #ff8c00;
            font-weight: bold;
            padding: 15px;
            border-radius: 8px;
            margin: 0 10px;
            transition: background-color 0.3s ease;
        }

        #header a:hover {
            background-color: #ffcc80;
        }

        #body {
            text-align: center;
            font-size: 18px; 
            background-color: #fff;
            padding: 30px; 
            border-radius: 15px;
            margin-top: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        #body h1 {
            font-size: 36px; 
            margin-bottom: 20px;
            color: #333;
        }

        #body ul {
            list-style: none;
            padding: 0;
            margin: 0 0 30px 0;
        }

        #body li {
            display: inline-block;
            margin: 0 15px; 
        }

        #body a {
            text-decoration: none;
            color: #333;
            padding: 15px;
            border-radius: 8px;
            background-color: #ff8c00;
            transition: background-color 0.3s ease;
        }

        #body a:hover {
            background-color: #ffcc80;
        }

        #footer {
            text-align: center;
            padding: 20px;
            border-top: 2px solid #ff8c00;
            background-color: #fff;
        }

        #footer a {
            text-decoration: none;
            color: #ff8c00;
            transition: color 0.3s ease; 
        }

        #footer a:hover {
            color: #ffcc80;
        }
</style>

</head>

<body>

    <div id="full">

        <div id="inner_full">

            <div id="header">
                <h2><a href="user-home.php">Diet Buddy</a></h2>
                <a href="index1.php">Go to Admin Home</a>
            </div>

            <div id="body">
                <br>
                <?php
                    $un=$_SESSION['un'];
                    if(!$un)
                    {
                        header("Location:index.php");
                    }
                ?>
                <h1>Welcome Home User</h1><br><br><br><br>

                <ul>
                    <li><a href="count-bmi.php">Diet Plan</a></li>
                    <li><a href="count-calorie.php">Count Calories</a></li>
                    <li><a href="exercise-display.php">Exercises</a></li>
                </ul>
                <br><br><br><br>
                <ul>
                    <li><a href="#">Consult Doctor</a></li>
                    <!-- <li><a href="profile.php">Profile</a></li> -->
                  
                    <?php
                        $q=$db->query("SELECT * FROM user_registration ");
                        if($r1=$q->fetch(PDO::FETCH_OBJ))
                        {
                    ?>
                    <li><a href="profile3.php?id=<?= $r1->id; ?>">Profile</a></li>
                    <?php
                        }       
                    ?>

                </ul><br><br><br><br>
            </div>

            <div id="footer">
                <h4 align="center">Copyright Diet Buddy</h4>
                <p align="center" ><a href="index.php" color="orange">Logout </a></p>
            </div>

        </div>
    </div>

</body>

</html>


