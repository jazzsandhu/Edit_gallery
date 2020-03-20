<?php
Class Query{
    private $dbcon;

    public function __construct($dbcon){
        $this->dbcon = $dbcon;
    }

    public function public_gallery(){
        $sql ="select * from gallery_listing";

        $pdostm =$this->dbcon->prepare($sql);
        $pdostm->execute();
        $gallery_listing =$pdostm->fetchAll(PDO::FETCH_OBJ);
        return $gallery_listing;
    }
    public function admin_gallery(){
        $sql = "select * from gallery_users";
        $pdostm = $this->dbcon->prepare($sql);
        $pdostm->execute();
        $gallery_users = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $gallery_users;
    }
    public function delete_pic($id){
        $sql ="delete from gallery_listing where id=:id";
        $pdostm = $this->dbcon->prepare($sql);
        $pdostm->bindParam(':id',$id);
        $count = $pdostm->execute();
        return $count;
    }
    public function add_pic($username, $posts, $tag_name, $image, $post_date){
        $sql = "insert into gallery_listing (user_name, posts, tag_name, image, post_date ) values(:username, :posts,:tag_name, :image, :post_date)";
        $pdostm =$this->dbcon->prepare($sql);
        $pdostm->bindParam(':username',$username);
        $pdostm->bindParam(':posts',$posts);
        $pdostm->bindParam(':tag_name',$tag_name);
        $pdostm->bindParam(':image',$image);
        $pdostm->bindParam(':post_date',$post_date);
        $count = $pdostm->execute();
        return $count;
    }
    public function edit_pic($id){
        $sql = "select * from gallery_listing where id =:id";
        $pdostm = $this->dbcon->prepare($sql);
        $pdostm->bindParam(':id',$id);
        $pdostm->execute();
        $values = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $values;
    }
}