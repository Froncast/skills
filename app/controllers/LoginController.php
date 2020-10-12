<?php 

namespace app\controllers;

use app\core\Controller;

class LoginController extends Controller
{
    public function loginAction()
    {
        if(isset($_SESSION['admin'])){
            $this->view->redirect('/admin');
        }
        if(!empty($_POST)){
            if(!$this->model->validate(['login', 'password'], $_POST)){
                $this->view->message('error', $this->model->error);
            }
            elseif (!$this->model->checkdata($_POST['login'], $_POST['password'])) {
                $this->view->model('error', $this->model->error);
            }
            if($this->model->adminAuth($_POST['login'])){
                $this->view->redirect('/admin');
            } else{
                $this->view->message('error', 'Failed to complete the request. Please try again.');
            }
        }
        $this->view->layout = 'admin_auth';
        $this->view->render('Авторизация | Панель Администратора');
    }
}