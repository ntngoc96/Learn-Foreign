<?php
    session_start();
    require_once('controllers/base_controller.php');
    require_once('models/Model_User.php');
    require_once('models/Model_School.php');

    class UsersController extends BaseController{
        function __construct(){
            $this->folder = 'users';
        }
        //admin route
        public function index(){
            $users = ModelUser::all();
            // echo '<pre>';
            // print_r($users);
            // echo '</pre>';
            $data = array('users' => $users);
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            $this->render('index',$data);
        }

        public function findById(){

            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                //user cannot see other users
                if($_SESSION['userid'] != $_GET['id']){
                    header('Location: index.php?controller=users&action=findById&id=' . $_SESSION['userid']);
                } else {
                    //because extract in base_controller will destructor this array
                    //so please don't make a mistake
                    $user1 = ModelUser::find($_GET['id']);
                    // echo '<pre>';
                    // print_r($user);
                    // echo '</pre>';
                    $data = array('user' => $user1);
                    // echo '<pre>';
                    // echo 'before';
                    // print_r($data);
                    // echo '</pre>';
                    $this->render('user_information',$data);
                }
            }
        }

        public function render_updateInformation(){
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                $user = ModelUser::find($_SESSION['userid']);
                $school = ModelSchool::getAll();
                $data = array('user' => $user,'schools'=>$school);
            //     echo '<pre>';
            // echo 'session is0;';
            // print_r($data);
            // echo '</pre>';
                $this->render('update_information',$data);
            }
        }
        public function updateInformation(){
            // echo '<pre>';
            // echo 'session is0;';
            // print_r($_SESSION);
            // echo '</pre>';
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                if(!empty($_POST)){
                    $path = 'assets/images/' . $_FILES['avatar']['name'];

                    move_uploaded_file($_FILES['avatar']['tmp_name'],$path);
                    //handle sql exception
                    ModelUser::update($_SESSION['userid'],$_POST['full_name'],$_POST['dob'],$_POST['gender'],$_POST['address'],$_POST['school_id'],$path);
                    
                    $user = ModelUser::find($_SESSION['userid']);
                    $school = ModelSchool::getAll();
                    $data = array('user' => $user,'schools'=>$school);

                    $this->render('user_information',$data);
                } else {
                    header('Location: index.php?controller=users&action=render_updateInformation');
                }
            }
        }


    }
?>