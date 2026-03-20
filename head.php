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

<header>
	<nav>
		<div style="display: flex; align-items: center; gap: 1rem;">
			<img src="img/logo-big-v2.png" alt="Logo" style="max-width: 60px; height: auto;">
			<div style="font-size: 1.5rem; font-weight: bold; background: linear-gradient(135deg, #22c55e 0%, #fbbf24 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
				📋 Takenlijst App
			</div>
		</div>
		<ul>
			<li><a href="index.php">🏠 Home</a></li>
			<li><a href="create.php">✨ Nieuwe Taak</a></li>
		</ul>
	</nav>
</header>

<!-- hier komt informatie over de website en waarvoor hij bedoelt is -->
