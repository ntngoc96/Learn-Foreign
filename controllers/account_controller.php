<?php
    session_start();
    require_once('controllers/base_controller.php');
    require_once('models/Model_Account.php');

    class AccountController extends BaseController{
        function __construct(){
            $this->folder = 'accounts';
        }

        public function index(){
            $this->render('account_index');
        }

        public function registerAccount(){
            $account_id = strip_tags($_POST['account_id']);
            $account_id = addslashes($account_id);
            $password = strip_tags($_POST['password']);
            $password = addslashes($password);
            $result = ModelAccount::register($account_id,$password);
            if($result){
                $_SESSION['userid'] = $result['UserId'];
                header('Location: index.php?controller=users&action=render_updateInformation');
            } else {
                $this->folder = 'pages';
                $this->render('error',array('error_name'=>'Cannot create more account for today'));
            }
        }

        public function render_login(){
            $this->render('account_login');
        }
        public function loginAccount(){
            //prevent user access this route
            if(!isset($_POST['account_id'])){
                $this->render('account_login');
            } else {
                $account_id = strip_tags($_POST['account_id']);
                $account_id = addslashes($account_id);
                $result = ModelAccount::login($_POST['account_id']);
                if(isset($result['AccountId'])){
                    $password = strip_tags($_POST['password']);
                    $password = addslashes($password);
                    $password = md5($password);
                    if($password == $result['Password']){
                        $_SESSION['userid'] = $result['UserId'];
                        header('Location: index.php?controller=users&action=findById&id=' . $result['UserId'] );
                    } else {
                        $data = array(
                            'errorPassword'=>'Wrong password',
                            'type'=>'signin'
                        );
                        $this->render('account_login',$data);
                    }
                } else {
                    $data = array(
                        'errorUsername'=>'Wrong username',
                        'type'=>'signin'
                    );
                    // echo $_POST['account_id'];
                    $this->render('account_login',$data);
                }
            }
        }

        public function logout(){
            unset($_SESSION['userid']);
            header('Location: index.php');
        }

        public function render_changePassword(){
            $this->render('account_update');
        }

        public function changePassword(){
            echo "<pre>";
            print_r($_POST);
            echo "<pre>";
            echo "<pre>";
            print_r($_SESSION);
            echo "<pre>";
            $old = md5($_POST['oldpassword']);
            $new = md5($_POST['newpassword']);
            $result = ModelAccount::changePassword($_SESSION['userid'],$old,$new);
            if($result){
                header('Location: index.php?controller=users&action=findById&id=' . $_SESSION['userid']);
            } else {
                $this->folder = 'pages';
                $this->render('error',array('error_name'=>'Sth get wrong'));
            }
        }
    }
?>