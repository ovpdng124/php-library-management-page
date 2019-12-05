<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit book information</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <form action="" method="post" role="form" enctype="multipart/form-data">
        <?php foreach ($bookList as $value): ?>
            <?php if ($dataForm['bookID'] == $value['bookID']) { ?>
                <h1 class="text-center">Edit book</h1>
                <label for="">BookID</label>
                <input type="text" class="form-control my-1" name="bookID" value="<?php echo $value['bookID']; ?>"
                       placeholder="" readonly>
                <label for="">Book Name</label>
                <input type="text" class="form-control my-1" name="bookName" value="<?php echo $value['name']; ?>"
                       placeholder="Book Name *" required>
                <label for="">Publisher</label>
                <input type="text" class="form-control my-1" name="publisher" value="<?php echo $value['publisher']; ?>"
                       placeholder="Publisher">
                <label for="">Author</label>
                <input type="text" class="form-control my-1" name="author" value="<?php echo $value['author']; ?>"
                       placeholder="Author *" required>
                <label for="">CategoryID</label>
                <select name="categoryID" id="inputCategoryID" class="form-control" required="required">
                    <?php foreach ($categoryList as $item): ?>
                        <option value="<?php echo $item['categoryID']?>"<?php if ($value['categoryID'] == $item['categoryID']) echo 'selected'?>><?php echo $item['categoryname'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="">Numofpage</label>
                <input type="text" class="form-control my-1" name="numOfPage" value="<?php echo $value['numofpage']; ?>"
                       placeholder="Number of book pages">
                <label for="">Maxdate</label>
                <input type="text" class="form-control my-1" name="maxDate" value="<?php echo $value['maxdate']; ?>"
                       placeholder="Maximum rental date">
                <label for="">Num</label>
                <input type="text" class="form-control my-1" name="num" value="<?php echo $value['num']; ?>"
                       placeholder="Number of books in the library *" required>
                <label for="">Summary</label>
                <input type="text" class="form-control my-1" name="summary" value="<?php echo $value['summary']; ?>"
                       placeholder="Book Summary">
                <label for="">Picture</label>
                <input type="hidden" class="form-control my-1" name="oldPicture" value="<?php echo $value['picture']; ?>"
                       placeholder="Book Picture">
                <input type="file" class="form-control my-1" name="picture" value="<?php echo $value['picture']; ?>"
                       placeholder="Book Picture">
                <button type="submit" class="btn btn-primary my-1" name="action" value="submit_update">Submit</button>
                <button type="button" onclick="window.location.href='index.php?action=list_book';"
                        class="btn btn-primary" >Back
                </button>
            <?php } endforeach; ?>
    </form>
</div>
</body>
</html>