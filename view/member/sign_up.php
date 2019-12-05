<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <form action="" method="post" role="form" enctype="multipart/form-data" accept-charset="utf-8">
        <label for="">User Name: </label>
        <input type="text" name="userName" class="form-control" placeholder="Enter Username *" required>
        <label for="">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password requires at least 8 characters *" required minlength="8">
        <label for="">Librarian Name: </label>
        <input type="text" name="librarianName" class="form-control" placeholder="Enter Your Name *" required>
        <button type="submit" class="btn btn-success my-2" name="action" value="create_user">Register</button>
        <button type="button" onclick="window.location.href='index.php';"
                class="btn btn-primary my-2" >Back
        </button>
    </form>
</div>
</body>
</html>