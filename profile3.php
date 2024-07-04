<?php
    include('connection.php');
    session_start();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: user-home.php"); 
        exit();
    }
    $dietPlanId = $_GET['id'];
    $query = $db->prepare("SELECT * FROM user_registration WHERE id = :dietPlanId");
    $query->bindValue(':dietPlanId', $dietPlanId, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() === 0) {
        header("Location: user-home.php"); 
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


    // Fetch diet plan information for the logged-in user
    $user_id = $_SESSION['id'];  // Adjust the session key based on your implementation
    $dietPlanQuery = $db->prepare("SELECT * FROM diet_plan WHERE dpid = :user_id");
    $dietPlanQuery->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $dietPlanQuery->execute();
    $dietPlans = $dietPlanQuery->fetchAll(PDO::FETCH_OBJ);


?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style type="text/css">
      * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background: #fff;
  color: rgba(0,0,0,0.6);
}
.profile-page {
  display: flex;
  min-height: 100vh;
  padding-top: 5rem;
}
.profile-page .content {
  display: flex;
  flex-direction: column;
  max-width: 800px;
  width: 100%;
  position: relative;
  z-index: 2;
  margin: auto;
  padding: 2rem;
  background: #fff;
  border-radius: 2rem;
  box-shadow: 0 15px 35px rgba(50,50,93,0.1), 0 5px 15px rgba(0,0,0,0.07);
}
.profile-page .content__cover {
  position: relative;
  background: linear-gradient(150deg, #ff8c00 20%, #ff8c00 100%);
}
.profile-page .content__avatar {
  width: 12rem;
  height: 12rem;
  position: absolute;
  bottom: 0;
  left: 50%;
  z-index: 2;
  transform: translate(-50%, 50%);
  background: #8f6ed5 url("https://image.freepik.com/free-photo/friendly-brunette-looking-camera_23-2147774849.jpg") center center no-repeat;
  background-size: cover;
  border-radius: 50%;
  box-shadow: 0 15px 35px rgba(50,50,93,0.1), 0 5px 15px rgba(0,0,0,0.07);
}
.profile-page .content__actions {
  display: flex;
  justify-content: space-between;
  padding: 0.2rem;
}
.profile-page .content__actions a {
  display: flex;
  flex-flow: row nowrap;
  align-items: center;
  justify-content: center;
  height: 3rem;
  padding: 0.2rem 1rem;
  border-radius: 2rem;
  text-decoration: none;
  font-size: 0.9rem;
}
.profile-page .content__actions a:hover:first-child {
  background: #1d8cf8;
  color: #fff;
}
.profile-page .content__title {
  margin-top: 4.5rem;
  text-align: center;
  order: 1;
}
.profile-page .content__title h1 {
  margin-bottom: 0.1rem;
  font-size: 2.4rem;
}
.profile-page .content__description {
  margin-top: 2.5rem;
  text-align: center;
  order: 2;
}
.profile-page .content__description p {
  margin-bottom: 0.2rem;
  font-size: 1.2rem;
}
.profile-page .content__list {
  display: flex;
  justify-content: center;
  margin-top: 2rem;
  list-style-type: none;
  order: 3;
}
.profile-page .content__list li {
  padding: 0 1.5rem;
  text-align: center;
  font-size: 1rem;
}
.profile-page .content__button {
  margin: 3rem 0 2rem;
  text-align: center;
  order: 4;
}
.profile-page .content__button .button {
  display: inline-block;
  padding: 1.2rem 1.8rem;
  text-align: center;
  text-decoration: none;
  background: linear-gradient(100deg, #1d8cf8 30%, #3358f4 100%);
  border-radius: 2rem;
  box-shadow: 0 4px 6px rgba(50,50,93,0.11), 0 1px 3px rgba(0,0,0,0.08);
  font-size: 1rem;
  color: #fff;
  cursor: pointer;
}
.profile-page .bg {
  width: 100%;
  height: 50%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
}
.profile-page .bg div {
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
  overflow: hidden;
  background: linear-gradient(150deg, #ff8c00 20%, #ff8c00 100%);
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
                <h1>User Profile</h1><br>

                <div class="profile-page">
                    <div class="content">
                        <div class="content__cover">
                            <div class="content__avatar"></div>
                        </div>
                        <div class="content__actions"><a href="index.php">
                            </svg><span>Logout</span></a></div>
                        <div class="content__title">
                            <h1><?= $dietPlan->name; ?></h1><span><?= $dietPlan->email; ?></span>
                        </div>
                        <div class="content__description">
                            <p>Web Producer - Web Specialist</p>
                            <p>Columbia University - New York</p>
                            <center>
                    <div id="form">
                        <table>
                            <tr>
                                <th>BMI</th>
                                <th>Breakfast</th>
                                <th>Midmeal</th>
                                <th>Lunch</th>
                                <th>Evening</th>
                                <th>Dinner</th>
                                <!-- <th>Actions</th> New column for actions -->
                            </tr>
                          
                              <!-- Cutted code will come here -->
                              <?php foreach ($dietPlans as $diet) : ?>
                              <tr>
                                  <td><?= $diet->dpbmi; ?></td>
                                  <td><?= $diet->dpbreakfast; ?></td>
                                  <td><?= $diet->dpmidmeal; ?></td>
                                  <td><?= $diet->dplunch; ?></td>
                                  <td><?= $diet->dpevening; ?></td>
                                  <td><?= $diet->dpdinner; ?></td>
                              </tr>
                          <?php endforeach; ?>

                        </table>
                    </div>
                </center>
                        </div>

                        <ul class="content__list">
                            <li><span><?= $dietPlan->gender; ?></span> Gender</li>
                            <li><span><?= $dietPlan->age; ?></span>Age</li>
                            <li><span><?= $dietPlan->cno; ?></span>Contact Number</li>
                        </ul>
                        <div class="content__button"><a class="button" href="#">
                            <div class="button__border"></div>
                            <div class="button__bg"></div>
                            <p class="button__text">Edit</p></a></div>
                    </div>
                    <div class="bg">
                        <div>
                            <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>




<?php
                                // $q = $db->query("SELECT * FROM diet_plan ");
                                // while($r1 = $q->fetch(PDO::FETCH_OBJ)) {
                            ?>
                                <!-- <tr>
                                    <td><?= $r1->dpbmi; ?></td>
                                    <td><?= $r1->dpbreakfast; ?></td>
                                    <td><?= $r1->dpmidmeal; ?></td>
                                    <td><?= $r1->dplunch; ?></td>
                                    <td><?= $r1->dpevening; ?></td>
                                    <td><?= $r1->dpdinner; ?></td>
                                  
                                </tr> -->
                            <?php
                                // }       
                            ?>
