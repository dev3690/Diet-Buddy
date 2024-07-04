<?php
include('connection.php');
session_start();

if (isset($_POST['sub'])) {
    $fname = $_POST['fname'];
    $fimage = uploadImage(); // Function to handle image upload
    $fcategory = $_POST['fcategory'];
    $fcalories = $_POST['fcalories'];
    $fcarbs = $_POST['fcarbs'];
    $ffat = $_POST['ffat'];
    $fprotein = $_POST['fprotein'];
    $ffiber = $_POST['ffiber'];

    $q = $db->prepare("INSERT INTO food_item (fname, fimage, fcategory, fcalories, fcarbs, ffat, fprotein, ffiber) VALUES (:fname, :fimage, :fcategory, :fcalories, :fcarbs, :ffat, :fprotein, :ffiber)");
    $q->bindValue(':fname', $fname);
    $q->bindValue(':fimage', $fimage);
    $q->bindValue(':fcategory', $fcategory);
    $q->bindValue(':fcalories', $fcalories);
    $q->bindValue(':fcarbs', $fcarbs);
    $q->bindValue(':ffat', $ffat);
    $q->bindValue(':fprotein', $fprotein);
    $q->bindValue(':ffiber', $ffiber);

    if ($q->execute()) {
        echo "<script>alert('Food Item Added Successfully')</script>";
    } else {
        echo "<script>alert('Failed to Add Food Item')</script>";
    }
}

// Function to handle image upload
function uploadImage() {
    $targetDirectory = "image/"; // Specify your target directory
    $targetFile = $targetDirectory . basename($_FILES["foodImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["foodImage"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["foodImage"]["size"] > 50000000) {
        echo "<script>alert('Sorry, your file is too large.')</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        return "";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["foodImage"]["tmp_name"], $targetFile)) {
            // Insert the file path or relevant information into the database
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
                                    <td width="200px" height="50px">Enter Food Name</td>
                                    <td width="200px" height="50px"><input type="text" name="fname" placeholder="Enter Name"></td>
                                    <td width="200px" height="50px">Add Food Image</td>
                                    <td width="200px" height="50px"><input type="file" name="foodImage" accept="image/*"></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Food Category</td>
                                    <td width="200px" height="50px">
                                        <select name="fcategory">
                                            <option>Vegetable</option>
                                            <option>Fruit</option>
                                            <option>Home Made Food</option>
                                            <option>Fast Food</option>
                                        </select>
                                    </td>
                                    <td width="200px" height="50px">Food Calorie</td>
                                    <td width="200px" height="50px"><input type="text" name="fcalories" placeholder="Enter Food Calorie"></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Food Carbs</td>
                                    <td width="200px" height="50px"><input type="text" name="fcarbs" placeholder="Enter Food carbs"></td>
                                    <td width="200px" height="50px">Food Fat</td>
                                    <td width="200px" height="50px"><input type="text" name="ffat" placeholder="Enter Food fat"></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Food Protein</td>
                                    <td width="200px" height="50px"><input type="text" name="fprotein" placeholder="Enter Food Protein"></td>
                                    <td width="200px" height="50px">Food Fiber</td>
                                    <td width="200px" height="50px"><input type="text" name="ffiber" placeholder="Enter Food fiber "></td>
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
