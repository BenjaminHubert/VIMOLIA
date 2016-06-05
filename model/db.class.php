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
            ucfirst(strtolower($data['first_name'])),
            strtoupper($data['last_name']),
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
            ucfirst(strtolower($data['first_name'])),
            strtoupper($data['last_name']),
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

    public function getAllUsers(){
        $query = $this->connection->prepare('
            SELECT user.*, status
            FROM user
            JOIN status_user ON user.id_status = status_user.id
        ');
        if($query->execute()){
            return $query->fetchAll();
        }else return false;
    }

    public function addAdministrator($d){
        $query = $this->connection->prepare('
            INSERT INTO user(first_name, last_name, birthday_date, email, password, role, id_status)
            SELECT ?, ?, ?, ?, ?, ?, ?
        ');

        return $query->execute([
            ucfirst(strtolower($d['first_name'])),
            strtoupper($d['last_name']),
            $d['birthday_submit'],
            $d['email'],
            $this->hashPwd($d['password']),
            'Administrateur',
            2,
        ]);
    }

    public function addAuthor($d){
        $query = $this->connection->prepare('
            INSERT INTO user(first_name, last_name, birthday_date, email, password, role, id_status)
            SELECT ?, ?, ?, ?, ?, ?, ?
        ');

        return $query->execute([
            ucfirst(strtolower($d['first_name'])),
            strtoupper($d['last_name']),
            $d['birthday_submit'],
            $d['email'],
            $this->hashPwd($d['password']),
            'Auteur',
            2,
        ]);
    }

    public function deleteUser($id, $hash = false){
        if($hash == false){
            $query = $this->connection->prepare('
                UPDATE user
                SET id_status = 4
                WHERE id = ?
            ');
            return $query->execute([$id]);
        }elseif($hash == 'sha1'){
            $query = $this->connection->prepare('
                UPDATE user
                SET id_status = 4
                WHERE sha1(id) = ?
            ');
            return $query->execute([$id]);
        }else return false;
    }

    public function getUser($id, $hash = false){
        if($hash == false){
            $query = $this->connection->prepare('
                SELECT *
                FROM user
                WHERE id = ?
            ');
            if($query->execute([$id])){
                return $query->fetch(PDO::FETCH_ASSOC);
            }else return false;
        }elseif($hash == 'sha1'){
            $query = $this->connection->prepare('
                SELECT *
                FROM user
                WHERE sha1(id) = ?
            ');
            if($query->execute([$id])){
                return $query->fetch(PDO::FETCH_ASSOC);
            }else return false;
        }else return false;
    }

    public function updateUser($user){
        $sql = 'UPDATE user SET ';
        $sql .= implode('=?, ', array_keys($user)).'=? ';
        $sql .= 'WHERE id = ?';

        $toExecute = array_values($user);
        $toExecute[] = $user['id'];
        $query = $this->connection->prepare($sql);
        return $query->execute($toExecute);
    }

    public function getAllDoctors(){
        $users = [];
        $query = $this->connection->prepare('
            SELECT user.*, possesses.skill 
            FROM user
            JOIN possesses ON possesses.id_user = user.id
            WHERE role = "Praticien"
            AND id_status != 4
        ');
        if($query->execute()){
            while($data = $query->fetch(PDO::FETCH_ASSOC)){
                if(!isset($users[$data['id']])){
                    $users[$data['id']] = $data;
                    unset($users[$data['id']]['skill']);
                    $users[$data['id']]['skills'] = [$data['skill']];
                }else $users[$data['id']]['skills'][] = $data['skill'];
            }
            return $users;
        }else return false;
    }

    public function getSkillsByUserId($id){
        $query = $this->connection->prepare('SELECT skill FROM possesses WHERE id_user = ?');
        if($query->execute([$id])){
            return $query->fetchAll(PDO::FETCH_COLUMN);
        }else return false;
    }

    public function getDoctorById($id){
        $query = $this->connection->prepare('SELECT * FROM user WHERE role = "Praticien" AND id_status != 4 AND id = ?');
        if($query->execute([$id])){
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $user['skills'] = $this->getSkillsByUserId($id);
            return $user;
        }else return false;
    }
    
    public function getAllQuestions(){
    	$query = $this->connection->prepare('SELECT * FROM question ORDER BY question_date');
    	if($query->execute()){
    		return $query->fetchAll(PDO::FETCH_ASSOC);
    	}else return false;
    }
    
    public function getQuestion($id){
    	$query = $this->connection->prepare('SELECT * FROM question WHERE id = ?');
    	if($query->execute([$id])){
    		return $query->fetch(PDO::FETCH_ASSOC);
    	}else return false;
    }
    
    public function getAnswersQuestion($idQuestion){
    	$query = $this->connection->prepare('
    			SELECT a.*, u.date_inscription, u.first_name, u.last_name, u.birthday_date, u.email, u.pseudo, u.address, u.postal_code, u.city, u.phone, u.mobile, u.siret, u.diploma, u.url_avatar, u.presentation, u.role, u.id_status
				FROM answer a 
				JOIN user u ON u.id = a.id_user 
				WHERE a.id_question = ?
				ORDER BY answer_date
    	');
    	if($query->execute([$idQuestion])){
    		return $query->fetchAll(PDO::FETCH_ASSOC);
    	}else return false;
    }
}