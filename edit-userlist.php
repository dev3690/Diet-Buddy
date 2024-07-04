<?php
    include('connection.php');
    session_start();
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: admin-home.php"); 
        exit();
    }
    $dietPlanId = $_GET['id'];
    $query = $db->prepare("SELECT * FROM user_registration WHERE id = :dietPlanId");
    $query->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() === 0) {
        header("Location: admin-home.php"); 
        exit();
    }

    $dietPlan = $query->fetch(PDO::FETCH_OBJ);
    if (isset($_POST['edit'])) {
        $name = $_POST['name'];
        $cno = $_POST['cno'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];

        $updateQuery = $db->prepare("UPDATE user_registration SET name = :name, cno = :cno, email = :email, gender = :gender, age = :age WHERE id = :dietPlanId");
        $updateQuery->bindValue(':name', $name);
        $updateQuery->bindValue(':cno', $cno);
        $updateQuery->bindValue(':email', $email);
        $updateQuery->bindValue(':gender', $gender);
        $updateQuery->bindValue(':age', $age);
        $updateQuery->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);

        if ($updateQuery->execute()) {
            header("Location: user-list.php"); 
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
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="<?= $dietPlan->name; ?>" required>
                            <label for="cno">cno:</label>
                            <input type="text" name="cno" value="<?= $dietPlan->cno; ?>" required>
                            <label for="email">email:</label>
                            <input type="text" name="email" value="<?= $dietPlan->email; ?>" required>
                            <label for="gender">gender:</label>
                            <input type="text" name="gender" value="<?= $dietPlan->gender; ?>" required>
                            <label for="age">age:</label>
                            <input type="text" name="age" value="<?= $dietPlan->age; ?>" required>
                           
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
