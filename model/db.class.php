<?php
class DB {
    private static $instance = null;

    private $registry;
    private $connection = null;
    private $salt = '>Uic9w4X>A24R53kB(,J}Y(n2pVj7bR4_Y?[KmgWM9{$(4!GqG4B54y{pPWp5Y%E?jT4-8{PXr3fJhwq867_jxq2i+22T-$6=/g-';
    public static function getInstance($arg) {
        if (!self::$instance instanceof self) {
            self::$instance = new self($arg);
        }
        return self::$instance;
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    private function __construct($registry) {
        $this->registry = $registry;
        if(USING_A_DB == true){
            try
            {
                $this->connection = new PDO(DBTYPE.":host=".DBHOST.";charset=UTF8;dbname=".DBNAME, DBUSER, DBPASSWORD);
            }catch(PDOException $e)
            {
                print "Error new PDO: ".$e->getMessage()."<br/>";
                die();
            }
        }
    }

    private function hashPwd($pwd){
        return sha1(md5(sha1($pwd).$this->salt));
    }

    public function isUserMailExist($e){
        $query = $this->connection->prepare('SELECT COUNT(*) AS nb FROM user WHERE email = ?');
        if($query->execute([$e])){
            $nb = $query->fetch();
            if($nb[0] == 0){
                return false;
            }else return true;
        }else return 'Error while requesting the database.';
    }

    public function addMember($data){
        $data['member'] = 'Membre';
        $query = $this->connection->prepare('
            INSERT INTO user(first_name, last_name, pseudo, birthday_date, address, postal_code, city, phone, mobile, email, password, role)
            SELECT ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        ');

        return $query->execute([$data['first_name'],$data['last_name'],$data['pseudo'],$data['birthday_submit'],$data['address'],$data['postal_code'],$data['city'],$data['phone'],$data['mobile'],$data['email'], $this->hashPwd($data['password']), $data['member']]);
    }
}