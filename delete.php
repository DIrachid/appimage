<?php
require_once 'data.php';
$id = $_GET['id'];
$sql = $con->prepare('delete from image where id= :id');
$sql->bindParam(':id',$id);
$sql->execute();
var_dump($sql);
header('location:list.php');