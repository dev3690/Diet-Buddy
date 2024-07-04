<?php
include('connection.php');
session_start();

if (isset($_POST['sub'])) {
    $ename = $_POST['ename'];
    $eimage = uploadImage(); // Function to handle image upload
    $ecategory = $_POST['ecategory'];
    $edesc = $_POST['edesc'];
  

    $q = $db->prepare("INSERT INTO exercise (ename, eimage, ecategory, edesc) VALUES (:ename, :eimage, :ecategory, :edesc)");
    $q->bindValue(':ename', $ename);
    $q->bindValue(':eimage', $eimage);
    $q->bindValue(':ecategory', $ecategory);
    $q->bindValue(':edesc', $edesc);
   

    if ($q->execute()) {
        echo "<script>alert('Food Item Added Successfully')</script>";
    } else {
        echo "<script>alert('Failed to Add Food Item')</script>";
    }
}

// Function to handle image upload
function uploadImage() {
    $targetDirectory = "image/exercise/";
    $targetFile = $targetDirectory . basename($_FILES["eimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["eimage"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }

    if ($_FILES["eimage"]["size"] > 50000000) {
        echo "<script>alert('Sorry, your file is too large.')</script>";
        $uploadOk = 0;
    }

    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        return "";
    } else {
        if (move_uploaded_file($_FILES["eimage"]["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            return "";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/s1.css">
    <title>Admin Home</title>
    
   
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td width="200px" height="50px">Enter Exercise Name</td>
                                    <td width="200px" height="50px"><input type="text" name="ename" placeholder="Enter Name"></td>
                                    <td width="200px" height="50px">Add Exercise Image</td>
                                    <td width="200px" height="50px"><input type="file" name="eimage" accept="image/*"></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Exercise Category</td>
                                    <td width="200px" height="50px">
                                        <select name="ecategory">
                                            <option>Biceps</option>
                                            <option>triceps</option>
                                            <option>Chests</option>
                                            <option>Back</option>
                                            <option>Arms</option>
                                            <option>Legs</option>
                                            <option>Shoulders</option>
                                        </select>
                                    </td>
                                    <td width="200px" height="50px">Exercise Description</td>
                                    <td width="200px" height="50px"><input type="text" name="edesc" placeholder="Enter Exercise Description"></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><input type="submit" name="sub" value="Save"></td>
                                </tr>
                            </table>
                        </form>
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
