<?php
    session_start();
    require_once('controllers/base_controller.php');
    require_once('models/Model_Word.php');

    class WordsController extends BaseController{
        function __construct(){
            $this->folder = 'words';
        }

        public function index(){
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                $words = ModelWord::all($_SESSION['userid']);
                if(count($words) > 0){
                    $data = array('words'=>$words);
                    // echo '<pre>';
                    // echo 'print';   
                    // print_r($data);
                    // echo '</pre>';
                    $this->render('index',$data);
                } else {
                    $this->render('word_add');
                }

            }
        }

        public function render_addWord(){
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                $this->render('word_add');
            }
        }

        public function addWord(){
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';

            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                $path = "assets/images/words/" . $_FILES['image']['name'];

                $pathSound = "assets/sounds/words/" . $_FILES['sound']['name'];

                move_uploaded_file($_FILES['image']['tmp_name'],$path);

                move_uploaded_file($_FILES['sound']['tmp_name'],$pathSound);

                $WordId = chr( mt_rand( 97 ,122 ) ) .substr( md5( time( ) ) ,26 );

                $newWord = new ModelWord($WordId,$_POST['word'],$_POST['wordform'],$_POST['kanji'],
                                            $_POST['pronounce'],$_POST['meaning'],$_POST['example'],$path,$pathSound,$_SESSION['userid']);

                $newWord->add();
                header('Location: index.php?controller=words');

            }
        }

        public function render_updateWord(){
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                //array not object
                $word = ModelWord::find($_GET['id']);
                $data = array('word'=>$word);
                $this->render('word_add',$data);
            }
        }

        public function updateWord(){
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                $listWordId = "'";
                $path = "assets/images/words/" . $_FILES['image']['name'];

                move_uploaded_file($_FILES['image']['tmp_name'],$path);

                $result = ModelWord::update($_POST['wordid'],$_POST['word'],$_POST['wordform'],$_POST['kanji'],$_POST['pronounce']
                ,$_POST['meaning'],$_POST['example'],$path,'add late');
                if($result){
                    header('Location: index.php?controller=words');
                } else {
                    echo "Sth get wrong";
                    $word = ModelWord::find($_POST['wordid']);
                    $data = array('word'=>$word);
                    $this->render('word_add',$data);
                }
            }
        }

        public function deleteWord(){
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                $result = ModelWord::delete($_GET['id'],$_SESSION['userid']);
                if ($result) {
                    header('Location: index.php?controller=words');
                } else {
                    echo 'wrong sw and cannot delete';
                    header('Location: index.php?controller=words');
                }
            }
        }

        public function learn(){
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                $listWordId = "'";

                foreach ($_POST as $item) {
                    $listWordId .= $item . "','";
                }
                $listWordId = rtrim($listWordId,"' ");
                $listWordId = rtrim($listWordId,", ");
                
                $listWords = ModelWord::getWords($_SESSION['userid'],$listWordId);
                
                $data = array('listWords'=>$listWords);

                $this->render('word_learn',$data);
            }
        }

        public function makeTest(){
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                // echo '<pre>';
                // print_r($_POST);
                // echo '</pre>';
                $listWordId = "'";
                $listWords = [];
                $listAllWords = [];
                $listQuestions = [];
                $listTemp = [];
                //make wordid string set
                foreach ($_POST as $item) {
                    $listWordId .= $item . "','";
                }
                $listWordId = rtrim($listWordId,"' ");
                $listWordId = rtrim($listWordId,", ");
                $listWords = ModelWord::getWords($_SESSION['userid'],$listWordId);
                $listAllWords = ModelWord::allLibrary();
                //shuffle rra
                shuffle($listAllWords);

                
                foreach ($listWords as $word) {
                    //add new key to obj
                    $word = (object) array_merge( (array)$word, array( 'isCorrect' => 'true' ) );
                    // echo '<pre>';
                    // echo 'word';
                    // print_r($word);
                    // echo '</pre>';
                    array_push($listTemp,$word);

                    $temp = array_pop($listAllWords);
                    $temp = (object) array_merge( (array)$temp, array( 'isCorrect' => 'false' ) );
                    array_push($listTemp,$temp);

                    $temp = array_pop($listAllWords);
                    $temp = (object) array_merge( (array)$temp, array( 'isCorrect' => 'false' ) );
                    array_push($listTemp,$temp);

                    $temp = array_pop($listAllWords);
                    $temp = (object) array_merge( (array)$temp, array( 'isCorrect' => 'false' ) );
                    array_push($listTemp,$temp);

                    array_push($listQuestions,$listTemp);
                    $listTemp = [];
                }
                // echo '<pre>';
                // echo 'list';
                // print_r($listQuestions);
                // echo '</pre>';

                $data = array('listQuestions' => $listQuestions);

                $this->render('word_test',$data);
            }
        }


    }
?>