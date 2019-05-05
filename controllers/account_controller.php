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
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';
            $result = ModelAccount::register($_POST['account_id'],$_POST['password']);
            if($result){
                $this->folder= 'users';
                $_SESSION['userid'] = $result['UserId'];
                $this->render('update_information');
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
                $result = ModelAccount::login($_POST['account_id']);
                if(isset($result['AccountId'])){
                    $password = md5($_POST['password']);
                    if($password == $result['Password']){
                        $_SESSION['userid'] = $result['UserId'];
                        header('Location: index.php?controller=users&action=findById&id=' . $result['UserId'] );
                    } else {
                        echo "Wrong password";
                        $this->render('account_login');
                    }
                } else {
                    echo "Wrong username";
                    // echo $_POST['account_id'];
                    $this->render('account_login');
                }
            }
        }

        public function logout(){
            unset($_SESSION['userid']);
            header('Location: index.php');
        }
    }
?>