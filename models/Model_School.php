<?php
    class ModelSchool{
        public $SchoolId;
        public $SchoolName;
        public $Area;
        public $Address;

    public function __construct(
        $_SchoolId,
        $_SchoolName,
        $_Area,
        $_Address
    ){
        $this->SchoolId = $_SchoolId;
        $this->SchoolName = $_SchoolName;
        $this->Area = $_Area;
        $this->Address = $_Address;
    }

    static function getAll(){
        require_once('configuration.php');
        $sqlgetAll= 'SELECT * FROM School';
        
        try{
            $req = $db->prepare($sqlgetAll);
            
            $req->execute();
            foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $item) {
                $list[] = new ModelSchool($item['Id'],$item['SchoolName'],$item['Area']
                ,$item['Address']);
            }

            // echo '<pre>';
            //     echo 'gg';
            //     print_r($list);
            // echo '</pre>';
            return $list;
        } catch (PDOException $e) {
            print $e->getMessage ();
            return null;
        }
    }
}
?>