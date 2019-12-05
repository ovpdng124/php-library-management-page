<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a new category</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1 class="text-center">Add a new category</h1>
    <form action="" method="post" role="form" enctype="multipart/form-data" accept-charset="utf-8">
        <label for="">Category ID</label>
        <input type="text" name="categoryID" class="form-control" placeholder="Category ID *" required maxlength="3">
        <label for="">Category Name</label>

        <input type="text" name="categoryName" class="form-control" placeholder="Category Name *" required>
        <label for="">More Infomation</label>

        <input type="text" name="moreInfo" class="form-control" placeholder="More Infomation">
        <button type="submit" class="btn btn-primary my-2" name="action" value="create_category">Add</button>
        <button type="button" onclick="window.location.href='index.php?action=categories_management';"
                class="btn btn-primary" >Back
        </button>
    </form>
</div>
</body>
</html>