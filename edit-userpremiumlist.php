<?php
    include('connection.php');
    session_start();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: admin-home.php"); 
        exit();
    }

    $dietPlanId = $_GET['id'];
    $query = $db->prepare("SELECT * FROM premium WHERE pid = :dietPlanId");
    $query->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() === 0) {
        header("Location: admin-home.php"); 
        exit();
    }

    $dietPlan = $query->fetch(PDO::FETCH_OBJ);

    if (isset($_POST['edit'])) {
        $pname = $_POST['pname'];
        $pemail = $_POST['pemail'];
        $pcno = $_POST['pcno'];
        $pcardno = $_POST['pcardno'];
        $pexpirydate = $_POST['pexpirydate'];
        $paddress = $_POST['paddress'];

        $updateQuery = $db->prepare("UPDATE premium SET pname = :pname, pemail = :pemail, pcno = :pcno, pcardno = :pcardno, pexpirydate = :pexpirydate, paddress = :paddress WHERE pid = :dietPlanId");
        $updateQuery->bindValue(':pname', $pname);
        $updateQuery->bindValue(':pemail', $pemail);
        $updateQuery->bindValue(':pcno', $pcno);
        $updateQuery->bindValue(':pcardno', $pcardno);
        $updateQuery->bindValue(':pexpirydate', $pexpirydate);
        $updateQuery->bindValue(':paddress', $paddress);
        $updateQuery->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);

        if ($updateQuery->execute()) {
            header("Location: userpremiumlist.php"); 
            exit();
        } else {
            $error = "Error updating diet plan. Please try again.";
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Diet Plan</title>
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
            </div>

            <div id="body">
                <h1>Edit Diet Plan</h1>
                <!-- Your content goes here -->
                <center>
                    <div id="form">
                        <form method="post" action="">
                            <label for="pname">Name:</label>
                            <input type="text" name="pname" value="<?= $dietPlan->pname; ?>" required>
                            <label for="pemail">Email:</label>
                            <input type="text" name="pemail" value="<?= $dietPlan->pemail; ?>" required>
                            <label for="pcno">Card Number:</label>
                            <input type="text" name="pcno" value="<?= $dietPlan->pcno; ?>" required>
                            <label for="pcardno">Card Number:</label>
                            <input type="text" name="pcardno" value="<?= $dietPlan->pcardno; ?>" required>
                            <label for="pexpirydate">Card Expiry Date:</label>
                            <input type="text" name="pexpirydate" value="<?= $dietPlan->pexpirydate; ?>" required>
                            <label for="paddress">Customer Address:</label>
                            <input type="text" name="paddress" value="<?= $dietPlan->paddress; ?>" required>
                            <input type="submit" name="edit" value="Save Changes">
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
