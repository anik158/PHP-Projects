<?php
require '../includes/header.php';
require '../config/config.php';

if (isset($_GET['id'])) {

	$id = $_GET['id'];

    $select = $pdo->prepare("SELECT * FROM topics WHERE id = :id");
    $select->execute([':id' => $id]);
    $topic = $select->fetch();

    if($topic->username !== $_SESSION['email']){
        header('location: /index.php');
    }else{
        $query = "DELETE FROM topics WHERE id = :id";

        $result = $pdo->prepare($query);
        $result->execute([":id"=>$id]);
    
        header("location: ../index.php");
    }

    
}
