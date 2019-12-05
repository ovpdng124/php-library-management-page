<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library books list</title>
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
                <li class="nav-item"><a class="nav-link" href="index.php?action=book_form">Add book</a></li>
                <a style="text-decoration: none" href="">\</a>
                <li class="nav-item"><a class="nav-link" href="index.php?action=categories_management">Categories List</a></li>
                <a style="text-decoration: none" href="">\</a>
                <li class="nav-item"><a class="nav-link" href="index.php?action=borrow_list">Borrows List</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container-fluid ">
    <form action="" method="post" accept-charset="utf-8">
        <!--        <div class="row border-danger border">-->
        <input type="text" class="col-2 form-control mx-1 mt-2 float-left" name="search" value="<?php echo !empty($dataForm['valueSearch']) ? $dataForm['valueSearch'] : ''; ?>" placeholder="Search">
        <button type="submit" class="btn btn-primary mx-1 mt-2" name="action" value="search_book">Search</button>
        <div class="row container-fluid">
            <select name="check_categoryID" class="form-control col-2 mx-1">
                <option value="">Choose categories</option>
                <?php foreach ($categoryList as $key => $value): ?>
                    <option value="<?php echo $value['categoryID'] ?>"><?php echo $value['categoryname'] ?></option>
                <?php endforeach; ?>
            </select>
            <label for="name" class="label mt-2 mx-2 " style="font-size: 20px;">
                <input id="name" style="width: 20px; height: 20px;" type="checkbox" name="check_name" value="1"
                       class=""> Name
            </label>
            <label for="author" class="label mt-2 mx-2 " style="font-size: 20px;">
                <input id="author" style="width: 20px; height: 20px;" type="checkbox" name="check_author" value="1"
                       class=""> Author
            </label>
            <label for="publisher" class="label mt-2 mx-2 " style="font-size: 20px;">
                <input id="publisher" style="width: 20px; height: 20px;" type="checkbox" name="check_publisher"
                       value="1" class=""> Publisher
            </label>
        </div>
    </form>
</div>

<div class="container-fluid">
    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>BookID</th>
            <th>Name</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>CategoryID</th>
            <th>Numofpage</th>
            <th>Maxdate</th>
            <th>Num</th>
            <th>Summary</th>
            <th>Picture</th>
            <th colspan="2" class="text-center">ACTION</th>
        </tr>

        <?php $count = 1;
        foreach ($bookList as $value):?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $value['bookID']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['author']; ?></td>
                <td><?php echo $value['publisher']; ?></td>
                <td><?php echo $value['categoryID']; ?></td>
                <td><?php echo $value['numofpage']; ?></td>
                <td><?php echo $value['maxdate']; ?></td>
                <td><?php echo $value['num']; ?></td>
                <td><?php echo $value['summary']; ?></td>
                <td><img src="public/images/<?php echo $value['picture']; ?>" height="120" width="80" alt=""></td>
                <form action="" method="post">
                    <td>
                        <input type="hidden" name="bookID" value="<?php echo $value['bookID']; ?>">
                        <button type="submit" class="btn btn-primary" name="action" value="edit_form">Edit</button>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary" name="action" value="delete">Delete</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div class="container-fluid">
    <form action="" method="post">
        <?php echo !empty($dataForm['valueSearch']) ? "<button class=\"btn btn-primary mb-2\" name=\"action\" value=\"list_book\">Back</button>" : "<button class=\"btn btn-primary mb-2\" name=\"action\" value=\"index\">Back</button>"; ?>
    </form>
</div>
</body>
</html>