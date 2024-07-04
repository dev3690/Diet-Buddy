<?php
    include('connection.php');
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffcc80; /* Set background color to orange */
        }

        #full {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #inner_full {
            width: 400px;
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #header h2 {
            margin: 0;
            font-size: 36px;
            color: #333;
        }

        #body {
            margin-top: 30px;
        }

        form {
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
        }

        table td {
            padding: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            height: 30px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            height: 40px;
            border: none;
            background-color: #ff8c00;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ffcc80;
        }

        #footer {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div id="full">

        <div id="inner_full">

            <div id="header">
                <h2>Diet Buddy</h2>
            </div>

            <div id="body">
                <form action="" method="post">
                    <table>
                        <tr>
                            <td><b>Enter Username</b></td>
                            <td><input type="text" name="un" placeholder="Enter Username"></td>
                        </tr>
                        <tr>
                            <td><b>Enter Password</b></td>
                            <td><input type="password" name="ps" placeholder="Enter Password"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" name="sub" value="Login"></td>
                        </tr>
                    </table>
                </form>

                <?php 
                    if(isset($_POST['sub']))
                    {
                        $un = $_POST['un'];
                        $ps = $_POST['ps'];
                        $q = $db->prepare("SELECT * FROM admin WHERE uname='$un' && pass='$ps'");
                        $q->execute();
                        $res = $q->fetchAll(PDO::FETCH_OBJ);
                        if($res)
                        {
                            $_SESSION['un'] = $un;
                            header("Location:admin-home.php");
                        }
                        else{
                            echo "<script>alert('Wrong User')</script>";
                        }
                    }
                ?>
            </div>

            <div id="footer">
                <h4>Copyright Diet Buddy</h4>
            </div>

        </div>
    </div>

</body>

</html>
