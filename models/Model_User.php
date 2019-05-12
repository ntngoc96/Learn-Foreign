<?php
    // include_once("Entity_User.php");

    class ModelUser{
        public $UserId;
        public $FullName;
        public $Dob;
        public $Gender;
        public $Address;
        public $SchoolId;
        public $Avatar;
        public $AccountId;

        public function __construct(
            $_UserId,
            $_FullName,
            $_Dob,
            $_Gender,
            $_Address,
            $_SchoolId,
            $_Avatar,
            $_AccountId)
            {
                $this->UserId = $_UserId;
                $this->FullName = $_FullName;
                $this->Dob = $_Dob;
                $this->Gender = $_Gender;
                $this->Address = $_Address;
                $this->SchoolId = $_SchoolId;
                $this->Avatar = $_Avatar;
                $this->AccountId = $_AccountId;
            }

        static function all(){
            $listUser = [];
            $db = DB::getInstance();
            $sqlSelectAllUser = 'SELECT * FROM User';
            //using placeholder to keep a sit. It help to avoid SQL Injection attack
            $req = $db->prepare($sqlSelectAllUser);
            $req->execute();
            foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $item) {
                $list[] = new ModelUser($item['UserId'],$item['FullName'],$item['Dob']
                ,$item['Gender'],$item['Address'],$item['School_Id'],$item['Avatar'],$item['AccountId']);
            }

            return $list;
        }

        static function find($id){
            $db = DB::getInstance();
            $sqlFindOne = "SELECT * FROM User WHERE UserId LIKE :id";
            $req = $db->prepare($sqlFindOne);
            $req->execute(array('id' => $id));
            $item = $req->fetch();
            if(isset($item['UserId'])){
                return new ModelUser($item['UserId'],$item['FullName'],$item['Dob']
                ,$item['Gender'],$item['Address'],$item['School_Id'],$item['Avatar'],$item['AccountId']);
            } else {
                return null;
            }
        }

        // static function findWithAccountId($accountid){
        //     $db = DB::getInstance();
        //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //     $sqlFindWithAccountId = 'SELECT * FROM User WHERE User.AccountId LIKE :accountid';

        //     $data = [
        //         ':accountid'=>$accountid
        //     ];

        //     try{
        //         $req = $db->prepare($sqlFindWithAccountId);
        //         $req->execute($data);
        //         $user = $req->fetch();
        //         if(!isset($user['UserId'])){
        //             return null;
        //         }
        //         return $user['UserId'];
        //     } catch (PDOException $e) {
        //         print $e->getMessage ();
        //     }
        // }

        static function update($_UserId,$_FullName,$_Dob,$_Gender,$_Address,$_SchoolId,$_Avatar){
            
            $db = DB::getInstance();
            
            $data = [
                ':FullName'=>$_FullName,
                ':Dob'=>$_Dob,
                ':Gender'=>$_Gender,
                ':Address'=>$_Address,
                ':SchoolId'=>$_SchoolId,
                ':Avatar'=>$_Avatar,
                ':UserId'=>$_UserId
            ];

            $sqlUpdateUser = "UPDATE User
            SET FullName=:FullName, Dob=:Dob,Gender=:Gender,Address=:Address,School_Id=:SchoolId,Avatar=:Avatar
            WHERE User.UserId LIKE :UserId";

            try{
                $req = $db->prepare($sqlUpdateUser);
                $req->execute($data);
            } catch (PDOException $e) {
                print $e->getMessage ();
            }

        }
        static function updateWithoutAvatar($_UserId,$_FullName,$_Dob,$_Gender,$_Address,$_SchoolId){
            
            $db = DB::getInstance();
            
            $data = [
                ':FullName'=>$_FullName,
                ':Dob'=>$_Dob,
                ':Gender'=>$_Gender,
                ':Address'=>$_Address,
                ':SchoolId'=>$_SchoolId,
                ':UserId'=>$_UserId
            ];

            $sqlUpdateUser = "UPDATE User
            SET FullName=:FullName, Dob=:Dob,Gender=:Gender,Address=:Address,School_Id=:SchoolId
            WHERE User.UserId LIKE :UserId";

            try{
                $req = $db->prepare($sqlUpdateUser);
                $req->execute($data);
            } catch (PDOException $e) {
                print $e->getMessage ();
            }

        }
        
    }
?>