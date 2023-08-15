<?php
session_start();
include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection) {
    echo mysqli_error($connection);
    throw new Exception("Database cannot Connect");
} else {
    $action = $_REQUEST['action'] ?? '';

    if(isset($_POST['edit_drug'])){
        $id = $_POST['id'];
        $d_name = $_REQUEST['d_name'];
        $drug_desc = $_POST['d_desc'];
        $mnf_date = $_POST['mnf_date'];
        $exp_date = $_POST['exp_date'];

        $status = $_POST['status'];

        echo $id. "<br>";
        echo $d_name. "<br>";
        echo $drug_desc. "<br>";
        echo $mnf_date. "<br>";
        echo $exp_date. "<br>";

        echo $status. "<br>";

        $query = "UPDATE drugs SET drug_name='$d_name', drug_description='$drug_desc', manufacturing_date='$mnf_date' expiry_date='$exp_date' status='$status' WHERE id='$id'";
        $res = mysqli_query($connection, $query);

        if($res){
            echo "sucess";
        }

    }

}