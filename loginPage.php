<?php

    session_start();
    if(isset($_SESSION['id'])) {
        $id = $_SESSION["id"];
        header("location: ./userDetail.php?id=$id");
    }

    $title = "Login Page";
    ob_start();
?>
    <h5 class="text-center fw-bold">Login to your account </h5>
    <?php if(isset($_GET['error']) && $_GET['error']=='username and password do not match') : ?>
            <div class="alert alert-danger text-center" role="alert">
                UserName and Password do not match.
            </div>
        <?php endif; ?>
    <form action="login.php" method="POST">
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email">
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="text" name="password" id="password" class="form-control" placeholder="Enter Your Password">
        </div>
        <div class="d-grid mb-2">
            <button class="btn btn-primary">Login</button>
        </div>
        <p class="text-center">Don't have an account. <a href="registerPage.php">Register Here.</a> </p>
    </form>
<?php
    $content = ob_get_clean();
    include "./welcome.php";

?>

