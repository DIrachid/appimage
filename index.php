<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD</title>
</head>
<body>
    <?php 
    require_once 'data.php';
    if(isset($_POST['ajouter'])){
        if(!empty($_FILES['image']) && isset($_POST['name']) && isset($_POST['description']) && $_POST['description'] != ""){
            $image = $_FILES['image']['name'];
            $description = $_POST['description'];
            $name = $_POST['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $time = time();
            $nouveau = $time . $image;
            $deplacer = move_uploaded_file($tmp,"image/".$nouveau);
            if($deplacer){
                $sql = $con->prepare('insert into image values(null,:name,:image,:description)');
                $sql->bindParam(":name",$name);
                $sql->bindParam(":image",$nouveau);
                $sql->bindParam(":description",$description);
                $sql->execute();
                if($sql){
                    header('location: list.php');
                }else{
                    echo "Echec de l'ajout de l'image";
                }
            }else{
                $message = "Veuillez choisir une image avec avec taille inferieur a 1 Mo";
            }
        }else{
            $message = 'Veuillez remplir le formulaire';
        }
    }
    ?>
    <a href="list.php" class="link">List des Photo</a>
    <p class="error"><?php if(isset($message)){echo $message;} ?></p>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Ajouter une photo </label>
        <input type="file" name="image">
        <label for="">Name</label>
        <input type="text" name='name'>
        <label for="">Description</label>
        <textarea name="description" cols="30" rows="10"></textarea>
        <input type="submit" value="Ajouter" name="ajouter">
    </form>
</body>
</html>