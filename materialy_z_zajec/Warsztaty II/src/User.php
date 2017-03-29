<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $hashedPassword;

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

    /**
     * @return string
     */
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

    /**
     * @param string $hashedPassword
     */
    public function setHashedPassword($hashedPassword)
    {
        $this->hashedPassword = password_hash($hashedPassword,PASSWORD_BCRYPT);
    }

    public function __construct()
    {
        $this->id = -1;
        $this->username = '';
        $this->email = '';
        $this->hashedPassword = '';
    }

    /**
     * @param mysqli $connection
     * @return bool
     */
    public function saveToDB(mysqli $connection)
    {
        if ($this->id == -1) {
            //saving new user into data base
            $sql = " INSERT INTO users(username,email,hashed_password) VALUES  ('$this->username','$this->email','$this->hashedPassword')";

            $result = $connection->query($sql);

            if ($result) {
                $this->id = $connection->insert_id;
                return true;
            }
        }
        return false;
    }

    // Metoda saveToDB po aktualizacji
    public function saveToDB2(mysqli $connection)
    {
        if ($this->id == -1) {
            //saving new user into data base
            $sql = " INSERT INTO users(username,email,hashed_password) VALUES  ('$this->username','$this->email','$this->hashedPassword')";

            $result = $connection->query($sql);

            if ($result) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE users SET username='$this->username',
                                    email='$this->email',  
                                    hashed_password='$this->hashedPassword'
                    WHERE id=$this->id";

            $result = $connection->query($sql);
            if($result) {
                return true;
            }
        }
        return false;
    }

    public function delete(mysqli $connection)
    {
        if($this->id != -1) {
            $sql = "DELETE FROM users WHERE id = $this->id";
            $result = $connection->query($sql);
            if ($result) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

    static public function loadUserById(mysqli $connection, $id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";

        $result = $connection->query($sql);
        #jeżelie ilość wierszy będzie inna niż 1 to oznacza błąd w bazie gdyż user o danym id może być tylko jeden
        if($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedUser = new User();

            #UWAGA na sposób odwołania do skłądowych !!! porównać z normalnym
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];

            return $loadedUser;
        }
        return null;
    }

    static public function loadAllUsers(mysqli $connection)
    {
        $sql = "SELECT * FROM users";
        $ret = []; //array()

        $result = $connection->query($sql);
        if($result && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];

                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

}