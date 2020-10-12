<section>
	<span class="section_title">Добавить оператора</span>
	<form action="/skills/admin/add_operator" method="post">
        <div class="form-group">
            <label for="surname">Enter Surname</label>
            <input type="text" id="surname" class='form-control' name="surname">
        </div>
        <div class="form-group">
            <label for="name">Enter Name</label>
            <input type="text" id="name" class='form-control' name="name">
        </div>
        <div class="form-group">
            <label for="patronymic">Enter Patronymic</label>
            <input type="text" id="patronymic" class='form-control' name="patronymic">
        </div>
            <label for="primary_skill">Enter primary skill</label>
            <br>
            <select class="form-control" name="primary_skill" id='primary_skill'>
                <option value="2">FL_SUP_MCNTT</option>
                <option value="5">FL_MVNO</option>
            </select>
            <br/>
        <button type="submit" class="btn btn-primary">Добавить</button>
		<div class="form-group message"></div>
    </form>
</section>