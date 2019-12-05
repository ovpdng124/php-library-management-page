<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create borrows list</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container bg-primary" style="border-radius: 12px; color: wheat">
    <h2 class="my-3 text-center">Borrow</h2>
    <form action="" method="post" accept-charset="utf-8" autocomplete="on">
        <div class="row">
            <label class="font-weight-bold col-form-label col-3">CardID: </label>
            <input type="text" class="my-1 col-8 form-control" name="cardID"
                   value="<?php echo isset($cardID) ? $cardID : ''; ?>" placeholder="" autofocus maxlength="8">
        </div>
        <div class="row">
            <label class="font-weight-bold col-form-label col-3">Book ID: </label>
            <input type="text" class="my-1 col-8 form-control" name="bookID"
                   value="<?php echo isset($bookID) ? $bookID : ''; ?>" placeholder="">
        </div>
        <div class="row">
            <div style="width: 40%;">
                <button type="submit" class="float-right col-4  btn-primary rounded" style="color: wheat;"
                        name="action" value="add_borrow"><b>Add</b>
                </button>
            </div>
            <div style="width: 40%;">
                <button type="submit" class="float-right col-4  btn-primary rounded" style="color: wheat;"
                        name="action" value="check_borrow"><b>Check</b>
                </button>
            </div>
            <div style="width: 100%;">
            </div>
            <div class="mt-1" style="width: 100%;">
                <button type="submit" class="float-left mx-2 col-2 btn-primary rounded" style="color: wheat;"
                        name="action" value="create_card_form"><b>Create New Card</b>
                </button>
                <button type="submit" class="float-right mx-2 col-1 btn-primary rounded" style="color: wheat;"
                        name="action" value="add_receipt"><b>Submit</b>
                </button>
            </div>
        </div>
    </form>
</div>
<div class="">
    <table class="container">
        <thead style="font-size: large">
        <?php $count = 1;
        if (isset($_SESSION[$cardID])) {
            foreach ($_SESSION[$cardID] as $item) {
                $studentName = $item['studentName'];
                $address = $item['address'];
                $phoneNumber = $item['phoneNumber'];
            }
        } ?>
        <th>CardID: <?php echo isset($cardID) ? $cardID : ''; ?></th>
        <th>Student Name: <?php echo isset($studentName) ? $studentName : ''; ?></th>
        <th>Address: <?php echo isset($address) ? $address : ''; ?></th>
        <th>Tel: <?php echo isset($phoneNumber) ? $phoneNumber : ''; ?></th>
        </thead>
    </table>
    <table class="table table-striped">
        <tr class="text-center">
            <th>#</th>
            <th>BookID</th>
            <th>Book Name</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Date Borrow</th>
            <th>Delete</th>
        </tr>
        <?php $count = 1;
        if (isset($_SESSION[$cardID])) {
            foreach ($_SESSION[$cardID] as $item):?>
                <tr class="text-center">
                    <td><?php
                        echo $count++; ?></td>
                    <td><?php echo $item['bookID']; ?></td>
                    <td><?php echo $item['bookName']; ?></td>
                    <td><?php echo $item['author']; ?></td>
                    <td><?php echo $item['publisher']; ?></td>
                    <td><?php echo $item['dateBorrow']; ?></td>
                    <form action="" method="post">
                        <td class="text-center">
                            <input type="hidden" name="bookID" value="<?php echo $item['bookID']; ?>">
                            <input type="hidden" name="cardID" value="<?php echo $cardID ?>">
                            <button type="submit" class="btn btn-danger" name="action" value="delete_borrow"><b>X</b>
                            </button>
                        </td>
                    </form>
                </tr>
            <?php endforeach;
        } ?>
    </table>
</div>
<form action="" method="post">
    <input type="hidden" name="cardID" value="<?php echo isset($cardID) ? $cardID : ''; ?>">
    <button type="button" onclick="window.location.href='index.php?action=borrow_list';"
            class="float-right mx-2 col-1 btn-primary rounded" style="color: wheat;"><b>Back</b>
    </button>
    <button type="submit" class="float-left mx-2 col-1 btn-primary rounded" style="color: wheat;" name="action" value="destroySession"><b>Delete All</b></button>
</form>
</body>
</html>