<?php
$pageTitle = 'Students';
require 'header.php';

$year = (int)($_GET['year'] ?? 0);
if ($year >= 1 && $year <= 5) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE year_level = ? ORDER BY last_name, first_name");
    $stmt->bind_param('i', $year);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $year = 0;
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
    <select name="year" aria-label="Year level">
      <option value="0">All year levels</option>
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <option value="<?= $i ?>" <?= $year === $i ? 'selected' : '' ?>>Year <?= $i ?></option>
      <?php endfor; ?>
    </select>
    <button class="btn" type="submit">Search</button>
  </form>
</div>

<?php if ($msg): ?><div class="alert ok"><?= e($msg) ?></div><?php endif; ?>

<?php if ($result->num_rows === 0): ?>
  <div class="card empty">
    <p><?= $year ? 'No students in Year ' . $year . ' yet.' : 'No student records yet.' ?></p>
    <a class="btn" href="create.php">Add the first student</a>
  </div>
<?php else: ?>
<div class="card table-wrap">
<table>
  <thead>
    <tr><th>Student</th><th>Number</th><th>Course</th><th>Year</th><th>Email</th><th>Contact</th><th>Birthdate</th><th>Actions</th></tr>
  </thead>
  <tbody>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td>
        <div class="person">
          <span class="avatar"><span><?= e(strtoupper(substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1))) ?></span></span>
          <span><strong><?= e($row['first_name']) ?> <?= e($row['last_name']) ?></strong></span>
        </div>
      </td>
      <td><?= e($row['student_no']) ?></td>
      <td><?= e($row['course']) ?></td>
      <td><span class="chip">Year <?= (int)$row['year_level'] ?></span></td>
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
