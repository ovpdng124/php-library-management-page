<?php
require_once "config/Database.php";

function getBorrowList()
{
    $connection = Database::getConnectDB();
    try {
        $query = "SELECT s.cardID, s.name AS studentName, s.address, s.tel, b.bookID, b.categoryID, b.name AS bookName, b.publisher, b.author, r.dateborrow AS dateBorrow, r.datereturn as dateReturn, r.returnOK ";
        $query .= "FROM students s INNER JOIN receipts r ON s.cardID = r.cardID ";
        $query .= "INNER JOIN books b ON r.bookID = b.bookID ";
        $query .= "INNER JOIN categories c ON c.categoryID = b.categoryID ORDER BY s.cardID";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        Database::closeDB();
        return $result;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('getBorrowListLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function addBorrow($cardID, $bookID, &$errorMessage)
{
    $connection = Database::getConnectDB();
    $result = array();
    $sessionExisted = false;
    if (isset($_SESSION[$cardID])) {
        foreach ($_SESSION[$cardID] as $item) {
            if ($item['bookID'] == $bookID && $item['cardID'] == $cardID) {
                $sessionExisted = true;
                break;
            }
        }
    }
    if (!$sessionExisted) {
        date_default_timezone_set("Asia/Bangkok");
        try {
            $query = "SELECT b.bookID, b.name as bookName, b.publisher, b.author, s.cardID, s.name as studentName, s.address, s.tel FROM books b,students s";
            $stmt = $connection->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            Database::closeDB();
        } catch (PDOException $e) {
            $date = date("d:m:y h:i:s");
            file_put_contents('addBorrowLog.txt', $date.$e->getMessage()."\n\n",8);
        }
        $dataToSession = array();
        $dateBorrow = date("Y-m-d");
        $dbExisted = false;
        foreach ($result as $item) {
            if ($item['bookID'] == $bookID && $item['cardID'] == $cardID) {
                $dbExisted = true;
            }
        }
        if ($dbExisted) {
            foreach ($result as $item) {
                if ($item['bookID'] == $bookID && $item['cardID'] == $cardID) {
                    $dataToSession = array(
                        'bookID' => $bookID,
                        'cardID' => $cardID,
                        'bookName' => $item['bookName'],
                        'studentName' => $item['studentName'],
                        'address' => $item['address'],
                        'author' => $item['author'],
                        'publisher' => $item['publisher'],
                        'dateBorrow' => $dateBorrow,
                        'phoneNumber' => $item['tel'],
                    );
                    break;
                }
            }
            $_SESSION[$cardID][] = $dataToSession;
            return $errorMessage = 'add success';
        } else {
            return $errorMessage = 'incorrect data';
        }
    } else return $errorMessage = 'session existed';
}

function pushToReceipt($cardID, &$errorMessage)
{
    $connection = Database::getConnectDB();
    $checkInventory = true;
    $outOfStock = array(array('bookID' => ''));
    try {
        $query = "SELECT bookID, name AS bookName FROM books WHERE num = 0";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $outOfStock = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        $checkInventory = false;
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('checkInventoryLog.txt', $date.$e->getMessage()."\n\n",8);
    }
    if ($checkInventory) {
        if (isset($_SESSION[$cardID])) {
            foreach ($_SESSION[$cardID] as $item) {
                foreach ($outOfStock as $value) {
                    if ($item['bookID'] == $value['bookID']) {
                        return $errorMessage = $value['bookName'];
                    }
                }
            }
        } else return $errorMessage = 'error: session empty';
    } else return $errorMessage = 'error: check inventory';
    $returnOK = 0;
    $borrowList = getBorrowList('dateborrow');
    $checkReturnOk = true;
    foreach ($borrowList as $item) {
        foreach ($_SESSION[$cardID] as $value) {
            if ($item['bookID'] == $value['bookID'] && $item['cardID'] == $value['cardID'] && $item['returnOK'] == 0) {
                $checkReturnOk = false;
                break;
            }
        }
    }
    if ($checkReturnOk) {
        $checkInsertDB = true;
        foreach ($_SESSION[$cardID] as $item) {
            try {
                $query = "INSERT INTO receipts(cardID, bookID, dateborrow, returnOK) VALUE (?,?,?,?)";
                $stmt = $connection->prepare($query);
                $stmt->bindValue(1, $cardID);
                $stmt->bindValue(2, $item['bookID']);
                $stmt->bindValue(3, $item['dateBorrow']);
                $stmt->bindValue(4, $returnOK);
                $stmt->execute();
                $stmt->closeCursor();
                $query = "UPDATE books SET num = num - ? WHERE bookID =?";
                $stmt = $connection->prepare($query);
                $stmt->bindValue(1, 1);
                $stmt->bindValue(2, $item['bookID']);
                $stmt->execute();
                $stmt->closeCursor();
                Database::closeDB();
            } catch (PDOException $e) {
                $checkInsertDB = false;
                date_default_timezone_set("Asia/Bangkok");
                $date = date("d:m:y h:i:s");
                file_put_contents('insertToReceiptLog.txt', $date.$e->getMessage()."\n\n",8);
                break;
            }
        }
        if ($checkInsertDB) {
            unset($_SESSION[$cardID]);
            return $errorMessage = 'success';
        } else return $errorMessage = 'error: insert DB';
    } else return $errorMessage = 'error: borrowing';
}

function deleteBorrow($cardID, $bookID)
{
    foreach ($_SESSION[$cardID] as $key => $item) {
        if ($item['bookID'] == $bookID) {
            unset($_SESSION[$cardID][$key]);
            break;
        }
    }
}

function returnBorrow($cardID, $bookID)
{
    $connection = Database::getConnectDB();
    $dateReturn = date("Y-m-d");
    try {
        $query = "UPDATE receipts SET returnOK = ?, datereturn = ? WHERE bookID = ? AND cardID = ?";
        $stmt = $connection->prepare($query);
        $stmt->bindValue(1, 1);
        $stmt->bindValue(2, $dateReturn);
        $stmt->bindValue(3, $bookID);
        $stmt->bindValue(4, $cardID);
        $stmt->execute();
        $stmt->closeCursor();
        $query = "UPDATE books SET num = num + ? WHERE bookID = ?";
        $stmt = $connection->prepare($query);
        $stmt->bindValue(1, 1);
        $stmt->bindValue(2, $bookID);
        $stmt->execute();
        $stmt->closeCursor();
        Database::closeDB();
        return true;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('returnBorrowLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }

}

function deleteReturned($cardID,$bookID){
    $connection = Database::getConnectDB();
    $query = "DELETE FROM receipts WHERE cardID = ? AND bookID = ?";
    try{
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1,$cardID);
        $stmt->bindParam(2,$bookID);
        $stmt->execute();
        $stmt->closeCursor();
        Database::closeDB();
        return true;
    }catch (PDOException $e){
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('deleteBorrowLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function searchBorrow($value, $sort)
{
    $connection = Database::getConnectDB();
    $value = '%' . $value . '%';
    $sortType = ($sort == 'dateborrow') || ($sort == 'datereturn') ? ' DESC' : ' ASC';
    try {
        $query = "SELECT s.cardID, s.name AS studentName, s.address, s.tel, b.bookID, b.categoryID, b.name AS bookName, b.publisher, b.author, r.dateborrow AS dateBorrow, r.datereturn as dateReturn, r.returnOK ";
        $query .= "FROM students s INNER JOIN receipts r ON s.cardID = r.cardID ";
        $query .= "INNER JOIN books b ON r.bookID = b.bookID ";
        $query .= "INNER JOIN categories c ON c.categoryID = b.categoryID ";
        $query .= "WHERE s.cardID LIKE ? OR b.bookID LIKE ? OR s.name LIKE ? OR s.tel LIKE ? OR b.name LIKE ? ORDER BY " . $sort . $sortType;
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1, $value);
        $stmt->bindParam(2, $value);
        $stmt->bindParam(3, $value);
        $stmt->bindParam(4, $value);
        $stmt->bindParam(5, $value);
        $stmt->execute();
        $resultSearch = $stmt->fetchAll(2);
        $stmt->closeCursor();
        Database::closeDB();
        return $resultSearch;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('searchBorrowLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }

}