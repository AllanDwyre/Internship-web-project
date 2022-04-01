<?php
require_once("Manager.php");


class SearchManager extends manager
{
    protected $db;

    //*  Constructor 
    public function __construct()
    {
        $pdo = new Manager();
        $this->db = $pdo->db;
    }

    public function searchCompanies($keyword): array
    {
        $keyword = '%' . $keyword . '%';

        $values = array(':keyword' => $keyword);

        $query = 'SELECT * FROM business WHERE business_name LIKE :keyword OR Activity_sector LIKE :keyword OR Locality LIKE :keyword';
        $res = $this->query($query, $values);

        $rows = $res->fetchAll(PdO::FETCH_OBJ);

        if (!isset($rows)) return array();

        foreach ($rows as $key => $value) {
            $rows[$key]->Trainee_mark_Stars = $this->getStarsFromRating($rows[$key]->Trainee_mark);
            $rows[$key]->Pilot_trust_Stars = $this->getStarsFromRating($rows[$key]->Pilot_trust);
            $rows[$key]->isCompany = true;
        }
        return $rows;
    }

    public function searchOffers($keyword)
    {
        $keyword = '%' . $keyword . '%';

        $values = array(':keyword' => $keyword);

        $query = "SELECT * from internship_offers inner JOIN business ON business.id_form = internship_offers.id_form
         WHERE skills LIKE :keyword OR localicy LIKE :keyword
         OR business_name LIKE :keyword OR Activity_sector LIKE :keyword OR Locality LIKE :keyword";
        $res = $this->query($query, $values);

        $rows = $res->fetchAll(PdO::FETCH_OBJ);

        foreach ($rows as $key => $value) {
            $query = 'SELECT business_name FROM business WHERE id_form = :id_form';
            $values = array(':id_form' => $value->id_form);

            $res = $this->query($query, $values);

            $rows[$key]->business_name = $res->fetch(PDO::FETCH_OBJ)->business_name;

            $rows[$key]->isOffer = true;
        }
        return $rows;
    }

    public function searchUsers($keyword, int $id_role)
    {

        $keyword = '%' . $keyword . '%';

        $values = array(':keyword' => $keyword);

        // Si on n'est pas un etudiant (il a 0 droit)
        $condition = "";
        if ($id_role != 3) {
            if ($id_role != 1) { // Si on n'est pas un admin (il a tout les droits)
                if ($id_role == 2 || $id_role == 4) $condition = " ID_Role = 3 AND";
            }
            $query = 'SELECT * FROM user WHERE' . $condition . '(lastname LIKE :keyword OR firstname LIKE :keyword OR email LIKE :keyword OR center LIKE :keyword)';
            $res = $this->query($query, $values);
            $rows = $res->fetchAll(PdO::FETCH_OBJ);

            foreach ($rows as $key => $value) {
                $query = 'SELECT login FROM authentification WHERE id_auth = :id_auth';
                $values = array(':id_auth' => $value->id_auth);

                $res = $this->query($query, $values);

                $rows[$key]->username = $res->fetch(PDO::FETCH_OBJ)->login;
                $rows[$key]->isUser = true;
            }

            return $rows;
        }

        return array();
    }

    public function searchAll($keyword, int $id_role)
    {
        $users = $this->searchUsers($keyword,  $id_role);
        $companies = $this->searchCompanies($keyword);
        $offers = $this->searchOffers($keyword);

        return array_merge($users, $companies, $offers);
    }

    function getStarsFromRating($rating): string
    {
        $rating /= 2;
        $result = '';

        $fullStar = (int) $rating;
        $halfStar = ($rating - (int) $rating) != 0;

        for ($i = 0; $i < $fullStar; $i++) {
            $result .= "star" . " ";
        }

        for ($i = 0; $i < 5 - $fullStar; $i++) {
            if ($halfStar && $i == 0) {
                $result .= "star_half" . " ";
                continue;
            }
            $result .= "star_outline" . " ";
        }
        return $result;
    }
}
