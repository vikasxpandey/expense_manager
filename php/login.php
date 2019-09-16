<?php 
session_start();
require('../config/dbconfig.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }  

$uid = $password = "";
$uiderr = $passworderr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $uid = test_input($_POST['uid']);
    $password = test_input($_POST['password']);

    if(!empty($uid) && !empty($password)){
        $stmt = $conn->prepare("SELECT * FROM members WHERE uid = :uid");
        $stmt->bindParam(':uid', $uid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {
            $_SESSION['seuid'] = $result['uid'];
            $_SESSION['sename'] = $result['name'];
            header('location:./userdash.php');
        } else {
            echo 'not found';
        }
        
    } else {
        echo 'error';
    }
}


?>