<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Se connecter</title>
	<link href="public/css/style.css" rel="stylesheet" /> 
</head>
<body>

	<div class="in-box" id="login">
		<div class="in-box-header">
			<span>Login</span>
		</div>
		<div class="in-box-content">
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