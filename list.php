<?php
require_once 'data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Liste Photo</title>
</head>
<body>
    <section>
        <a href="index.php" class="link">Ajouter une Photo</a>
        <?php
        $sql = $con->prepare('select * from image');
        $sql->execute();
        $image = $sql->fetchAll();
        foreach($image as $img){
        ?>
        <div class="box">
            <img class="img-prin" src="image/<?php echo $img['image'] ?>" alt="">
            <div class=""><?php echo $img['name'] ?></div>
            <a href="delete.php?id=<?php echo $img['id'] ?>" class="delete">
                <img src="image/R.png" alt="">
            </a>
        </div>
        <?php }
        $row = $sql->rowCount();
        if($row < 1){
            ?>
            <p class="vide">La liste des photos est vide</p>
            <?php
        }
        ?>
    </section>
</body>
</html>