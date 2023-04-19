<?php

    include "db.php";
    $database = new MyDatabase('loginlogout','localhost','root','12345');

    $userName = $_POST["userName"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $id = $_POST["id"];

    function checkEmpty($name){
        if($name===''){
            return true;
        }
        return false;
    }

    // check validate and redirect
    if(checkEmpty($userName) || checkEmpty($email) || checkEmpty($dob) || checkEmpty($gender)){
        header("location: ./updatePage.php?userName=$userName&email=$email&dob=$dob&gender=$gender");
    }else{

        try{
            $statement = $database->query(
                "
                    UPDATE users 
                    SET name = :userName,
                        email = :email,
                        dob = :dob,
                        gender = :gender 
                    WHERE id = $id
                "
            );

            $statement->bindParam(':userName',$userName);
            $statement->bindParam(':email',$email);
            $statement->bindParam(':dob',$dob);
            $statement->bindParam(':gender',$gender);

            if($statement->execute()) {
                header("location: ./userDetail.php?iod=$id");
            }

        }catch(PDOException $err){
            if($err->getCode() == 23000) {
                $errMessage = 'email already exists';
                header("location:updatePage.php?err_message=$errMessage&userName=$userName&email=$email&dob=$dob&gender=$gender");
            }
        }

    }



?>