<?php
namespace app\models;
use app\core\Model;
/**
 * 
 */
class Admin extends Model
{

    public $error;
    public $lastId;

    /**
     *  Validate start
     */

    public function validate($input, $post)
    {
        $rules = [
            'email' => [
                'pattern' => '/^([a-z0-9_.-]{3,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$/',
                'message' => 'Invalid email address!',
            ],

            'login' => [
                'pattern' => '/^[a-z]{3,15}$/',
                'message' => 'The login specified is incorrect (only latin letters from 3 to 15 characters are allowed)',
            ],

            'password' => [
                'pattern' => '/^([a-z0-9!_.-]{5,30})$/',
                'message' => 'The password is incorrect (only latin letters and numbers from 5 to 30 characters are allowed)',
            ],
        ];
        
        foreach ($input as $val) {
            if(!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])){
                $this->error = $rules[$val]['message'];
                return false;
            }
            return true;
        }
    }

    /**
     *  Validate end
     */

    /**
     *  Admin auth start
     */

    public function checkData($login, $password)
    {
        $params = [
            'login' => $login,
        ];

        $hash = $this->db->column('SELECT `password` FROM users WHERE `login` = :login', $params);
        if (!$hash or !password_verify($password, $hash)) {
            $this->error = "Username or password are incorrect!";
            return false;
        }
        return true;
    }

    public function adminAuth($login)
    {
        $params = [
            'login' => $login,
        ];

        $data = $this->db->row('SELECT * FROM `users` WHERE `login` = :login', $params);
        $_SESSION['admin'] = $data[0];
        return true;
    }

    /**
     *  Admin auth end
     */
    
    /**
     * Operators
     */
    
    public function select_operators($route, $max)
    {
      
      $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
      ];

      return $results = $this->db->row('SELECT `id`, `staff_fullname` FROM `ot_staff` ORDER BY `staff_fullname` ASC LIMIT :start, :max', $params);
    }

    /**
     *  Verification Skills table start
     */

    public function countVerSkillsTable()
    {
        return $this->db->column('SELECT COUNT(`id`) FROM `ot_staff`');
    }

    public function verSkillsTable($route, $max)
    {
        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];

        $results = $this->db->row('SELECT `id`, `staff_fullname` FROM `ot_staff` ORDER BY `staff_fullname` ASC LIMIT :start, :max', $params);

        foreach ($results as $key => $result) {
            $results[$key]['verSkills'] = $this->db->row('SELECT `hookups`.*, `skills`.`title`, `skills`.`verification_method_id`, `verification_method`.`vm_title` FROM `hookups`
                JOIN `skills` ON `hookups`.`skill_id` = `skills`.`id`
                    JOIN `verification_method` ON `skills`.`verification_method_id` = `verification_method`.`id`
                        WHERE `hookups`.`operator_id` = '.$result['id'].' ORDER BY `skill_id` ASC');
        }
        return $results;
    }

    /**
     *  Verification Skills table end
     */

    /**
     * AddAdmin start
     */

	

    public function checkEmailExists($email)
    {
        $params = [
            'email' => $email,
        ];

        if ($this->db->column('SELECT `email` FROM users WHERE `email` = :email', $params)) {
            $this->error = "This email is already in use!";
            return true;
        }
        return false;
    }

    public function checkLoginExists($login)
    {
        $params = [
            'login' => $login,
        ];

        if ($this->db->column('SELECT `login` FROM users WHERE `login` = :login', $params)) {
            $this->error = "This login is already in use!";
            return true;
        }
        return false;
    }

    public function addAdmin($post)
    {
        $params = [
            'id' => NULL,
            'fullname' => $post['fullname'],
            'email' => $post['email'],
            'login' => $post['login'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
        ];

        if($this->db->query('INSERT INTO users VALUES (:id, :fullname, :email, :login, :password)', $params))
        {
            return true;
        }
        $this->error = "Failed to complete the request. Please try again.";
        return false;
    }

    /**
     * AddAdmin end
     */

     /**    
      * Add Operator
      */

      public function validateAddOperator($input, $post)
      {
        $rules = [
            'surname' => [
                'pattern' => '/^([а-яёА-ЯЁ]{1,20}+)$/u',
                'message' => 'The name is incorrect!',
            ],

            'name' => [
                'pattern' => '/^([а-яёА-ЯЁ]{1,20}+)$/u',
                'message' => 'Surname is incorrect!',
            ],

            'patronymic' => [
                'pattern' => '/^([а-яёА-ЯЁ]{1,20}+)$/u',
                'message' => 'The middle name is incorrect!',
            ],
        ];
        
        foreach ($input as $val) {
            if(!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])){
                $this->error = $rules[$val]['message'];
                return false;
            }
            return true;
        }
      }

    public function stmt_fullname($input, $post)
    {
        $surname = preg_replace('/\s+/', '', $_POST['surname']);
        $name = preg_replace('/\s+/', '', $_POST['name']);
        $patronymic = preg_replace('/\s+/', '', $_POST['patronymic']);
        $fullname = $surname.' '.$name.' '.$patronymic;
        return $fullname;
    }

    public function checkOperatorExists($fullname)
    {
        $params = [
            'fullname' => $fullname,
        ];
        if ($this->db->column('SELECT `staff_fullname` FROM ot_staff WHERE `staff_fullname` = :fullname', $params)) {
            $this->error = "Запись с такими данными уже имеется в базе!";
            return true;
        }
        return false;
    }

    public function addOperator($fullname, $primary_skill)
    {
        $params_operator = [
            'id' => NULL,
            'staff_fullname' => $fullname,
            'subdivisions_id' => 1,
            'presents_id' => 1,
            'partitions_id' => 1,
            'leadings_id' => 1,
            'comments' => 1,
        ];

        if($this->db->query('INSERT INTO ot_staff VALUES (:id, :staff_fullname, :subdivisions_id, :presents_id, :partitions_id, :leadings_id, :comments)', $params_operator))
        {
            $this->lastId = $this->db->lastInsertId();
            $params_skill = [
                'id' => NULL,
                'operator_id' => 1,
                'operator_id' => $this->lastId,
                'skill_id' => $primary_skill,
                'testresult' => NULL,
            ];

            if($this->db->query('INSERT INTO hookups VALUES (:id, :operator_id, :skill_id, :testresult)', $params_skill))
            {
                return true;
            }
        }
        $this->error = "Failed to complete the request. Please try again.";
        return false;
    }

    /** 
     * Edit operator
     */
    
    public function editOperatorValidate($post, $type)
    {
      $fullnameLenght = iconv_strlen($post['fullname']);
      if($fullnameLenght < 10 or $fullnameLenght > 50)
      {
        $this->error = "10 or 50 length";
      }
      return true;
    }

    public function editOperator($post, $id)
    {
        $params = [
          'id' => $id,
          'fullname' => $post['fullname'],
        ];

        $this->db->query('UPDATE `ot_staff` SET `staff_fullname` = :fullname WHERE `ot_staff`.`id` = :id', $params);
    }

    /**
     * Delete Operator
     */
    
    public function isOperatorExists($id)
    {
      $params = [
        'id' => $id,
      ];

      return $this->db->column('SELECT `id` FROM `ot_staff` WHERE id = :id', $params);
    }

    public function operatorDelete($id)
    {
      $params = [
        'id' => $id,
      ];

      $this->db->query('DELETE FROM `ot_staff` WHERE `id` = :id', $params);
    }

    /**
     * operatorData
     */
    
    public function operatorData($id)
    {
      $params = [
        'id' => $id,
      ];

      return $this->db->row('SELECT * FROM `ot_staff` WHERE `id` = :id', $params);
    }

    /**
     * Add skill to operator
     */

     public function checkHookupsExsists($post)
     {
         $params = [
            'operator_id' => $post['list_operators'],
            'skill_id' => $post['list_skills'],
         ];

         return $this->db->column('SELECT `id` FROM `hookups` WHERE `operator_id` = :operator_id AND `skill_id` = :skill_id', $params);
     }

     public function listOperators()
     {
         $result = $this->db->row('SELECT `id`, `staff_fullname` FROM `ot_staff` ORDER BY `staff_fullname` ASC');
         return $result;
     }

     public function listSkills()
     {
         $result = $this->db->row('SELECT `id`, `title` FROM `skills` ORDER BY `id` ASC');
         return $result;
     }

     public function addToSkillOperator($post)
     {
         $test_result = NULL;
         if(!empty($post['test_result']))
         {
            $test_result = $post['test_result'];
         }
         $params = [
            'id' => NULL,
            'operator_id' => $post['list_operators'],
            'skill_id' => $post['list_skills'],
            'test_result' => $test_result."%",
         ];

        if(!$this->db->query('INSERT INTO `hookups` VALUES (:id, :operator_id, :skill_id, :test_result)', $params))
        {
            $this->error = "Failed to complete the request. Please try again.";
            return false;
        }
        return true;
     }

     /**
      * Skills
      */

      public function skills()
      {
          $results = $this->db->row('SELECT * FROM `skills` ORDER BY `id` ASC');

          foreach ($results as $key => $result) {
            $results[$key]['ver_m'] = $this->db->row('SELECT * FROM `verification_method` WHERE id='.$result['verification_method_id']);
          }

          return $results;
      }

      /**
       * Verivication methods
       */
      
      public function ver_m()
      {
        return $result = $this->db->row('SELECT * FROM `verification_method` ORDER BY `id` ASC');
      }

      /**
       * Admin Management
       */
      
      public function admin_list()
      {
        return $result = $this->db->row('SELECT `fullname`, `email`, `login` FROM `users` ORDER BY `fullname` ASC');
      }

      public function testAjax($post)
      {
        $this->view->error('test');
      }

}