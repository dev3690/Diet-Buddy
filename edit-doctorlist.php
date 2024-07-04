<?php
    include('connection.php');
    session_start();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: admin-home.php"); 
        exit();
    }

    $dietPlanId = $_GET['id'];
    $query = $db->prepare("SELECT * FROM doctor_registration WHERE id = :dietPlanId");
    $query->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() === 0) {
        header("Location: admin-home.php"); 
        exit();
    }

    $dietPlan = $query->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['edit'])) {
        $dname = $_POST['dname'];
        $dcno = $_POST['dcno'];
        $demail = $_POST['demail'];
        $dgender = $_POST['dgender'];
        $ddesc = $_POST['ddesc'];

        $updateQuery = $db->prepare("UPDATE doctor_registration SET dname = :dname, dcno = :dcno, demail = :demail, dgender = :dgender, ddesc = :ddesc WHERE id = :dietPlanId");
        $updateQuery->bindValue(':dname', $dname);
        $updateQuery->bindValue(':dcno', $dcno);
        $updateQuery->bindValue(':demail', $demail);
        $updateQuery->bindValue(':dgender', $dgender);
        $updateQuery->bindValue(':ddesc', $ddesc);
        $updateQuery->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);

        if ($updateQuery->execute()) {
            header("Location: doctor-list.php");
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
            <a href="userpremiumlist.php">user Premium List</a>
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
                            <label for="dname">Name:</label>
                            <input type="text" name="dname" value="<?= $dietPlan->dname; ?>" required>
                            <label for="dcno">dcno:</label>
                            <input type="text" name="dcno" value="<?= $dietPlan->dcno; ?>" required>
                            <label for="demail">demail:</label>
                            <input type="text" name="demail" value="<?= $dietPlan->demail; ?>" required>
                            <label for="dgender">dgender:</label>
                            <input type="text" name="dgender" value="<?= $dietPlan->dgender; ?>" required>
                            <label for="ddesc">ddesc:</label>
                            <input type="text" name="ddesc" value="<?= $dietPlan->ddesc; ?>" required>
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
