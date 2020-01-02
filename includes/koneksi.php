<?php
$host = 'localhost'; // Nama hostnya
$username = 'u4580489_dev'; // Username
$password = 'P@ssw0rdmyteacher'; // Password (Isi jika menggunakan password)
$database = 'u4580489_edc'; // Nama databasenya
// Koneksi ke MySQL dengan PDO
$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
