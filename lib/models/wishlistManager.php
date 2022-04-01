<?php
require_once("Manager.php");


class WishlistManager extends manager
{
    protected $db;

    //*  Constructor 
    public function __construct()
    {
        $pdo = new Manager();
        $this->db = $pdo->db;
    }
    public function addWishlistByOfferById($id_offer): ?array
    {
        $query = 'SELECT * FROM internship_offers where id_offer = :id_offer';
        $values = array(':id_offer' => $id_offer);

        $res = $this->query($query, $values);
        $row = $res->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;
        return $row;
    }

    public function getStudentIdByUserId($id): ?int
    {
        $query = 'SELECT id_student FROM student where id_user = :id_user';
        $values = array(':id_user' => $id);

        $res = $this->query($query, $values);
        $student_id = $res->fetch(PDO::FETCH_ASSOC);

        // if student_id == null then return null array;
        if (!$student_id) return null;

        return $student_id["id_student"];
    }

    public function getWishlistFromUserId($id): array
    {
        $student_id = $this->getStudentIdByUserId($id);

        if (!isset($student_id)) return array();

        $query = 'SELECT * FROM wish_list where id_student = :id_student';
        $values = array(':id_student' => $student_id);

        $res = $this->query($query, $values);

        $row = $res->fetchAll(PDO::FETCH_ASSOC);

        return $row ?? array();
    }
    public function offerIsWishedFromUserById($id_offer, int $id): bool
    {

        $student_id = $this->getStudentIdByUserId($id);

        $query = 'SELECT id_wish_list FROM wish_list where id_student = :id_student AND id_offer = :id_offer';
        $values = array(':id_student' => $student_id, ':id_offer' => $id_offer);

        $res = $this->query($query, $values);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return (bool) $row;
    }

    function addInWishlist($id_user, $id_offer, $companyName)
    {
        $student_id = $this->getStudentIdByUserId($id_user);
        if (!isset($student_id)) return null;

        $query = 'INSERT INTO wish_list (Business_Name, id_student, id_offer) VALUES (:businessName, :id_student, :id_offer)';
        $values = array(':businessName' => $companyName, ':id_student' => $student_id, ':id_offer' => $id_offer);

        $res = $this->query($query, $values);
    }
    function deleteFromWishlist($id_user, $id_offer)
    {
        $student_id = $this->getStudentIdByUserId($id_user);
        if (!isset($student_id)) return null;

        $query = 'DELETE FROM wish_list where id_student = :id_student AND id_offer = :id_offer';
        $values = array(':id_student' => $student_id, ':id_offer' => $id_offer);

        $res = $this->query($query, $values);
    }
}
