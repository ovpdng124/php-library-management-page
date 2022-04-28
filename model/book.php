<?php
require_once "config/Database.php";
function getBooks()
{
    $connection = Database::getConnectDB();
    $query = "SELECT * FROM books";
    //sua lai code
    try {
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('getBookListLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function createBook($bookID, $bookName, $publisher, $author, $categoryID, $numOfPage, $maxDate, $num, $summary, $picture)
{
    $connection = Database::getConnectDB();
    $bookList = getBooks();
    $bookIdExisted = false;
    foreach ($bookList as $item) {
        if ($item['bookID'] == $bookID) {
            $bookIdExisted = true;
        }
    }
    if (!$bookIdExisted) {
        try {
            $query = "INSERT INTO books(bookID,name,publisher,author,categoryID,numofpage,maxdate,num,summary,picture) VALUE (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(1, $bookID);
            $stmt->bindParam(2, $bookName);
            $stmt->bindParam(3, $publisher);
            $stmt->bindParam(4, $author);
            $stmt->bindParam(5, $categoryID);
            $stmt->bindParam(6, $numOfPage);
            $stmt->bindParam(7, $maxDate);
            $stmt->bindParam(8, $num);
            $stmt->bindParam(9, $summary);
            $stmt->bindParam(10, $picture);
            $stmt->execute();
            $stmt->closeCursor();
            Database::closeDB();
            return true;
        } catch (PDOException $e) {
            date_default_timezone_set("Asia/Bangkok");
            $date = date("d:m:y h:i:s");
            file_put_contents('createBookLog.txt', $date.$e->getMessage()."\n\n",8);
            return false;
        }
    }else return false;
}

function deleteBook($id)
{
    $connection = Database::getConnectDB();

    $query = "DELETE FROM books WHERE bookID = ?";
    try {
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $stmt->closeCursor();
        Database::closeDB();
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('deleteBookLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function updateBook($id)
{
    $connection = Database::getConnectDB();
    $dataForm = dataForm();
    $picture = $dataForm['oldPicture'];
    $image_dir_path = getcwd() . '/public/images';
    if (isset($_FILES['picture'])) {
        $fileName = $_FILES['picture']['name'];
        if (!empty($fileName)) {
            $source = $_FILES['picture']['tmp_name'];
            $target = $image_dir_path . '/' . $fileName;
            move_uploaded_file($source, $target);
            $picture = $fileName;
        }
    }

    $query = "UPDATE books SET name = ?, publisher = ?, author = ?, categoryID = ?, numofpage = ?, maxdate = ?, num = ?, summary = ?, picture = ? WHERE bookID = ?";
    try {
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1, $dataForm['bookName']);
        $stmt->bindParam(2, $dataForm['publisher']);
        $stmt->bindParam(3, $dataForm['author']);
        $stmt->bindParam(4, $dataForm['categoryID']);
        $stmt->bindParam(5, $dataForm['numOfPage']);
        $stmt->bindParam(6, $dataForm['maxDate']);
        $stmt->bindParam(7, $dataForm['num']);
        $stmt->bindParam(8, $dataForm['summary']);
        $stmt->bindParam(9, $picture);
        $stmt->bindParam(10, $id);
        $stmt->execute();
        $stmt->closeCursor();
        Database::closeDB();
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('updateBookLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function searchBook($value, $checkName, $checkAuthor, $checkCategoryID, $checkPublihser)
{
    $connection = Database::getConnectDB();
    $result = '';
    $value = '%' . $value . '%';
    $bool = false;
    isset($checkName) ? $checkName = $value : $checkName = '';
    isset($checkAuthor) ? $checkAuthor = $value : $checkAuthor = '';
    isset($checkPublihser) ? $checkPublihser = $value : $checkPublihser = '';
    empty($checkCategoryID) ? $checkCategoryID = '' : '';

    if (!empty($checkName) && empty($checkCategoryID) && empty($checkPublihser) && empty($checkAuthor)
        || !empty($checkPublihser) && empty($checkCategoryID) && empty($checkAuthor) && empty($checkName)
        || !empty($checkAuthor) && empty($checkCategoryID) && empty($checkPublihser) && empty($checkName)) {
        try {
            $query = "SELECT * FROM books WHERE name LIKE ? OR author LIKE ? OR publisher LIKE ?";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(1, $checkName);
            $stmt->bindParam(2, $checkAuthor);
            $stmt->bindParam(3, $checkPublihser);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            $bool = true;
//            echo "<script>alert(\"1 Checkbox\");</script>";
        } catch (PDOException $e) {
            date_default_timezone_set("Asia/Bangkok");
            $date = date("d:m:y h:i:s");
            file_put_contents('searchBookLog.txt', $date.$e->getMessage()."\n\n",8);
            return false;
        }
    }
    if (!empty($checkName) && !empty($checkCategoryID) && empty($checkPublihser) && empty($checkAuthor)
        || !empty($checkPublihser) && !empty($checkCategoryID) && empty($checkName) && empty($checkAuthor)
        || !empty($checkAuthor) && !empty($checkCategoryID) && empty($checkPublihser) && empty($checkName)) {
        try {
            $query = "SELECT * FROM books WHERE (name LIKE ? OR author LIKE ? OR publisher LIKE ?) AND categoryID LIKE ?";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(1, $checkName);
            $stmt->bindParam(2, $checkAuthor);
            $stmt->bindParam(3, $checkPublihser);
            $stmt->bindParam(4, $checkCategoryID);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            $bool = true;
//            echo "<script>alert(\"1 Checkbox and categories\");</script>";
        } catch (PDOException $e) {
            date_default_timezone_set("Asia/Bangkok");
            $date = date("d:m:y h:i:s");
            file_put_contents('searchBookLog.txt', $date.$e->getMessage()."\n\n",8);
            return false;
        }
    }
    if (!empty($checkName) && !empty($checkPublihser)
        || !empty($checkName) && !empty($checkAuthor)
        || !empty($checkAuthor) && !empty($checkPublihser)) {
        if (!empty($checkName) && !empty($checkAuthor) && !empty($checkPublihser) && empty($checkCategoryID)) {
            try {
                $query = "SELECT * FROM books WHERE name LIKE :name AND author LIKE :author AND publisher LIKE :publisher";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":name", $checkName);
                $stmt->bindParam(":author", $checkAuthor);
                $stmt->bindParam(":publisher", $checkPublihser);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $stmt->closeCursor();
                $bool = true;
//                echo "<script>alert(\"Three Checkbox\");</script>";
            } catch (PDOException $e) {
                date_default_timezone_set("Asia/Bangkok");
                $date = date("d:m:y h:i:s");
                file_put_contents('searchBookLog.txt', $date.$e->getMessage()."\n\n",8);
                return false;
            }
        } elseif (!empty($checkName) && !empty($checkAuthor) && !empty($checkPublihser) && !empty($checkCategoryID)) {
            try {
                $query = "SELECT * FROM books WHERE name LIKE :name AND author LIKE :author AND publisher LIKE :publisher AND categoryID LIKE :categoryID";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":name", $checkName);
                $stmt->bindParam(":author", $checkAuthor);
                $stmt->bindParam(":publisher", $checkPublihser);
                $stmt->bindParam(":categoryID", $checkCategoryID);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $stmt->closeCursor();
                $bool = true;
//                echo "<script>alert(\"3 checkbox and categories\");</script>";
            } catch (PDOException $e) {
                date_default_timezone_set("Asia/Bangkok");
                $date = date("d:m:y h:i:s");
                file_put_contents('searchBookLog.txt', $date.$e->getMessage()."\n\n",8);
                return false;
            }
        } elseif (!empty($checkCategoryID)) {
            try {
                $query = "SELECT * FROM books WHERE name LIKE :name AND author LIKE :author AND categoryID LIKE :categoryID ";
                $query .= "OR name LIKE :name AND publisher LIKE :publisher AND categoryID LIKE :categoryID ";
                $query .= "OR publisher LIKE :publisher AND author LIKE :author AND categoryID LIKE :categoryID ";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":name", $checkName);
                $stmt->bindParam(":author", $checkAuthor);
                $stmt->bindParam(":publisher", $checkPublihser);
                $stmt->bindParam(":categoryID", $checkCategoryID);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $stmt->closeCursor();
                $bool = true;
//                echo "<script>alert(\"2 Checkbox and categories\");</script>";
            } catch (PDOException $e) {
                date_default_timezone_set("Asia/Bangkok");
                $date = date("d:m:y h:i:s");
                file_put_contents('searchBookLog.txt', $date.$e->getMessage()."\n\n",8);
                return false;
            }
        } else {
            try {
                $query = "SELECT * FROM books WHERE name LIKE :name AND author LIKE :author ";
                $query .= "OR name LIKE :name AND publisher LIKE :publisher ";
                $query .= "OR publisher LIKE :publisher AND author LIKE :author ";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(":name", $checkName);
                $stmt->bindParam(":author", $checkAuthor);
                $stmt->bindParam(":publisher", $checkPublihser);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $stmt->closeCursor();
                $bool = true;
//                echo "<script>alert(\"2 Checkbox\");</script>";
            } catch (PDOException $e) {
                date_default_timezone_set("Asia/Bangkok");
                $date = date("d:m:y h:i:s");
                file_put_contents('searchBookLog.txt', $date.$e->getMessage()."\n\n",8);
                return false;
            }
        }
    }

    if (!$bool) {
        if (empty($checkCategoryID)) {
            try {
                $query = "SELECT * FROM books WHERE bookID LIKE ? OR name LIKE ? OR author LIKE ? OR categoryID LIKE ? OR publisher LIKE ? OR num LIKE ?
                       OR numofpage LIKE ? OR maxdate LIKE ? OR summary LIKE ?";
                $stmt = $connection->prepare($query);
                $stmt->bindValue(1, $value);
                $stmt->bindValue(2, $value);
                $stmt->bindValue(3, $value);
                $stmt->bindValue(4, $value);
                $stmt->bindValue(5, $value);
                $stmt->bindValue(6, $value);
                $stmt->bindValue(7, $value);
                $stmt->bindValue(8, $value);
                $stmt->bindValue(9, $value);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $stmt->closeCursor();
//                echo "<script>alert(\"No Checkbox\");</script>";
                Database::closeDB();
                return $result;
            } catch (PDOException $e) {
                date_default_timezone_set("Asia/Bangkok");
                $date = date("d:m:y h:i:s");
                file_put_contents('searchBookLog.txt', $date.$e->getMessage()."\n\n",8);
                return false;
            }
        } else {
            try {
                $query = "SELECT * FROM books WHERE categoryID LIKE ?";
                $stmt = $connection->prepare($query);
                $stmt->bindValue(1, '%' . $checkCategoryID . '%');
                $stmt->execute();
                $result = $stmt->fetchAll();
                $stmt->closeCursor();
//                echo "<script>alert(\"Just categories\");</script>";
                Database::closeDB();
                return $result;
            } catch (PDOException $e) {
                date_default_timezone_set("Asia/Bangkok");
                $date = date("d:m:y h:i:s");
                file_put_contents('searchBookLog.txt', $date.$e->getMessage()."\n\n",8);
                return false;
            }
        }
    } else return $result;
}

