<?php 

require_once 'app/init.php'; 

if(isset($_POST['name'])) {
    $name = trim($_POST['name']);

    if(!empty($name)) {
        $addedQuary = $db->prepare("INSERT INTO items (name, user, done, created) VALUE (:name, :user, 0, NOW()) ");

        $addedQuary->execute(['name' => $name, 'user' => $_SESSION['user_id']]);
    }
}

header('Location: index.php');