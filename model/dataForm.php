<?php
function dataForm()
{
    $bookID = strtoupper(filter_input(INPUT_POST, 'bookID'));
    $bookName = filter_input(INPUT_POST, 'bookName');
    $publisher = filter_input(INPUT_POST, 'publisher');
    $author = filter_input(INPUT_POST, 'author');
    $numOfPage = filter_input(INPUT_POST, 'numOfPage');
    $maxDate = filter_input(INPUT_POST, 'maxDate');
    $num = filter_input(INPUT_POST, 'num');
    $summary = filter_input(INPUT_POST, 'summary');
    $picture = filter_input(INPUT_POST, 'picture');
    $oldPicture = filter_input(INPUT_POST, 'oldPicture');
    $categoryID = filter_input(INPUT_POST, 'categoryID');
    $categoryName = filter_input(INPUT_POST, 'categoryName');
    $moreInfo = filter_input(INPUT_POST, 'moreInfo');
    $cardID = strtoupper(filter_input(INPUT_POST, 'cardID'));
    $studentName = filter_input(INPUT_POST, 'studentName');
    $address = filter_input(INPUT_POST, 'address');
    $phoneNumber = filter_input(INPUT_POST, 'phoneNumber');
    $timeBorrow = filter_input(INPUT_POST, 'timeBorrow');
    $sort = filter_input(INPUT_POST, 'sort');
    $userName = filter_input(INPUT_POST, 'userName');
    $password = filter_input(INPUT_POST, 'password');
    $librarianName = filter_input(INPUT_POST, 'librarianName');
    $search = trim(preg_replace('/\s+/', ' ', filter_input(INPUT_POST, 'search')));
    $image_dir_path = getcwd() . '/public/images';
    if (isset($_FILES['picture'])) {
        $fileName = $_FILES['picture']['name'];
        if (!empty($fileName)) {
            $source = $_FILES['picture']['tmp_name'];
            $target = $image_dir_path.'/'. $fileName;
            move_uploaded_file($source, $target);
            $picture = $fileName;
        }
    }else $picture = '';
    $dataForm = array(
        'bookID' => $bookID,
        'bookName' => $bookName,
        'publisher' => $publisher,
        'author' => $author,
        'categoryID' => $categoryID,
        'numOfPage' => $numOfPage,
        'maxDate' => $maxDate,
        'num' => $num,
        'summary' => $summary,
        'picture' => $picture,
        'oldPicture' => $oldPicture,
        'categoryName' => $categoryName,
        'moreInfo' => $moreInfo,
        'cardID' => $cardID,
        'studentName' => $studentName,
        'address' => $address,
        'phoneNumber' => $phoneNumber,
        'timeBorrow' => $timeBorrow,
        'sort' => $sort,
        'valueSearch' => $search,
        'userName' => $userName,
        'password' => $password,
        'librarianName' => $librarianName,
    );
    return $dataForm;
}