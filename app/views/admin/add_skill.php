<section>
	<span class="section_title">Добавить скилл</span>
	<form action="/skills/admin/add_skill" method="post">
		<div class="form-group">
			<label for="skill_title">Enter the name of the skill</label>
			<input type="text" id="skill_title" class="form-control" name="skill_title">
		</div>
		<div class="form-group">
			<label for="list_vm">Specify verification method</label>
			<select name="list_vm" id="list_vm" class="form-control">
				<option value="">Lorem ipsum.</option>
				<option value="">Lorem ipsum.</option>
				<option value="">Lorem ipsum.</option>
				<option value="">Lorem ipsum.</option>
				<option value="">Lorem ipsum.</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Добавить</button>
		<div class="form-group message"></div>
	</form>
</section>