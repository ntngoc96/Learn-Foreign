<?php
    class ModelWord{
        public $WordId;
        public $Word;
        public $WordForm;
        public $Kanji;
        public $Pronounce;
        public $Meaning;
        public $Example;
        public $Image;
        public $Sound;
        public $UserId;

        public function __construct(
            $_WordId,
            $_Word,
            $_WordForm,
            $_Kanji,
            $_Pronounce,
            $_Meaning,
            $_Example,
            $_Image,
            $_Sound,
            $_UserId)
            {
                $this->WordId = $_WordId;
                $this->Word = $_Word;
                $this->WordForm = $_WordForm;
                $this->Kanji = $_Kanji;
                $this->Pronounce = $_Pronounce;
                $this->Meaning = $_Meaning;
                $this->Example = $_Example;
                $this->Image = $_Image;
                $this->Sound = $_Sound;
                $this->UserId = $_UserId;
        }
        
        static function find($id){
            require('configuration.php');
            $sqlFindOne = "SELECT * FROM Vocabulary WHERE WordId LIKE :id";
            $data = [
                ':id'=>$id
            ];

            $req = $db->prepare($sqlFindOne);
            $req->execute($data);
            $item = $req->fetch();
            // echo '<pre>';
            // echo 'im réuklt';
            // print_r($item);
            // echo '</pre>';
            if(isset($item['Word'])){
                return $item;
            } else {
                return null;
            }
        }

        static function all($userid){
            $listWords = [];
            require_once('configuration.php');

            $sqlSelectAllWordWithUserId = 'SELECT * FROM Vocabulary WHERE User_UserId LIKE :UserId';

            $data = [
                ':UserId'=>$userid
            ];
            //using placeholder to keep a sit. It help to avoid SQL Injection attack
            try {
                $req = $db->prepare($sqlSelectAllWordWithUserId);
                $req->execute($data);
                
                foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $item) {

                    $listWords[] = new ModelWord($item['WordId'],$item['Word'],$item['WordForm']
                    ,$item['Kanji'],$item['Pronounce'],$item['Meaning'],$item['Example'],$item['Image'],'add late',$item['User_UserId']);
                }
                
                return $listWords;
            } catch (PDOException $e) {
                print $e->getMessage ();
                return null;
            }

        }

        static function allLibrary(){
            $listWords = [];
            $db = DB::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlSelectAllWords = 'SELECT * FROM Vocabulary';

            //using placeholder to keep a sit. It help to avoid SQL Injection attack
            try {
                $req = $db->prepare($sqlSelectAllWords);
                $req->execute();
                
                foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $item) {

                    $listWords[] = new ModelWord($item['WordId'],$item['Word'],$item['WordForm']
                    ,$item['Kanji'],$item['Pronounce'],$item['Meaning'],$item['Example'],$item['Image'],'add late',$item['User_UserId']);
                }
                
                return $listWords;
            } catch (PDOException $e) {
                print $e->getMessage ();
                return null;
            }

        }
        
        public function add(){
            require_once('configuration.php');
            $sqlAddWord = 'INSERT INTO Vocabulary(WordId,Word,WordForm,Kanji,Pronounce,Meaning,Example,Image,Sound,User_UserId)
            VALUES (:WordId,:Word,:WordForm,:Kanji,:Pronounce,:Meaning,:Example,:Image,:Sound,:UserId);';

            $data = [
                ':WordId'=>$this->WordId,
                ':Word'=>$this->Word,
                ':WordForm'=>$this->WordForm,
                ':Kanji'=>$this->Kanji,
                ':Pronounce'=>$this->Pronounce,
                ':Meaning'=>$this->Meaning,
                ':Example'=>$this->Example,
                ':Image'=>$this->Image,
                ':Sound'=>$this->Sound,
                ':UserId'=>$this->UserId
            ];

            try {
                $req = $db->prepare($sqlAddWord);

                $req->execute($data);
            } catch (PDOException $e) {
                print $e->getMessage ();
            }
        }
        //lo tay viet argument bang camel @@ 
        static function update($WordId,$Word,$WordForm,$Kanji,$Pronounce,$Meaning,$Example,$Image,$Sound){
            echo $WordForm;
            require_once('configuration.php');
            // $sqlUpdateUser = "UPDATE User
            // SET FullName=:FullName, Dob=:Dob,Gender=:Gender,Address=:Address,School_Id=:SchoolId,Avatar=:Avatar
            // WHERE User.UserId LIKE :UserId";
            $sqlUpdateWord = 'UPDATE Vocabulary 
            SET Word=:Word,WordForm=:WordForm,Kanji=:Kanji,Pronounce=:Pronounce,Meaning=:Meaning,Example=:Example,Image=:Image,Sound=:Sound
            WHERE WordId LIKE :WordId';

            $data = [
                'Word'=>$Word,
                'WordForm'=>$WordForm,
                'Kanji'=>$Kanji,
                'Pronounce'=>$Pronounce,
                'Meaning'=>$Meaning,
                'Example'=>$Example,
                'Image'=>$Image,
                'Sound'=>$Sound,
                'WordId'=>$WordId
            ];

            try {
                $req = $db->prepare($sqlUpdateWord);

                $req->execute($data);
                return $req->rowCount();
            } catch (PDOException $e) {
                print $e->getMessage ();
                return null;
            }
            
        }

        static function delete($wordid,$userid){
            require_once('configuration.php');
            $sqlDeleteWord = 'DELETE FROM Vocabulary WHERE Vocabulary.WordId = :WordId AND Vocabulary.User_UserId = :UserId';
            $data = [
                ':WordId'=>$wordid,
                ':UserId'=>$userid
            ];

            try {
                $req = $db->prepare($sqlDeleteWord);

                $req->execute($data);
                return $req->rowCount();
            } catch (PDOException $e) {
                print $e->getMessage ();
                return null;
            }

        }
        
        static function getWords($userid,$wordsid){
            $listWords = [];
            require_once('configuration.php');
            $sqlGetWords = "SELECT * FROM Vocabulary 
                            WHERE User_UserId = :UserId AND WordId IN ($wordsid)";
            $data = [
                ':UserId'=>$userid
            ];

            try {
                $req = $db->prepare($sqlGetWords);

                $req->execute($data);

                foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $item) {

                    $listWords[] = new ModelWord($item['WordId'],$item['Word'],$item['WordForm']
                    ,$item['Kanji'],$item['Pronounce'],$item['Meaning'],$item['Example'],$item['Image'],$item['Sound'],$item['User_UserId']);
                }

                // echo '<pre>';
                // echo 'print';   
                // print_r($listWords);
                // echo '</pre>';
                return $listWords;
            } catch (PDOException $e) {
                print $e->getMessage ();
                return null;
            }
        }

    }
?>