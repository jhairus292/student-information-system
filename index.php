<?php
$pageTitle = 'Students';
require 'header.php';

$q = trim($_GET['q'] ?? '');
if ($q !== '') {
    $like = '%' . $q . '%';
    $stmt = $conn->prepare("SELECT * FROM students
        WHERE student_no LIKE ? OR first_name LIKE ? OR last_name LIKE ? OR course LIKE ?
        ORDER BY last_name, first_name");
    $stmt->bind_param('ssss', $like, $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM students ORDER BY last_name, first_name");
}

$messages = [
    'created' => 'Student added.',
    'updated' => 'Changes saved.',
    'deleted' => 'Student deleted.',
];
$msg = $messages[$_GET['msg'] ?? ''] ?? '';
?>
<div class="head">
  <h1>Students <span class="count"><?= $result->num_rows ?></span></h1>
  <form method="get" class="search">
    <input type="search" name="q" value="<?= e($q) ?>" placeholder="Search name, number or course">
    <button class="btn" type="submit">Search</button>
  </form>
</div>

<?php if ($msg): ?><div class="alert ok"><?= e($msg) ?></div><?php endif; ?>

<?php if ($result->num_rows === 0): ?>
  <div class="card empty">
    <p><?= $q !== '' ? 'No students match your search.' : 'No student records yet.' ?></p>
    <a class="btn" href="create.php">Add the first student</a>
  </div>
<?php else: ?>
<div class="card table-wrap">
<table>
  <thead>
    <tr><th>Student no.</th><th>Name</th><th>Course</th><th>Year</th><th>Email</th><th>Contact</th><th>Birthdate</th><th>Actions</th></tr>
  </thead>
  <tbody>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= e($row['student_no']) ?></td>
      <td><strong><?= e($row['last_name']) ?></strong>, <?= e($row['first_name']) ?></td>
      <td><?= e($row['course']) ?></td>
      <td><?= (int)$row['year_level'] ?></td>
      <td><?= e($row['email']) ?></td>
      <td><?= e($row['contact']) ?></td>
      <td><?= e($row['birthdate']) ?></td>
      <td class="row-actions">
        <a class="btn small ghost" href="edit.php?id=<?= (int)$row['id'] ?>">Edit</a>
        <form method="post" action="delete.php" class="inline" data-confirm="Delete <?= e($row['first_name'] . ' ' . $row['last_name']) ?>? This cannot be undone.">
          <input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
          <button class="btn small danger" type="submit">Delete</button>
        </form>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
</div>
<?php endif; ?>
<?php require 'footer.php'; ?>
