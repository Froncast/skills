<section>
	<span class="section_title">Изменить данные</span>
	<form action="/skills/admin/operators/edit/<?php echo $data['id']; ?>" method="post">
		<div class="form-group">
			<label for="fullname">Укажите ФИО специалиста</label>
			<input type="text" id="fullname" class="form-control" name="fullname" value="<?php echo $data['staff_fullname']; ?>">
		</div>
		<button type="submit" class="btn btn-primary">Изменить</button>
		<div class="form-group message"></div>
	</form>
</section>