<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit student information</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container  bg-primary"  style="border-radius: 12px; color: wheat">
    <h1 class="text-center">Edit student information</h1>
    <form action="" method="post">
        <?php foreach ($studentList as $value): ?>
            <?php if ($dataForm['cardID'] == $value['cardID']) { ?>
                <div class="row">
                    <label class="font-weight-bold col-form-label col-3">Card ID: </label>
                    <input type="text" class="my-1 col-8 form-control" name="cardID"
                           value="<?php echo $value['cardID']; ?>" placeholder="Card ID *" READONLY maxlength="8">
                </div>
                <div class="row">
                    <label class="font-weight-bold col-form-label col-3">Student Name: </label>
                    <input type="text" class="my-1 col-8 form-control" name="studentName"
                           value="<?php echo $value['name']; ?>" placeholder="Student Name *" required>
                </div>
                <div class="row">
                    <label class="font-weight-bold col-form-label col-3">Address: </label>
                    <input type="text" class="my-1 col-8 form-control" name="address"
                           value="<?php echo $value['address']; ?>" placeholder="e.g: 194B-Pasteur-Da Nang" required>
                </div>
                <div class="row">
                    <label class="font-weight-bold col-form-label col-3">Phone Number: </label>
                    <input type="tel" pattern="[0-9]{11}||[0-9]{10}" class="my-1 col-8 form-control" name="phoneNumber"
                           value="<?php echo $value['tel']; ?>" placeholder="e.g 0905xxxxxx" required maxlength="10" minlength="10">
                </div>
                <div class="row">
                    <div style="width: 60%;">
                        <button type="submit" class="float-right col-4 btn-primary rounded" style="color: wheat;"
                                name="action" value="submit_update_student"><b>Submit</b>
                        </button>
                    </div>
                    <div style="width: 40%;">
                        <button type="button" class="float-right col-2 btn-primary rounded" style="color: wheat;"
                                onclick="window.location.href='index.php?action=card_list';"><b>Back</b>
                        </button>
                    </div>
                </div>
            <?php } endforeach; ?>
    </form>
</div>
</body>
</html>