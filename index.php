<?php

require_once 'app/init.php';

$itemsQuery = $db->prepare("
    SELECT id, name, done
    FROM items
    WHERE user = :user
");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Your own To-do</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto:500" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
</head>
<body>
        <div class="list">
            <h1 class="header">To-do</h1>
            <?php if(!empty($items)): ?>
            <ul class="items">
                <?php foreach($items as $item): ?>
                <li>
                    <span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?> </span>
                    <?php if(!$item['done']): ?>    
                        <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Mark as done</a>
                    <?php endif; ?>
                    <a href="delete.php?del=<?php echo $item['id']; ?>" class="delete-button"><i class="fas fa-minus-circle">Delete</i></a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <p> You haven't added any items yet.</p>
            <?php endif; ?>
            <form class="item-add" action="add.php" method="post">
                <input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required>
                <input type="submit" value="Add" class="submit">
            </form>

        </div>
</body>
</html>