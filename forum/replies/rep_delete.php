<?php
require '../includes/header.php';
require '../config/config.php';

if (isset($_GET['id'])) {

	$id = $_GET['id'];

    $select = $pdo->prepare("SELECT * FROM replies WHERE id = :id");
    $select->execute([':id' => $id]);
    $reply = $select->fetch();

    if($reply->user_id !== $_SESSION['user_id']){
        header('location: ../index.php');
    }else{
        $query = "DELETE FROM replies WHERE id = :id";

        $result = $pdo->prepare($query);
        $result->execute([":id"=>$id]);
    
        header("location: ../index.php");
    }

    
}
