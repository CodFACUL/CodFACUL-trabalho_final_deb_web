<?php

session_start();
global $pdo;
try {
    $pdo = new PDO("mysql:dbname=trabalho_final;host=localhost", "root", "");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
