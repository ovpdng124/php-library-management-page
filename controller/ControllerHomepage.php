<?php


class ControllerHomepage
{
    public function invoke()
    {
        $action = filter_input(INPUT_POST, 'action');
        if (empty($action)) {
            $action = filter_input(INPUT_GET, 'action');
            if (empty($action)) {
                $action = 'index';
            }
        }
        switch ($action) {
            case 'index':
                $dataForm = dataForm();
                $loginSuccess = false;
                if (checkLogin($dataForm['userName'], $dataForm['password'], $dataForm['librarianName'])) {
                    $loginSuccess = true;
                    include "view/home/homepage.php";
                } else {
                    include "view/home/homepage.php";
                }
                break;
            case 'sign_in':
                include "view/member/sign_in.php";
                break;
            case 'sign_up':
                include "view/member/sign_up.php";
                break;
            case 'sign_out':
                doLogout();
                header("Location:index.php");
                break;
            case 'create_user':
                $dataForm = dataForm();
                $errorMessage = '';
                createNewAccount($dataForm['userName'], $dataForm['password'], $errorMessage);
                if ($errorMessage == 'failed') {
                    echo "<script>alert(\"SYSTEM ERROR: Register failed!!!\");</script>";
                    include "view/member/sign_up.php";
                } elseif ($errorMessage == 'existed') {
                    echo "<script>alert(\"Username already exists!\");</script>";
                    include "view/member/sign_up.php";
                } else {
                    echo "<script>alert(\"Register successfully!\");</script>";
                    $loginSuccess = false;
                    include "view/home/homepage.php";
                }
                break;
            case 'login':
                $dataForm = dataForm();
                if (doLogin($dataForm['userName'], $dataForm['password'])) {
                    echo "<script>alert(\"Login successfully!\");</script>";
                    header("Location:index.php");

                } else {
                    echo "<script>alert(\"Incorrect username or password!\");</script>";
                    include "view/member/sign_in.php";
                }
                break;
            case 'your_profile':
                $userName = '';
                $editProfile = 0;
                $profileList = getProfile($userName);
                include "view/member/profile.php";
                break;
            case 'edit_profile':
                $editProfile = 1;
                $profileList = getProfile($userName);
                include "view/member/profile.php";
                break;
            case 'update_profile':
                $dataForm = dataForm();
                $editProfile = 0;
                if (updateProfile($dataForm['userName'], $dataForm['password'], $dataForm['librarianName'])) {
                    $loginSuccess = true;
                    include "view/home/homepage.php";
                    echo "<script>alert(\"Completed update!\")</script>";

                } else {
                    $profileList = getProfile($userName);
                    include "view/member/profile.php";
                    echo "<script>alert(\"ERROR: Update failed!\")</script>";

                }

                break;
        }
    }
}