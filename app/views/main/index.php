<div class="table-wrap">
	<div class="filters-wrap">
		<input type="text" placeholder="search" name="search" class="search">
		<select name="count">
			<option value="1">Lorem ipsum.</option>
			<option value="2">Numquam, quam.</option>
			<option value="3">Expedita, blanditiis.</option>
			<option value="4">Praesentium, hic.</option>
			<option value="5">Tempore, quam.</option>
		</select>
	</div>
	<div class="block_search_result">
		<div class="search_result"></div>
	</div>
	<table>
		<thead>
			<tr>
				<th class="fullname">ФИО Специалиста</th>
				<th class="list_of_skills">Список скиллов</th>
				<th class="ver_m">Метод верификации</th>
				<th class="test_result">Тестирование</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($vars['verSkillsTable'] as $operator): ?>
			<tr>
				<td><?php echo $operator['staff_fullname']; ?></td>
				<td>
					<select name="list_of_skills" data-operator-id=<?php echo $operator['id']; ?>>
						<?php foreach($operator['verSkills'] as $list_of_skills): ?>
						<option value="<?php echo $list_of_skills['skill_id'] ?>"><?php echo $list_of_skills['title']; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
				<td>
					<span class="vm_title"><?php $vm_title = array_shift($operator['verSkills']); echo $vm_title['vm_title']; ?></span>
				</td>
				<td>
					<span class="test_result"><?php echo $vm_title['testresult']; ?></span>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php echo $pagination; ?>
	<div class="clear" style="clear: both;"></div>
</div>