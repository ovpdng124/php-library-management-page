<?php
require_once "config/Database.php";

function getStudents()
{
    $connection = Database::getConnectDB();
    $query = "SELECT * FROM students";
    try {
        $statement = $connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        Database::closeDB();
        return $result;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('getStudentLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function addStudent($cardID, $studentName, $address, $phoneNumber)
{
    $connection = Database::getConnectDB();
    $studentList = getStudents();
    $studentExisted = false;
    foreach ($studentList as $item) {
        if ($item['cardID'] == $cardID) {
            $studentExisted = true;
        }
    }
    if (!$studentExisted) {
        try {
            $query = "INSERT INTO students(cardID,name,address,tel) VALUE (?,?,?,?)";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(1, $cardID);
            $stmt->bindParam(2, $studentName);
            $stmt->bindParam(3, $address);
            $stmt->bindParam(4, $phoneNumber);
            $stmt->execute();
            $stmt->closeCursor();
            Database::closeDB();
            return true;
        } catch (PDOException $e) {
            date_default_timezone_set("Asia/Bangkok");
            $date = date("d:m:y h:i:s");
            file_put_contents('addStudentLog.txt', $date.$e->getMessage()."\n\n",8);
            return false;
        }
    } else return false;
}

function searchStudent($value,$sort)
{
    $connection = Database::getConnectDB();
    $value = '%' . $value . '%';
    try {
        $query = "SELECT * FROM students WHERE cardID LIKE ? OR name LIKE ? OR tel LIKE ? ORDER BY " . $sort;
        $stmt = $connection->prepare($query);
        $stmt->bindValue(1, $value);
        $stmt->bindValue(2, $value);
        $stmt->bindValue(3, $value);
        $stmt->execute();
        $result = $stmt->fetchAll(2);
        $stmt->closeCursor();
        Database::closeDB();
        return $result;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('searchStudentLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function deleteStudent($cardID)
{
    $connection = Database::getConnectDB();
    $query = "DELETE FROM students WHERE cardID = ?";
    try {
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1, $cardID);
        $stmt->execute();
        $stmt->closeCursor();
        Database::closeDB();
        return true;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('deleteStudentLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}


function updateStudent($cardID)
{
    $connection = Database::getConnectDB();
    $dataForm = dataForm();
    $query = "UPDATE students SET name = ?, address = ?, tel = ? WHERE cardID = ?";
    try {
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1, $dataForm['studentName']);
        $stmt->bindParam(2, $dataForm['address']);
        $stmt->bindParam(3, $dataForm['phoneNumber']);
        $stmt->bindParam(4, $cardID);
        $stmt->execute();
        $stmt->closeCursor();
        Database::closeDB();
        return true;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('updateStudentLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

