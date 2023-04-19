<?php
    
    session_start();
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];

    try{
        require "db.php";
        $database = new MyDatabase('loginlogout','localhost','root','12345');
    
        $statement = $database->query("SELECT * FROM users WHERE email='$inputEmail'");
        if($statement->execute()){
            $user = $statement->fetch(PDO::FETCH_OBJ);
        }

        if(password_verify($inputPassword,$user->password)){
            // var_dump($user);
            $getId = $user->id;
            $_SESSION["id"] = $getId;
            if($user->role==='admin') {
                header("location: ./adminDashboard.php");
            }else{
                header("location: ./userDetail.php?id=$getId");
            }
        }else{
            header("location: ./loginPage.php?error=username and password do not match");
        }

    }catch(PDOException $err){
        var_dump($err->getMessage());
    }


?>