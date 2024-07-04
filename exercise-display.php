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
                <center>
                    <div id="form">
                        <form method="GET" action="">
                            <label for="search">Search Food:</label>
                            <input type="text" id="search" name="esearch" placeholder="Enter Exercise name or category">
                            <button type="submit" name="sub">Search</button>
                        </form>

                        <table>
                            <tr>
                                <th><center><b><font color="blue">Exercise Image</font></b></center></th>
                                <th><center><b><font color="blue">Exercise Name</font></b></center></th>
                                <th><center><b><font color="blue">Exercise Category</font></b></center></th>
                                <th><center><b><font color="blue">Exercise Description</font></b></center></th>
                  
                            </tr>
                            
                            <?php
                                if (isset($_GET['sub'])) {
                                    $esearch = $_GET['esearch'];
                                    $q = $db->prepare("SELECT * FROM exercise WHERE ecategory LIKE :esearch or ename LIKE :esearch");
                                    $q->bindValue(':esearch', '%' . $esearch . '%', PDO::PARAM_STR);
                                    $q->execute();

                                    if ($q->rowCount() > 0) {
                                        while ($r1 = $q->fetch(PDO::FETCH_OBJ)) {
                                            ?>
                                            <tr>
                                                <td><center><img src="<?= $r1->eimage; ?>" alt="Exercise Image" class="food-image"></center></td>
                                                <td><center><?= $r1->ename; ?></center></td>
                                                <td><center><?= $r1->ecategory; ?></center></td>
                                                <td><center><?= $r1->edesc; ?></center></td>
                                        
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
