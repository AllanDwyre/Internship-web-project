<?php
require_once("Manager.php");


class CompanyManager extends manager
{
    protected $db;

    //*  Constructor 
    public function __construct()
    {
        $pdo = new Manager();
        $this->db = $pdo->db;
    }

    // todo: evaluate the company


    public function addCompanyWithObject(object $companyInfo): ?int
    {
        // transform to CamelCase :
        $companyName = trim(ucfirst($companyInfo->business_name));
        $companyActivity_sector = trim($companyInfo->Activity_sector);
        $companyLocality = trim($companyInfo->Locality);

        // si le nombre est negatif mettre par defaut 0
        $companyNumber_Cesi_trainees = $companyInfo->Number_Cesi_trainees < 0 ? 0 : $companyInfo->Number_Cesi_trainees;

        // Check if the company already exist.
        if (!is_null($this->getIdFromName($companyName))) {
            return null;
        }

        $query = 'INSERT INTO business (business_name, Activity_sector, Locality, Number_Cesi_trainees) VALUES (:business_name, :Activity_sector, :Locality, :Number_Cesi_trainees)';

        $values = array(':business_name' => $companyName, ':Activity_sector' => $companyActivity_sector, ':Locality' => $companyLocality, ':Number_Cesi_trainees' => $companyNumber_Cesi_trainees);

        $res = $this->query($query, $values);

        return $this->db->lastInsertId();
    }
    public function updateCompanyById(object $companyInfo)
    {
        // print_r($companyInfo);
        $query = 'UPDATE business
        SET business_name = :business_name , Activity_sector = :Activity_sector , Locality = :Locality , Number_Cesi_trainees = :Number_Cesi_trainees
        WHERE id_form = :id_form';
        $values = array(
            ':id_form' => $companyInfo->id_form,
            ':business_name' => $companyInfo->business_name, ':Activity_sector' => $companyInfo->Activity_sector,
            ':Locality' => $companyInfo->Locality, ':Number_Cesi_trainees' => $companyInfo->Number_Cesi_trainees
        );
        $res = $this->query($query, $values);
    }
    public function deleteCompany(string $companyName, int $id)
    {
        $query = 'DELETE FROM wish_list WHERE Business_Name = :Business_Name';
        $values = array(':Business_Name' => $companyName);
        $res = $this->query($query, $values);

        $query = 'DELETE FROM internship_offers WHERE id_form = :id_form';
        $values = array(':id_form' => $id);
        $res = $this->query($query, $values);

        $query = 'DELETE FROM business WHERE business_name = :business_name';
        $values = array(':business_name' => $companyName);
        $res = $this->query($query, $values);
    }

    public function getCompagnies(): ?array
    {
        $query = 'SELECT * FROM business ';

        try {
            $res = $this->db->query($query);
        } catch (PDOException $e) {
            throw $e;
        }

        $row = $res->fetchAll(PDO::FETCH_OBJ);

        return $row ?? null;
    }
    public function getCompanyFromId(int $id): ?object
    {
        $query = 'SELECT * FROM business WHERE (id_form = :id_form)';
        $values = array(':id_form' => $id);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            throw $e;
        }

        $row = $res->fetch(PDO::FETCH_OBJ);

        return $row ?? null;
    }

    public function getIdFromName(string $name): ?int
    {
        $query = 'SELECT id_form FROM business WHERE (business_name = :business_name)';
        $values = array(':business_name' => $name);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            throw $e;
        }

        $row = $res->fetch(PDO::FETCH_ASSOC);

        return $row["id_form"] ?? null;
    }

    public function getCompanyByName(string $business_name): ?object
    {
        $query = 'SELECT * FROM business WHERE (business_name = :business_name)';
        $values = array(':business_name' => $business_name);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            throw $e;
        }

        $row = $res->fetch(PDO::FETCH_OBJ);

        if (!$row) {
            return null;
        }
        return (object)$row;
    }


    //* A sanitization check for the company name 
    public function isNameValid(string $name): bool
    {
        $valid = TRUE;

        $len = mb_strlen($name);
        if (($len < 8) || ($len > 26)) {
            $valid = FALSE;
        }

        return $valid;
    }
}
