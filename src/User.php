<?php

class User
{
    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    /**
     * User constructor.
     */
    public function __construct()
    {
        //Na początku napiszemy konstruktor. Konstruktor w naszej klasie nie będzie przyjmować żadnych argumentów i będzie nastawiał wszystkie jej atrybuty na domyślne (puste) wartości. Jedynie id nowo stworzonego użytkownika będzie nastawiane na -1.
        //Nastawiamy id na -1 jako że ten obiekt nie jest połączony z żadnym rzędem w bazie danych
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
    }

    public function setPassword($newPassword)
    {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

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
     * @return string
     */
    public function getPassword()
    {
        return $this->hashedPassword;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

//TU TRZEBA POPRAWIĆ
    public function saveToDB(mysqli $conn)
    {
        $flag = true;
        $flag = $this->id == -1 ? true : false;

        if ($flag) {//nie było w bazie danych - trzeba dodać do bazy
            $sql = "INSERT INTO users (email, username, hashed_password) VALUES ('$this->email', '$this->username', '$this->hashedPassword')";
            $result = $conn->query($sql); //DB zwaraca nam id wstawionego użytkownika

            if ($result == true) {// czy baza danych nie zwróciła nam błędu - czy zapisano do bazy w tym przypadku
                $this->id = $conn->insert_id;
                return true;
            }

        }
        else {

            $sql = "UPDATE users SET email = '$this->email', username = '$this->username', hashed_password = '$this->hashedPassword' WHERE id = " . (int)$this->id;
            $result = $conn->query($sql);//aktualizacja w bazie danych
        }
    }

    static public function loadUserById(mysqli $conn, $id)
    {
        $sql = "SELECT * FROM users WHERE id = " . (int)$id;// dajemy tu (int)$id jako zabezpieczenie do bazy danyc, żeby ktoś nie wstrzyknął jakiegoś kodu
        //$sql = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($sql);


        if ($result == true && $result->num_rows == 1) { //Zabezpieczenie, żeby nam tylko jeden rezulata zwrócił
            $row = $result->fetch_assoc(); //zostaną dopisane do tablicy asocjacyjnej

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];

            return $loadedUser; //trzeba go zwrócić po za metodę, bo inaczej zostanie usunięty desctructorem
        }

        return false;
    }

    static public function loadAllUser(mysqli $conn)
    {
        $sql = "SELECT * FROM users";
        //$sql = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($sql);


        if ($result == true and $result->num_rows > 0) {
            $loadedUsers = [];
            foreach ($result as $user) {

                $loadedUser = new User();
                $loadedUser->id = $user['id'];
                $loadedUser->username = $user['username'];
                $loadedUser->hashedPassword = $user['hashed_password'];
                $loadedUser->email = $user['email'];

                $loadedUsers[] = $loadedUser;
            }

            return $loadedUsers; //trzeba go zwrócić po za metodę, bo inaczej zostanie usunięty desctructorem
        }

        return false;
    }


    public function delete (mysqli $conn)
    {
        if ($this->id !== -1) {
            $sql = "DELETE FROM users WHERE id=".$this->id;
            $result = $conn->query($sql);
            if ($result == true) {
                $this->id = -1;
                return true;
            } else {
                return false;
            }

        } else {
            return true;
        }
    }


}