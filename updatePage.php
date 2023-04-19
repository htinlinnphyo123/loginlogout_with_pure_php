<?php
    
    session_start();
    if(!isset($_SESSION["id"])) {
        header("location: ./loginPage.php");
    }

    $sessionId = $_SESSION["id"];

    require "db.php";
    $database = new MyDatabase('loginlogout','localhost','root','12345');
    $statement = $database->query("SELECT * FROM users WHERE id=$sessionId");
    if($statement->execute()){
        $user = $statement->fetch(PDO::FETCH_OBJ);
    }


    $title = 'Update Account';

    ob_start();
?>
<h5 class="text-center fw-bold">Update your account </h5>
<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $user->id ?>">
    <div class="form-group mb-3">
        <label for="userName">Name</label>
        <input type="text" name="userName" id="userName" class="form-control" value="<?php echo $user->name ?>">
        <?php if(isset($_GET['userName']) && $_GET['userName']==='') : ?>
            <p class="text-danger">Username should not be empty.</p>
        <?php endif; ?>
    </div>
    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" value="<?php echo $user->email ?>">
        <?php if(isset($_GET['email']) && $_GET['email']==='') : ?>
            <p class="text-danger">Email should not be empty.</p>
        <?php elseif(isset($_GET['err_message'])): ?>
            <p class="text-danger">Email already exists</p>
        <?php endif; ?>
    </div>
    <div class="form-group mb-3">
        <label for="gender">Gender</label>
        <select name="gender" id="gender" class="form-select">
            <option value="male" <?php if($user->gender==='male')  echo 'selected'  ?> >Male</option>
            <option value="female" <?php if($user->gender==='female')  echo 'selected'  ?>>Female</option>
        </select>
        <?php if(isset($_GET['gender']) && $_GET['gender']==='') : ?>
            <p class="text-danger">Please select your gender.</p>
        <?php endif; ?>
    </div>
    <div class="form-group mb-3">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" class="form-control" value="<?php echo $user->dob ?>">
        <?php if(isset($_GET['dob']) && $_GET['dob']==='') : ?>
            <p class="text-danger">Please choose your birthday.</p>
        <?php endif; ?>
    </div>
    <div class="d-grid">
        <button class="btn btn-primary">Update your account</button>
    </div>
</form>
<?php

    $content = ob_get_clean();
    include "./welcome.php";


?>