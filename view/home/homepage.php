<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<header>
    <div class="container-fluid">
    <nav>
        <ul class="navbar nav navbar-expand-sm float-right">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <a style="text-decoration: none" href="">\</a>
            <li class="nav-item"><a class="nav-link" href="index.php?action=<?php echo ($loginSuccess)? 'list_book' : 'sign_in' ?>">Library books</a></li>
            <a style="text-decoration: none" href="">\</a>
            <li class="nav-item"><a class="nav-link" href="index.php?action=<?php echo ($loginSuccess)? 'borrow_list' : 'sign_in' ?>">Borrows List</a></li>
            <?php echo ($loginSuccess)? "<a style=\"text-decoration: none\" href=\"\">\</a><li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?action=your_profile\">Profile</a></li>" : '';?>
            <a style="text-decoration: none" href="">\</a>
            <li class="nav-item"><a class="nav-link" href="index.php?action=<?php echo ($loginSuccess)? 'sign_out' : 'sign_in' ?>"><?php echo ($loginSuccess)? 'Sign out' : 'Sign in' ?></a></li>
            <?php echo ($loginSuccess)? '' : "<a style=\"text-decoration: none\" href=\"\">\</a>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php?action=sign_up\">Sign up</a></li>" ?>



        </ul>
    </nav>
    </div>
    <div class="container-fluid">
        <img src="public/logo/logo.jpg" alt="" width="80" height="70" class="float-left">
        <h1 class="mx-3 mt-2">Homepage</h1>
    </div>
    <hr class="mt-4">
</header>
<main class="container">
    <div class="container-fluid">
    <h1 class="text-center">Library book management system</h1>
        <?php echo ($loginSuccess)? "<h4>Hello ".$dataForm['librarianName']."!</h4>" : "<h4>Hello librarian!</h4>" ?>
    </div>
</main>

</body>
</html>