<?php

class User
{
    private $id;
    private $username;
    private $hashPassword;
    private $email;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->hashPassword;
    }

    /**
     * @param string $hashPassword
     */
    public function setPassword($hashPassword)
    {
        $hashPassword = password_hash($hashPassword,PASSWORD_BCRYPT);
        $this->hashPassword = $hashPassword;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function saveToDB(mysqli $connection)
    {
        $flag = true;
        $flag = $this->id == -1 ? true : false;

        if ($flag) {

            $sql = " INSERT INTO users(username,email,hashed_password) 
            VALUES  ('$this->username','$this->email','$this->hashPassword')";
            $result = $connection->query($sql); // BD zwraca nam id wstawionego urzytkownika
            if ($result) {
                $this->id = $connection->insert_id;
                return true;
            }

        } else {
            $sql = " UPDATE users SET
            username = '$this->username',
            email = '$this->email',
            hashed_password = '$this->hashPassword'
            WHERE id=".(int)$this->id;
            echo $sql;
            $result = $connection->query($sql);
            if ($result) {
                return true;
            }
        }

        return false;
    }

    public function __construct()
    {
        $this->id = -1;
        $this->email = "";
        $this->username = "";
        $this->hashPassword = "";
    }

    public static function loadUserByID(mysqli $connection,$id)
    {
        $sql = "SELECT * FROM users WHERE id = ".(int)$id;
        $result = $connection ->query($sql);



        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadUser = new User();
            $loadUser -> id = $row['id'];
            $loadUser -> hashPassword = $row['hashed_password'];
            $loadUser -> email = $row['email'];
            $loadUser -> username = $row['username'];

            return $loadUser;
        }
        return false;
    }

    public static function loadAllUsers(mysqli $connection)
    {
        $sql = "SELECT * FROM users";
        $result = $connection ->query($sql);

        if ($result) {
            $loadUsers = array();
            foreach ($result as $user) {
                $loadUser = new User();
                $loadUser -> id = $user['id'];
                $loadUser -> hashPassword = $user['hashed_password'];
                $loadUser -> email = $user['email'];
                $loadUser -> username = $user['username'];

                $loadUsers[] = $loadUser;
            }
            return $loadUsers;
        }
        return false;
    }
}