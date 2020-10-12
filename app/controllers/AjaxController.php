<?php

namespace app\controllers;

use app\core\Controller;

/**
 * 
 */
class AjaxController extends Controller
{
	
	function ajaxAction(){
		if(isset($_POST['searchVal']) && !empty($_POST['searchVal'])){
			$results = $this->model->search($_POST['searchVal']);
			if($results){
				?>
				<p>Результаты поиска</p>
				<table>
				<tbody>
				<thead>
					<tr>
						<th class="fullname">ФИО Специалиста</th>
						<th class="list_of_skills">Список скиллов</th>
						<th class="ver_m">Метод верификации</th>
						<th class="test_result">Тестирование</th>
					</tr>
				</thead>
		<?php
				foreach ($results as $result): ?>

				<tr>
					<td><?php echo $result['staff_fullname']; ?></td>
					<td>
						<select name="list_of_skills" data-operator-id=<?php echo $result['id']; ?>>
							<?php foreach($result['verSkills'] as $list_of_skills): ?>
							<option value="<?php echo $list_of_skills['skill_id'] ?>"><?php echo $list_of_skills['title']; ?></option>
							<?php endforeach; ?>
						</select>
					</td>
					<td>
						<span class="vm_title"><?php $vm_title = array_shift($result['verSkills']); echo $vm_title['vm_title']; ?></span>
					</td>
					<td>
						<span class="test_result"><?php echo $vm_title['testresult']; ?></span>
					</td>
				</tr>

				<?php endforeach; ?>
<?php
			echo "</tbody>";
			echo "</table>";
			} else{
				echo "<p>В результате поиска ничего не найдено...</p>";
			}
		}

		if(isset($_POST['checkDataSkill']) && !empty($_POST)){
			$results = $this->model->checkSkillData($_POST);
			exit(json_encode(['testresult' => $results[0]['testresult'], 'vm_title' => $results[0]['vm_title']]));
			// print_r($results);
			// print_r($results[0]['testresult']);
			// print_r($results);
			// print_r($skillId);
		}

		// if (isset($_POST['getXlsx']) || $_POST['getXlsx'] == true) {
		// 	print_r($_POST);
		// }
	}

}

// foreach ($results as $result) {
				// 	echo "<table>";
				// 	echo "<tbody>";
				// 	echo "<tr>";
				// 	echo "<td>";
				// 	echo $result['staff_fullname'];
				// 	echo "</td>";
				// 	echo "</tr>";
				// 	echo "<tbody>";
				// 	echo "</table>";
				// }