<?php

require_once 'app/init.php';

if(isset($_GET['del'])) {
    $del = $_GET['del'];

    if(!empty($del)) {
            $delQuery = $db->prepare("DELETE FROM `items` WHERE `items`.`id` = :del AND user = :user ");

            $delQuery->execute([
                'del' => $del,
                'user' => $_SESSION['user_id']
            ]);
    }
}

header('Location: index.php');