<?php
require_once "config/Database.php";

function getCategories()
{
    $connection = Database::getConnectDB();
    $query = "SELECT * FROM categories";
    try {
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        Database::closeDB();
        return $result;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('getCategoryListLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function createCategory($categoryID, $categoryName, $moreInfo)
{
    $connection = Database::getConnectDB();
    $categoriesList = getCategories();
    $categoryIdExisted = false;
    foreach ($categoriesList as $item) {
        if ($item['categoryID'] == $categoryID) {
            $categoryIdExisted = true;
        }
    }
    if (!$categoryIdExisted) {
        try {
            $query = "INSERT INTO categories(categoryID,categoryname,moreinfo) VALUE (?,?,?)";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(1, $categoryID);
            $stmt->bindParam(2, $categoryName);
            $stmt->bindParam(3, $moreInfo);
            $stmt->execute();
            $stmt->closeCursor();
            Database::closeDB();
            return true;
        } catch (PDOException $e) {
            date_default_timezone_set("Asia/Bangkok");
            $date = date("d:m:y h:i:s");
            file_put_contents('createCategoryLog.txt', $date.$e->getMessage()."\n\n",8);
            return false;
        }
    }else return false;
}

function deleteCategory($id)
{
    $connection = Database::getConnectDB();
    $query = "DELETE FROM categories WHERE categoryID = ?";
    try {
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $stmt->closeCursor();
        Database::closeDB();
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('deleteCategoryLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function updateCategory($id)
{
    $connection = Database::getConnectDB();
    $dataForm = dataForm();

    $query = "UPDATE categories SET categoryname = ?, moreinfo = ? WHERE categoryID = ?";
    try {
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1, $dataForm['categoryName']);
        $stmt->bindParam(2, $dataForm['moreInfo']);
        $stmt->bindParam(3, $id);
        $stmt->execute();
        $stmt->closeCursor();
        Database::closeDB();
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('updateCategoryLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function searchCategory($value)
{
    $connection = Database::getConnectDB();
    $value = '%' . $value . '%';
    try {
        $query = "SELECT * FROM categories WHERE categoryID LIKE ? OR categoryname LIKE ? OR moreinfo LIKE ? ";
        $stmt = $connection->prepare($query);
        $stmt->bindValue(1, $value);
        $stmt->bindValue(2, $value);
        $stmt->bindValue(3, $value);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        Database::closeDB();
        return $result;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('searchCategoryLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}
