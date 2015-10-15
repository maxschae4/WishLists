<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF8"/>
	<title>Dashboard</title>
</head>
<body>
<a href="/logout">Logout</a>
<h1>Hello <?= $this->session->userdata('userinfo')['username'] ?></h1>
<h3>Your wishlist:</h3>
<table>
	<thead>
		<tr>
			<th>Item</th>
			<th>Added BY</th>
			<th>Date Added</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($my_wishes as $index => $item): ?>
		<tr>
			<td><a href="/items/<?= $item['item_id'] ?>"><?= $item['name'] ?></a></td>
			<td><?= $item['username'] ?></td>
			<td><?= $item['created_at'] ?></td>
			<td>
				<?php 
				if($item['added_by_user_id'] === $this->session->userdata('userinfo')['user_id']) 
				{ ?>
					<a href="/items/delete/<?= $item['item_id'] ?>">Delete</a>
				<?php }
				else 
				{ ?>
					<a href="/items/remove/<?= $item['item_id'] ?>">Remove from my wishlist</a>
				<?php } ?>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<h2>Other users' wishes:</h2>
<table>
	<thead>
		<tr>
			<th>Item</th>
			<th>Added BY</th>
			<th>Date Added</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($other_wishes as $index => $item): ?>
		<tr>
			<td><a href="/items/<?= $item['item_id'] ?>"><?= $item['name'] ?></a></td>
			<td><?= $item['username'] ?></td>
			<td><?= $item['created_at'] ?></td>
			<td><a href="/items/add_to_wishlist/<?= $item['item_id'] ?>">Add to my wishlist!</a></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
	<a href="/items/new">Add Item</a>
</body>
</html>