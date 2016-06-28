<?php
class DB {
    private static $instance = null;
    private $registry;
    private $connection = null;
    private $salt = '>Uic9w4X>A24R53kB(,J}Y(n2pVj7bR4_Y?[KmgWM9{$(4!GqG4B54y{pPWp5Y%E?jT4-8{PXr3fJhwq867_jxq2i+22T-$6=/g-';
    public static function getInstance($arg){
        if(!self::$instance instanceof self){
            self::$instance = new self($arg);
        }
        return self::$instance;
    }
    public function __clone(){
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup(){
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }
    private function __construct($registry){
        $this->registry = $registry;
        if(USING_A_DB == true){
            try{
                $this->connection = new PDO(DBTYPE . ":host=" . DBHOST . ";charset=UTF8;dbname=" . DBNAME, DBUSER, DBPASSWORD);
            }catch(PDOException $e){
                print "Error new PDO: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
    public function hashPwd($pwd){
        return sha1(md5(sha1($pwd) . $this->salt));
    }
    public function isUserMailExist($e){
        $query = $this->connection->prepare('SELECT COUNT(*) AS nb FROM user WHERE email = ?');
        if($query->execute([
            $e
        ])){
            $nb = $query->fetch();
            if($nb[0] == 0){
                return false;
            }else
                return true;
        }else
            return 'Error while requesting the database.';
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
        if($query->execute([
            $email,
            $password
        ])){
            $nb = $query->fetch();
            if($nb[0] == 1){
                $query = $this->connection->prepare('UPDATE user SET id_status = 2 WHERE md5(email) = ? AND md5(password) = ?;');
                if($query->execute([
                    $email,
                    $password
                ])){
                    return true;
                }else
                    return false;
            }else
                return false;
        }else
            return false;
    }
    public function login($email, $password){
        $query = $this->connection->prepare('SELECT * FROM user WHERE email = ? AND password = ? AND id_status = 2');
        if($query->execute([
            $email,
            $this->hashPwd($password)
        ])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else
            return false;
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
        return $query->execute([
            $token,
            $amount,
            $currencyCode,
            $localeCode
        ]);
    }
    public function getTransactionByToken($token){
        $query = $this->connection->prepare('SELECT * FROM transaction WHERE paypal_token = ?');
        if($query->execute([
            $token
        ])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else
            return false;
    }
    public function cancelTransactionByToken($token){
        $query = $this->connection->prepare('UPDATE transaction SET id_status = 2 WHERE paypal_token = ?');
        return $query->execute([
            $token
        ]);
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
            $data['presentation']
        ]);
    }
    public function addSkillToUser($idUser, $skill){
        $skills = $this->getSkills();
        if(in_array($skill, $skills)){
            $query = $this->connection->prepare('
                INSERT INTO possesses(id_user, skill)
                SELECT ?, ?
            ');
            return $query->execute([
                $idUser,
                $skill
            ]);
        }else
            return false;
    }
    public function getIDUserByEmail($e){
        $query = $this->connection->prepare('SELECT id FROM user WHERE email = ?');
        if($query->execute([
            $e
        ])){
            return $query->fetch(PDO::FETCH_ASSOC)['id'];
        }else
            return false;
    }
    public function addSubscription($idUser, $idSubscriptionType, $token){
        $query = $this->connection->prepare('
            INSERT INTO subscription(id_user, id_subscription_type, id_transaction)
            SELECT ?, ?, (SELECT id FROM transaction WHERE paypal_token = ?)
        ');

        return $query->execute([
            $idUser,
            $idSubscriptionType,
            $token
        ]);
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
            $t['TOKEN']
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
                $t['TOKEN']
            ]);

            return $e;
        }else
            return false;
    }
    public function getAllUsers(){
        $query = $this->connection->prepare('
            SELECT user.*, status
            FROM user
            JOIN status_user ON user.id_status = status_user.id
        ');
        if($query->execute()){
            return $query->fetchAll();
        }else
            return false;
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
            2
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
            2
        ]);
    }
    public function deleteUser($id, $hash = false){
        if($hash == false){
            $query = $this->connection->prepare('
                UPDATE user
                SET id_status = 4
                WHERE id = ?
            ');
            return $query->execute([
                $id
            ]);
        }elseif($hash == 'sha1'){
            $query = $this->connection->prepare('
                UPDATE user
                SET id_status = 4
                WHERE sha1(id) = ?
            ');
            return $query->execute([
                $id
            ]);
        }else
            return false;
    }
    public function getUser($id, $hash = false){
        if($hash == false){
            $query = $this->connection->prepare('
                SELECT *
                FROM user
                WHERE id = ?
            ');
            if($query->execute([
                $id
            ])){
                return $query->fetch(PDO::FETCH_ASSOC);
            }else
                return false;
        }elseif($hash == 'sha1'){
            $query = $this->connection->prepare('
                SELECT *
                FROM user
                WHERE sha1(id) = ?
            ');
            if($query->execute([
                $id
            ])){
                return $query->fetch(PDO::FETCH_ASSOC);
            }else
                return false;
        }else
            return false;
    }
    public function updateUser($user){
        $sql = 'UPDATE user SET ';
        $sql .= implode('=?, ', array_keys($user)) . '=? ';
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
                    $users[$data['id']]['skills'] = [
                        $data['skill']
                    ];
                }else
                    $users[$data['id']]['skills'][] = $data['skill'];
            }
            return $users;
        }else
            return false;
    }
    public function getSkillsByUserId($id){
        $query = $this->connection->prepare('SELECT skill FROM possesses WHERE id_user = ?');
        if($query->execute([
            $id
        ])){
            return $query->fetchAll(PDO::FETCH_COLUMN);
        }else
            return false;
    }
    public function getDoctorById($id){
        $query = $this->connection->prepare('SELECT * FROM user WHERE role = "Praticien" AND id_status != 4 AND id = ?');
        if($query->execute([
            $id
        ])){
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $user['skills'] = $this->getSkillsByUserId($id);
            return $user;
        }else
            return false;
    }
    public function getAllQuestions(){
        $query = $this->connection->prepare('SELECT * FROM question ORDER BY question_date DESC');
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else
            return false;
    }
    public function getQuestion($id){
        $query = $this->connection->prepare('
			SELECT q.id, question_title, question_text, question_date, is_public, satisfaction, id_user, `status`, u.first_name, u.last_name, u.pseudo
			FROM question q
			JOIN user u ON u.id = q.id_user
			WHERE q.id = ?
		');
        if($query->execute([
            $id
        ])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else
            return false;
    }
    public function getAnswerQuestion($idQuestion){
        $query = $this->connection->prepare('
    			SELECT a.*, u.date_inscription, u.first_name, u.last_name, u.birthday_date, u.email, u.pseudo, u.address, u.postal_code, u.city, u.phone, u.mobile, u.siret, u.diploma, u.url_avatar, u.presentation, u.role, u.id_status
				FROM answer a 
				JOIN user u ON u.id = a.id_user 
				WHERE a.id_question = ?
				ORDER BY answer_date
    	');

        if($query->execute([
            $idQuestion
        ])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else
            return false;
    }
    public function addQuestion($question_title, $question_text, $isPublic, $idUser, $idStatus){
        $query = $this->connection->prepare('
    		INSERT INTO question(question_title, question_text, is_public, id_user, status)
    		SELECT ?, ?, ?, ?, ?
    	');

        return $query->execute([
            $question_title,
            $question_text,
            $isPublic,
            $idUser,
            $idStatus
        ]);

        if($query->execute([
            $idQuestion
        ])){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else
            return false;
    }
    public function getListArticle($isPublished = false){
        if($isPublished){
            $where = 'WHERE date_publish < NOW() ';
        }else
            $where = '';

        $query = $this->connection->prepare('SELECT * FROM article ' . $where . 'ORDER BY date_publish DESC');
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else
            return false;
    }
    public function getArticleById($id){
        $query = $this->connection->prepare('SELECT * FROM article WHERE id = ?');
        if($query->execute([
            $id
        ])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else
            return false;
    }
    public function addArticle($article){
        $query = $this->connection->prepare('
            INSERT INTO article(title, content, main_picture, date_create, date_publish, description, id_user)
            SELECT ?, ?, ?, CURRENT_TIMESTAMP, ?, ?, ?');

        return $query->execute([
            $article['title'],
            $article['content'],
            $article['main_picture'],
            $article['date_publish'],
            $article['description'],
            $article['id_user']
        ]);
    }
    public function editArticle($article, $id){
        $query = $this->connection->prepare('
            UPDATE article SET title = ?, content = ?, main_picture = ?, date_publish = ?, description = ?
            WHERE id = ?');

        return $query->execute([
            $article['title'],
            $article['content'],
            $article['main_picture'],
            $article['date_publish'],
            $article['description'],
            $id
        ]);
    }
    public function getListPage($isPublished = false){
        if($isPublished){
            $where = 'WHERE date_publish < NOW() ';
        }else
            $where = '';
        $query = $this->connection->prepare('SELECT * FROM page ' . $where . 'ORDER BY date_create DESC');
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else
            return false;
    }
    public function getPageById($id){
        $query = $this->connection->prepare('SELECT * FROM page WHERE id = ?');
        if($query->execute([
            $id
        ])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else
            return false;
    }
    public function addPage($page){
        $query = $this->connection->prepare('
            INSERT INTO page(title, content, date_create, date_publish, id_user)
            SELECT ?, ?, CURRENT_TIMESTAMP, ?, ?');

        return $query->execute([
            $page['title'],
            $page['content'],
            $page['date_publish'],
            $page['id_user']
        ]);
    }
    public function editPage($page, $id){
        $query = $this->connection->prepare('
            UPDATE page SET title = ?, content = ?, date_publish = ?
            WHERE id = ?');

        return $query->execute([
            $page['title'],
            $page['content'],
            $page['date_publish'],
            $id
        ]);
    }
    public function getQuestionStatus(){
        $query = $this->connection->prepare('
            SELECT status
			FROM status_question 
    	');

        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_COLUMN);
        }else
            return false;
    }
    public function changeStatusQuestion($idQuestion, $status){
        $query = $this->connection->prepare('
			UPDATE question 
			SET status = ?
			WHERE id = ?
		');

        return $query->execute([
            $status,
            $idQuestion
        ]);
    }
    public function addAnswer($answer, $idUser, $idQuestion){
        $query = $this->connection->prepare('
			INSERT INTO answer(answer_text, id_user, id_question)
			SELECT ?, ?, ?
		');

        return $query->execute([
            $answer,
            $idUser,
            $idQuestion
        ]);
    }
    public function updateAnswer($answer, $idUser, $idAnswer){
        $query = $this->connection->prepare('
			UPDATE answer
			SET answer_text = ?, id_user = ?
			WHERE id = ?
		');

        return $query->execute([
            $answer,
            $idUser,
            $idAnswer
        ]);
    }
    public function addQuestionnaire($symptoms, $pain, $history, $other, $id_user, $id_question, $id_doctor = null){
        $query = $this->connection->prepare('
			INSERT INTO questionnaire(symptome, pain, history, other, id_doctor, id_user, id_question)
			SELECT ?, ?, ?, ?, ?, ?, ?
		');
        return $query->execute([
            $symptoms,
            $pain,
            $history,
            $other,
            $id_doctor,
            $id_user,
            $id_question
        ]);
    }
    public function getProposedDoctors(){
        $users = [];
        $query = $this->connection->prepare('
			SELECT p.id, p.date_suggestion,
				u_exp.first_name AS first_name_expert, u_exp.last_name AS last_name_expert, u_exp.pseudo AS pseudo_expert,
				u_pra.id AS id_praticien, u_pra.first_name AS first_name_praticien, u_pra.last_name AS last_name_praticien, u_pra.pseudo AS pseudo_praticien,
				u_mem.first_name AS first_name_member, u_mem.last_name AS last_name_member, u_mem.pseudo AS pseudo_member,
				q.id AS id_question, q.question_title, q.question_text, q.question_date, q.is_public, q.satisfaction, q.id_user, q.`status`,
				possesses.skill
			FROM proposed_praticien p
			JOIN user u_exp ON u_exp.id = p.id_expert
			JOIN user u_pra ON u_pra.id = p.id_praticien
			JOIN question q ON q.id = p.id_question
			JOIN user u_mem ON u_mem.id = q.id_user
			JOIN possesses ON possesses.id_user = u_pra.id
			WHERE u_exp.id_status != 4 
				AND u_pra.id_status != 4 
				AND u_mem.id_status != 4  
		');

        if($query->execute()){
            while($data = $query->fetch(PDO::FETCH_ASSOC)){
                if(!isset($users[$data['id']])){
                    $users[$data['id']] = $data;
                    unset($users[$data['id']]['skill']);
                    $users[$data['id']]['skills'] = [
                        $data['skill']
                    ];
                }else
                    $users[$data['id']]['skills'][] = $data['skill'];
            }
            return $users;
        }else
            return false;
    }
    public function addPropopsedPraticien($id_expert, $id_praticien, $id_question){
        $query = $this->connection->prepare('
			INSERT INTO proposed_praticien(id_expert, id_praticien, id_question)
			SELECT ?, ?, ?
		');
        return $query->execute([
            $id_expert,
            $id_praticien,
            $id_question
        ]);
    }

    public function deleteProposedDoctor($id_proposed_doctor){
        $query = $this->connection->prepare('
			DELETE
			FROM proposed_praticien
			WHERE id = ?
		');

        return $query->execute([
            $id_proposed_doctor,
        ]);
    }

    public function addVideoCategory($category){
        $query = $this->connection->prepare('
            INSERT INTO video_category(category)
            SELECT ?
        ');
        return $query->execute([$category]);
    }

    public function editVideoCategory($category, $id){
        $query = $this->connection->prepare('
            UPDATE video_category
            SET category = ?
            WHERE id = ?
        ');
        return $query->execute([
            $category,
            $id
        ]);
    }

    public function deleteVideoCategory($id){
        $query = $this->connection->prepare('
            UPDATE video
            SET id_category = 1
            WHERE id_category = ?
        ');
        if($query->execute([$id])){
            $query = $this->connection->prepare('
            DELETE FROM video_category
            WHERE id = ?
        ');
            return $query->execute([$id]);
        }else
            return false;
    }

    public function listVideoCategory(){
        $query = $this->connection->prepare('
            SELECT * FROM video_category ORDER BY category
        ');
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else
            return false;
    }

    public function addVideoThematic($thematic){
        $query = $this->connection->prepare('
            INSERT INTO video_thematic(thematic)
            SELECT ?
        ');
        return $query->execute([$thematic]);
    }

    public function editVideoThematic($thematic, $id){
        $query = $this->connection->prepare('
            UPDATE video_thematic
            SET thematic = ?
            WHERE id = ?
        ');
        return $query->execute([
            $thematic,
            $id
        ]);
    }

    public function deleteVideoThematic($id){
        $query = $this->connection->prepare('
            UPDATE video
            SET id_thematic = 1
            WHERE id_thematic = ?
        ');
        if($query->execute([$id])){
            $query = $this->connection->prepare('
            DELETE FROM video_thematic
            WHERE id = ?
        ');
            return $query->execute([$id]);
        }else
            return false;
    }

    public function listVideoThematic(){
        $query = $this->connection->prepare('
            SELECT * FROM video_thematic ORDER BY thematic
        ');
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else
            return false;
    }

    public function addVideo($video){
        $query = $this->connection->prepare('
            INSERT INTO video(url, title, description, id_category, id_user, id_thematic)
            SELECT ?, ?, ?, ?, ?, ?
        ');
        return $query->execute([
            $video['url'],
            $video['title'],
            $video['description'],
            $video['id_category'],
            $video['id_user'],
            $video['id_thematic']
        ]);
    }

    public function editVideo($video, $id){
        $query = $this->connection->prepare('
            UPDATE video SET url = ?, title = ?, description = ?, id_category = ?, id_user = ?, id_thematic = ?
            WHERE id = ?
        ');
        return $query->execute([
            $video['url'],
            $video['title'],
            $video['description'],
            $video['id_category'],
            $video['id_user'],
            $video['id_thematic'],
            $id
        ]);
    }

    public function deleteVideo($id){
        $query = $this->connection->prepare('
            DELETE FROM video
            WHERE id = ?
        ');
        return $query->execute([$id]);
    }

    public function getListVideo($filter = false){
        if($filter){
            if(array_key_exists('id_category', $filter)){
                $where = 'id_category = '.$filter['id_category'];
                if(array_key_exists('id_thematic', $filter)){
                    $where .= ' AND id_thematic = '.$filter['id_thematic'];
                }
            }else $where = 'id_thematic = '.$filter['id_thematic'];
        }else
            $where = '1';

        $query = $this->connection->prepare('
            SELECT * FROM video WHERE '.$where.' ORDER BY date_create DESC
        ');
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else
            return false;
    }

    public function getVideoById($id){
        $query = $this->connection->prepare('
            SELECT * FROM video 
            WHERE id = ?
        ');
        if($query->execute([
            $id
        ])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else
            return false;
    }

    public function getCategoryById($id){
        $query = $this->connection->prepare('
            SELECT * FROM video_category 
            WHERE id = ?
        ');
        if($query->execute([
            $id
        ])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else
            return false;
    }

    public function getThematicById($id){
        $query = $this->connection->prepare('
            SELECT * FROM video_thematic 
            WHERE id = ?
        ');
        if($query->execute([
            $id
        ])){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else
            return false;
    }
	
	public function getProposedDoctorsByQuestion($idQuestion){
		$users = [];
		$query = $this->connection->prepare('
			SELECT p.id, p.date_suggestion,
				u_exp.first_name AS first_name_expert, u_exp.last_name AS last_name_expert, u_exp.pseudo AS pseudo_expert,
				u_pra.id AS id_praticien, u_pra.first_name AS first_name_praticien, u_pra.last_name AS last_name_praticien, u_pra.pseudo AS pseudo_praticien, u_pra.url_avatar AS url_avatar_praticien, u_pra.presentation AS presentation_praticien,
				u_mem.first_name AS first_name_member, u_mem.last_name AS last_name_member, u_mem.pseudo AS pseudo_member,
				q.id AS id_question, q.question_title, q.question_text, q.question_date, q.is_public, q.satisfaction, q.id_user, q.`status`,
				possesses.skill
			FROM proposed_praticien p
			JOIN user u_exp ON u_exp.id = p.id_expert
			JOIN user u_pra ON u_pra.id = p.id_praticien
			JOIN question q ON q.id = p.id_question
			JOIN user u_mem ON u_mem.id = q.id_user
			JOIN possesses ON possesses.id_user = u_pra.id
			WHERE u_exp.id_status != 4
				AND u_pra.id_status != 4
				AND u_mem.id_status != 4
				AND q.id = ?
				
		');
	
		if($query->execute([$idQuestion])){
			while($data = $query->fetch(PDO::FETCH_ASSOC)){
				if(!isset($users[$data['id']])){
					$users[$data['id']] = $data;
					unset($users[$data['id']]['skill']);
					$users[$data['id']]['skills'] = [
						$data['skill']
					];
				}else
					$users[$data['id']]['skills'][] = $data['skill'];
			}
			return $users;
		}else
			return false;
	}
	
	public function getAllAppointmentsByIdUser($id, $role){
		$rolesAccepted = ['Membre', 'Praticien'];
		if(!in_array($role, $rolesAccepted)){
			return false;
		}
		switch($role){
			case 'Membre':
				$role = 'id_member';
				break;
			case 'Praticien':
				$role = 'id_doctor';
				break;
		}
		
		$query = $this->connection->prepare('
			SELECT a.id, a.appointment_request_date, a.recommendation, a.rating, a.is_canceled, a.is_pending, a.is_validated, a.is_virtual, a.id_member, a.id_doctor,
				u_mem.first_name AS first_name_member, u_mem.last_name AS last_name_member, u_mem.pseudo AS pseudo_mem,
				u_doc.first_name AS first_name_doctor, u_doc.last_name AS last_name_doctor
			FROM appointment a
			JOIN user u_mem ON u_mem.id = a.id_member
			JOIN user u_doc ON u_doc.id = a.id_doctor
			WHERE a.'.$role.' = ?
		');
		
		if($query->execute([$id])){
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}else return false;
	}
	
	public function getAppointment($idAppointment){
		$query = $this->connection->prepare('
			SELECT a.id, a.appointment_date, a.recommendation, a.rating, a.is_canceled, a.is_pending,	a.is_validated, a.is_virtual, a.id_member, a.id_expert, a.id_doctor,
				u_mem.first_name AS first_name_member, u_mem.last_name AS last_name_member, u_mem.pseudo AS pseudo_mem,
				u_exp.first_name AS first_name_expert, u_exp.last_name AS last_name_expert,
				u_doc.first_name AS first_name_doctor, u_doc.last_name AS last_name_doctor
			FROM appointment a
			JOIN user u_mem ON u_mem.id = a.id_member
			JOIN user u_exp ON u_exp.id = a.id_expert
			JOIN user u_doc ON u_doc.id = a.id_doctor
			WHERE a.id = ?
		');
		if($query->execute([$idAppointment])){
			return $query->fetch(PDO::FETCH_ASSOC);
		}else return false;
	}
	
	public function updateAppointment($appointment){
		$query = $this->connection->prepare('
			UPDATE appointment
			SET appointment_date = ?,
				recommendation = ?,
				rating = ?,
				is_canceled = ?,
				is_pending = ?,
				is_validated = ?,
				is_virtual = ?,
				id_member = ?,
				id_expert = ?,
				id_doctor = ?
			WHERE id = ?
		');
		
		$execute = [
			$appointment['appointment_date'],
			$appointment['recommendation'],
			$appointment['rating'],
			$appointment['is_canceled'],
			$appointment['is_pending'],
			$appointment['is_validated'],
			$appointment['is_virtual'],
			$appointment['id_member'],
			$appointment['id_expert'],
			$appointment['id_doctor'],
			$appointment['id'],
		];
		
		return $query->execute($execute);
	}
    
    public function deleteArticle($id){
        $query = $this->connection->prepare('
            DELETE FROM article
            WHERE id = ?
        ');
        return $query->execute([$id]);
    }
    
    public function deletePage($id){
        $query = $this->connection->prepare('
            DELETE FROM page
            WHERE id = ?
        ');
        return $query->execute([$id]);
    }
    
    public function addAppointment($is_virtual, $id_member, $id_doctor){
    	$query = $this->connection->prepare('
			INSERT INTO appointment(is_virtual, id_member, id_doctor)
    		SELECT ?, ?, ?
    	');
    	
    	return $query->execute([$is_virtual, $id_member, $id_doctor]);
    }
    
    public function getAllSettings(){
    	$query = $this->connection->prepare('
    		SELECT *
    		FROM settings
    	');
    	
    	if($query->execute()){
    		return $query->fetchAll(PDO::FETCH_ASSOC);
    	}else return false;
    }
    
    public function updateSetting($attribute, $value){
    	$query = $this->connection->prepare('
    		UPDATE settings
    		SET value = ?
    		WHERE attribute = ?
    	');
    	
    	return $query->execute([$value, $attribute]);
    }
}