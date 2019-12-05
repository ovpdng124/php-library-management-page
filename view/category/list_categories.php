<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories List</title>
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
                <li class="nav-item"><a class="nav-link" href="index.php?action=category_form">Add category</a></li>
                <a style="text-decoration: none" href="">\</a>
                <li class="nav-item"><a class="nav-link" href="index.php?action=list_book">Library books</a></li>
                <a style="text-decoration: none" href="">\</a>

                <li class="nav-item"><a class="nav-link" href="index.php?action=borrow_list">Borrows List</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="container-fluid">
    <form action="" method="post" accept-charset="utf-8">
        <div class="row">
            <input type="text" class="col-3 form-control ml-3 mr-2 mt-2" name="search" value="<?php echo !empty($dataForm['valueSearch']) ? $dataForm['valueSearch'] : ''; ?>" placeholder="Search">
            <button type="submit" class="btn btn-primary mt-2" name="action" value="search_category">Search</button>
        </div>
    </form>
</div>
<div class="container-fluid">
    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>CategoryID</th>
            <th>Category Name</th>
            <th>More Info</th>
            <th colspan="2" class="text-center">ACTION</th>
        </tr>

        <?php $count = 1;
        foreach ($categoryList as $value):?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $value['categoryID']; ?></td>
                <td><?php echo $value['categoryname']; ?></td>
                <td><?php echo $value['moreinfo']; ?></td>
                <form action="" method="post">
                    <td>
                        <input type="hidden" name="categoryID" value="<?php echo $value['categoryID']; ?>">
                        <button type="submit" class="btn btn-primary" name="action" value="edit_category">Edit</button>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary" name="action" value="delete_category">Delete</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div class="container-fluid">
        <?php echo !empty($dataForm['valueSearch']) ? "" : "<button class=\"btn btn-primary\" onclick=\"window.location.href='index.php?action=list_book';\" type=\"button\">Back</button>"; ?>
        <?php echo !empty($dataForm['valueSearch']) ? "<button type=\"button\" onclick=\"window.location.href='index.php?action=categories_management';\"
                        class=\"btn btn-primary\" >Back
                </button>": ''; ?>
</div>
</body>
</html>