<?php
require_once("Manager.php");
// * https://alexwebdevelop.com/user-authentication/

// todo : make roles
// todo : make permissions
class UserManager extends manager
{
    protected $db;
    //*  Constructor 
    public function __construct()
    {
        $pdo = new Manager();
        $this->db = $pdo->db;
    }
    //*  Destructor 
    public function __destruct()
    {
        $this->db = null;
    }

    //* ________________ CRUD __________________________

    public function addUserWithObject(object $userInfo): ?int
    {
        if ($userInfo->ID_Role < 2 && $userInfo->ID_Role > 4) {
            return null;
        }

        $login = trim($userInfo->username);
        $passwd = trim($userInfo->password);

        if (!$this->isNameValid($login)) {
            return null;
        }
        if (!$this->isPasswdValid($passwd)) {
            return null;
        }

        if (!is_null($this->getIdFromUsername($login))) {
            return null;
        }

        $query = 'INSERT INTO authentification (login, password) VALUES (:login, :password)';

        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        $values = array(':login' => $login, ':password' => $hash);

        $res = $this->query($query, $values);

        $id_auth = (int) $this->db->lastInsertId();

        $query = 'INSERT INTO user  (firstname, lastname, email, center, ID_Role, id_auth) VALUES (:firstname, :lastname, :email, :center, :ID_Role,:id_auth)';
        $values = array(':firstname' => $userInfo->firstname, ':lastname' => $userInfo->lastname, ':email' => $userInfo->email, ':center' => $userInfo->center, ':ID_Role' => $userInfo->ID_Role, ':id_auth' => $id_auth);

        $res = $this->query($query, $values);

        $id_user = $this->db->lastInsertId();

        $values = array(':promotion' => $userInfo->promotion, ':id_user' => $id_user);
        if ($userInfo->ID_Role == 2) {
            $query = 'INSERT INTO pilot  (assigned_promotions, id_user) VALUES (:promotion, :id_user)';
            $res = $this->query($query, $values);
        } elseif ($userInfo->ID_Role == 3) {
            $query = 'INSERT INTO student  (Promotion, id_user) VALUES (:promotion, :id_user)';
            $res = $this->query($query, $values);
        }



        return  $id_user;
    }



    public function updatePassword(int $id_auth, string $passwd, string $newPasswd): bool
    {
        // trim = Remove extra spaces 
        $passwd = trim($passwd);
        $newPasswd = trim($newPasswd);

        // test passwords
        if ($passwd == $newPasswd) {
            return FALSE;
        }

        if (!$this->isPasswdValid($passwd)) {
            return FALSE;
        }
        if (!$this->isPasswdValid($newPasswd)) {
            return FALSE;
        }



        $query = 'SELECT password FROM authentification WHERE (id_auth = :id_auth) ';
        $values = array(':id_auth' => $id_auth);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);

            $passwd_db = $res->fetch(PDO::FETCH_ASSOC);
            // test if password is the same as the database
            if (!$passwd_db || !password_verify($passwd, $passwd_db["password"])) return FALSE;
        } catch (PDOException $e) {
            throw $e;
        }

        // hash passwords
        $newPasswd_hash = password_hash($newPasswd, PASSWORD_DEFAULT);

        $query = 'UPDATE authentification SET password = :password WHERE (id_auth = :id_auth) ';
        $values = array(':password' => $newPasswd_hash, ':id_auth' => $id_auth);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
            return $res->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Database query error');
        }
        return TRUE;
    }

    public function updateAccountInformation(int $id_user, int $id_auth, object $infos, bool $selfChange): bool
    {
        $query = 'UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email, center = :center, ID_Role = :id_role WHERE id_user = :id_user';

        $values = array(
            ':firstname' => $infos->firstname,
            ':lastname' => $infos->lastname,
            ':email' => $infos->email,
            ':center' => $infos->center,
            ':id_role' => $infos->ID_Role,
            ':id_user' => $id_user,
        );
        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $query = 'UPDATE authentification SET login = :login WHERE id_auth = :id_auth';
        $values = array(':login' => $infos->username, ':id_auth' => $id_auth);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            throw new Exception('Database query error');
        }
        $infos->id_user  = $id_user;
        $infos->id_auth = $id_auth;
        $infos->role  = $id_user;

        if ($selfChange) {
            $this->setSession($infos);
        }
        return true;
    }
    public function deleteAccount(int $id_user, int $id_auth, int $id_role)
    {
        if ($id_role == 2) {
            $query = 'DELETE FROM pilot WHERE id_auth = :id';
        } else {
            $query = 'DELETE FROM student WHERE id_auth = :id';
        }

        $values = array(':id' => $id_auth);

        $res = $this->query($query, $values);

        $query = 'DELETE FROM user WHERE (id_user = :id)';
        $values = array(':id' => $id_user);

        $res = $this->query($query, $values);


        $query = 'DELETE FROM authentification WHERE id_auth = :id';
        $values = array(':id' => $id_auth);


        $res = $this->query($query, $values);
    }

    public function getUsersByIdRole(int $id_role): array
    {
        if ($id_role == 1) {
            $query = 'SELECT * FROM user ';
            try {
                $res = $this->db->query($query);
            } catch (PDOException $e) {
                throw $e;
            }
        } elseif ($id_role == 2 || $id_role == 4) {
            $query = 'SELECT * FROM user WHERE (ID_Role > :ID_Role)';
            $values = array(':ID_Role' => $id_role);
            $res = $this->query($query, $values);
        }

        $rows = $res->fetchAll(PDO::FETCH_OBJ);

        foreach ($rows as $value) {
            $query = 'SELECT login FROM authentification WHERE (id_auth = :id_auth)';
            $values = array(':id_auth' =>  $value->id_auth);
            $res = $this->query($query, $values);
            $value->username = $res->fetch(PDO::FETCH_OBJ)->login;

            $value->role = $this->getRoleById($value->ID_Role);
        }
        return $rows ?? array();
    }
    public function getIdFromUsername(string $name): ?int
    {
        $query = 'SELECT id_auth FROM authentification WHERE (login = :login)';
        $values = array(':login' => $name);

        $res = $this->query($query, $values);

        $row = $res->fetch(PDO::FETCH_ASSOC);

        return $row["id_auth"] ?? null;
    }
    public function getAccountByUsername($username): object
    {
        $query = 'SELECT id_auth FROM authentification WHERE (login = :login)';
        $values = array(':login' => $username);

        try {
            $res = $this->db->prepare($query);
            $res->execute($values);
            $id_auth = $res->fetch(PDO::FETCH_ASSOC);
            if ($id_auth == false) return null;
        } catch (PDOException $e) {
            throw new Exception('Database query error');
        }

        $query = 'SELECT * FROM user WHERE (id_auth = :id_auth)';
        $values = array(':id_auth' => $id_auth["id_auth"]);
        try {
            $res = $this->db->prepare($query);
            $res->execute($values);

            $user = $res->fetch(PDO::FETCH_OBJ);
            $user->username = $username;
            $user->role = $this->getRoleById($user->ID_Role);
            return $user;
        } catch (PDOException $e) {
            throw new Exception('Database query error');
        }
    }
    //*------------------ CUSTOM -------------------------

    public function login(string $login, string $passwd): bool
    {
        // trim = Remove extra spaces 
        $login = trim($login);
        $passwd = trim($passwd);

        // test form
        if (!$this->isNameValid($login)) {
            return FALSE;
        }
        if (!$this->isPasswdValid($passwd)) {
            return FALSE;
        }


        $query = 'SELECT * FROM authentification WHERE (login = :login)';
        $values = array(':login' => $login);

        $res = $this->query($query, $values);
        $user_auth = $res->fetch(PDO::FETCH_ASSOC);

        if (!$user_auth) return FALSE;

        // verify passwd
        if (!password_verify($passwd, $user_auth["password"])) return False;


        $id_auth = $user_auth["id_auth"];
        $query = 'SELECT * FROM user WHERE (id_auth = :id_auth)';
        $values = array(':id_auth' => $id_auth);

        $res = $this->query($query, $values);

        $user = $res->fetch(PDO::FETCH_OBJ);
        $user->username = $login;

        return $user && $this->setSession($user);
    }

    public function setSession(object $user): bool
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            $_SESSION["login"] = true;
            $_SESSION["id_user"] = $user->id_user;
            $_SESSION["id_auth"] = $user->id_auth;
            $_SESSION["username"] = $user->username;
            $_SESSION["firstname"] = $user->firstname;
            $_SESSION["lastname"] = $user->lastname;
            $_SESSION["email"] = $user->email;
            $_SESSION["center"] = $user->center;
            $_SESSION["ID_Role"] = $user->ID_Role;
            $_SESSION["role"] = $this->getRoleById($user->ID_Role);

            return TRUE;
        }
        return FALSE;
    }

    public function logout()
    {
        session_unset();
        // ? use session_destroy() ??? 
    }

    public function getRoleById($id)
    {
        switch ($id) {
            case 1:
                return "admin";
                break;
            case 2:
                return "pilot";
                break;
            case 3:
                return "student";
                break;
            case 4:
                return "delegate";
                break;
            default:
                return "student";
                break;
        }
    }

    //* ________________ TESTS __________________________

    //* A sanitization check for the account username 
    public function isNameValid(string $login): bool
    {
        $valid = TRUE;

        $len = mb_strlen($login);
        if (($len < 4) || ($len > 26)) {
            $valid = FALSE;
        }
        // todo : check if it contains number

        return $valid;
    }
    //* A sanitization check for the account password 
    public function isPasswdValid(string $passwd): bool
    {
        $valid = TRUE;

        $len = mb_strlen($passwd);

        if (($len < 4) || ($len > 16)) {
            $valid = FALSE;
        }
        return $valid;
    }
}
