<?php
session_start();
$sessionId = $_SESSION['id'] ?? '';
$sessionRole = $_SESSION['role'] ?? '';
echo "$sessionId $sessionRole";
if (!$sessionId && !$sessionRole) {
    header("location:login.php");
    die();
}

ob_start();

include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection) {
    echo mysqli_error($connection);
    throw new Exception("Database cannot Connect");
}

$id = $_REQUEST['id'] ?? 'dashboard';
$action = $_REQUEST['action'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>DMS||DashBoard</title>
</head>

<body>
    <!--------------------------------- Secondary Navber -------------------------------->
    <section class="topber">
        <div class="topber__title">
            <span class="topber__title--text">
                <?php
                if ('dashboard' == $id) {
                    echo "DashBoard";
                } elseif ('addManager' == $id) {
                    echo "Add Manager";
                } elseif ('allManager' == $id) {
                    echo "Managers";
                } elseif ('addDrug' == $id) {
                    echo "Add Drug";
                } elseif ('allDrug' == $id) {
                    echo "Drugs";
                } elseif ('expiredDrug' == $id) {
                    echo "Expired Drugs";
                } elseif ('addSalesman' == $id) {
                    echo "Add OtherUser";
                } elseif ('allSalesman' == $id) {
                    echo "Otherusers";
                } elseif ('userProfile' == $id) {
                    echo "Your Profile";
                } elseif ('editManager' == $action) {
                    echo "Edit Manager";
                } elseif ('editDrug' == $action) {
                    echo "Edit Drug";
                } elseif ('viewDrug' == $action) {
                    echo "View Drug";
                } elseif ('editSalesman' == $action) {
                    echo "Edit Otheruser";
                }
                ?>

            </span>
        </div>

        <div class="topber__profile">
            <?php
            $query = "SELECT fname,lname,role,avatar FROM {$sessionRole}s WHERE id='$sessionId'";
            $result = mysqli_query($connection, $query);

            if ($data = mysqli_fetch_assoc($result)) {
                $fname = $data['fname'];
                $lname = $data['lname'];
                $role = $data['role'];
                $avatar = $data['avatar'];
                ?>
                                                        <img src="assets/img/<?php echo "$avatar"; ?>" height="25" width="25" class="rounded-circle" alt="profile">
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <?php
                                                            echo "$fname $lname (" . ucwords($role) . " )";
            }
            ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="home.php">Dashboard</a>
                        <a class="dropdown-item" href="home.php?id=userProfile">Profile</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </div>
        </div>
    </section>
    <!--------------------------------- Secondary Navber -------------------------------->


    <!--------------------------------- Sideber -------------------------------->
    <section id="sideber" class="sideber">
        <ul class="sideber__ber">
            <h3 class="sideber__panel"><i id="left" class="fas fa-laugh-wink"></i> DMS</h3>
            <li id="left" class="sideber__item<?php if ('dashboard' == $id) {
                echo " active";
            } ?>">
                <a href="home.php?id=dashboard"><i id="left" class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <?php if ('admin' == $sessionRole) { ?>
                                                        <!-- Only For Admin -->
                                                        <li id="left" class="sideber__item sideber__item--modify<?php if ('addManager' == $id) {
                                                            echo " active";
                                                        } ?>">
                                                            <a href="home.php?id=addManager"><i id="left" class="fas fa-user-plus"></i></i>Add Manager</a>
                                                        </li><?php } ?>
            <li id="left" class="sideber__item<?php if ('allManager' == $id) {
                echo " active";
            } ?>">
                <a href="home.php?id=allManager"><i id="left" class="fas fa-user"></i>All Manager</a>
            </li>
            <?php if ('admin' == $sessionRole || 'manager' == $sessionRole) { ?>
                                                        <!-- For Admin, Manager -->
                                                        <li id="left" class="sideber__item sideber__item--modify<?php if ('addDrug' == $id) {
                                                            echo " active";
                                                        } ?>">
                                                            <a href="home.php?id=addDrug"><i id="left" class="fas fa-capsules"></i></i>Add
                                                                Drug</a>
                                                        </li><?php } ?>
            <li id="left" class="sideber__item<?php if ('allDrug' == $id) {
                echo " active";
            } ?>">
                <a href="home.php?id=allDrug"><i id="left" class="fas fa-tablets"></i>All Drugs</a>
                
            </li>

            <li id="left" class="sideber__item<?php if ('expiredDrug' == $id) {
                echo " active";
            } ?>">
                <a href="home.php?id=expiredDrug"><i id="left" class="fas fa-pills"></i>Expired Drugs</a>
                
            </li>
            
            <?php if ('admin' == $sessionRole || 'manager' == $sessionRole || 'pharmacist' == $sessionRole) { ?>
                                                        <!-- For Admin, Manager, Pharmacist-->
                                                        <li id="left" class="sideber__item sideber__item--modify<?php if ('addSalesman' == $id) {
                                                            echo " active";
                                                        } ?>">
                                                            <a href="home.php?id=addSalesman"><i id="left" class="fas fa-user-plus"></i>Add Otheruser</a>
                                                        </li><?php } ?>
            <li id="left" class="sideber__item<?php if ('allSalesman' == $id) {
                echo " active";
            } ?>">
                <a href="home.php?id=allSalesman"><i id="left" class="fas fa-user"></i>All Otherusers</a>
            </li>
        </ul>
        <footer class="text-center"><span>DMS</span><br>©2023 All right reserved. By shaka</footer>
    </section>
    <!--------------------------------- #Sideber -------------------------------->


    <!--------------------------------- Main section -------------------------------->
    <section class="main">
        <div class="container">

            <!-- ---------------------- DashBoard ------------------------ -->
            <?php if ('dashboard' == $id) { ?>
                                                        <div class="dashboard p-5">
                                                            <div class="total">
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <!-- <div class="total__box text-center">
                                                        <h1>1002</h1>
                                                        <h2>Total Sell</h2>
                                                    </div> -->
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="total__box text-center">
                                                                            <h1>
                                                                                <?php
                                                                                $query = "SELECT COUNT(*) totalManager FROM managers;";
                                                                                $result = mysqli_query($connection, $query);
                                                                                $totalManager = mysqli_fetch_assoc($result);
                                                                                echo $totalManager['totalManager'];
                                                                                ?>
                                                                            </h1>
                                                                            <h2>Managers</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="total__box text-center">
                                                                            <h1>
                                                                                <?php
                                                                                $query = "SELECT COUNT(*) totalDrug FROM drugs;";
                                                                                $result = mysqli_query($connection, $query);
                                                                                $totalPharmacist = mysqli_fetch_assoc($result);
                                                                                echo $totalPharmacist['totalDrug'];
                                                                                ?>

                                                                            </h1>
                                                                            <h2>Drugs</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="total__box text-center">
                                                                            <h1><?php
                                                                            $query = "SELECT COUNT(*) totalSalesman FROM salesmans;";
                                                                            $result = mysqli_query($connection, $query);
                                                                            $totalSalesman = mysqli_fetch_assoc($result);
                                                                            echo $totalSalesman['totalSalesman'];
                                                                            //?></h1>
                                                                            <h2>Otherusers</h2>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
            <?php } ?>
            <!-- ---------------------- DashBoard ------------------------ -->




            <!-- ---------------------- Manager ------------------------ -->
            <div class="manager">
                <?php if ('allManager' == $id) { ?>
                                                            <div class="allManager">
                                                                <div class="main__table">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Avater</th>
                                                                                <th scope="col">Name</th>
                                                                                <th scope="col">Email</th>
                                                                                <th scope="col">Phone</th>
                                                                                <?php if ('admin' == $sessionRole) { ?>
                                                                                                                            <!-- Only For Admin -->
                                                                                                                            <th scope="col">Edit</th>
                                                                                                                            <th scope="col">Delete</th>
                                                                                <?php } ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            <?php
                                                                            $getManagers = "SELECT * FROM managers";
                                                                            $result = mysqli_query($connection, $getManagers);

                                                                            while ($manager = mysqli_fetch_assoc($result)) { ?>

                                                                                                                        <tr>
                                                                                                                            <td>
                                                                                                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $manager['avatar']; ?>" alt=""></center>
                                                                                                                            </td>
                                                                                                                            <td><?php printf("%s %s", $manager['fname'], $manager['lname']); ?></td>
                                                                                                                            <td><?php printf("%s", $manager['email']); ?></td>
                                                                                                                            <td><?php printf("%s", $manager['phone']); ?></td>
                                                                                                                            <?php if ('admin' == $sessionRole) { ?>
                                                                                                                                                                        <!-- Only For Admin -->
                                                                        
                                                                                                                                                                        <td><?php printf("<a href='home.php?action=editManager&id=%s'><i class='fas fa-edit'></i></a>", $manager['id']) ?></td>
                                                                                                                                                                        <td><?php printf("<a class='delete' href='home.php?action=deleteManager&id=%s'><i class='fas fa-trash'></i></a>", $manager['id']) ?></td>
                                                                                                                            <?php } ?>
                                                                                                                        </tr>

                                                                            <?php } ?>

                                                                        </tbody>
                                                                    </table>


                                                                </div>
                                                            </div>
                <?php } ?>

                <?php if ('addManager' == $id) { ?>
                                                            <div class="addManager">
                                                                <div class="main__form">
                                                                    <div class="main__form--title text-center">Add New Manager</div>
                                                                    <form action="add.php" method="POST">
                                                                        <div class="form-row">
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-user-circle"></i>
                                                                                    <input type="text" name="fname" placeholder="First name" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-user-circle"></i>
                                                                                    <input type="text" name="lname" placeholder="Last Name" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-envelope"></i>
                                                                                    <input type="email" name="email" placeholder="Email" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-phone-alt"></i>
                                                                                    <input type="number" name="phone" placeholder="Phone" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-key"></i>
                                                                                    <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                                                                    <i id="pwd" class="fas fa-eye right"></i>
                                                                                </label>
                                                                            </div>
                                                                            <input type="hidden" name="action" value="addManager">
                                                                            <div class="col col-12">
                                                                                <input type="submit" value="Submit">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                <?php } ?>

                <?php if ('editManager' == $action) {
                    $managerId = $_REQUEST['id'];
                    $selectManagers = "SELECT * FROM managers WHERE id='{$managerId}'";
                    $result = mysqli_query($connection, $selectManagers);

                    $manager = mysqli_fetch_assoc($result); ?>
                                                            <div class="addManager">
                                                                <div class="main__form">
                                                                    <div class="main__form--title text-center">Update Manager</div>
                                                                    <form action="add.php" method="POST">
                                                                        <div class="form-row">
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-user-circle"></i>
                                                                                    <input type="text" name="fname" placeholder="First name" value="<?php echo $manager['fname']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-user-circle"></i>
                                                                                    <input type="text" name="lname" placeholder="Last Name" value="<?php echo $manager['lname']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-envelope"></i>
                                                                                    <input type="email" name="email" placeholder="Email" value="<?php echo $manager['email']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-phone-alt"></i>
                                                                                    <input type="number" name="phone" placeholder="Phone" value="<?php echo $manager['phone']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <input type="hidden" name="action" value="updateManager">
                                                                            <input type="hidden" name="id" value="<?php echo $managerId; ?>">
                                                                            <div class="col col-12">
                                                                                <input type="submit" value="Update">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                <?php } ?>

                <?php if ('deleteManager' == $action) {
                    $managerId = $_REQUEST['id'];
                    $deleteManager = "DELETE FROM managers WHERE id ='{$managerId}'";
                    $result = mysqli_query($connection, $deleteManager);
                    header("location:home.php?id=allManager");
                } ?>
            </div>
            <!-- ---------------------- manager ------------------------ -->

            <!-- ---------------------- drugs ------------------------ -->
            <div class="drugs">
                <?php if ('allDrug' == $id) { ?>
                                                            <div class="allDrug">
                                                                
                                                                                                                            
                                                                <form  class="form-group ml-5 mr-5 row" > 
                                                                    <input type="text" name="searchKeyword" id="searchInput" onkeyup="searchTable()" placeholder="search" class="form-control">
                                                            
                                                                </form>
                                                                <div class="main__table">
                                    
                                                                    <table class="table" id="dataTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <!-- <th scope="col">ID</th> -->
                                                                                <th scope="col">Drug Name</th>
                                                                                <th scope="col">Description</th>
                                                                                <th scope="col">Drug Status</th>
                                                                                <?php if ('admin' == $sessionRole || 'manager' == $sessionRole) { ?>
                                                                                                                            <!-- For Admin, Manager -->
                                                                                                                            <th scope="col">View</th>
                                                                                                                            <th scope="col">Edit</th>
                                                                                                                            <th scope="col">Delete</th>
                                                                                <?php } ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            <?php
                                                                            $getDrug = "SELECT * FROM drugs";
                                                                            $result = mysqli_query($connection, $getDrug);

                                                                            while ($drug = mysqli_fetch_assoc($result)) {

                                                                                $current_time = date("Y-m-d");
                                                                                if ($drug['expiry_date'] == $current_time) {
                                                                                    $query = "UPDATE drugs SET status='-1' where id='{$drug['id']}'";
                                                                                    mysqli_query($connection, $query);
                                                                                } ?>

                                                                

                                                                                                                        <tr>
                                                                                            
                                                                                                                            <td><?php printf("%s", $drug['drug_name']); ?></td>
                                                                                                                            <td><?php printf("%s", $drug['drug_description']); ?></td>
                                                                                                                            <td>
                                                                                                                                <?php

                                                                                                                                if ($drug['status'] == '1') {
                                                                                                                                    echo "<p style='color:green;'>Good</p>";
                                                                                                                                } elseif ($drug['status'] == '0') {
                                                                                                                                    echo "<p style='color:orange;'>Warning</p>";
                                                                                                                                } elseif ($drug['status'] == '-1') {
                                                                                                                                    echo "<p style='color:red;'>Expired</p>";
                                                                                                                                }

                                                                                                                                ?>
                                                                                                                            </td>
                                                                                                                            <?php if ('admin' == $sessionRole || 'manager' == $sessionRole) { ?>
                                                                                                                                                                        <!-- For Admin, Manager -->
                                                                                                                                                                        <td><?php printf("<a href='home.php?action=viewDrug&id=%s'><i class='fas fa-eye'></i></a>", $drug['id']) ?></td>
                                                                                                                                                                        <td><?php printf("<a href='home.php?action=editDrug&id=%s'><i class='fas fa-edit'></i></a>", $drug['id']) ?></td>
                                                                                                                                                                        <td><?php printf("<a class='delete' href='home.php?action=deleteDrug&id=%s'><i class='fas fa-trash'></i></a>", $drug['id']) ?></td>
                                                                                                                            <?php } ?>
                                                                                                                        </tr>

                                                                            <?php } ?>

                                                                        </tbody>
                                                                    </table>


                                                                </div>
                                                            </div>
                            <?php
                }
                ?>

             <!-- ==========================expiredDrug ========================= -->
             <div class="drugs">
                <?php if ('expiredDrug' == $id) { ?>
                                                            <div class="expiredDrug">
                                                            <form  class="form-group ml-5 mr-5 row" > 
                                                                    <input type="text" name="searchKeyword" id="searchInput" onkeyup="searchTable()" placeholder="search" class="form-control">
                                                            
                                                                </form>
                                                                
                                                                <div class="main__table">
                                    
                                                                    <table class="table" id="dataTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <!-- <th scope="col">ID</th> -->
                                                                                <th scope="col">Drug Name</th>
                                                                                <th scope="col">Description</th>
                                                                                <th scope="col">Drug Status</th>
                                                                                <?php if ('admin' == $sessionRole || 'manager' == $sessionRole) { ?>
                                                                                                                            <!-- For Admin, Manager -->
                                                                                                                            <th scope="col">View</th>
                                                                                                                            <th scope="col">Edit</th>
                                                                                                                            <th scope="col">Delete</th>
                                                                                <?php } ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            <?php
                                                                            $getDrug = "SELECT * FROM drugs";
                                                                            $result = mysqli_query($connection, $getDrug);

                                                                            while ($drug = mysqli_fetch_assoc($result)) {
                                                                                if ($drug['status'] == '-1') { ?>

                                                                                    <tr>
                                            
                                                                                        <td><?php printf("%s", $drug['drug_name']); ?></td>
                                                                                        <td><?php printf("%s", $drug['drug_description']); ?></td>
                                                                                        <td>
                                                                                            <?php

                                                                                            if ($drug['status'] == '1') {
                                                                                                echo "<p style='color:green;'>Good</p>";
                                                                                            } elseif ($drug['status'] == '0') {
                                                                                                echo "<p style='color:orange;'>Warning</p>";
                                                                                            } elseif ($drug['status'] == '-1') {
                                                                                                echo "<p style='color:red;'>Expired</p>";
                                                                                            }

                                                                                            ?>
                                                                                        </td>
                                                                                        <?php if ('admin' == $sessionRole || 'manager' == $sessionRole) { ?>
                                                                                                                                    <!-- For Admin, Manager -->
                                                                                                                                    <td><?php printf("<a href='home.php?action=viewDrug&id=%s'><i class='fas fa-eye'></i></a>", $drug['id']) ?></td>
                                                                                                                                    <td><?php printf("<a href='home.php?action=editDrug&id=%s'><i class='fas fa-edit'></i></a>", $drug['id']) ?></td>
                                                                                                                                    <td><?php printf("<a class='delete' href='home.php?action=deleteDrug&id=%s'><i class='fas fa-trash'></i></a>", $drug['id']) ?></td>
                                                                                        <?php } ?>
                                                                                    </tr>

                                        <?php }
                                                                            } ?>

                                                                        </tbody>
                                                                    </table>


                                                                </div>
                                                            </div>
                            <?php
                }
                ?>


<!-- ====================================== add drug ================================================================== -->
                <?php if ('addDrug' == $id) { ?>
                                                            <div class="addDrug">
                                                                <div class="main__form">
                                                                    <div class="main__form--title text-center">Add New Drug</div>
                                                                    <form action="add.php" method="POST">
                                                                        <div class="form-row">
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-capsules"></i>
                                                                                    <input type="text" name="d_name" placeholder="Drug Name" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-tablets"></i>
                                                                                    <input type="text" name="d_desc" placeholder="Drug description" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <p id="left">mnf</p>
                                                                                    <input type="text" name="mnf_date" placeholder="YYYY-MM-DD" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <p id="left">Exp</p>
                                                                                    <input type="text" name="exp_date" placeholder="YYYY-MM-DD" required>
                                                                                </label>
                                                                            </div>
                                                            
                                                                            <input type="hidden" name="action" value="addDrug">
                                                                            <div class="col col-12">
                                                                                <input type="submit" name="add_drug" value="Submit">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                <?php } ?>
<!--------------------------------- view drug --------------------------------------------------------------------------------------------->
                <?php if ('viewDrug' == $action) {
                    $drugID = $_REQUEST['id'];
                    $selectDrug = "SELECT * FROM drugs WHERE id='{$drugID}'";
                    $result = mysqli_query($connection, $selectDrug);

                    $drug = mysqli_fetch_assoc($result); ?>
                            <div class="addManager">
                                <div class="main__form">
                                    <div class="main__form--title text-center"><?= $drug['drug_name'] ?></div>
                                    
                                    <div class="row">
                                        <div class="col-4">
                                            <h6>Manufacturing Date</h6>
                                            <p><?= $drug['manufacturing_date'] ?></p>
                                        </div>

                                        <div class="col-4">
                                            <h6>Expiry Date</h6>
                                            <p><?= $drug['expiry_date'] ?></p>
                                        </div>

                                        <div class="col-4">
                                            <h6>Status</h6>
                                            <?php


                                            if ($drug['status'] == '1') {
                                                echo "<p style='color:green;'>Good</p>";
                                            } elseif ($drug['status'] == '0') {
                                                echo "<p style='color:orange;'>Warning</p>";
                                            } elseif ($drug['status'] == '-1') {
                                                echo "<p style='color:red;'>Expired</p>";
                                            }

                                            ?>
                                        </div>

                                     </div>

                                     <div class="mt-3">
                                     <h6 class="">Drug description</h6>
                                        <p><?= $drug['drug_description'] ?></p>
                                     </div>
                                </div>
                            </div>
                <?php } ?>

<!-------------------------------------------------- edit drug------------------------------------------------------------------------------------------ -->
                <?php if ('editDrug' == $action) {
                    $drugID = $_REQUEST['id'];
                    $selectDrug = "SELECT * FROM drugs WHERE id='{$drugID}'";
                    $result = mysqli_query($connection, $selectDrug);

                    $drug = mysqli_fetch_assoc($result); ?>
                                                            <div class="addManager">
                                                                <div class="main__form">
                                                                    <div class="main__form--title text-center">Update Drug</div>
                                                                    <form action="add.php" method="POST">
                                                                        <div class="form-row">
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-hospital"></i>
                                                                                    <input type="text" name="d_name" placeholder="Drug Name" value="<?php echo $drug['drug_name']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                <p id="left">Dec</p>
                                                                                    <input type="text" name="d_desc" placeholder="Drug Description" value="<?php echo $drug['drug_description']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                <p id="left">Mnf</p>
                                                                                    <input type="text" name="mnf_date" placeholder="YYYY-MM-DD" value="<?php echo $drug['manufacturing_date']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                <p id="left">Exp</p>
                                                                                    <input type="text" name="exp_date" placeholder="Expiry Date" value="<?php echo $drug['expiry_date']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <input type="text" hidden name="status" value="<?php echo $drug['status'] ?>" >
                                                                            <input type="hidden" name="action" value="updateDrug">
                                                                            <input type="hidden" name="id" value="<?php echo $drugID; ?>">
                                                                            <div class="col col-12">
                                                                                <input type="submit" name="edit_drug" value="Update">
                                                                            </div>
                                                            
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                <?php } ?>

                <?php if ('deleteDrug' == $action) {
                    $drugID = $_REQUEST['id'];
                    $deleteDrug = "DELETE FROM drugs WHERE id ='{$drugID}'";
                    $result = mysqli_query($connection, $deleteDrug);
                    header("location:home.php?id=allDrug");
                } ?>
            </div>
            <!-- ---------------------- drugs ------------------------ -->

            <!-- ---------------------- OtherUsers ------------------------ -->
            <div class="salesman">
                <?php if ('allSalesman' == $id) { ?>
                                                            <div class="allSalesman">
                                                                <div class="main__table">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Avatar</th>
                                                                                <th scope="col">Name</th>
                                                                                <th scope="col">Email</th>
                                                                                <th scope="col">Phone</th>
                                                                                <?php if ('admin' == $sessionRole || 'manager' == $sessionRole || 'pharmacist' == $sessionRole) { ?>
                                                                                                                            <!-- For Admin, Manager, Pharmacist-->
                                                                                                                            <th scope="col">Edit</th>
                                                                                                                            <th scope="col">Delete</th>
                                                                                <?php } ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            <?php
                                                                            $getSalesman = "SELECT * FROM salesmans";
                                                                            $result = mysqli_query($connection, $getSalesman);

                                                                            while ($salesman = mysqli_fetch_assoc($result)) { ?>

                                                                                                                        <tr>
                                                                                                                             <td>
                                                                                                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $salesman['avatar']; ?>" alt=""></center>
                                                                                                                            </td>
                                                                                                                            <td><?php printf("%s %s", $salesman['fname'], $salesman['lname']); ?></td>
                                                                                                                            <td><?php printf("%s", $salesman['email']); ?></td>
                                                                                                                            <td><?php printf("%s", $salesman['phone']); ?></td>
                                                                                                                            <?php if ('admin' == $sessionRole || 'manager' == $sessionRole || 'pharmacist' == $sessionRole) { ?>
                                                                                                                                                                        <!-- For Admin, Manager, Pharmacist-->
                                                                                                                                                                        <td><?php printf("<a href='home.php?action=editSalesman&id=%s'><i class='fas fa-edit'></i></a>", $salesman['id']) ?></td>
                                                                                                                                                                        <td><?php printf("<a class='delete' href='home.php?action=deleteSalesman&id=%s'><i class='fas fa-trash'></i></a>", $salesman['id']) ?></td>
                                                                                                                            <?php } ?>
                                                                                                                        </tr>

                                                                            <?php } ?>

                                                                        </tbody>
                                                                    </table>


                                                                </div>
                                                            </div>
                <?php } ?>

                <?php if ('addSalesman' == $id) { ?>
                                                            <div class="addSalesman">
                                                                <div class="main__form">
                                                                    <div class="main__form--title text-center">Add New User</div>
                                                                    <form action="add.php" method="POST">
                                                                        <div class="form-row">
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-user-circle"></i>
                                                                                    <input type="text" name="fname" placeholder="First name" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-user-circle"></i>
                                                                                    <input type="text" name="lname" placeholder="Last Name" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-envelope"></i>
                                                                                    <input type="email" name="email" placeholder="Email" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-phone-alt"></i>
                                                                                    <input type="number" name="phone" placeholder="Phone" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-key"></i>
                                                                                    <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                                                                </label>
                                                                            </div>
                                                                            <input type="hidden" name="action" value="addSalesman">
                                                                            <div class="col col-12">
                                                                                <input type="submit" value="Submit">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                <?php } ?>

                <?php if ('editSalesman' == $action) {
                    $salesmanID = $_REQUEST['id'];
                    $selectSalesman = "SELECT * FROM salesmans WHERE id='{$salesmanID}'";
                    $result = mysqli_query($connection, $selectSalesman);

                    $salesman = mysqli_fetch_assoc($result); ?>
                                                            <div class="addManager">
                                                                <div class="main__form">
                                                                    <div class="main__form--title text-center">Update OtherUser</div>
                                                                    <form action="add.php" method="POST">
                                                                        <div class="form-row">
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-user-circle"></i>
                                                                                    <input type="text" name="fname" placeholder="First name" value="<?php echo $salesman['fname']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-user-circle"></i>
                                                                                    <input type="text" name="lname" placeholder="Last Name" value="<?php echo $salesman['lname']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-envelope"></i>
                                                                                    <input type="email" name="email" placeholder="Email" value="<?php echo $salesman['email']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col col-12">
                                                                                <label class="input">
                                                                                    <i id="left" class="fas fa-phone-alt"></i>
                                                                                    <input type="number" name="phone" placeholder="Phone" value="<?php echo $salesman['phone']; ?>" required>
                                                                                </label>
                                                                            </div>
                                                                            <input type="hidden" name="action" value="updateSalesman">
                                                                            <input type="hidden" name="id" value="<?php echo $salesmanID; ?>">
                                                                            <div class="col col-12">
                                                                                <input type="submit" value="Update">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                <?php } ?>

                <?php if ('deleteSalesman' == $action) {
                    $salesmanID = $_REQUEST['id'];
                    $deleteSalesman = "DELETE FROM salesmans WHERE id ='{$salesmanID}'";
                    $result = mysqli_query($connection, $deleteSalesman);
                    header("location:home.php?id=allSalesman");
                    ob_end_flush();
                } ?>
            </div>
            <!-- ---------------------- otherUsers ------------------------ -->

            <!-- ---------------------- User Profile ------------------------ -->
            <?php if ('userProfile' == $id) {
                $query = "SELECT * FROM {$sessionRole}s WHERE id='$sessionId'";
                $result = mysqli_query($connection, $query);
                $data = mysqli_fetch_assoc($result)
                    ?>
                                                        <div class="userProfile">
                                                            <div class="main__form myProfile">
                                                                <form action="home.php">
                                                                    <div class="main__form--title myProfile__title text-center">My Profile</div>
                                                                    <div class="form-row text-center">
                                                                        <div class="col col-12 text-center pb-3">
                                                                            <img src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                                                        </div>
                                                                        <div class="col col-12">
                                                                            <h4><b>Full Name : </b><?php printf("%s %s", $data['fname'], $data['lname']); ?></h4>
                                                                        </div>
                                                                        <div class="col col-12">
                                                                            <h4><b>Email : </b><?php printf("%s", $data['email']); ?></h4>
                                                                        </div>
                                                                        <div class="col col-12">
                                                                            <h4><b>Phone : </b><?php printf("%s", $data['phone']); ?></h4>
                                                                        </div>
                                                                        <input type="hidden" name="id" value="userProfileEdit">
                                                                        <div class="col col-12">
                                                                            <input class="updateMyProfile" type="submit" value="Update Profile">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
            <?php } ?>

            <?php if ('userProfileEdit' == $id) {
                $query = "SELECT * FROM {$sessionRole}s WHERE id='$sessionId'";
                $result = mysqli_query($connection, $query);
                $data = mysqli_fetch_assoc($result)
                    ?>


                                                        <div class="userProfileEdit">
                                                            <div class="main__form">
                                                                <div class="main__form--title text-center">Update My Profile</div>
                                                                <form enctype="multipart/form-data" action="add.php" method="POST">
                                                                    <div class="form-row">
                                                                        <div class="col col-12 text-center pb-3">
                                                                            <img id="pimg" src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                                                            <i class="fas fa-pen pimgedit"></i>
                                                                            <input onchange="document.getElementById('pimg').src = window.URL.createObjectURL(this.files[0])" id="pimgi" style="display: none;" type="file" name="avatar">
                                                                        </div>
                                                                        <div class="col col-12">
                                                                        <?php if (isset($_REQUEST['avatarError'])) {
                                                                            echo "<p style='color:red;' class='text-center'>Please make sure this file is jpg, png or jpeg</p>";
                                                                        } ?>
                                                                        </div>
                                                                        <div class="col col-12">
                                                                            <label class="input">
                                                                                <i id="left" class="fas fa-user-circle"></i>
                                                                                <input type="text" name="fname" placeholder="First name" value="<?php echo $data['fname']; ?>" required>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col col-12">
                                                                            <label class="input">
                                                                                <i id="left" class="fas fa-user-circle"></i>
                                                                                <input type="text" name="lname" placeholder="Last Name" value="<?php echo $data['lname']; ?>" required>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col col-12">
                                                                            <label class="input">
                                                                                <i id="left" class="fas fa-envelope"></i>
                                                                                <input type="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>" required>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col col-12">
                                                                            <label class="input">
                                                                                <i id="left" class="fas fa-phone-alt"></i>
                                                                                <input type="number" name="phone" placeholder="Phone" value="<?php echo $data['phone']; ?>" required>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col col-12">
                                                                            <label class="input">
                                                                                <i id="left" class="fas fa-key"></i>
                                                                                <input id="pwdinput" type="password" name="oldPassword" placeholder="Old Password" required>
                                                                                <i id="pwd" class="fas fa-eye right"></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col col-12">
                                                                            <label class="input">
                                                                                <i id="left" class="fas fa-key"></i>
                                                                                <input id="pwdinput" type="password" name="newPassword" placeholder="New Password" required>
                                                                                <p>Type Old Password if you don't want to change</p>
                                                                                <i id="pwd" class="fas fa-eye right"></i>
                                                                            </label>
                                                                        </div>
                                                                        <input type="hidden" name="action" value="updateProfile">
                                                                        <div class="col col-12">
                                                                            <input type="submit" value="Update">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
            <?php } ?>
            <!-- ---------------------- User Profile ------------------------ -->

        </div>

    </section>

    <!--------------------------------- #Main section -------------------------------->



    <!-- Optional JavaScript -->
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) { // Start from index 1 to skip header row
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    var cell = td[j];
                    if (cell) {
                        txtValue = cell.textContent || cell.innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break; // Show the row if any cell matches
                        } else {
                            tr[i].style.display = "none"; // Hide the row if no cell matches
                        }
                    }
                }
            }
        }
    </script>

    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="./assets/js/app.js"></script>
</body>

</html>