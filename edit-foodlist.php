<?php
    include('connection.php');
    session_start();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: admin-home.php"); 
        exit();
    }

    $dietPlanId = $_GET['id'];
    $query = $db->prepare("SELECT * FROM food_item WHERE fid = :dietPlanId");
    $query->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() === 0) {
        header("Location: admin-home.php"); 
        exit();
    }

    $dietPlan = $query->fetch(PDO::FETCH_OBJ);

    if (isset($_POST['edit'])) {
        $fimage = $_POST['fimage'];
        $fname = $_POST['fname'];
        $fcategory = $_POST['fcategory'];
        $fcalories = $_POST['fcalories'];
        $fcarbs = $_POST['fcarbs'];
        $ffat = $_POST['ffat'];
        $fprotein = $_POST['fprotein'];
        $ffiber = $_POST['ffiber'];

        $updateQuery = $db->prepare("UPDATE food_item SET fimage = :fimage, fname = :fname, fcategory = :fcategory, fcalories = :fcalories, fcarbs = :fcarbs, ffat = :ffat, fprotein = :fprotein, ffiber = :ffiber WHERE fid = :dietPlanId");
        $updateQuery->bindValue(':fimage', $fimage);
        $updateQuery->bindValue(':fname', $fname);
        $updateQuery->bindValue(':fcategory', $fcategory);
        $updateQuery->bindValue(':fcalories', $fcalories);
        $updateQuery->bindValue(':fcarbs', $fcarbs);
        $updateQuery->bindValue(':ffat', $ffat);
        $updateQuery->bindValue(':fprotein', $fprotein);
        $updateQuery->bindValue(':ffiber', $ffiber);
        $updateQuery->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);

        if ($updateQuery->execute()) {
            header("Location: food-list.php"); 
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
                            <label for="fimage">Image:</label>
                            <input type="text" name="fimage" value="<?= $dietPlan->fimage; ?>" required>
                            <label for="fname">fname:</label>
                            <input type="text" name="fname" value="<?= $dietPlan->fname; ?>" required>
                            <label for="fcategory">fcategory:</label>
                            <input type="text" name="fcategory" value="<?= $dietPlan->fcategory; ?>" required>
                            <label for="fcalories">fcalories:</label>
                            <input type="text" name="fcalories" value="<?= $dietPlan->fcalories; ?>" required>
                            <label for="fcarbs">fcarbs:</label>
                            <input type="text" name="fcarbs" value="<?= $dietPlan->fcarbs; ?>" required>
                            <label for="ffat">ffat:</label>
                            <input type="text" name="ffat" value="<?= $dietPlan->ffat; ?>" required>
                            <label for="fprotein">fprotein:</label>
                            <input type="text" name="fprotein" value="<?= $dietPlan->fprotein; ?>" required>
                            <label for="ffiber">ffiber:</label>
                            <input type="text" name="ffiber" value="<?= $dietPlan->ffiber; ?>" required>
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
