<link rel="stylesheet" href="assets/css/components/button.css">
<link rel="stylesheet" href="assets/css/components/navigation.css">
<link rel="stylesheet" href="assets/css/words/word_test.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
    <div class="container"> 
        <div class="navigation">
            <input type="checkbox" class="navigation__checkbox" id="navi-toggle">
            
            <label for="navi-toggle" class="navigation__button">
                <span class="navigation__icon">&nbsp;</span>
            </label>

            <!-- <div class="navigation__background">&nbsp;</div> -->

            <nav class="navigation__nav">
                <ul class="navigation__list">
                        <li class="navigation__item"><a href="index.php?controller=words" class="navigation__link"><span>01</span> Mangager word library</a></li>
                        <li class="navigation__item"><a href="index.php?controller=words&action=render_addWord" class="navigation__link"><span>02</span> Add new word</a></li>
                        <li class="navigation__item"><a href="index.php?controller=words" class="navigation__link"><span>03</span> Make a test</a></li>
                        <li class="navigation__item"><a href="#" class="navigation__link"><span class="span1">04</span> Ranking</a></li>
                        <li class="navigation__item"><a href="index.php?controller=users&action=render_updateInformation" class="navigation__link"><span class="span1">05</span> Update Information</a></li>
                        <li class="navigation__item"><a href="index.php?controller=account&action=logout" class="navigation__link"><span class="span1">06</span> Log out</a></li>
                </ul>
            </nav>
        </div>
        <header class="header">
            <h1 class="heading-primary">
                grammar quiz
            </h1>
        </header>
        <section class="section-quiz">
            <form action="" class="form-quiz">
                <?php
                $order = 1;
                $multiple = 65;
                foreach ($listQuestions as $question) {
                    echo "<h3 class='heading-tertiary'>" . $order ." . What is meaning of " . $question[0]->Word ."</h3>";
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
                ?>
                <input type="submit" class="btn btn--gray btn--finish" value="Finish Test">
            </form>
        </section>
            <div class="popup">
                <div class="popup__header">
                    Score!!!
                </div>
                <div class="score">
                    200
                </div>
                <div class="result">
                    18/20
                </div>
                <button class="btn btn-close">Return to the test</button>
            </div>
    </div>
    <script src="assets/javascripts/words/word_test.js"></script>