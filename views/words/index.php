<?php
// echo '<ul>';
// foreach ($words as $word) {
//   echo '<li>
//     <a href="#">' . $word->Word . '</a>
//   </li>';
// }
// echo '</ul>';
?>

<?php
    // include '../check_session.php';
    // if(!hasSession('userid')){
    //     redirectTo('../html/login.html');
    // }

    // require '../config/sql.php';
    $GLOBALS['count'] = 0;


?>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/components/button.css">
    <link rel="stylesheet" href="assets/css/words/word_index.css">
    <div class="container">
        <section class="section-show-library">
            <a href="index.php?controller=account&action=logout" class="link__logout">Log out</a>
            <form action="index.php?controller=words&action=makeTest" class="form__post-test" id="form__post-test" method="POST">
                <table class="table__show-library" border="1">
                    <legend class="table__caption">Select word to make a test</legend>
                    <tr>
                        <th width="30%">Word</th>
                        <th width="5%">Form</th>
                        <th width="30%">Meaning</th>
                        <th width="5%">Select</th>
                        <th width="30%">Functional</th>
                    </tr>
                    <?php
                        $UserId = $_SESSION['userid'];

                        foreach ($words as $word) {
                                
                                echo <<<_RENDER_WORD
                                <tr>
                                    <td>{$word->Word}</td>
                                    <td>{$word->WordForm}</td>
                                    <td>{$word->Meaning}</td>
                                    <td style="text-align:center">
                                        <input type="checkbox" value="{$word->WordId}" name="{$GLOBALS['count']}" />
                                    </td>
                                    <td>
                                        
                                        <label href="#" class="table__label" for="table__show">Detail</label>
                                        <input type="checkbox" name="show{$GLOBALS['count'] }" id="table__show">
                                        <a href="index.php?controller=words&action=render_updateWord&id={$word->WordId}" class="table__link">Update</a>
                                        <a href="index.php?controller=words&action=deleteWord&id={$word->WordId}" class="table__link">Delete</a>
                                    </td>
                                </tr>
_RENDER_WORD;
                        $GLOBALS['count'] = $GLOBALS['count']+ 1;
                      }
                      if(count($words) < 6){
                        for ($i=0; $i < 6; $i++) { 
                            echo <<<_RENDER_MORE
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
_RENDER_MORE;
                        }
                      }

                    ?>
                    <tr>
                        <td colspan="5">
                            <div class="table__button">
                                <!-- <input type="hidden" name="counter" value=> -->
                                <button type="submit" class = "btn btn--make-test" id="btn--make-test">Make a quiz</button>
                                <button type="submit" class = "btn btn--start-learn" id="btn--start-learn">Learn first &nbsp;&nbsp;</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <div class="link__redirect">
                <a href="index.php?controller=words&action=render_addWord" class="link__items">Add new word</a>
                <a href="index.php?controller=users&action=findById&id=<?php echo $_SESSION['userid'];?>" class="link__items">Back to profile</a>
            </div>
        </section>
    </div>
    <script src="assets/javascripts/words/word_index.js"></script>

    