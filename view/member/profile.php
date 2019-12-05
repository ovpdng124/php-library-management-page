<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Information user</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body >
<div class="container bg-primary" style="border-radius: 12px; color: wheat">
    <h2 class="my-3 text-center">Your profile</h2>
    <form action="" method="post">
        <?php foreach ($profileList as $item):?>
        <div class="row">
            <label class="font-weight-bold col-form-label col-3">User ID: </label>
            <input type="text" class="my-1 col-8 form-control" name="userID"
                   value="<?php echo $item['userID']?>" placeholder="" readonly >
        </div>
        <div class="row">
            <label class="font-weight-bold col-form-label col-3">User Name: </label>
            <input type="text" class="my-1 col-8 form-control" name="userName"
                   value="<?php echo $item['userName']?>" placeholder="Student Name *" readonly>
        </div>
        <div class="row">
            <label class="font-weight-bold col-form-label col-3">Password: </label>
            <input type="password" class="my-1 col-8 form-control" name="password"
                   value="<?php echo $item['password']?>"  placeholder="e.g: 194B-Pasteur-Da Nang *"  <?php echo ($editProfile == 1)? 'minlength="8"': 'readonly'?>>
        </div>
        <div class="row">
            <label class="font-weight-bold col-form-label col-3">Librarian Name: </label>
            <input type="text" class="my-1 col-8 form-control" name="librarianName"
                   value="<?php echo $item['librarianName']?>" placeholder=""  <?php echo ($editProfile == 1)? '': 'readonly'?>>
        </div>
        <div class="row">
            <div style="width: 60%;">
                <button type="submit" class="float-right col-2 btn-primary rounded" style="color: wheat;" name="action" value="<?php echo ($editProfile == 1)? 'update_profile': 'edit_profile'?>"><b> <?php echo ($editProfile == 1)? 'Update': 'Edit'?></b>
                </button>
            </div>
            <div  style="width: 40%;">
                <button type="button" class=" ml-2 col-2 btn-primary rounded" style="color: wheat;"
                        onclick="window.location.href='index.php';"><b>Back</b>
                </button>
            </div>
        </div>
        <?php endforeach;?>
    </form>
</div>
</body>
</html>