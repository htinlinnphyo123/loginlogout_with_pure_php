<?php

    require "db.php";
    session_start();

    $database = new MyDatabase('loginlogout','localhost','root','12345');

    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $cfmpassword = $_POST['cfmpassword'];

    function emptyCheck($name) {
        if($name=='') {
            return true;
        }
        return false;
    }

    if(emptyCheck($userName) || emptyCheck($email) || emptyCheck($dob) || emptyCheck($gender) || emptyCheck($password)) {
        header("location:./registerPage.php?userName=$userName&email=$email&dob=$dob&gender=$gender&password=$password");
    }elseif($password !== $cfmpassword){
        header("location:./registerPage.php?cfmpassword=password do not match&userName=$userName&email=$email&dob=$dob&gender=$gender&password=$password");
    }else{
        try{
            $insertStatement = $database->query(
            "
                INSERT INTO users(name,email,gender,dob,password)
                VALUES(:name, :email, :gender, :dob, :password)    
            ");
        
            $hashed_password = password_hash($_POST["password"],PASSWORD_DEFAULT);
            $insertStatement->bindParam(":name",$_POST["userName"]);
            $insertStatement->bindParam(":email",$_POST["email"]);
            $insertStatement->bindParam(":gender",$_POST["gender"]);
            $insertStatement->bindParam(":dob",$_POST["dob"]);
            $insertStatement->bindParam(":password",$hashed_password);
        
            if($insertStatement->execute()){
                $getId = $database->getId();
                $_SESSION["id"] = $getId;
                header("location: userDetail.php?id=$getId");
            }
        }catch(PDOException $err) {
            if($err->getCode() == 23000) {
                $errMessage = 'email already exists';
                header("location:registerPage.php?err_message=$errMessage&userName=$userName&email=$email&dob=$dob&gender=$gender&password=$password");
            }
    
        }
    }



?>