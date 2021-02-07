<?php

namespace App\Entity;

class User
{
    public int $id = 0;
    public string $login = '';
    public string $password = '';
    public string $email = '';
    public int $is_admin = 0;

    public function __construct(int $id = 0)
    {
        if($id > 0) {
            $this->get($id);
        }
    }

    private function get(int $id)
    {
        $link = db_connect();
        $query = "SELECT id, login, email, password, is_admin FROM users WHERE id = {$id}";
        $res = mysqli_query($link, $query);
        while($row = mysqli_fetch_assoc($res)) {
            $this->id = $row['id'];
            $this->login = $row['login'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->is_admin = $row['is_admin'];
        }
    }

    public static function getByEmail(string $email): User
    {
        $user = new self();
        $link = db_connect();
        $query = "SELECT id, login, email, password, is_admin FROM users WHERE email = ? LIMIT 1";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($res)) {
            $user->id = $row['id'];
            $user->login = $row['login'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->is_admin = $row['is_admin'];
        }
        return $user;
    }

    public static function getList(): array
    {
        $arItems = [];
        $link = db_connect();
        $query = "SELECT id, login, email, password, is_admin FROM users ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $user = new self();
            $user->id = $row['id'];
            $user->login = $row['login'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->is_admin = $row['is_admin'];
            $arItems[] = $user;
        }
        return $arItems;
    }

    public function add(): bool
    {
        $result = false;
        if ($this->id == 0) {
            $link = db_connect();
            $hash = password_hash($this->password, PASSWORD_DEFAULT);
            $query = "
                    INSERT INTO users
                    SET 
                    login = '{$this->login}', email = '{$this->email}', 
                    is_admin = {$this->is_admin}, password = '{$hash}'
            ";
            $result = mysqli_query($link, $query);
        }
        return (bool) $result;
    }

    public function delete(): bool
    {
        $result = false;
        if ($this->id > 0) {
            $link = db_connect();
            $query = "DELETE FROM users WHERE id = {$this->id}";
            $result = mysqli_query($link, $query);
        }
        return (bool) $result;
    }

    public function update(): bool
    {
        $result = false;
        if ($this->id > 0) {
            $link = db_connect();
            $query = "
                    UPDATE users
                    SET login = '{$this->login}', 
                        email = '{$this->email}', 
                        is_admin = {$this->is_admin}
                    WHERE id = {$this->id}
            ";
            $result = mysqli_query($link, $query);
            if ($this->password != '') {
                $hash = password_hash($this->password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET password = '" . $hash . "' WHERE id = {$this->id}";
                mysqli_query($link, $query);
            }
        }
        return (bool) $result;
    }
}