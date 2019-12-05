<?php
require_once 'model/categories.php';

class ControllerCategory
{
    function invoke()
    {
        $action = filter_input(INPUT_POST, 'action');
        if (empty($action)) {
            $action = filter_input(INPUT_GET, 'action');
            if (empty($action)) {
                $action = 'index';
            }
        }
        switch ($action) {
            case 'categories_management':
                $dataForm = dataForm();
                if (checkLogin($dataForm['userName'],$dataForm['password'],$dataForm['librarianName'])){
                    $categoryList = getCategories();
                    include "view/category/list_categories.php";
                }else{
                    include "view/member/sign_in.php";
                    echo "<script>alert(\"Login session expired\");</script>";
                }
                break;
            case 'category_form':
                include "view/category/add_category.php";
                break;
            case 'create_category':
                $dataForm = dataForm();
                if (createCategory($dataForm['categoryID'], $dataForm['categoryName'], $dataForm['moreInfo'])){
                    $categoryList = getCategories();
                    include "view/category/list_categories.php";
                }else{
                    include "view/category/add_category.php";
                    echo "<script>alert(\"Category ID already exists\");</script>";
                }
                break;
            case 'delete_category':
                $dataForm = dataForm();
                deleteCategory($dataForm['categoryID']);
                $categoryList = getCategories();
                include "view/category/list_categories.php";
                break;
            case 'edit_category':
                $dataForm = dataForm();
                $categoryList = getCategories();
                include 'view/category/edit_category.php';
                break;
            case 'submit_update_category':
                $dataForm = dataForm();
                updateCategory($dataForm['categoryID']);
                $categoryList = getCategories();
                include "view/category/list_categories.php";
                break;
            case 'search_category':
                $dataForm = dataForm();
                $categoryList = searchCategory($dataForm['valueSearch']);
                include "view/category/list_categories.php";
                break;
        }
    }
}