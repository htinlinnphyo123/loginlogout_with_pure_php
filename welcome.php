<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

    <div class="container w-75 p-3 rounded-sm mt-5 mx-auto shadow">
        <?php
            echo $content;
        ?>
    </div>



</body>
</html>