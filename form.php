<?php
// Shared form + validation used by create.php and edit.php
function validateStudent(array $d): array {
    $err = [];
    if ($d['student_no'] === '') $err[] = 'Student number is required.';
    if ($d['first_name'] === '') $err[] = 'First name is required.';
    if ($d['last_name'] === '') $err[] = 'Last name is required.';
    if (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) $err[] = 'Enter a valid email address.';
    if ($d['course'] === '') $err[] = 'Course is required.';
    if (!in_array((int)$d['year_level'], [1, 2, 3, 4, 5], true)) $err[] = 'Year level must be 1 to 5.';
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $d['birthdate'])) $err[] = 'Birthdate is required.';
    if ($d['contact'] !== '' && !preg_match('/^[0-9+\- ]{7,20}$/', $d['contact'])) $err[] = 'Contact number may only contain digits, +, - and spaces.';
    return $err;
}

function readStudentInput(): array {
    $keys = ['student_no','first_name','last_name','email','course','year_level','birthdate','contact','address'];
    $d = [];
    foreach ($keys as $k) $d[$k] = trim($_POST[$k] ?? '');
    return $d;
}

function renderForm(array $s, array $errors, string $button): void { ?>
<?php if ($errors): ?>
  <div class="alert bad"><ul><?php foreach ($errors as $m): ?><li><?= e($m) ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>
<form method="post" class="card form">
  <div class="grid">
    <label>Student number
      <input name="student_no" value="<?= e($s['student_no']) ?>" maxlength="20" required></label>
    <label>Email
      <input type="email" name="email" value="<?= e($s['email']) ?>" maxlength="120" required></label>
    <label>First name
      <input name="first_name" value="<?= e($s['first_name']) ?>" maxlength="60" required></label>
    <label>Last name
      <input name="last_name" value="<?= e($s['last_name']) ?>" maxlength="60" required></label>
    <label>Course
      <input name="course" value="<?= e($s['course']) ?>" maxlength="100" required></label>
    <label>Year level
      <select name="year_level" required>
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <option value="<?= $i ?>" <?= (int)$s['year_level'] === $i ? 'selected' : '' ?>>Year <?= $i ?></option>
        <?php endfor; ?>
      </select></label>
    <label>Birthdate
      <input type="date" name="birthdate" value="<?= e($s['birthdate']) ?>" required></label>
    <label>Contact number
      <input name="contact" value="<?= e($s['contact']) ?>" maxlength="20"></label>
    <label class="full">Address
      <input name="address" value="<?= e($s['address']) ?>" maxlength="255"></label>
  </div>
  <div class="actions">
    <button class="btn" type="submit"><?= e($button) ?></button>
    <a class="btn ghost" href="index.php">Cancel</a>
  </div>
</form>
<?php }
