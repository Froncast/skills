<?php

namespace app\models;
use app\core\Model;
/**
 * 
 */
class Ajax extends Model
{
	public function search($post)
	{
		$params = [
			'like' => '%'.$post.'%',
		];

		$results = $this->db->row('SELECT `id`, `staff_fullname` FROM `ot_staff` WHERE `staff_fullname` LIKE :like', $params);

        foreach ($results as $key => $result) {
            $results[$key]['verSkills'] = $this->db->row('SELECT `hookups`.*, `skills`.`title`, `skills`.`verification_method_id`, `verification_method`.`vm_title` FROM `hookups`
                JOIN `skills` ON `hookups`.`skill_id` = `skills`.`id`
                    JOIN `verification_method` ON `skills`.`verification_method_id` = `verification_method`.`id`
                        WHERE `hookups`.`operator_id` = '.$result['id'].' ORDER BY `skill_id` ASC');
        }
        if (!empty($results)) {
        	json_encode(['status' => true]);
			return $results;
		} else{
			return false;
		}
	}

	public function checkSkillData($post)
	{
		$params = [
			'operatorId' => $post['operatorId'],
			'skillId' => $post['skillId'],
		];

		$results = $this->db->row('SELECT `hookups`.`testresult`, `skills`.`verification_method_id`, `verification_method`.`vm_title` FROM `hookups` 
				JOIN `skills` ON `hookups`.`skill_id` = `skills`.`id`
					JOIN `verification_method` ON `skills`.`verification_method_id` = `verification_method`.`id`
						WHERE `operator_id` = :operatorId AND `skill_id` = :skillId', $params);
		if(!empty($results)){
			return $results;
		} else{
			return false;
		}
	}
}

?>