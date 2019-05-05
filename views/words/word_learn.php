
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
    <link rel="stylesheet" href="assets/css/components/navigation.css">
    <link rel="stylesheet" href="assets/css/words/word_learn.css"/>
    <link rel="stylesheet" href="assets/css/components/button.css"/>
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
        <form class="form" action="index.php?controller=words&action=makeTest" method="post">
            <?php
                $count = 1;
                $GLOBALS['count'] = 0;

                foreach ($listWords as $word ) {
                    if($count == 1){
                        $count = 2;
                        echo "<div class='wrapper actived'>";
                    } else {
                        echo "<div class='wrapper'>";
                    }
                    echo <<<_RENDER_LEARN
                    <div class="word"> 
                        <span>{$word->Word}</span>
                    </div>
                    <div class="image">
                        <img src={$word->Image} width="160" />
                    </div>
                    <div class="describe">
                        <table>
                            <tr>
                                <th>Example:</th>
                                <td id="example">
                                    <div class="example">{$word->Example} </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Word Form:</th>
                                <td id="wordform">
                                    <div class="wordform">{$word->WordForm} </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Pronounce:</th>
                                <td id="pronounce">
                                    <div class="pronounce">{$word->Pronounce} </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Kanji:</th>
                                <td id="kanji">
                                    <div class="kanji">{$word->Kanji} </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Meaning:</th>
                                <td id="meaning">
                                    <div class="meaning">{$word->Meaning} </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                        <audio controls="">
                            <source src={$word->Sound} type="audio/ogg"/>
                            <source src={$word->Sound} type="audio/mpeg"/>
                        </audio>
                    <div class="button">
                        <i class="fas fa-arrow-left left"></i>
                        <i class="fas fa-arrow-right right"></i>
                    </div>
                        <input type="text" name={$GLOBALS['count']} value = {$word->WordId} style="visibility:hidden;" />
                    </div>
_RENDER_LEARN;
                $GLOBALS['count'] = $GLOBALS['count']+ 1;
                }
            ?>
            <button class="btn btn--primary btn--value" type="submit">Make quiz</button>
        </form>
    <script src="assets/javascripts/words/word_learn.js"></script>
</body>
</html>