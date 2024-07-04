<?php
    include('connection.php');
    session_start();
    // Handle delete action
    if(isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $delete_query = $db->prepare("DELETE FROM exercise WHERE eid = :delete_id");
        $delete_query->bindValue(':delete_id', $delete_id, PDO::PARAM_INT);
        $delete_query->execute();
        header("Location: exercise-list.php"); // Redirect after delete
        exit();
    }
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

                <center>
                    <div id="form">
                        <table>
                            <tr>
                                <td><center><b><font color="blue">Exercise Image</font></b></center></td>
                                <td><center><b><font color="blue">Exercise Name</font></b></center></td>
                                <td><center><b><font color="blue">Exercise Category</font></b></center></td>
                                <td><center><b><font color="blue">Exercise Description</font></b></center></td>
                                <td><center><b><font color="blue">Actions</font></b></center></td>
                  
                            </tr>
                            <?php
                                $q = $db->query("SELECT * FROM exercise ");
                                while ($r1 = $q->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                    <tr>
                                        <td><center><img src="<?= $r1->eimage; ?>" alt="Exercise Image" class="food-image"></center></td>
                                        <td><center><?= $r1->ename; ?></center></td>
                                        <td><center><?= $r1->ecategory; ?></center></td>
                                        <td><center><?= $r1->edesc; ?></center></td>
                                        <td>
                                            <a href="edit-exerciselist.php?id=<?= $r1->eid; ?>">Edit</a> |
                                            <a href="?delete_id=<?= $r1->eid; ?>" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                                        </td>
                                        </tr>
                            <?php
                                }
                            ?>
                        </table>
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
