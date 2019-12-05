<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body style="width: 30%; height: 100%; margin: 15% auto;">
<div class="container bg-primary" style="border-radius: 12px; color: wheat">
    <h2 class="my-3 text-center">Login</h2>
    <form action="" method="post">
        <div class="row">
            <label class="font-weight-bold col-form-label col-3">Username: </label>
            <input type="text" class="my-1 col-8 form-control" name="userName"
                   value="" placeholder="">
        </div>
        <div class="row">
            <label class="font-weight-bold col-form-label col-3">Password: </label>
            <input type="password" class="my-1 col-8 form-control" name="password"
                   value="" placeholder="">
        </div>
        <div class="row">
            <div style="width: 60%;">
                <button type="submit" class="float-right col-4 btn btn-primary rounded" style="color: wheat;" name="action" value="login"><b>Login</b>
                </button>
            </div>
            <div style="width: 40%;">
                <a class="float-right mx-2 mt-3" style="color: wheat" href="index.php">Back</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>