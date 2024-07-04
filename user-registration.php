<?php
    include('connection.php');
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="css/s1.css">
    <style type="text/css">
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
            align-items: center;
        }

        #inner_full {
            width: 80%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
        }

        #header {
            background-color: #ff8c00; 
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #d17f00; 
        }

        #header h2 {
            margin: 0;
            font-size: 28px;
            color: #fff; 
        }

        #body {
            background-color: #fff;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        #body h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        #form {
            width: 80%;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            width: 200px;
            height: 50px;
        }

        table, th, td {
            border: 1px solid #ff8c00;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #ff8c00;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d17f00;
        }

        #footer {
            background-color: #ff8c00;
            padding: 20px;
            text-align: center;
            border-top: 2px solid #d17f00; 
        }

        #footer h4 {
            margin: 0;
            color: #fff;
        }

        #footer a {
            text-decoration: none;
            color: #fff;
            transition: color 0.3s ease;
        }

        #footer a:hover {
            color: #f0f0f0; 
        }
    </style>
</head>

<body>

    <div id="full">

        <div id="inner_full">

            <div id="header">
                <h2><a href="admin-home.php">Diet Buddy</a></h2>
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
                <h1>Welcome Home</h1><br>
                <center>
                    <div id="form">
                        <form action="" method="post">     
                            <table>
                                <tr>
                                    <td width="200px" height="50px">Enter Name</td>
                                    <td width="200px" height="50px"><input type="text" name="name" placeholder="Enter Name"></td>
                                    <td width="200px" height="50px">Enter Contact Number</td>
                                    <td width="200px" height="50px"><input type="text" name="cno" placeholder="Enter Contact Number"></td>

                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Enter Email Address</td>
                                    <td width="200px" height="50px"><input type="text" name="email" placeholder="Enter email"></td>
                                    <td width="200px" height="50px">Enter Gender</td>
                                    <td width="200px" height="50px">
                                        <select name="gender">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="200px" height="50px">Enter Age</td>
                                    <td width="200px" height="50px"><input type="text" name="age" placeholder="Enter Age"></td>
                                    <!-- <td width="200px" height="50px">Enter Name</td>
                                    <td width="200px" height="50px"><input type="text" name="name" placeholder="Enter Name"></td> -->

                                </tr>
                                <tr>
                                    <td><input type="submit" name="sub" value="Save"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                            if(isset($_POST['sub']))
                            {
                                $name=$_POST['name'];
                                $cno=$_POST['cno'];
                                $email=$_POST['email'];
                                $gender=$_POST['gender'];
                                $age=$_POST['age'];
                                $q=$db->prepare("INSERT INTO user_registration (name,cno,email,gender,age) VALUES (:name,:cno,:email,:gender,:age)");
                                $q->bindValue('name',$name);
                                $q->bindValue('cno',$cno);    
                                $q->bindValue('email',$email);    
                                $q->bindValue('gender',$gender);    
                                $q->bindValue('age',$age);    
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

                <div id="footer">
                    <h4 align="center">Copyright Diet Buddy</h4>
                    <p align="center"><a href="index.php">Logout</a></p>
                </div>

            </div>
        </div>
    </div>

</body>

</html>




















<!-- <center>
                    <div id="form">
                        <form method="post" action="">
                            <label for="dpbmi">dpbmi:</label>
                            <input type="text" name="dpbmi" value="<?= $dietPlan->dpbmi; ?>" required>
                            <label for="dpbreakfast">dpbreakfast:</label>
                            <input type="text" name="dpbreakfast" value="<?= $dietPlan->dpbreakfast; ?>" required>
                            <label for="dpmidmeal">dpmidmeal:</label>
                            <input type="text" name="dpmidmeal" value="<?= $dietPlan->dpmidmeal; ?>" required>
                            <label for="dplunch">dplunch:</label>
                            <input type="text" name="dplunch" value="<?= $dietPlan->dplunch; ?>" required>
                            <label for="fcarbs">fcarbs:</label>
                            <input type="submit" name="edit" value="Save Changes">
                        </form>
                        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
                    </div>
                </center> -->