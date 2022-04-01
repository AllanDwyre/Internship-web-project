<?php
require_once("Manager.php");


class CandidacyManager extends manager
{
    private $db;
    //*  Constructor 
    public function __construct()
    {
        $pdo = new Manager();
        $this->db = $pdo->db;
    }

    // ------------ Crud -----------------------
    public function getCandidacyByUserId($userId)
    {
        $query = 'SELECT * FROM candidacy WHERE (id_student = :userID)';
        $values = array(':candidacy' => $userId);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);

            $candidacy = $res->fetch(PDO::FETCH_ASSOC);
            if ($candidacy == false) return null;
        } catch (PDOException $e) {
            throw new Exception('Database query error');
        }

        $id_offer = $candidacy["id_offer"];

        $query = 'SELECT * FROM internship_offers WHERE (id_offer = :id_offer)';
        $values = array(':id_offer' => $id_offer["id_offer"]);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);

            $offer = $res->fetch(PDO::FETCH_OBJ);

            return $offer;
        } catch (PDOException $e) {
            throw new Exception('Database query error');
        }
    }
}
