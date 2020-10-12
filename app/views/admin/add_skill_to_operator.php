<section>
	<span class="section_title">Добавить оператора</span>
	<form action="/skills/admin/add_skill_to_operator" method="post">
        <div class="form-group">
            <label for="list_operators">Choose an operator</label>
            <select class="form-control" name="list_operators" id="list_operators">
            <?php
                foreach($vars['list_operators'] as $operators)
                {
            ?>
                <option value="<?php echo $operators['id']; ?>"><?php echo $operators['staff_fullname']; ?></option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="list_skills">Choose skill</label>
            <select class="form-control" name="list_skills" id="list_skills">
            <?php
                foreach($vars['list_skills'] as $operators)
                {
            ?>
                <option value="<?php echo $operators['id']; ?>"><?php echo $operators['title']; ?></option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="test_result">Test results</label>
            <input type="number" min="0" max="100" class="form-control" name="test_result" id="test_result">
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
		<div class="form-group message"></div>
    </form>
</section>