<?php
    session_start();
    if($_SESSION["id"]) :
?>
<?php
    include "db.php";
    $database = new MyDatabase('loginlogout','localhost','root','12345');
    $id = $_SESSION["id"];
    $statement = $database->query("SELECT * FROM users WHERE id=$id");
    var_dump($statement);
    if($statement->execute()){
        $user = $statement->fetch(PDO::FETCH_OBJ);
    }
    if($user->role==='admin') {
        header("location: ./adminDashboard.php");
    }else{
        header("location:./userDetail.php?id=$id");
    }

?>
<?php else : ?>
<?php header("location: ./loginPage.php") ?>

<?php endif ?>
