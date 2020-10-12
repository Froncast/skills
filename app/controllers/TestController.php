<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Test;

/**
 * 
 */
class TestController extends Controller
{
	
	public function testAction()
	{
		$test = $this->model->getCSV($_SERVER['DOCUMENT_ROOT'].'/skills/skills.csv');
		// $this->model->tt($test);
	    $vars = [
	    	'test' => $test,
	    ];
	    $this->view->layout = 'default';
		$this->view->render('Test page', $vars);
		$this->view->layout = 'test';
	}
	
}