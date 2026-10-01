<?php
$pageTitle = 'Add student';
require 'header.php';
require 'form.php';

$s = ['student_no'=>'','first_name'=>'','last_name'=>'','email'=>'','course'=>'','year_level'=>'1','birthdate'=>'','contact'=>'','address'=>''];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $s = readStudentInput();
    $errors = validateStudent($s);
    if (!$errors) {
        try {
            $stmt = $conn->prepare("INSERT INTO students
                (student_no, first_name, last_name, email, course, year_level, birthdate, contact, address)
                VALUES (?,?,?,?,?,?,?,?,?)");
            $yl = (int)$s['year_level'];
            $stmt->bind_param('sssssisss', $s['student_no'], $s['first_name'], $s['last_name'], $s['email'],
                $s['course'], $yl, $s['birthdate'], $s['contact'], $s['address']);
            $stmt->execute();
            header('Location: index.php?msg=created');
            exit;
        } catch (mysqli_sql_exception $ex) {
            $errors[] = ($ex->getCode() === 1062)
                ? 'That student number already exists.'
                : 'The record could not be saved. Try again.';
        }
    }
}
?>
<h1>Add student</h1>
<?php renderForm($s, $errors, 'Save student'); ?>
<?php require 'footer.php'; ?>
