<?php

    session_start();
    if(!isset($_SESSION["id"])) {
        header("location: ./loginPage.php");
    }

    include "db.php";
    $database = new MyDatabase('loginlogout','localhost','root','12345');
    $id = $_SESSION["id"];
    $statement = $database->query("SELECT * FROM users WHERE id=$id");
    if($statement->execute()){
        $user = $statement->fetch(PDO::FETCH_OBJ);
    }

    if($user->role!=='admin') :
?>
<?php

    $title =  'access denied';
    ob_start();
?>
<h1 class="text-danger">You have no access to enter this page.</h1>
<?php

    $content = ob_get_clean();
    include "welcome.php"
?>

<?php elseif($user->role==='admin') : ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>

        <?php
            $usersStatement = $database->query("SELECT * FROM users");
            if($usersStatement->execute()){
                $users = $usersStatement->fetchAll(PDO::FETCH_OBJ);
            }
        ?>
        <div class="container w-75 mx-auto mt-4">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user) : ?>
                    <tr>
                        <td><?php echo $user->id ?></td>
                        <td><?php echo $user->name ?></td>
                        <td><?php echo $user->email ?></td>
                        <td><?php echo $user->gender ?></td>
                        <td><?php echo $user->dob ?></td>
                        <td>
                            <?php echo $user->role ?>
                            <?php if($user->role==='user') :?>
                                <a href="">(Promote to admin.)</a>        
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ; ?>
                </tbody>
            </table>
            <a href="./logout.php" class="btn btn-danger">Logout</a>
        </div>



    </body>
    </html>

<?php endif; ?>