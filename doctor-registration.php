
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
                                    <td width="200px" height="50px">Enter Doctor Name</td>
                                    <td width="200px" height="50px"><input type="text" name="dname" placeholder="Enter Name"></td>
                                    <td width="200px" height="50px">Enter Doctor Contact Number</td>
                                    <td width="200px" height="50px"><input type="text" name="dcno" placeholder="Enter Contact Number"></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Enter Doctor Email</td>
                                    <td width="200px" height="50px"><input type="text" name="demail" placeholder="Enter email"></td>
                                    <td width="200px" height="50px">Doctor Gender</td>
                                    <td width="200px" height="50px">
                                        <select name="dgender">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Doctor Description</td>
                                    <td width="200px" height="50px"><input type="text" name="ddesc" placeholder="Enter Description"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="sub" value="Save"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                            if(isset($_POST['sub']))
                            {
                                $dname=$_POST['dname'];
                                $dcno=$_POST['dcno'];
                                $demail=$_POST['demail'];
                                $dgender=$_POST['dgender'];
                                $ddesc=$_POST['ddesc'];
                                $q=$db->prepare("INSERT INTO doctor_registration (dname,dcno,demail,dgender,ddesc) VALUES (:dname,:dcno,:demail,:dgender,:ddesc)");
                                $q->bindValue('dname',$dname);
                                $q->bindValue('dcno',$dcno);    
                                $q->bindValue('demail',$demail);    
                                $q->bindValue('dgender',$dgender);    
                                $q->bindValue('ddesc',$ddesc);    
                                if($q->execute())
                                {
                                    echo "<script>alert('Doctor Registration Successful')</script>";
                                }
                                else{
                                    echo "<script>alert('Doctor Registration fail')</script>";
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
