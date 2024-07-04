<?php
    include('connection.php');
    session_start();

    
    $dietPlanId = $_GET['id'];
    $query = $db->prepare("SELECT * FROM user_registration WHERE id = :dietPlanId");
    $query->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() === 0) {
        header("Location: user-home.php"); 
        exit();
    }

    $dietPlan = $query->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['edit'])) {
        $name = $_POST['name'];
        $cno = $_POST['cno'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; 
            color: black;
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

        input[type="text"], button {
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
            /* border: 1px solid #ccc; */
            text-align: center;
        }

        th {
            background-color: #f0f0f0; 
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .food-image {
            max-width: 100px;
            max-height: 100px;
        }


            body {
            /* background-color: #e8f5ff; */
            font-family: Arial;
            /* overflow: hidden; */
            }

            /* Main */
            .main {
            margin-left: 20%;
            font-size: 28px;
            width: 58%;
            }

            .main h2 {
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 24px;
            margin-bottom: 10px;
            }

            .main .card {
            background-color: #fff;
            border-radius: 18px;
            box-shadow: 1px 1px 8px 0 grey;
            height: auto;
            margin-bottom: 30px;
            padding: 20px 0 20px 50px;
            }

            .main .card table {
            border: none;
            font-size: 16px;
            height: 270px;
            width: 80%;
            }

            .edit {
            position: absolute;
            color: #black;
            right: 14%;
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
                <h1>User Profile</h1><br>

                <div class="main">
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td><center><?= $dietPlan->name; ?></center></td>
                                    </tr>
                                    <tr>
                                        <td>Contact Number</td>
                                        <td>:</td>
                                        <td><center><?= $dietPlan->cno; ?></center></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><center><?= $dietPlan->email; ?></center></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>:</td>
                                        <td><center><?= $dietPlan->gender; ?></center></td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>:</td>
                                        <td><center><?= $dietPlan->age; ?></center></td>
                                    </tr>
                                    <tr>
                                    <?php
                                        $q=$db->query("SELECT * FROM user_registration ");
                                        if($r1=$q->fetch(PDO::FETCH_OBJ))
                                        {
                                    ?>
                                    <td><a href="edituserprofile.php?id=<?= $r1->id; ?>">Edit</a></td>
                                    <?php
                                        }       
                                    ?>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="footer" height='70px'>
                    <h4 align="center"> Copyright Diet Buddy</h4>
                    <p align="center"> <a href="index.php">Logout </a> </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


