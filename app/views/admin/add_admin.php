<section>
	<span class="section_title">Добавить администратора</span>
	<form action="/skills/admin/add_admin" method="post">
		<div class="form-group">
			<label for="fullname">Enter fullname</label>
			<input type="fullname" id="fullname" class="form-control" name="fullname">
		</div>
		<div class="form-group">
			<label for="email">Enter email</label>
			<input type="email" id="email" class="form-control" name="email">
		</div>
		<div class="form-group">
			<label for="login">Enter login</label>
			<input type="text" id="login" class="form-control" name="login" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password">Enter password</label>
			<input type="password" id="password" class="form-control" name="password" autocomplete="off">
		</div>
		<button type="submit" class="btn btn-primary">Добавить</button>
		<div class="form-group message"></div>
	</form>
</section>