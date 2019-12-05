<?php
require_once 'model/book.php';
require_once 'model/categories.php';
require_once 'model/dataForm.php';
require_once 'model/login.php';
require_once 'controller/ControllerCategory.php';

class ControllerBook
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
            case 'list_book':
                $dataForm = dataForm();
                if (checkLogin($dataForm['userName'],$dataForm['password'],$dataForm['librarianName'])){
                    $bookList = getBooks();
                    $categoryList = getCategories();
                    include 'view/book/list_books.php';
                }else{
                    include "view/member/sign_in.php";
                    echo "<script>alert(\"Login session expired\");</script>";
                }
                break;
            case 'book_form':
                $categoryList = getCategories();
                include 'view/book/add_book.php';
                break;
            case 'create_book':
                $dataForm = dataForm();
                $categoryList = getCategories();
                if (createBook($dataForm['bookID'], $dataForm['bookName'], $dataForm['publisher'], $dataForm['author'], $dataForm['categoryID'],
                    $dataForm['numOfPage'], $dataForm['maxDate'], $dataForm['num'], $dataForm['summary'], $dataForm['picture'])){
                    $bookList = getBooks();
                    include 'view/book/list_books.php';
                }else{
                    include 'view/book/add_book.php';
                    echo "<script>alert(\"Book ID already exists\");</script>";
                }
                break;
            case 'delete':
                $dataForm = dataForm();
                deleteBook($dataForm['bookID']);
                $bookList = getBooks();
                $categoryList = getCategories();
                include "view/book/list_books.php";
                break;
            case 'edit_form':
                $dataForm = dataForm();
                $bookList = getBooks();
                $categoryList = getCategories();
                include "view/book/edit_book.php";
                break;
            case 'submit_update':
                $dataForm = dataForm();
                updateBook($dataForm['bookID']);
                $bookList = getBooks();
                $categoryList = getCategories();
                include "view/book/list_books.php";
                break;
            case 'search_book':
                $dataForm = dataForm();
                $checkName = filter_input(INPUT_POST, 'check_name');
                $checkAuthor = filter_input(INPUT_POST, 'check_author');
                $checkCategoryID = filter_input(INPUT_POST, 'check_categoryID');
                $checkPublihser = filter_input(INPUT_POST, 'check_publisher');
                $bookList = searchBook($dataForm['valueSearch'], $checkName, $checkAuthor, $checkCategoryID, $checkPublihser);
                $categoryList = getCategories();
                include 'view/book/list_books.php';
                break;
        }
    }

}