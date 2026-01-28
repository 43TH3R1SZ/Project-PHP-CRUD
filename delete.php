<?php
require_once "./db/connect.php";
require_once "./db/controller.php";
if(!assert($_GET["id"])){
    header("Location:index.php");
}else{
    $id = $_GET["id"];
    $result = $controller -> delete($id);
    echo "ลบรหัสพนักงาน =".$id;
}
?>