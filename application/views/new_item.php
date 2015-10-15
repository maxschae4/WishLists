<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF8"/>
	<title>New Item</title>
</head>
<body>
	<a href="/">Home</a>
	<a href="/logout">Logout</a>
	<h1>Create a new wishlist item</h1>
	<?= $this->session->flashdata('errors') ?>
	<form action="/items/create" method="post">
		<label>Item/Products<input type="text" name="item"></label>
		<button>Submit</button>
	</form>
</body>
</html>