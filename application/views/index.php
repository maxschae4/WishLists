<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF8"/>
	<title>Welcome</title>
</head>
<body>
	<h1>Welcome</h1>
	<?=	$this->session->flashdata('errors') ?>
	<form action="/register" method="post">
		<fieldset>
			<legend>Register</legend>
			<label>Name: <input type="text" name="name"></label>
			<label>Username: <input type="text" name="username"></label>
			<label>Email: <input type="email" name="email"></label>
			<label>Password: <input type="password" name="password"></label>
			<p>password must be at least 8 characters</p>
			<label>Confirm Password	: <input type="password" name="passconf"></label>
			<label>Hire Date: <input type="date" name="hire_date"></label>
			<button>Register</button>
		</fieldset>
	</form>
	<form action="/login" method="post">
		<fieldset>
			<legend>Login</legend>
			<label>username: <input type="text" name="username"></label>
			<label>password: <input type="password" name="password"></label>
			<button>Login</button>
		</fieldset>
	</form>

</body>
</html>