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

    public function hashPwd($pwd){
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
        $query = $this->connection->prepare('
            INSERT INTO user(first_name, last_name, pseudo, birthday_date, address, postal_code, city, phone, mobile, email, password, role, id_status)
            SELECT ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        ');

        return $query->execute([
            $data['first_name'],
            $data['last_name'],
            $data['pseudo'],
            $data['birthday_submit'],
            $data['address'],
            $data['postal_code'],
            $data['city'],
            $data['phone'],
            $data['mobile'],
            $data['email'],
            $this->hashPwd($data['password']),
            'Membre', 
            1
        ]);
    }

    public function confirmEmail($email, $password){
        $query = $this->connection->prepare('SELECT COUNT(*) AS nb FROM user WHERE md5(email) = ? AND md5(password) = ?;');
        if($query->execute([$email, $password])){
            $nb = $query->fetch();
            if($nb[0] == 1){
                $query = $this->connection->prepare('UPDATE user SET id_status = 2 WHERE md5(email) = ? AND md5(password) = ?;');
                if($query->execute([$email, $password])){
                    return true;
                }else return false;
            }else return false;
        }else return false;
    }

    public function login($email, $password){
        $query = $this->connection->prepare('SELECT * FROM user WHERE email = ? AND password = ? AND id_status = 2');
        if($query->execute([$email, $this->hashPwd($password)])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else return false;
    }

    public function getSkills(){
        $query = $this->connection->prepare('SELECT skill FROM skill ORDER BY skill;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getSubscriptionTypes(){
        $query = $this->connection->prepare('SELECT * FROM subscription_type ORDER BY amount;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTransaction($token, $amount, $currencyCode, $localeCode){
        $query = $this->connection->prepare('
            INSERT INTO transaction (id_status, paypal_token, paypal_amount, paypal_currencycode, paypal_localecode)
            SELECT 1, ?, ?, ?, ?
        ');
        return $query->execute([$token, $amount, $currencyCode, $localeCode]);
    }

    public function getTransactionByToken($token){
        $query = $this->connection->prepare('SELECT * FROM transaction WHERE paypal_token = ?');
        if($query->execute([$token])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else return false;
    }

    public function cancelTransactionByToken($token){
        $query = $this->connection->prepare('UPDATE transaction SET id_status = 2 WHERE paypal_token = ?');
        return $query->execute([$token]);
    }

    public function addDoctor($data){
        $query = $this->connection->prepare('
            INSERT INTO user(first_name, last_name, pseudo, birthday_date, address, postal_code, city, phone, mobile, email, password, role, id_status, siret, presentation)
            SELECT ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        ');

        return $query->execute([
            $data['first_name'],
            $data['last_name'],
            $data['pseudo'],
            $data['birthday_submit'],
            $data['address'],
            $data['postal_code'],
            $data['city'],
            $data['phone'],
            $data['mobile'],
            $data['email'],
            $this->hashPwd($data['password']),
            'Praticien', 
            3,
            $data['siret'],
            $data['presentation'],
        ]);
    }

    public function addSkillToUser($idUser, $skill){
        $skills = $this->getSkills();
        if(in_array($skill, $skills)){
            $query = $this->connection->prepare('
                INSERT INTO possesses(id_user, skill)
                SELECT ?, ?
            ');
            return $query->execute([$idUser, $skill]);
        }else return false;
    }

    public function getIDUserByEmail($e){
        $query = $this->connection->prepare('SELECT id FROM user WHERE email = ?');
        if($query->execute([$e])){
            return $query->fetch(PDO::FETCH_ASSOC)['id'];
        }else return false;
    }

    public function addSubscription($idUser, $idSubscriptionType, $token){
        $query = $this->connection->prepare('
            INSERT INTO subscription(id_user, id_subscription_type, id_transaction)
            SELECT ?, ?, (SELECT id FROM transaction WHERE paypal_token = ?)
        ');

        return $query->execute([$idUser, $idSubscriptionType, $token]);
    }

    public function updateTransaction($t){
        $q = $this->connection->prepare('
            UPDATE transaction
            SET 
                paypal_successpageredirectrequested = ?,
                paypal_timestamp = ?,
                paypal_correlationid = ?,
                paypal_ack = ?,
                paypal_version = ?,
                paypal_build = ?,
                paypal_transactionid = ?,
                paypal_transactiontype = ?,
                paypal_paymenttype = ?,
                paypal_ordertime = ?,
                paypal_amount = ?,
                paypal_feeamt = ?,
                paypal_taxamt = ?,
                paypal_currencycode = ?,
                paypal_paymentstatus = ?,
                paypal_pendingreason = ?,
                paypal_reasoncode = ?,
                id_status = 3
            WHERE paypal_token = ?
        ');
        $e = $q->execute([
            $t['SUCCESSPAGEREDIRECTREQUESTED'],
            date('Y-m-d H:i:s', strtotime($t['TIMESTAMP'])),
            $t['CORRELATIONID'],
            $t['ACK'],
            intval($t['VERSION']),
            $t['BUILD'],
            $t['TRANSACTIONID'],
            $t['TRANSACTIONTYPE'],
            $t['PAYMENTTYPE'],
            date('Y-m-d H:i:s', strtotime($t['ORDERTIME'])),
            floatval($t['AMT']),
            floatval($t['FEEAMT']),
            floatval($t['TAXAMT']),
            $t['CURRENCYCODE'],
            $t['PAYMENTSTATUS'],
            $t['PENDINGREASON'],
            $t['REASONCODE'],
            $t['TOKEN'],
        ]);
        if($e){
            $q = $this->connection->prepare('
                UPDATE user u
                JOIN subscription s ON u.id = s.id_user
                JOIN transaction t on s.id_transaction = t.id
                SET u.id_status = 2
                WHERE t.paypal_token = ? 
            ');
            $e = $q->execute([
                $t['TOKEN'],
            ]);
            
            return $e;
        }else return false;
    }
}