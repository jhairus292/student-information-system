<?php
$pageTitle = 'Edit student';
require 'header.php';
require 'form.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$s = $stmt->get_result()->fetch_assoc();

if (!$s) {
    echo '<div class="alert bad">Student not found.</div><a class="btn" href="index.php">Back to list</a>';
    require 'footer.php';
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $s = readStudentInput();
    $errors = validateStudent($s);
    if (!$errors) {
        try {
            $stmt = $conn->prepare("UPDATE students SET student_no=?, first_name=?, last_name=?, email=?,
                course=?, year_level=?, birthdate=?, contact=?, address=? WHERE id=?");
            $yl = (int)$s['year_level'];
            $stmt->bind_param('sssssisssi', $s['student_no'], $s['first_name'], $s['last_name'], $s['email'],
                $s['course'], $yl, $s['birthdate'], $s['contact'], $s['address'], $id);
            $stmt->execute();
            header('Location: index.php?msg=updated');
            exit;
        } catch (mysqli_sql_exception $ex) {
            $errors[] = ($ex->getCode() === 1062)
                ? 'That student number already exists.'
                : 'The changes could not be saved. Try again.';
        }
    }
}
?>
<h1>Edit student</h1>
<?php renderForm($s, $errors, 'Save changes'); ?>
<?php require 'footer.php'; ?>
