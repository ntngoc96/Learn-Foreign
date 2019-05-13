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

                $result = $newWord->add();
                if($result){
                    header('Location: index.php?controller=words');
                } else {
                    $this->folder = 'pages';
                    $this->render('error',array('error_name'=>'You can just add 50 words per day'));
                }

            }
        }

        public function getDetail(){
            $word = ModelWord::find($_GET['id']);
            if(!empty($word)){
                    echo <<<_RENDER_WORD_DETAIL
                    <div class="popup__word-detail">
                        <div class="word"> 
                            <span>{$word['Word']}</span>
                        </div>
                        <div class="image">
                            <img src={$word['Image']} width="160" />
                        </div>
                        <div class="describe">
                            <table class="table__describe">
                                <tr>
                                    <th>Example:</th>
                                    <td id="example">
                                        <div class="example">{$word['Example']} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Word Form:</th>
                                    <td id="wordform">
                                        <div class="wordform">{$word['WordForm']} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pronounce:</th>
                                    <td id="pronounce">
                                        <div class="pronounce">{$word['Pronounce']} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kanji:</th>
                                    <td id="kanji">
                                        <div class="kanji">{$word['Kanji']} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Meaning:</th>
                                    <td id="meaning">
                                        <div class="meaning">{$word['Meaning']} </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <audio controls="" class="audio__describe>
                            <source src={$word['Sound']} type="audio/ogg"/>
                            <source src={$word['Sound']} type="audio/mpeg"/>
                        </audio>
                        <span  class="btn--close">&nbsp;&nbsp;X&nbsp;&nbsp;</span>
                    </div>
_RENDER_WORD_DETAIL;
            } else {
                echo 'word is not exist or deleted';
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
                if($_FILES['image']['error'] == '4' && $_FILES['sound']['error'] == '4'){ //both null
                    $listWordId = "'";

                    $result = ModelWord::updateWithoutImageAndSound($_POST['wordid'],$_POST['word'],$_POST['wordform'],$_POST['kanji'],$_POST['pronounce']
                    ,$_POST['meaning'],$_POST['example'],$_SESSION['userid']);
                    if($result){
                        header('Location: index.php?controller=words');
                    } else {
                        $word = ModelWord::find($_POST['wordid']);
                        $data = array('word'=>$word,'errorUpdate'=>'Nothing changed or error sql constraint');
                        $this->render('word_add',$data);
                    }
                } else if($_FILES['image']['error'] == '4'){ //image is null
                    $pathSound = "assets/sounds/words/" . $_FILES['sound']['name'];
                    
                    move_uploaded_file($_FILES['sound']['tmp_name'],$pathSound);

                    $listWordId = "'";

                    $result = ModelWord::updateWithoutImage($_POST['wordid'],$_POST['word'],$_POST['wordform'],$_POST['kanji'],$_POST['pronounce']
                    ,$_POST['meaning'],$_POST['example'],$pathSound,$_SESSION['userid']);

                    if($result){
                        header('Location: index.php?controller=words');
                    } else {
                        $word = ModelWord::find($_POST['wordid']);
                        $data = array('word'=>$word,'errorUpdate'=>'Nothing changed or error sql constraint');
                        $this->render('word_add',$data);
                    }
                } else if($_FILES['sound']['error'] == '4'){ //sound is null
                    $pathImage = "assets/images/words/" . $_FILES['image']['name'];

                    move_uploaded_file($_FILES['image']['tmp_name'],$pathImage);

                    $listWordId = "'";

                    $result = ModelWord::updateWithoutSound($_POST['wordid'],$_POST['word'],$_POST['wordform'],$_POST['kanji'],$_POST['pronounce']
                    ,$_POST['meaning'],$_POST['example'],$pathImage,$_SESSION['userid']);
                    if($result){
                        header('Location: index.php?controller=words');
                    } else {
                        $word = ModelWord::find($_POST['wordid']);
                        $data = array('word'=>$word,'errorUpdate'=>'Nothing changed or error sql constraint');
                        $this->render('word_add',$data);
                    }
                } else {
                    $pathImage = "assets/images/words/" . $_FILES['image']['name'];
                    
                    $pathSound = "assets/sounds/words/" . $_FILES['sound']['name'];
                    
                    move_uploaded_file($_FILES['image']['tmp_name'],$pathImage);
                    
                    move_uploaded_file($_FILES['sound']['tmp_name'],$pathSound);
                    
                    $listWordId = "'";

                    $result = ModelWord::update($_POST['wordid'],$_POST['word'],$_POST['wordform'],$_POST['kanji'],$_POST['pronounce']
                    ,$_POST['meaning'],$_POST['example'],$pathImage,$pathSound,$_SESSION['userid']);
                    if($result){
                        header('Location: index.php?controller=words');
                    } else {
                        $word = ModelWord::find($_POST['wordid']);
                        $data = array('word'=>$word,'errorUpdate'=>'Nothing changed or error sql constraint');
                        $this->render('word_add',$data);
                    }
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
                $listAllWords = ModelWord::allLibrary($listWordId);
                //shuffle rra
                shuffle($listAllWords);

                
                foreach ($listWords as $word) {
                    //add new key to obj
                    $word = (object) array_merge( (array)$word, array( 'isCorrect' => 'true' ) );
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

                $data = array('listQuestions' => $listQuestions);
                
                $this->render('word_test',$data);
            }
        }

        public function getQuestion(){
            if(!isset($_SESSION['userid'])){
                header('Location: index.php?controller=account&action=render_login&type=signin');
            } else {
                $type = $_GET['type'];
                
                unset($_GET['controller']);
                unset($_GET['action']);
                unset($_GET['type']);

                $listWordId = "'";
                $listWords = [];
                $listAllWords = [];
                $listQuestions = [];
                $listTemp = [];
                //make wordid string set
                foreach ($_GET as $item) {
                    $listWordId .= $item . "','";
                }
                $listWordId = rtrim($listWordId,"' ");
                $listWordId = rtrim($listWordId,", ");

                $listWords = ModelWord::getWords($_SESSION['userid'],$listWordId);
                $listAllWords = ModelWord::allLibrary($listWordId);
                //shuffle rra
                shuffle($listAllWords);

                
                foreach ($listWords as $word) {
                    //add new key to obj
                    $word = (object) array_merge( (array)$word, array( 'isCorrect' => 'true' ) );
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

                switch ($type) {
                    case 'meaning':
                        $order = 1;
                        $multiple = 65;
                        echo "<form action='index.php?controller=words&action=getQuestion' class='form-quiz'>";
                        foreach ($listQuestions as $question) {
                            echo "<h3 class='heading-tertiary'>" . $order ." . What is meaning of " . $question[0]->Word ."</h3>";
                            echo "<input type=hidden value='" . $question[0]->WordId . "'/>";
                            shuffle($question);
                            foreach ($question as $miniquestion) {
                                $value = chr($multiple++) . ". " . $miniquestion->Meaning;
                                echo <<<_RENDER_QUESTION
                                <div class="answers">
                                    <input class='form__input' type='radio' name={$order} id={$order}{$multiple} value={$miniquestion->isCorrect} />
                                    <label class="form__label" for={$order}{$multiple} > {$value} </label>
                                </div>
_RENDER_QUESTION;
                                    }
                            $order++;    
                            $multiple = 65;
                }
                        echo "<input type='submit' class='btn btn--gray btn--finish' value='Finish Test'>";
                        echo "</form>";
                        break;
                    case 'pronounce':
                        $order = 1;
                        $multiple = 65;
                        echo "<form action='index.php?controller=words&action=getQuestion' class='form-quiz'>";
                        foreach ($listQuestions as $question) {
                            echo "<h3 class='heading-tertiary'>" . $order ." . What is Pronounce of " . $question[0]->Word ."</h3>";
                            echo "<input type=hidden value='" . $question[0]->WordId . "'/>";
                            shuffle($question);
                            foreach ($question as $miniquestion) {
                                $value = chr($multiple++) . ". " . $miniquestion->Pronounce;
                                echo <<<_RENDER_QUESTION
                                <div class="answers">
                                    <input class='form__input' type='radio' name={$order} id={$order}{$multiple} value={$miniquestion->isCorrect} />
                                    <label class="form__label" for={$order}{$multiple} > {$value} </label>
                                </div>
_RENDER_QUESTION;
                                }
                        $order++;    
                        $multiple = 65;
            }
                        echo "<input type='submit' class='btn btn--gray btn--finish' value='Finish Test'>";
                        echo "</form>";
                        break;
                    case 'kanji':
                        $order = 1;
                        $multiple = 65;
                        echo "<form action='index.php?controller=words&action=getQuestion' class='form-quiz'>";
                        foreach ($listQuestions as $question) {
                            echo "<h3 class='heading-tertiary'>" . $order ." . What is Kanji of " . $question[0]->Word ."</h3>";
                            echo "<input type=hidden value='" . $question[0]->WordId . "'/>";
                            shuffle($question);
                            foreach ($question as $miniquestion) {
                                $value = chr($multiple++) . ". " . $miniquestion->Kanji;
                                echo <<<_RENDER_QUESTION
                                <div class="answers">
                                    <input class='form__input' type='radio' name={$order} id={$order}{$multiple} value={$miniquestion->isCorrect} />
                                    <label class="form__label" for={$order}{$multiple} > {$value} </label>
                                </div>
_RENDER_QUESTION;
                                }
                        $order++;    
                        $multiple = 65;
            }
                        echo "<input type='submit' class='btn btn--gray btn--finish' value='Finish Test'>";
                        echo "</form>";
                        break;
                    
                    default:
                        echo "<h1>Error</h1>";
                        break;
                }
            }
        }


    }
?>

