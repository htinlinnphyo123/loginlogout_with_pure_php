<?php
    
    session_start();
    if(isset($_SESSION['id'])) {
        $id = $_SESSION["id"];
        header("location: ./userDetail.php?id=$id");
    }

    $title = 'Register Page';

    ob_start();
?>
<h5 class="text-center fw-bold">Register your account </h5>
<form action="register.php" method="POST">
    <div class="form-group mb-3">
        <label for="userName">Name</label>
        <input type="text" name="userName" id="userName" class="form-control" placeholder="Enter Your User Name" value="<?php if(isset($_GET['userName'])) echo $_GET['userName'] ?>">
        <?php if(isset($_GET['userName']) && $_GET['userName']==='') : ?>
            <p class="text-danger">Username should not be empty.</p>
        <?php endif; ?>
    </div>
    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email" value="<?php if(isset($_GET['email'])) echo $_GET['email'] ?>">
        <?php if(isset($_GET['email']) && $_GET['email']==='') : ?>
            <p class="text-danger">Email should not be empty.</p>
        <?php elseif(isset($_GET['err_message'])): ?>
            <p class="text-danger">Email already exists</p>
        <?php endif; ?>
    </div>
    <div class="form-group mb-3">
        <label for="gender">Gender</label>
        <select name="gender" id="gender" class="form-select">
            <option value="" selected>Choose your gender</option>
            <option value="male" <?php if(isset($_GET['gender']) && $_GET['gender']==='male') echo "selected" ?> >Male</option>
            <option value="female" <?php if(isset($_GET['gender']) && $_GET['gender']==='female') echo "selected" ?>>Female</option>
        </select>
        <?php if(isset($_GET['gender']) && $_GET['gender']==='') : ?>
            <p class="text-danger">Please select your gender.</p>
        <?php endif; ?>
    </div>
    <div class="form-group mb-3">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" class="form-control" value="<?php if(isset($_GET['dob'])) echo $_GET['dob'] ?>">
        <?php if(isset($_GET['dob']) && $_GET['dob']==='') : ?>
            <p class="text-danger">Please choose your birthday.</p>
        <?php endif; ?>
    </div>
    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
        <?php if(isset($_GET['password']) && $_GET['password']==='') : ?>
            <p class="text-danger">Password should not be empty.</p>
        <?php endif; ?>
    </div>
    <div class="form-group mb-3">
        <label for="cfmpassword">Confirm Password</label>
        <input type="password" name="cfmpassword" id="cfmpassword" class="form-control" placeholder="Enter Your Password Again">
        <?php if(isset($_GET['cfmpassword'])) : ?>
            <p class="text-danger">Password do not match.</p>
        <?php endif; ?>
    </div>
    <div class="d-grid">
        <button class="btn btn-primary">Register your account</button>
    </div>
    <p class="text-center">Already have an account . <a href="loginPage.php">Login Here.</a> </p>
</form>
<?php

    $content = ob_get_clean();
    include "./welcome.php";


?>