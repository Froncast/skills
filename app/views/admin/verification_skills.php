<section>
	<span class="section_title">Верификация Skills</span>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">ФИО Специалиста</th>
				<th scope="col">Список скиллов</th>
				<th scope="col">Метод верификации</th>
				<th scope="col">Тест</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($vars['verSkillsTable'] as $val)
			{
				?>
				<tr id="operator-id-<?php echo $val['id']; ?>">
					<td><?php echo $val['staff_fullname']; ?></td>
					<td>
						<select name="list-skills">
							<?php
							foreach ($val['verSkills'] as $listSkills)
							{
								?>
								<option value="<?php echo $listSkills['skill_id']; ?>"><?php echo $listSkills['title']; ?></option>
								<?php
							}
							?>
						</select>
					</td>
					<td>
						<span id="vm-title">
							<?php
							$vm_title = array_shift($val['verSkills']);
							echo $vm_title['vm_title'];
							?>
						</span>
					</td>
					<td>
						<span id="test-result">
							<?php echo $vm_title['testresult']; ?>
						</span>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<?php echo $pagination; ?>
	<div class="clear" style="clear: both;"></div>
</section>