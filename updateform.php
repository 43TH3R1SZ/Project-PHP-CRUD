<?php 
require_once "./db/connect.php";
require_once "./db/controller.php";
if(isset($_POST["submit"])){
    $emp_id = $_POST["emp_id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $salary = $_POST["salary"];
    $department_id = $_POST["department_id"];

    $result = $controller -> update($fname,$lname,$salary,$department_id,$emp_id);
    if($result) {
        header("Location:index.php");
    }

    echo "แก้ไขข้อมูลล่าสุด";
    echo $emp_id . "<br>";
    echo $fname . "<br>";
    echo $lname . "<br>";
    echo $salary . "<br>";
    echo $department_id . "<br>";
}
?>