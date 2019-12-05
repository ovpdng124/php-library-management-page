<?php
require_once "model/receipt.php";

class ControllerBorrowBook
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
            case 'borrow_list':
                $dataForm = dataForm();
                !empty($dataForm['sort']) ? $sort = $dataForm['sort'] : $sort = 'dateborrow';
                if (checkLogin($dataForm['userName'],$dataForm['password'],$dataForm['librarianName'])){
                    $listBorrowBook = getBorrowList();
                    include "view/receipt/borrow_list.php";
                }else{
                    include "view/member/sign_in.php";
                    echo "<script>alert(\"Login session expired\");</script>";
                }
                break;
            case 'borrow_book':
                $dataForm = dataForm();
                $cardID = isset($cardID) ? $cardID : '';
                include "view/receipt/add_borrow.php";
                break;
            case 'add_borrow':
                $dataForm = dataForm();
                $errorMessage = '';
                if (!empty($dataForm['cardID']) || $dataForm['cardID'] != null && !empty($dataForm['bookID']) || $dataForm['bookID'] != null) {
                    addBorrow($dataForm['cardID'], $dataForm['bookID'], $errorMessage);
                    if ($errorMessage == 'incorrect data') {
                        echo "<script>alert(\"Incorrect cardID or bookID\")</script>";
                    } elseif ($errorMessage == 'session existed') {
                        echo "<script>alert(\"This book already exist in borrow list\")</script>";
                    }
                    $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                    include "view/receipt/add_borrow.php";
                } else {
                    $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                    include "view/receipt/add_borrow.php";
                    echo "<script>alert(\"Empty cardID or bookID\")</script>";
                }
                break;
            case 'check_borrow':
                $dataForm = dataForm();
                $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                include "view/receipt/add_borrow.php";
                break;
            case 'add_receipt':
                $dataForm = dataForm();
                $errorMessage = '';
                pushToReceipt($dataForm['cardID'], $errorMessage);
                if ($errorMessage == 'success') {
                    $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                    include "view/receipt/add_borrow.php";
                    echo "<script>alert(\"Adding data successfully\")</script>";
                } elseif ($errorMessage == 'error: check inventory') {
                    $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                    include "view/receipt/add_borrow.php";
                    echo "<script>alert(\"SYSTEM: The process of checking inventory is interrupted\")</script>";
                } elseif ($errorMessage == 'error: insert DB') {
                    $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                    include "view/receipt/add_borrow.php";
                    echo "<script>alert(\"SYSTEM: The process of adding data is interrupted\")</script>";
                } elseif ($errorMessage == 'error: session empty') {
                    $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                    include "view/receipt/add_borrow.php";
                    echo "<script>alert(\"No data\")</script>";
                } elseif ($errorMessage == 'error: borrowing') {
                    $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                    include "view/receipt/add_borrow.php";
                    echo "<script>alert(\"This student has borrowed the book before and not returned it yet\")</script>";
                } else {
                    $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                    include "view/receipt/add_borrow.php";
                    echo "<script>alert(\"The book '$errorMessage' is out of stock\")</script>";
                }
                break;
            case 'delete_borrow':
                $dataForm = dataForm();
                deleteBorrow($dataForm['cardID'], $dataForm['bookID']);
                $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                include "view/receipt/add_borrow.php";
                break;
            case 'return_borrow':
                $dataForm = dataForm();
                !empty($dataForm['sort']) ? $sort = $dataForm['sort'] : $sort = 'returned';
                returnBorrow($dataForm['cardID'], $dataForm['bookID']);
                $listBorrowBook = searchBorrow($dataForm['valueSearch'], $dataForm['sort']);
                include "view/receipt/borrow_list.php";
                break;
            case 'delete_returned':
                $dataForm = dataForm();
                !empty($dataForm['sort']) ? $sort = $dataForm['sort'] : $sort = 'returned';
                deleteReturned($dataForm['cardID'],$dataForm['bookID']);
                $listBorrowBook = searchBorrow($dataForm['valueSearch'], $dataForm['sort']);
                include "view/receipt/borrow_list.php";
                break;
            case 'search_borrow':
                $dataForm = dataForm();
                !empty($dataForm['sort']) ? $sort = $dataForm['sort'] : $sort = 'returned';
                $listBorrowBook = searchBorrow($dataForm['valueSearch'], $dataForm['sort']);
                include "view/receipt/borrow_list.php";
                break;
            case 'sort_borrow_list':
                $dataForm = dataForm();
                !empty($dataForm['sort']) ? $sort = $dataForm['sort'] : $sort = 'dateborrow';
                $listBorrowBook = searchBorrow($dataForm['valueSearch'], $dataForm['sort']);
                include "view/receipt/borrow_list.php";
                break;
            case 'destroySession':
                $dataForm = dataForm();
                $cardID = !empty($dataForm['cardID']) ? $dataForm['cardID'] : '';
                unset($_SESSION[$cardID]);
                include "view/receipt/add_borrow.php";
                break;


        }
    }
}