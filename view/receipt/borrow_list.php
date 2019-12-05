<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Borrows list</title>
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
    #returned {
        width: 75px;
        height: 40px;
    }

    #returned:after {
        content: 'Done';
        font-weight: bold;
        color: black;
    }

    #returned:hover:after {
        content: 'Delete';
        color: red;
    }
</style>
<body class="container-fluid">
<div class="">
    <form action="" method="post" accept-charset="utf-8">
        <input type="text" class="float-left col-3 form-control mt-2" name="search"
               value="<?php echo !empty($dataForm['valueSearch']) ? $dataForm['valueSearch'] : null; ?>" placeholder="Search">
        <button type="submit" class="col-1 btn btn-primary mx-2 mt-2 float-left" name="action" value="search_borrow">Search</button>
        <select name="sort" id="" class="float-left form-control mt-2 col-2">
            <option value="dateborrow" <?php echo !empty($sort)&&$sort=='dateborrow'?'selected':''?>>Date Borrow</option>
            <option value="datereturn" <?php echo !empty($sort)&&$sort=='datereturn'?'selected':''?>>Date Return</option>
            <option value="bookID" <?php echo !empty($sort)&&$sort=='bookID'?'selected':''?>>Book ID</option>
            <option value="b.name" <?php echo !empty($sort)&&$sort=='b.name'?'selected':''?>>Book Name</option>
            <option value="s.cardID" <?php echo !empty($sort)&&$sort=='s.cardID'?'selected':''?>>Card ID</option>
            <option value="s.name" <?php echo !empty($sort)&&$sort=='s.name'?'selected':''?>>Student Name</option>
            <option value="returnOK" <?php echo !empty($sort)&&$sort=='returnOK'?'selected':''?>>Returned</option>
        </select>
        <button type="submit" class="btn btn-primary mx-2 float-left mt-2" name="action" value="sort_borrow_list">Sort</button>
            <nav>
                <ul class="navbar nav navbar-expand-sm float-right">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <a style="text-decoration: none" href="">\</a>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=borrow_book">Add borrow</a></li>
                    <a style="text-decoration: none" href="">\</a>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=list_book">Library books</a></li>
                    <a style="text-decoration: none" href="">\</a>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=card_list">List students</a></li>
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
            <th>Tel</th>
            <th>Address</th>
            <th>Book Name</th>
            <th>Author</th>
            <th>Book ID</th>
            <th>Date Borrow</th>
            <th>Date Return</th>
            <th>Returned</th>
        </tr>

        <?php $count = 1;
        foreach ($listBorrowBook as $value):?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $value['cardID']; ?></td>
                <td><?php echo $value['studentName']; ?></td>
                <td><?php echo $value['tel']; ?></td>
                <td><?php echo $value['address']; ?></td>
                <td><?php echo $value['bookName']; ?></td>
                <td><?php echo $value['author']; ?></td>
                <td><?php echo $value['bookID']; ?></td>
                <td><?php echo $value['dateBorrow']; ?></td>
                <td><?php echo $value['dateReturn']; ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="cardID" value="<?php echo $value['cardID']; ?>">
                        <input type="hidden" name="bookID" value="<?php echo $value['bookID']; ?>">
                        <input type="hidden" name="sort" value="<?php echo !empty($sort)?$sort:'';?>">
                        <input type="hidden" name="search" value="<?php echo !empty($dataForm['valueSearch']) ? $dataForm['valueSearch'] : null; ?>">
                        <?php echo ($value['returnOK'] == 1) ? "<button type='submit' class='btn' name='action' value='delete_returned' id='returned'></button>" : "<button type='submit' class='btn' name='action' value='return_borrow' id='owed'></button>"; ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div class="container-fluid">
        <button type="button" onclick="window.location.href='<?php echo empty($dataForm['valueSearch']) ? 'index.php?action=list_book' : 'index.php?action=borrow_list'; ?>'"
                class="btn btn-primary mb-1" >Back
        </button>
</div>
</body>
</html>