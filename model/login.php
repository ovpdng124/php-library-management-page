<?php
require_once "config/Database.php";
function getAccountList()
{
    $connection = Database::getConnectDB();
    try {
        $query = "SELECT * FROM userAccounts";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(2);
        $stmt->closeCursor();
        Database::closeDB();
        return $result;
    } catch (PDOException $e) {
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents('getAccountListLog.txt', $date.$e->getMessage()."\n\n",8);
        return false;
    }
}

function createNewAccount($userName, $password,&$errorMessage)
{
    $accountList = getAccountList();
    $checkAccountExisted = false;
    foreach ($accountList as $item) {
        if ($item['userName'] == $userName) {
            $checkAccountExisted = true;
            break;
        }
    }
    if (!$checkAccountExisted) {
        $connection = Database::getConnectDB();
        try {
            $query = "INSERT INTO userAccounts(userName, password) VALUE (?,?)";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $password);
            $stmt->execute();
            $stmt->closeCursor();
            Database::closeDB();
            return true;
        } catch (PDOException $e) {
            date_default_timezone_set("Asia/Bangkok");
            $date = date("d:m:y h:i:s");
            file_put_contents('createAccountListLog.txt', $date.$e->getMessage()."\n\n",8);
            return $errorMessage = 'failed';
        }
    } else {
        return $errorMessage = 'existed';
    }
}

function doLogin($userName, $password)
{
    $accountList = getAccountList();
    if (!empty($userName) || $userName != null && !empty($password) || $password != null) {
        $loginSuccess = false;
        foreach ($accountList as $item) {
            if ($item['userName'] == $userName && $item['password'] == $password) {
                $loginSuccess = true;
                break;
            }
        }
        if ($loginSuccess) {
            $name = 'userName';
            $value = $userName;
            setcookie($name, $value, time() + 24 * 3600, '/');
            $name = 'password';
            $value = $password;
            setcookie($name, $value, time() + 24 * 3600, '/');
            return true;
        } else return false;
    } else return false;
}

function doLogout()
{
    $name = 'userName';
    $value = '';
    setcookie($name, $value, time() - 24 * 3600, '/');
    $name = 'password';
    $value = '';
    setcookie($name, $value, time() - 24 * 3600, '/');
}

function checkLogin(&$userName, &$password,&$librarianName)
{
    $accountList = getAccountList();
    $userName = isset($_COOKIE['userName']) ? $_COOKIE['userName'] : false;
    $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : false;
    if ($userName && $password) {
        foreach ($accountList as $item) {
            if ($item['userName'] == $userName && $item['password'] == $password) {
                $librarianName = $item['librarianName'];
                return true;
            }
        }
    }
    return false;
}

function getProfile(&$userName){
    $userName = isset($_COOKIE['userName'])?$_COOKIE['userName']:'';
    $connection = Database::getConnectDB();
    try{
        $query = "SELECT * FROM useraccounts WHERE userName = ?";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1,$userName);
        $stmt->execute();
        $profile = $stmt->fetchAll(2);
        $stmt->closeCursor();
        Database::closeDB();
        return $profile;
    }catch (PDOException $e){
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents("getProfileLog.txt", $date.$e->getMessage()."\n\n", FILE_APPEND);
        return false;
    }
}

function updateProfile($userName,$password,$librarianName){
    $connection = Database::getConnectDB();
    try{
        $query = "UPDATE userAccounts SET password = ?, librarianName = ? WHERE userName = ?";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(1, $password);
        $stmt->bindParam(2, $librarianName);
        $stmt->bindParam(3, $userName);
        $stmt->execute();
        $stmt->closeCursor();
        Database::closeDB();
        return true;
    }catch (PDOException $e){
        date_default_timezone_set("Asia/Bangkok");
        $date = date("d:m:y h:i:s");
        file_put_contents("updateProfileLog.txt", $date.$e->getMessage()."\n\n", FILE_APPEND);
        return false;
    }
}
