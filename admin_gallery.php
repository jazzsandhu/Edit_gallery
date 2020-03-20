<?php
session_start();
if($_SESSION['username']){
    require_once 'Class/Connection.php';
    require_once  'Class/Query.php';
    $dbcon = Connection::getDb();
    $gallery_users = new Query($dbcon);
    $users= $gallery_users->admin_gallery();
    $list = $gallery_users->public_gallery();
    foreach($users as $user){
        if($user->user_name == $_SESSION['username']){
            $user_name = $user->user_name;
            $bio = $user->bio;
        }
    }
    if(isset($_POST['Delete'])){
        $id = $_POST['id'];
       // print "<script> window.confirm('Are you sure you want to delete this?')".
        if(confirm == true){
            var_dump($id);
            $gallery_users->delete_pic($id);
            header('Location:admin_gallery.php');
        }
        "</script>";


    }
}
else{
    header('Location:login_gallery.php');
}
if(isset($_POST['logout'])){
    session_destroy();
    header('Location:login_gallery.php');
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Admin Gallery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="script/view_image.js" type="text/javascript" ></script>
    <style>
        .popup{
            transform: scale(1.2);
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="index.html" class="navbar-brand d-flex align-items-center">
                <strong>Mad Event</strong>
            </a>
            <a href="public_gallery.php" class="navbar-brand d-flex align-items-center">Gallery</a>
            <a href="add_pic.php" class="navbar-brand d-flex align-items-center">Add More</a>
            <a href="admin_gallery.php" class="navbar-brand d-flex align-items-center">
                My Profile
            </a>
            <form method="post" action="" >
                <input type="submit" name="logout"  value="Logout" />
            </form>
        </div>
    </div>
</header>

<main role="main">

    <section class="jumbotron text-center" style="background-color:lightcoral">
        <div class="container">
            <h1 class="jumbotron-heading"><?= $user_name; ?> </h1>
            <p class="lead text-muted"><?= $bio; ?></p>
        </div>
    </section>


    <div class="album py-5 bg-light">
        <div class="container" id="container">
            <div class="row" id="div_flex">
                <?php foreach($list as $l){
                    if($l->user_name == $_SESSION['username']){
                    ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="data:image/jpeg;base64,<?= base64_encode($l->image); ?>" alt="Card image cap" name="image">
                        <div class="card-body">
                            <p class="card-text"><?= $l->posts." <span style='color:blue'>".$l->tag_name ."</span>"?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?= $l->id; ?>"/>
                                        <input type="submit" name="Delete" value="Delete" class="btn btn-sm-outline-secondary" />
                                    </form>
                                    <form action="edit_pic.php" method="post">
                                        <input type="hidden" name="id" value="<?= $l->id; ?>"/>
                                        <input type="submit" name="Edit" value="Edit" class="btn btn-sm-outline-secondary" />
                                    </form>
                                </div>
                                <small class="text-muted"><?= $l->post_date; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }};?>
            </div>
        </div>
    </div>

</main>


</body>
</html>


