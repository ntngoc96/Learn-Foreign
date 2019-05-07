<?php
    class ModelAccount{
        public $AccountId;
        public $Password;

    public function __construct(
        $_AccountId,
        $_Password
    ){
        $this->AccountId = $_AccountId;
        $this->Password = $_Password;
    }

    static function register($id,$password){
        $password = md5($password);
        $UserId = chr( mt_rand( 97 ,122 ) ) .substr( md5( time( ) ) ,27 );
        $AccountType = 'MB';

        
        $db = DB::getInstance();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $date = new DateTime();
        $today = $date->format('Y-m-d');
        $sqlCheckLimit = 'SELECT * FROM Account WHERE DATE(DateJoin) LIKE :today';
        $dataCheck = [  
            ':today'=>$today
        ];
        try {
            $req = $db->prepare($sqlCheckLimit);

            $req->execute($dataCheck);
            $limit = $req->rowCount();
        } catch (PDOException $e) {
            print $e->getMessage ();
        }

        if($limit < 30 ){
            $sqlRegisterAccount = 'INSERT INTO Account(AccountId,Password,AccountType) VALUES(:id,:password,:accounttype);
            INSERT INTO User(UserId,AccountId) VALUES(:userid,:accountid);';
                try{
                $req = $db->prepare($sqlRegisterAccount);

                $req->execute(array('id'=>$id,'password'=>$password,'accounttype'=>'MB','userid'=>$UserId,'accountid'=>$id));
                return array('UserId'=>$UserId,'req'=>$req);
            } catch (PDOException $e) {
                print $e->getMessage ();
                return null;
            }
        } else {
            return null;
        }
    }

    static function login($id){
        require_once('configuration.php');
        $sqlLogin = 'SELECT * FROM Account JOIN User ON Account.AccountId LIKE User.AccountId WHERE Account.AccountId LIKE :id';
        $data = [
            ':id'=>$id
        ];
        
        try{
            $req = $db->prepare($sqlLogin);
            
            $req->execute($data);
            $result = $req->fetch();
            return $result;
        } catch (PDOException $e) {
            print $e->getMessage ();
            return null;
        }
    }

    static function changePassword($userid,$old,$new){
        require_once('configuration.php');

        $sqlChangePassword = 'UPDATE Account 
        INNER JOIN User ON Account.AccountId = User.AccountId
        SET Account.Password = :newpassword
        WHERE Account.Password LIKE :oldpassword AND User.UserId LIKE :userid';

        $data = [
            ':newpassword'=>$new,
            ':oldpassword'=>$old,
            ':userid'=>$userid
        ];

        try{
            $req = $db->prepare($sqlChangePassword);
            
            $req->execute($data);
            return $req->rowCount();
        } catch (PDOException $e) {
            print $e->getMessage ();
            return null;
        }
    }
}
?>