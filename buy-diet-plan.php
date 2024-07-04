<?php
    include('connection.php');
    session_start();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        // header("Location: admin-home.php"); 
        header("Location: buy-diet-plan.php"); 
        exit();
    }

    $dietPlanId = $_GET['id'];
    $query = $db->prepare("SELECT * FROM user_registration WHERE id = :dietPlanId");
    $query->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() === 0) {
        // header("Location: admin-home.php"); 
        header("Location: buy-diet-plan.php"); 

        exit();
    }
    $dietPlan = $query->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>

<head>    
    <title>Edit Diet Plan</title>
    <link rel="stylesheet" type="text/css" href="css/s1.css">
</head>

<body>

    <div id="full">
        <div id="content">
            <div id="header">
                <h2><a href="user-home.php">Diet Buddy</a></h2>
            </div>

            <div id="body">
                <h1>Buy Premium </h1>
                <!-- Your content goes here -->
                <center>
                    <div id="form">
                        <form method="post" action="">
                            <table>
                                <tr>
                                    <td width="200px" height="50px"><label for="name">Name:</label></td>
                                    <td width="200px" height="50px"><input type="text" name="pname"  value="<?= $dietPlan->name; ?>" required></td>
                                    <td width="200px" height="50px">Enter Contact Number</td>
                                    <td width="200px" height="50px"><input type="text" name="pcno" value="<?= $dietPlan->cno; ?>"></td>

                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Enter Email</td>
                                    <td width="200px" height="50px"><input type="text" name="pemail" value="<?= $dietPlan->email; ?>"></td>
                                    <td width="200px" height="50px">Enter Card Number</td>
                                    <td width="200px" height="50px"><input type="text" name="pcardno" placeholder="Enter Card Number"></td>

                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Enter Expiry Date</td>
                                    <td width="200px" height="50px"><input type="date" name="pexpirydate" placeholder="Enter Expiry Date"></td>
                                 
                                    <td width="200px" height="50px">Enter Address</td>
                                    <td width="200px" height="50px"><input type="text" name="paddress" placeholder="Enter Address"></td>
                                </tr>
                            </table>
                            <input type="submit" name="sub" value="Buy Premium">
                            
                            <?php
                            if(isset($_POST['sub']))
                            {
                                $pname=$_POST['pname'];
                                $pemail=$_POST['pemail'];
                                $pcno=$_POST['pcno'];
                                $pcardno=$_POST['pcardno'];
                                $pexpirydate=$_POST['pexpirydate'];
                                $paddress=$_POST['paddress'];
                                $q=$db->prepare("INSERT INTO premium (pname,pemail,pcno,pcardno,pexpirydate,paddress) VALUES (:pname,:pemail,:pcno,:pcardno,:pexpirydate,:paddress)");
                                $q->bindValue('pname',$pname);
                                $q->bindValue('pemail',$pemail);    
                                $q->bindValue('pcno',$pcno);    
                                $q->bindValue('pcardno',$pcardno);    
                                $q->bindValue('pexpirydate',$pexpirydate);     
                                $q->bindValue('paddress',$paddress);     
                                if($q->execute())
                                {
                                    echo "<script>alert('User subscirbed to Premium Successfully')</script>";
                                }
                                else{
                                    echo "<script>alert('User fail to Subscribe')</script>";
                                    
                                }
                                
                            }
                            ?>
                    </form>
                        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
                    </div>
                </center>
            </div>

            <div id="footer">
                <h4>Copyright Diet Buddy</h4>
                <p><a href="index.php">Logout</a></p>
            </div>
        </div>
    </div>

</body>

</html>
