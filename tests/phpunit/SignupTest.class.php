<?php

include('../../conf/config.php');
require('../../application/registry.class.php');
require('../../application/baseController.class.php');
require('../../application/template.class.php');
require('../../model/db.class.php');
require('../../controller/signup.php');

class SignupTest extends PHPUnit_Framework_TestCase
{
    private $db;
    
    public function __construct(){
        $registry = new Registry();
        $this->db = DB::getInstance($registry);
    }
    
    //Création d'un objet à tester
    public function setUp() {
        //$bdd = Outils_Bd::getInstance()->getConnexion();    //REMPLACER ICI PAR L'ACCES A LA BDD
        //$db = new DB();
        
        $insert = $this->db->connection->prepare('INSERT INTO doctor SET id=1000, first_name="Inspecteur", last_name="Le Blanko", birthday="1993-04-03", email="leblanko@gmail.com", password="oui"');
        
        $insert->execute();
    }
    
    //Méthode pour détruire les objets à tester après les tests
    public function tearDown() {
        //$bdd = Outils_Bd::getInstance()->getConnexion();    //REMPLACER ICI PAR L'ACCES A LA BDD
        //$db = new DB();
        
        $delete = $this->db->connection->prepare('DELETE FROM doctor WHERE id = 1000'); // On tape dans le 1000 comme ça on est safe
        
        $delete->execute();
    }

    
    //Je tente test de addDoctor dans dbclass
    public function testEnregistrerNouveau(){
        //$musique = new Musique(array('id'=> 95, 'titre' => '95 c le barca', 'id_album' => 95, 'fichier' => '95.mp3'));
        //'INSERT INTO doctor SET id=1000, first_name="Inspecteur", last_name="Le Blanko", birthday=, email="leblanko@gmail.com", password="oui"'
        $doctor = array(
            'id' => 1001,
            'first_name' => 'Prénom',
            'last_name' => 'Nom',
            'birthday' => '1993-03-04',
            'email' => 'prenom@mail.com',
            'password' => 'motdepasse',
            );
        //Musique_Bd::enregistrerNouveau($musique);
        $this->db->addDoctor($doctor);
        //$musiqueTest = Musique_Bd::lire(95);
        $doctorTest = $this->db->getDoctorById(1001);
        
        $this->assertEquals($doctorTest->first_name, 'Le nom quon a mis en paramètre');
        $this->assertEquals($doctorTest->first_name, 'Inspecteur');
        
    }
    
    public function testGetDoctorById(){
        $doctor = $this->db->getDoctorById(1000);
        
        $this->assertEquals($doctor->first_name, 'Le nom quon a mis en paramètre');
        $this->assertEquals($doctor->first_name, 'Inspecteur');
    }
        
}