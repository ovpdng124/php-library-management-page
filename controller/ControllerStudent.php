<?php
require_once 'model/student.php';

class ControllerStudent
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
            case 'create_card_form':
                include "view/receipt/create_card.php";
                break;
            case 'create_card':
                $dataForm = dataForm();
                if (addStudent($dataForm['cardID'], $dataForm['studentName'], $dataForm['address'], $dataForm['phoneNumber'])) {
                    $studentList = getStudents();
                    include "view/receipt/list_card.php";
                    echo "<script>alert(\"Create successfully\");</script>";
                } else {
                    echo "<script>alert(\"Card ID already exist\");</script>";
                    include "view/receipt/create_card.php";
                }
                break;
            case 'card_list':
                $studentList = getStudents();
                include "view/receipt/list_card.php";
                break;
            case 'search_student':
                $dataForm = dataForm();
                $studentList = searchStudent($dataForm['valueSearch'], $dataForm['sort']);
                include "view/receipt/list_card.php";
                break;
            case 'sort_student_list':
                $dataForm = dataForm();
                !empty($dataForm['sort']) ? $sort = $dataForm['sort'] : $sort = 'cardID';
                $studentList = searchStudent($dataForm['valueSearch'], $dataForm['sort']);
                include "view/receipt/list_card.php";
                break;
            case 'edit_card_student':
                $dataForm = dataForm();
                $studentList = getStudents();
                include "view/receipt/edit_card.php";
                break;
            case 'submit_update_student':
                $dataForm = dataForm();
                updateStudent($dataForm['cardID']);
                $studentList = getStudents();
                include "view/receipt/list_card.php";
                break;
            case 'delete_card_student':
                $dataForm = dataForm();
                if (!deleteStudent($dataForm['cardID'])) {
                    echo "<script>alert(\"ERROR SYSTEM: Delete failed! This CardID is being used at another table\")</script>";
                }
                $studentList = getStudents();
                include "view/receipt/list_card.php";
                break;

        }
    }
}