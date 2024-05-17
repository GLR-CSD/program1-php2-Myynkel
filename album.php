<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$formValues = $_SESSION['formValues'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['formValues']);

require_once 'db.php';
require_once 'classes/Album.php';

$albums = album::getAll($db);

include 'views/album_view.php';
