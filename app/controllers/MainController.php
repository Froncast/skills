<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Pagination;
use app\models\Admin;
use app\models\Ajax;
/**
 * 
 */
class MainController extends Controller
{

    public function indexAction()
    {
        $max = 25;
        $tableSkills = new Admin();
        $pagination = new Pagination($this->route, $tableSkills->countVerSkillsTable(), $max);
        $vars = [
            'pagination' => $pagination->get(),
            'verSkillsTable' => $tableSkills->verSkillsTable($this->route, $max),
        ];
        $this->view->layout = 'main';
        $this->view->render('Main Page', $vars);
    }

    // public function indexAction()
    // {
    //     $max = 25;
    //     $tableSkills = new Admin();
    //     $pagination = new Pagination($this->route, $tableSkills->countVerSkillsTable(), $max);
    //     $vars = [
    //         'pagination' => $pagination->get(),
    //         'verSkillsTable' => $tableSkills->verSkillsTable($this->route, $max),
    //     ];
    //     $this->view->layout = 'main';
    //     $this->view->render('Main Page', $vars);
    // }

}
// if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            
        // }
?>