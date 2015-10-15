<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF8"/>
	<title><?= $item['name'] ?></title>
</head>
<body>
	<a href="/">Home</a>
	<a href="/logout">Logout</a>
	<h1><?= $item['name'] ?></h1>
	<h3>Users who added this item to their wishlist are:</h3>
	<?php foreach ($wishers as $index => $wisher): ?>
		<p><?= $wisher['name'] ?></p>
	<?php endforeach ?>
</body>
</html>