# Student Information Management System

A CRUD web application for managing student records.

**Live site:** <paste your InfinityFree URL here>

## Technologies
HTML, CSS, JavaScript, PHP, MySQLi, MySQL, GitHub, InfinityFree

## Features
- Create: add a student with validation
- Read: list all students, with search
- Update: edit a student's details
- Delete: remove a student (with confirmation)

## Files
| File | Purpose |
|---|---|
| config.php | MySQLi connection |
| database.sql | Table structure and sample data |
| index.php | Read / list / search |
| create.php | Create |
| edit.php | Update |
| delete.php | Delete |
| form.php | Shared form and validation |
| header.php, footer.php | Page layout |
| style.css, script.js | Design and client-side behavior |

## Run locally
1. Install XAMPP and start Apache and MySQL.
2. Copy this folder to `C:\xampp\htdocs\student-system`.
3. In phpMyAdmin, create a database named `student_db`, then import `database.sql`.
4. Open http://localhost/student-system/

## Deploy
Upload the files to `htdocs` on InfinityFree, create the MySQL database there,
import `database.sql`, and update the credentials in `config.php`.
