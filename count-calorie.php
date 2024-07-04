<?php
    include('connection.php');
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Food List</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; 
            color: black;
        }

        h1, h2 {
            color: orange; 
        }
        
        h4 {
            color: white; 
        }

        a {
            color: white; 
            text-decoration: none;
        }

        a:hover {
            color: #007bff; 
        }

        #header {
            background-color: orange; 
            color: #fff; 
            padding: 10px;
            text-align: center;
        }

        #footer {
            background-color: orange; 
            border-top: 1px solid #ccc; 
            padding: 10px;
            text-align: center;
        }

        #form {
            background-color: #fff; 
            border: 1px solid #ccc; 
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        button {
            background-color: #4495d1; 
            color: #fff; 
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #f0f0f0; 
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .food-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>
    <div id="full">
        <div id="inner_full">
            <div id="header"><h2><a href="user-home.php">Diet Buddy</a></h2></div>
            <div id="body">
                <br>
                <?php
                    $un = $_SESSION['un'];
                    if (!$un) {
                        header("Location:index.php");
                    }
                ?>
                <h1>Food List</h1><br>

                <div id="categories">
                    <h3>Food Categories</h3>
                    <?php
                        $categoriesQuery = $db->query("SELECT DISTINCT fcategory FROM food_item");
                        while ($category = $categoriesQuery->fetch(PDO::FETCH_OBJ)) {
                            echo '<a href="?category=' . urlencode($category->fcategory) . '">' . $category->fcategory . '</a> ';
                        }
                    ?>
                </div>


                <center>
                    <div id="form">
                        <form method="GET" action="">
                            <label for="search">Search Food:</label>
                            <input type="text" id="search" name="fsearch" placeholder="Enter food name">
                            <button type="submit" name="sub">Search</button>
                            <input type="hidden" name="category" value="<?= isset($_GET['category']) ? $_GET['category'] : '' ?>">
                        </form>

                        <table>
                            <tr>
                                <th><center><b><font color="blue">Food Image</font></b></center></th>
                                <th><center><b><font color="blue">Food Name</font></b></center></th>
                                <th><center><b><font color="blue">Food Category</font></b></center></th>
                                <th><center><b><font color="blue">Food Calories</font></b></center></th>
                                <th><center><b><font color="blue">Food Carbs</font></b></center></th>
                                <th><center><b><font color="blue">Food Fat</font></b></center></th>
                                <th><center><b><font color="blue">Food Protein</font></b></center></th>
                                <th><center><b><font color="blue">Doctor Fiber</font></b></center></th>
                            </tr>
                            
                            <?php
                                if (isset($_GET['sub'])) {
                                    $fsearch = $_GET['fsearch'];
                                    // $q = $db->prepare("SELECT * FROM food_item WHERE fcategory LIKE :fsearch or fname LIKE :fsearch");
                                    // $q->bindValue(':fsearch', '%' . $fsearch . '%', PDO::PARAM_STR);
                                    // $q->execute();

                                    $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
                                    $q = $db->prepare("SELECT * FROM food_item WHERE (fcategory LIKE :fsearch or fname LIKE :fsearch) AND (fcategory = :category OR :category = '')");
                                    $q->bindValue(':fsearch', '%' . $fsearch . '%', PDO::PARAM_STR);
                                    $q->bindValue(':category', $categoryFilter, PDO::PARAM_STR);
                                    $q->execute();    


                                    if ($q->rowCount() > 0) {
                                        while ($r1 = $q->fetch(PDO::FETCH_OBJ)) {
                                            ?>
                                            <tr>
                                                <td><center><img src="<?= $r1->fimage; ?>" alt="Food Image" class="food-image"></center></td>
                                                <td><center><?= $r1->fname; ?></center></td>
                                                <td><center><?= $r1->fcategory; ?></center></td>
                                                <td><center><?= $r1->fcalories; ?></center></td>
                                                <td><center><?= $r1->fcarbs; ?></center></td>
                                                <td><center><?= $r1->ffat; ?></center></td>
                                                <td><center><?= $r1->fprotein; ?></center></td>
                                                <td><center><?= $r1->ffiber; ?></center></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        echo "<script>alert('No matching food category found. Please try again.');</script>";
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </center>

                <div id="footer" height='70px'>
                    <h4 align="center"> Copyright Diet Buddy</h4>
                    <p align="center"> <a href="index.php">Logout </a> </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
