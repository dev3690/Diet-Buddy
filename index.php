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
  font-family: sans-serif;
  background-color: #f5f5f5;
}

#full {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.15);
  animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

#inner_full {
  width: 400px;
  padding-top : 10px; 
  padding: 30px;
  /* background-color: #orange; */
  text-align: center;
}

#header {
  background-color: orange;
  margin-bottom: 10px;
  padding : 10px;
  border-radius : 5px;
  color : white;
}

#header a {
  text-decoration: none;
  color: #333;
}

#body table {
  width: 100%;
}

#body td {
  padding: 10px;
}

#body input[type="text"],
#body input[type="password"],
#body input[type="submit"] {
  width: 180px;
  height: 35px;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 5px;
  margin-bottom: 10px;
}

#body input[type="submit"] {
  background-color: #333;
  color: #fff;
  cursor: pointer;
}

#footer {
  background-color: orange;
  margin-top: 30px; 
  padding : 10px;
  border-radius : 5px;
  color : white;
}


</style>
 </head>

 
 <body>

<div id="full">

    <div id="inner_full">

        <div id="header"><h2>Diet Buddy</h2> <a href="index1.php">Click here to go Admin Panel</a></div>

            <div id="body">

                

                <form action="" method="post">
                <table align="center">
                    <tr>
                        <td width="200px" height="70px"><b>Enter Username</b></td>
                        <td width="100px" height="70px"><input type="text" name="un" placeholder="Enter Username" style=" width: 180px; height: 30px; border-radius: 10px;"></td> 
                    </tr>
                    <tr>
                        <td width="200px" height="70px"><b>Enter Password</b></td>
                        <td width="200px" height="70px"><input type="passsword" name="ps" placeholder="Enter Password" style=" width: 180px; height: 30px; border-radius: 10px;"></td>
                    </tr>
                </table>
                <input type="submit" name="sub" value="Login" style="width: 70px; height: 30px; border-radius: 5px;">
                <p>New User?</p> <a href="user-registration.php">Click Here to register</a>
                </form>


                <?php 
                        if(isset($_POST['sub']))
                        {
                            $un= $_POST['un'];
                            $ps= $_POST['ps'];
                            $q=$db->prepare("SELECT * FROM user_registration where name='$un' && age='$ps'");
                            $q->execute();
                            $res=$q->fetchAll(PDO::FETCH_OBJ);
                            if($res)
                            {
                                $_SESSION['un']=$un;
                                header("Location:user-home.php");
                            }
                            else{
                                echo "<script>alert('Wrong User') </script>";
                            }

                        }
                ?>


            </div>

        <div id="footer"><h4 align="center"> Copyright Diet Buddy</h4></div>

    </div>
</div>

</body>
</html>