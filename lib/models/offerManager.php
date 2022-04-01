<?php
require_once("Manager.php");


class OfferManager extends manager
{
    protected $db;

    //*  Constructor 
    public function __construct()
    {
        $pdo = new Manager();
        $this->db = $pdo->db;
    }

    public function addOfferWithObject(object $offerInfo): ?int
    {
        $skills = $offerInfo->skills;
        $localicy = $offerInfo->localicy;
        $duration = $offerInfo->duration;
        $remuneration = $offerInfo->remuneration;
        $added_date = date('Y-m-d', strtotime(str_replace('-', '/', $offerInfo->added_date)));
        $offer_date = date('Y-m-d', strtotime(str_replace('-', '/', $offerInfo->offer_date)));
        $id_form = $offerInfo->id_form;

        // Check if the offer already exist.
        if (!is_null($this->getIdFromSkill($skills))) {
            return null;
        }

        $query = 'INSERT INTO internship_offers (skills, localicy, duration, remuneration, added_date, offer_date, id_form) VALUES (:skills, :localicy, :duration, :remuneration, :added_date, :offer_date, :id_form)';

        $values = array(':skills' => $skills, ':localicy' => $localicy, ':duration' => $duration, ':remuneration' => $remuneration, ':added_date' => $added_date, ':offer_date' => $offer_date, ':id_form' => $id_form);

        $res = $this->query($query, $values);


        return $this->db->lastInsertId();
    }
    public function updateOfferById($id, $offerInfo)
    {
        $skills = $offerInfo->skills;
        $localicy = $offerInfo->localicy;
        $duration = $offerInfo->duration;
        $remuneration = $offerInfo->remuneration;
        $added_date = $offerInfo->added_date;
        $offer_date = $offerInfo->offer_date;

        $query = 'UPDATE internship_offers
        SET skills = :skills, localicy = :localicy,duration = :duration, remuneration = :remuneration, added_date = :added_date, offer_date = :offer_date
        WHERE id_offer = :id_offer';

        $values = array(
            ':id_offer' => $id,
            ':skills' => $skills, ':localicy' => $localicy, ':duration' => $duration, ':remuneration' => $remuneration, ':added_date' => $added_date, ':offer_date' => $offer_date
        );

        $this->query($query, $values);
    }
    public function getOffers(): ?array
    {
        $query = 'SELECT * FROM internship_offers';

        try {
            $res = $this->db->query($query);
        } catch (PDOException $e) {
            throw $e;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;
        return $row;
    }

    public function getOfferById($id): ?array
    {
        $query = 'SELECT * FROM internship_offers where id_offer = :id_offer';
        $values = array(':id_offer' => $id);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            throw $e;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;
        return $row;
    }

    public function getOffersFromCompanyId($id): array
    {
        $query = 'SELECT * FROM internship_offers where id_form = :id_form';
        $values = array(':id_form' => $id);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            throw $e;
        }

        $row = $res->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }
    public function deleteOfferById($id)
    {
        $query = 'DELETE FROM wish_list WHERE id_offer = :id_offer';
        $values = array(':id_offer' => $id);
        $res = $this->query($query, $values);

        $query = 'DELETE FROM internship_offers WHERE id_offer = :id_offer';
        $values = array(':id_offer' => $id);
        $res = $this->query($query, $values);
    }

    public function getIdFromSkill($id): ?int
    {
        $query = 'SELECT id_offer FROM internship_offers where skills = :skills';
        $values = array(':skills' => $id);

        $res = $this->query($query, $values);

        $row = $res->fetch(PDO::FETCH_ASSOC);

        return $row["id_offer"] ?? null;
    }
}
