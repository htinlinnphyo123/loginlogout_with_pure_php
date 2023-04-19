<?php

    session_start();
    if(!isset($_SESSION["id"])) {
        header("location: ./loginPage.php");
    }

    $userId = $_GET['id'];
    $sessionId = $_SESSION["id"];

    if(isset($_SESSION)) {
        if($sessionId != $userId) {
            header("location: index.php");
        }
    }


    include "db.php";
    $database = new MyDatabase('loginlogout','localhost','root','12345');

    $statement = $database->query("SELECT * FROM users WHERE id=$userId");

    if($statement->execute()){
        $getUser = $statement->fetch(PDO::FETCH_OBJ);
    }
    if($getUser->role==='admin'){
        header("location: ./adminDashboard.php");
    }
    $title = 'User Detail';
    ob_start();
?>
<p class="text-center"> Name - <?php echo $getUser->name ?></p>
<p class="text-center"> Email - <?php echo $getUser->email ?></p>
<p class="text-center"> Date Of Birth - <?php echo $getUser->dob ?></p>
<p class="text-center"> Gender - <?php echo $getUser->gender ?></p>
<p class="text-center"> Role - <?php echo $getUser->role ?></p>

<div class="text-center">
    <a href="./logout.php" class="btn btn-danger rounded-md mx-2">Log out</a>
    <a href="./updatePage.php?id=<?php echo $sessionId ?>" class="btn btn-info rounded-md mx-2">Update</a>
</div>

<?php
    $content = ob_get_clean();
    include "welcome.php";

?>