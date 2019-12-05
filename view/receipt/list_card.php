<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cards list</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<style>
    #owed {
        width: 75px;
        height: 40px;
    }

    #owed:after {
        content: 'Owed';
        font-weight: bold;
        color: red;
    }

    #owed:hover:after {
        content: 'Return';
        color: green;

    }
</style>
<body class="container-fluid">
<div>
    <form action="" method="post" accept-charset="utf-8" class="">
        <input type="text" class="float-left col-2 mt-1 form-control" name="search"
               value="<?php echo !empty($dataForm['valueSearch']) ? $dataForm['valueSearch'] : null; ?>" placeholder="Search">
        <button type="submit" class="col-1 btn btn-primary mx-2 mt-1 float-left" name="action" value="search_student">Search</button>
        <select name="sort" id="" class=" form-control col-2 mt-1 float-left">
            <option value="cardID" <?php echo !empty($sort)&&$sort=='cardID'?'selected':''?>>Card ID</option>
            <option value="name" <?php echo !empty($sort)&&$sort=='name'?'selected':''?>>Student Name</option>
        </select>
        <button type="submit" class="btn btn-primary mx-2 mt-1 float-left" name="action" value="sort_student_list">Sort</button>
        <nav>
            <ul class="navbar nav navbar-expand-sm float-right">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <a style="text-decoration: none" href="">\</a>
                <li class="nav-item"><a class="nav-link" href="index.php?action=create_card_form">Add card</a></li>
                <a style="text-decoration: none" href="">\</a>
                <li class="nav-item"><a class="nav-link" href="index.php?action=list_book">Library books</a></li>
                <a style="text-decoration: none" href="">\</a>
                <li class="nav-item"><a class="nav-link" href="index.php?action=borrow_list">Borrow list</a></li>
            </ul>
        </nav>
    </form>

</div>
<div class="">
    <table class="table table-striped text-center">
        <tr>
            <th>#</th>
            <th>Card ID</th>
            <th>Student Name</th>
            <th>Address</th>
            <th>Tel</th>
            <th colspan="2">Action</th>
        </tr>

        <?php $count = 1;
        foreach ($studentList as $value):?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $value['cardID']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['address']; ?></td>
                <td><?php echo $value['tel']; ?></td>
                <form action="" method="post">
                    <td>
                        <input type="hidden" name="cardID" value="<?php echo $value['cardID']; ?>">
                        <button type="submit" class="btn btn-primary" name="action" value="edit_card_student">Edit</button>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary" name="action" value="delete_card_student">Delete</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div class="container-fluid">
    <button type="button" onclick="window.location.href='<?php echo empty($dataForm['valueSearch']) ? 'index.php?action=borrow_list' : 'index.php?action=card_list'; ?>'"
            class="btn btn-primary" >Back
    </button>
</div>
</body>
</html>