<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Se connecter</title>
</head>
<body>

	<div id="login">
		<div>
			<span>Login</span>
		</div>
		<div>
			<form method="post" action="index.php?action=login">
				<p><label for="pseudo">Pseudo:</label><br />
				<input type="text" name="pseudo" placeholder="Pseudo"></p>
				<p><label for="pass">Mot de passe:</label><br />
				<input type="password" name="pass" placeholder="Mot de passe"></p>
				<button type="submit">Se connecter</button>
			</form>
		</div>

	</div>

</body>
</html>