<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Admin;
use app\lib\Pagination;
/**
 * 
 */
class AdminController extends Controller
{

	public function __construct($route)
	{
		parent::__construct($route);
		if (!isset($_SESSION['admin'])) {
			$this->view->redirect('/login');
		}
		$this->view->layout = 'admin';
	}
	/**
	 * Login start
	 */

	// public function admin_authAction()
	// {
	// 	if (!empty($_POST)) {
	// 		if (!$this->model->validate(['login', 'password'], $_POST)) {
	// 			$this->view->message('error', $this->model->error);
	// 		}
	// 		elseif (!$this->model->checkData($_POST['login'], $_POST['password']))
	// 		{
	// 			$this->view->message('error', $this->model->error);
	// 		}
	// 		if ($this->model->adminAuth($_POST['login'])) {
	// 			$this->view->redirect('/admin');
	// 		} else
	// 		{
	// 			$this->view->message('error', 'Failed to complete the request. Please try again.');
	// 		}
	// 	}
	// 	$this->view->layout = 'admin_auth';
	// 	$this->view->render('Панель Администратора | Авторизация');
	// }

	/**
	 * Main page
	 */

	public function indexAction()
	{
		if (!empty($_POST)) {
			$this->model->adminAuth($_POST);
		}
		$this->view->layout = 'admin';
		$this->view->render('Admin Page');
	}

	/**
	 * Operators
	 */
	
	public function operatorsAction()
	{
		$max = 25;
		$pagination = new Pagination($this->route, $this->model->countVerSkillsTable(), $max);
		$vars = [
			'pagination' => $pagination->get(),
			'operators' => $this->model->select_operators($this->route, $max),
		];
		$this->view->render('Панель Администратора | Операторы', $vars);
	}

	/**
	 * Verification Skills
	 */

	public function verification_skillsAction()
	{
		$this->view->layout = 'admin';
		$max = 14;
		$pagination = new Pagination($this->route, $this->model->countVerSkillsTable(), $max);
		$vars = [
			'pagination' => $pagination->get(),
			'verSkillsTable' => $this->model->verSkillsTable($this->route, $max),
		];

		$this->view->render("Панель Администратора | Верификация Skills", $vars);
	}

	/**
	 * Add admin
	 */

	public function add_adminAction()
	{
		if (!empty($_POST))
		{
			if(!$this->model->validate(['email', 'login', 'password'], $_POST))
			{
				$this->view->message('error', $this->model->error);
			} 
			elseif ($this->model->checkEmailExists($_POST['email'])) {
				$this->view->message('error', $this->model->error);
			}
			elseif ($this->model->checkLoginExists($_POST['login'])) {
				$this->view->message('error', $this->model->error);
			}
			if ($this->model->addAdmin($_POST))
			{
				$this->view->message('success', 'Admin added!');
			} else
			{
				$this->view->message('success', $this->model->error);
			}
		}
		$this->view->layout = 'admin';
		$this->view->render("Панель администратора | Добавить админа");
	}

	/**
	 * Logout
	 */

	public function logoutAction()
	{
		unset($_SESSION['admin']);
		$this->view->redirect('/login');
	}

	/** 
	 * Add Operator
	*/

	public function add_operatorAction()
	{
		if(!empty($_POST))
		{
			$stmt_fullname = $this->model->stmt_fullname(['surname', 'name', 'patronymic'], $_POST);
			if(!$this->model->validateAddOperator(['surname', 'name', 'patronymic', 'primary_skills'], $_POST))
			{
				$this->view->message('error', $this->model->error);
			} elseif($this->model->checkOperatorExists($stmt_fullname))
			{
				$this->view->message('error', $this->model->error);
			}
			if(!$this->model->addOperator($stmt_fullname, $_POST['primary_skill']))
			{
				$this->view->message('error', $this->model->error);
			} else
			{
				$this->view->message('success', 'Operator added!');
			}
		}
		$this->view->layout = 'admin';
		$this->view->render("Панель администратора | Добавить оператора");
	}

	/**	
	 * Edit operator
	 */

	public function editOperatorAction()
	{
		if(!$this->model->isOperatorExists($this->route['id']))
		{
			$this->view->errorCode(404);
		}
		if(!empty($_POST))
		{
			if(!$this->model->editOperatorValidate($_POST, 'edit'))
			{
				$this->model->message('error', $this->model->error);
			}
			$this->model->editOperator($_POST, $this->route['id']);
			$this->view->message('success', 'Save');
		}
		$vars = [
			'data' => $this->model->operatorData($this->route['id'])[0],
		];
		$this->view->render('Admin Panel | Edit operator', $vars);
	}

	/**
	 * Delete operator
	 */
	
	public function delete_operatorAction()
	{
		if(!$this->model->isOperatorExists($this->route['id']))
		{
			$this->view->errorCode(404);
		}
		$this->model->operatorDelete($this->route['id']);
		$this->view->redirect('/admin/operators');
	}

	/**
	 * Add skill to operator
	 */

	 public function add_skill_to_operatorAction()
	 {
		if(!empty($_POST))
		{
			if($this->model->checkHookupsExsists($_POST))
			{
				$this->view->message('error', 'Such an entry is already in the database! Please do not duplicate information!');
				return false;
			}
			$this->model->addToSkillOperator($_POST);
			$this->view->message('success', 'Record added!');
		}
		$list_operators = $this->model->listOperators();
		$list_skills = $this->model->listSkills();
		$vars = [
			'list_operators' => $list_operators,
			'list_skills' => $list_skills,
		];
		$this->view->layout = 'admin';
		$this->view->render("Панель администратора | Добавить скилл оператору", $vars);
	 }

	 /**
	  * skillsAction
	  */
	  
	  public function skillsAction()
	  {
		$skills = $this->model->skills();
		$vars = [
			'skills' => $skills,
		];
		$this->view->layout = 'admin';
		$this->view->render("Панель администратора | Скиллы", $vars);
	  }

	  public function add_skillAction()
	  {
	  	$this->view->layout = 'admin';
		$this->view->render("Панель администратора | Добавить скилл");
	  }

	  /**
	   * verification_methods
	   */
	  
	  public function verification_methodsAction()
	  {
	  	$ver_m = $this->model->ver_m();
	  	$vars = [
	  		'ver_m' => $ver_m,
	  	];
		$this->view->render("Панель администратора | Методы верификации", $vars);
	  }

	  /**
	   * Admin_management
	   */
	  
	  public function admin_managementAction()
	  {
	  	$admin_list = $this->model->admin_list();
	  	$vars = [
	  		'admin_list' => $admin_list,
	  	];
	  	$this->view->render("Панель администратора | Администраторы", $vars);
	  }

}

?>