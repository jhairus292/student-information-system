<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle ?? 'Student Records') ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="top">
  <div class="wrap bar">
    <a class="brand" href="index.php">Student Records</a>
    <a class="btn" href="create.php">Add student</a>
  </div>
</header>
<main class="wrap">
