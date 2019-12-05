<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit category information</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <form action="" method="post" role="form" enctype="multipart/form-data">
        <?php foreach ($categoryList as $value): ?>
            <?php if ($dataForm['categoryID'] == $value['categoryID']) { ?>
                <h1 class="text-center">Edit category</h1>
                <label for="">Category ID</label>
                <input type="text" class="form-control my-1" name="categoryID" value="<?php echo $value['categoryID']; ?>"
                       placeholder="" readonly>
                <label for="">Category Name</label>
                <input type="text" class="form-control my-1" name="categoryName" value="<?php echo $value['categoryname']; ?>"
                       placeholder="Category Name*" required>
                <label for="">More Info</label>
                <input type="text" class="form-control my-1" name="moreInfo" value="<?php echo $value['moreinfo']; ?>"
                       placeholder="More Info">
                <button type="submit" class="btn btn-primary my-1" name="action" value="submit_update_category">Submit</button>
                <button type="button" onclick="window.location.href='index.php?action=categories_management';"
                        class="btn btn-primary" >Back
                </button>
            <?php } endforeach; ?>
    </form>
</div>
</body>
</html>