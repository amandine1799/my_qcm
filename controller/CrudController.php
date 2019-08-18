<?php
include_once 'db.php';

class CrudController
{
    private $connection = null;

    public function __construct() {
        $db = new DB();
        $this->connection = $db->openConnection();        
    }

    public function fetchQCM()
    {
        $sql = "SELECT id, name FROM qcm";
        $req = $this->connection->query($sql);
        $result = $req->fetchAll();
    
        return $result;
    }

    public function fetchQuestions($id_qcm)
    {
        $sql = "SELECT id, question FROM qcm_question
                JOIN question ON qcm_question.id_question=question.id
                WHERE id_qcm=:id_qcm";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id_qcm" => $id_qcm]);
        $res = $stmt->fetchAll();
        return $res;
    }

    public function fetchResponses($id_question)
    {
        $sql = "SELECT id, response FROM question_response
                JOIN response ON question_response.id_response=response.id
                WHERE id_question=:id_question";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id_question" => $id_question]);
        $res = $stmt->fetchAll();
        return $res;
    }

    public function validate($id_qcm, $user_answer)
    {
        $sql = 'SELECT question.id AS q_id, response.id r_id, valid
                FROM question_response
                JOIN response ON response.id=id_response
                JOIN question ON question.id=question_response.id_question
                JOIN qcm_question ON question.id=qcm_question.id_question
                WHERE id_qcm=:id_qcm';

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id_qcm' => $id_qcm]);
        $res = $stmt->fetchAll();

        $result = [
            'success' => true,
            'questions_wrong' => [],
            'error_message' => '',
        ];
        $questions_wrong = [];

        foreach ($res as $v) {
            $valid = $v['valid'] == "1";
            $q_id = $v['q_id'];

            if(!array_key_exists('q' . $q_id, $user_answer)) {
                $result['error_message'] = "Merci de répondre à toutes les questions.";
                $result['success'] = false;
                return $result;
            }

            $user_resp = $user_answer['q' . $q_id];

            $check = in_array($v['r_id'], $user_resp);
            if ($check != $valid) {
                $result['error_message'] = "Vous avez eu faux à une ou plusieurs questions";
                $questions_wrong[] = $q_id;
                $result['success'] = false;
            }
        }

        $result['questions_wrong'] = array_unique($questions_wrong);
        return $result;
    }

    /* Add New QCM */
    public function addQcm()
    {
        $titre = $_POST['nom_qcm'];
        
        $db = new DB();
        
        $conn = $db->openConnection();
        
        $sql = "INSERT INTO qcm(nom_qcm) VALUES ('". $titre ."')"; 
        $conn->query($sql);

        $sql = "SELECT * FROM qcm ORDER BY id_qcm DESC LIMIT 1";
        $query = $conn->query($sql);
        $result = $query->fetch();
        $id = $result["id_qcm"];  

        $db->closeConnection();

        return $id;
    }

        /* Add New Question */
        public function addQuestion($id)
        {   
            $question = $_POST['q_question'];

            $db = new DB();
            
            $conn = $db->openConnection();
            
            $sql = "INSERT INTO question (q_question) VALUES ('" . $question . "')";
        
            $conn->query($sql);

            $sql = "SELECT * FROM question ORDER BY id_question DESC LIMIT 1";
            $query = $conn->query($sql);
            $result = $query->fetch();
            $id_question = $result["id_question"]; 

            $sql = "INSERT INTO contient (id_question, id_qcm) VALUES ('" .$id_question. "', '" .$id. "')";
            $conn->query($sql);

            $db->closeConnection();

            return $id_question;
        }

        /*Add Reponse */
        public function addReponse($id)
        {
            $reponse = $_POST['r_reponse'];
            if(empty($_POST['valid_reponse']) ){
                 $right_reponse = 0;
            }
           else {
            $right_reponse = 1;
           }
            $db = new DB();
            
            $conn = $db->openConnection();
            
            $sql = "INSERT INTO reponse (r_reponse, valid_reponse) VALUES ('" . $reponse . "', '" . $right_reponse . "')";
        
            $conn->query($sql);

            $sql = "SELECT * FROM reponse ORDER BY id_reponse DESC LIMIT 1";
            $query = $conn->query($sql);
            $result = $query->fetch();
            $id_reponse = $result["id_reponse"]; 

            $sql = "INSERT INTO a (id_reponse, id_question) VALUES ('" .$id_reponse. "', '" .$id. "')";
            $conn->query($sql);

            $db->closeConnection();

            return $id_reponse;
    } 

            /* Edit a Record */
            public function edit($formArray, $id) 
            {
                $nom_qcm = $_POST['nom_qcm'];
                
                
                $db = new DB();
                
                $conn = $db->openConnection();
                
                $sql = "UPDATE qcm SET nom_qcm = '" . $nom_qcm . "' WHERE id_qcm=" . $id;
                
                $conn->query($sql);
                $db->closeConnection();

                return $id;
            } 

            /* Delete a Record */
            public function delete($id)
            {
                $id_question = $_POST["id_question"];

                $db = new DB();
                
                $conn = $db->openConnection();
                
                $sql = "DELETE FROM contient where id_question=' . $id_question' AND id_qcm=". $id;
                $sql = "DELETE FROM qcm where id='" . $id;
                
                $conn->query($sql);
                $db->closeConnection();
            } 
}

?>