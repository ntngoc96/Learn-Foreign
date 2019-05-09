<link rel="stylesheet" href="assets/css/components/button.css">
<link rel="stylesheet" href="assets/css/words/word_add.css">
    <div class="container">
        <a href="index.php?controller=account&action=logout" class="link__logout">Log out</a>
        <a href="index.php?controller=users&action=findById&id=<?php echo $_SESSION['userid']; ?>" class="link__previous">Back to profile</a>
        <section class="section-add-word">
            <div class="form__group form__heading">
                <h2 class="form__heading-primary">
                    Add word
                </h2>
            </div>
            <form action="<?php if (!empty($word)) {
                echo 'index.php?controller=words&action=updateWord';
            } else{
                echo 'index.php?controller=words&action=addWord';
            } ?>" class="form__add-word" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="wordid" value="<?php if(!empty($word)){ echo $word['WordId']; }?>">
                <div class="form__group">
                    <label for="word"class="form__label">Word</label>
                    <input class="form__input" id="word" type="text" name="word" value="<?php if(!empty($word)){ echo $word['Word']; }?>">
                </div>
                <div class="form__group">
                    <label class="form__label">Word Form</label>
                    <div class="form__wordform">
                        <?php if(!empty($word)){
                            switch ($word['WordForm']) {
                                case 'Noun':
                                    echo <<<_RENDER_MALE
                                    <input class="form__input" id="noun" type="radio" value="Noun" name="wordform" checked/>
                                    <label for="noun" class="form__label">
                                        Noun
                                    </label>
                                    <input class="form__input" id="verb" type="radio" value="Verb" name="wordform" />
                                    <label for="verb" class="form__label">
                                        Verb
                                    </label>
                                    <input class="form__input" type="radio" id="adj" value="Adj" name="wordform" />
                                    <label for="adj" class="form__label">
                                        Adj
                                    </label>
                                    <input class="form__input" type="radio" id="adv" value="Adv" name="wordform" />
                                    <label for="adv" class="form__label">
                                        Adv
                                    </label>
_RENDER_MALE;
                                    break;
                                case 'Verb':
                                    echo <<<_RENDER_FEMALE
                                    <input class="form__input" id="noun" type="radio" value="Noun" name="wordform" />
                                    <label for="noun" class="form__label">
                                        Noun
                                    </label>
                                    <input class="form__input" id="verb" type="radio" value="Verb" name="wordform" checked/>
                                    <label for="verb" class="form__label">
                                        Verb
                                    </label>
                                    <input class="form__input" type="radio" id="adj" value="Adj" name="wordform" />
                                    <label for="adj" class="form__label">
                                        Adj
                                    </label>
                                    <input class="form__input" type="radio" id="adv" value="Adv" name="wordform" />
                                    <label for="adv" class="form__label">
                                        Adv
                                    </label>
_RENDER_FEMALE;
                                    break;
                                case 'Adj':
                                    echo <<<_RENDER_OTHER
                                    <input class="form__input" id="noun" type="radio" value="Noun" name="wordform" />
                                    <label for="noun" class="form__label">
                                        Noun
                                    </label>
                                    <input class="form__input" id="verb" type="radio" value="Verb" name="wordform" />
                                    <label for="verb" class="form__label">
                                        Verb
                                    </label>
                                    <input class="form__input" type="radio" id="adj" value="Adj" name="wordform" checked/>
                                    <label for="adj" class="form__label">
                                        Adj
                                    </label>
                                    <input class="form__input" type="radio" id="adv" value="Adv" name="wordform" />
                                    <label for="adv" class="form__label">
                                        Adv
                                    </label>
_RENDER_OTHER;
                                    break;
                                case 'Adv':
                                    echo <<<_RENDER_OTHER
                                    <input class="form__input" id="noun" type="radio" value="Noun" name="wordform" />
                                    <label for="noun" class="form__label">
                                        Noun
                                    </label>
                                    <input class="form__input" id="verb" type="radio" value="Verb" name="wordform" />
                                    <label for="verb" class="form__label">
                                        Verb
                                    </label>
                                    <input class="form__input" type="radio" id="adj" value="Adj" name="wordform" />
                                    <label for="adj" class="form__label">
                                        Adj
                                    </label>
                                    <input class="form__input" type="radio" id="adv" value="Adv" name="wordform" checked/>
                                    <label for="adv" class="form__label">
                                        Adv
                                    </label>
_RENDER_OTHER;
                                    break;
                                
                                default:
                                    
                                    break;
                            }
                        } else {
                            echo <<<_RENDER_DEFAULT
                                    <input class="form__input" id="noun" type="radio" value="Noun" name="wordform" checked/>
                                    <label for="noun" class="form__label">
                                        Noun
                                    </label>
                                    <input class="form__input" id="verb" type="radio" value="Verb" name="wordform" />
                                    <label for="verb" class="form__label">
                                        Verb
                                    </label>
                                    <input class="form__input" type="radio" id="adj" value="Adj" name="wordform" />
                                    <label for="adj" class="form__label">
                                        Adj
                                    </label>
                                    <input class="form__input" type="radio" id="adv" value="Adv" name="wordform" />
                                    <label for="adv" class="form__label">
                                        Adv
                                    </label>
_RENDER_DEFAULT;
                        }
                        
                        ?>
                    </div>
                </div>
                <div class="form__group">
                    <label for="kanji"class="form__label">Kanji</label>
                    <input class="form__input" id="kanji" type="text" name="kanji" value="<?php if(!empty($word)){ echo $word['Kanji']; }?>">
                </div>
                <div class="form__group">
                    <label for="pronounce" class="form__label">Pronounce</label>
                    <input class="form__input" id="pronounce" type="text" name="pronounce" value="<?php if(!empty($word)){ echo $word['Pronounce']; }?>">
                </div>
                <div class="form__group">
                    <label for="meaning"class="form__label">Meaning</label>
                    <input class="form__input" id="meaning" type="text" name="meaning" value="<?php if(!empty($word)){ echo $word['Meaning']; }?>">
                </div>
                <div class="form__group">
                    <label for="example"class="form__label">Example</label>
                    <input class="form__input" id="example" type="text" name="example" value="<?php if(!empty($word)){ echo $word['Example']; }?>">
                </div>
                <div class="form__group">
                    <label for="image"class="form__label">Image</label>
                    <input class="form__input" id="image" type="file" name="image" value="<?php if(!empty($word)){ echo $word['Image']; }?>">
                </div>
                <div class="form__group">
                    <label for="sound"class="form__label">Sound</label>
                    <input class="form__input" id="sound" type="file" name="sound">
                </div>
                <div class="form__button">
                    <input type="submit" class="btn btn--light btn--add" value="Register">
                    <input type="reset" class="btn btn--light btn--clear" value="&nbsp;&nbsp;&nbsp;Clear&nbsp;&nbsp;&nbsp;">
                </div>

               
            </form>
        </section>
    </div>