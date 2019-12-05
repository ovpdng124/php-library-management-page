<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a new book</title>
    <link rel="stylesheet" href="view/bootstrap4/css/bootstrap.min.css">
    <script src="view/bootstrap4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <form action="" method="post" role="form" enctype="multipart/form-data">
        <h1 class="text-center">Create a new book</h1>
        <label for="">BookID</label>
        <input type="text" class="form-control my-1" name="bookID" placeholder="Book ID *" required maxlength="6" minlength="3">
        <label for="">Book Name</label>
        <input type="text" class="form-control my-1" name="bookName" placeholder="Book Name *" required>
        <label for="">Publisher</label>
        <input type="text" class="form-control my-1" name="publisher" placeholder="Publisher">
        <label for="">Author</label>
        <input type="text" class="form-control my-1" name="author" placeholder="Author *" required>
        <label for="">CategoryID</label>
        <select name="categoryID" id="inputCategoryID" class="form-control" required ="required">
            <option value="">Choose categories</option>
            <?php foreach ($categoryList  as $key => $value): ?>
                <option value="<?php echo $value['categoryID']?>"><?php echo $value['categoryname']?></option>
            <?php endforeach;?>
        </select>
        <label for="">Numofpage</label>
        <input type="text" class="form-control my-1" name="numOfPage" placeholder="Number of book pages">
        <label for="">Maxdate</label>
        <input type="text" class="form-control my-1" name="maxDate" placeholder="Maximum rental date">
        <label for="">Num</label>
        <input type="text" class="form-control my-1" name="num" placeholder="Number of books in the library *" required>
        <label for="">Summary</label>
        <input type="text" class="form-control my-1" name="summary" placeholder="Book summary">
        <label for="">Picture</label>
        <input type="file" class="form-control my-1" name="picture" placeholder="Book piture">
        <button type="submit" class="btn btn-primary my-1" name="action" value="create_book" >Submit</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='index.php?action=list_book';">Back</button>
    </form>

</div>
</body>
</html>