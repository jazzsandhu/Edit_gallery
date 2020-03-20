<?php
session_start();
if($_SESSION){
    require_once 'Class/Connection.php';
    require_once 'Class/Query.php';
    if(isset($_POST['Edit'])){
        $id = $_POST['id'];
        var_dump($id);
        $dbcon  = Connection::getDb();
        $gallery_listing = new Query($dbcon);
        $values = $gallery_listing->edit_pic($id);
        var_dump($values);
        $tag = $values->user_name;
    }
}
?>