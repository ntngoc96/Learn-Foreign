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
        //debug
        // echo '<pre>';
        //     print_r($password);
        // echo '</pre>';

        
        $db = DB::getInstance();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    }

    static function login($id){
        require_once('configuration.php');
        $sqlLogin = 'SELECT * FROM Account JOIN User ON Account.AccountId LIKE User.AccountId WHERE Account.AccountId LIKE :id';
        $placeholder = [
            ':id'=>$id
        ];
        
        try{
            $req = $db->prepare($sqlLogin);
            
            $req->execute($placeholder);
            $result = $req->fetch();
            echo '<pre>';
                echo $id;
                print_r($result);
            echo '</pre>';
            return $result;
        } catch (PDOException $e) {
            print $e->getMessage ();
            return null;
        }
    }
}
?>