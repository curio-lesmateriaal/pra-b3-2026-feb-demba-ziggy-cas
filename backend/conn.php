<?php

//Haal de configuratie op
$configPath = __DIR__ . '/config.php';
$configExamplePath = __DIR__ . '/config.example.php';

if (file_exists($configPath)) {
	require_once $configPath;
} else {
	require_once $configExamplePath;
}

//Met behulp van PDO zetten we de connectie op, waarna we met setAttribute de manier van errormeldingen weergeven bepalen.
$conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
