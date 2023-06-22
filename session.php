<?php

// Start de sessie
session_start();

// Variabelen instellen
$_SESSION['naam'] = 'Ensar Korkmaz';
$_SESSION['email'] = 'ensar7042@gmail.com';

header("Location: variabele.php");
exit;
?>