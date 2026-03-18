<?php
$configPath = __DIR__ . '/backend/config.php';
$configExamplePath = __DIR__ . '/backend/config.example.php';

if (file_exists($configPath)) {
	require_once $configPath;
} elseif (file_exists($configExamplePath)) {
	require_once $configExamplePath;
} else {
	die('Missing backend/config.php (and config.example.php)');
}
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo $base_url; ?>/css/normalize.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>/css/main.css">

</div class ="nav">
<nav>
<a href="inlog.php">Home</a>
<a href="statestiek.php">Statestieken</a>
<a href="planbord.php">Planbord</a>
</nav>
</div>

<h1>Planning app </h1>


<!-- hier komt informatie over de website en waarvoor hij bedoelt is -->
