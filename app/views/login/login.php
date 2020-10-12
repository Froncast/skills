<form action="/skills/login" method="post">
	<img src="./public/img/logo.png">
	<div class="form-group">
		<input type="text" name="login" placeholder="Username" autocomplete="off">
	</div>
	<div class="form-group">
		<input type="password" name="password" placeholder="Password" autocomplete="off">
	</div>
	<button type="submit">Login</button>
	<div class="message"></div>
</form>
<?php
print_r($_SESSION);
?>