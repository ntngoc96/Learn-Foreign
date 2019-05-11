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

        static function allLibrary($wordsid){
            $listWords = [];
            $db = DB::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlSelectAllWords = "SELECT * FROM Vocabulary WHERE WordId NOT IN ($wordsid) AND Kanji NOT LIKE ''";

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
            $limit = 0;
            $date = new DateTime();
            $today = $date->format('Y-m-d');
            $sqlCheckLimit = 'SELECT * FROM Vocabulary WHERE DATE(DateCreate) LIKE :today AND User_UserId LIKE :userid';
            $dataCheck = [  
                ':today'=>$today,
                ':userid'=>$this->UserId
            ];
            try {
                $req = $db->prepare($sqlCheckLimit);

                $req->execute($dataCheck);
                $limit = $req->rowCount();
            } catch (PDOException $e) {
                print $e->getMessage ();
            }

            if($limit < 31){
                $sqlAddWord = 'INSERT INTO Vocabulary(WordId,Word,WordForm,Kanji,Pronounce,Meaning,Example,Image,Sound,User_UserId)
                VALUES (:WordId,:Word,:WordForm,:Kanji,:Pronounce,:Meaning,:Example,:Image,:Sound,:UserId);INSERT INTO VocabularyLibrary(WordId,Word,WordForm,Kanji,Pronounce,Meaning,Example,Image,Sound,User_UserId)
                VALUES (:WordId,:Word,:WordForm,:Kanji,:Pronounce,:Meaning,:Example,:Image,:Sound,:UserId)';

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
                    // echo $req->rowCount();
                    return $req->rowCount();
                } catch (PDOException $e) {
                    print $e->getMessage ();
                } 
            } else {
                return null;
            }
        }
        //lo tay viet argument bang camel @@ 
        static function update($WordId,$Word,$WordForm,$Kanji,$Pronounce,$Meaning,$Example,$Image,$Sound,$UserId){
            echo $WordForm;
            require_once('configuration.php');
            // $sqlUpdateUser = "UPDATE User
            // SET FullName=:FullName, Dob=:Dob,Gender=:Gender,Address=:Address,School_Id=:SchoolId,Avatar=:Avatar
            // WHERE User.UserId LIKE :UserId";
            $sqlUpdateWord = 'UPDATE Vocabulary 
            SET Word=:Word,WordForm=:WordForm,Kanji=:Kanji,Pronounce=:Pronounce,Meaning=:Meaning,Example=:Example,Image=:Image,Sound=:Sound
            WHERE WordId LIKE :WordId AND User_UserId LIKE :UserId;UPDATE VocabularyLibrary 
            SET Word=:Word,WordForm=:WordForm,Kanji=:Kanji,Pronounce=:Pronounce,Meaning=:Meaning,Example=:Example,Image=:Image,Sound=:Sound
            WHERE WordId LIKE :WordId AND User_UserId LIKE :UserId';

            $data = [
                ':Word'=>$Word,
                ':WordForm'=>$WordForm,
                ':Kanji'=>$Kanji,
                ':Pronounce'=>$Pronounce,
                ':Meaning'=>$Meaning,
                ':Example'=>$Example,
                ':Image'=>$Image,
                ':Sound'=>$Sound,
                ':WordId'=>$WordId,
                ':UserId'=>$UserId
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

                return $listWords;
            } catch (PDOException $e) {
                print $e->getMessage ();
                return null;
            }
        }

    }
?>