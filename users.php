<?php

include_once __DIR__ .'/db.php';
include_once __DIR__ .'/validate.php';
class User
{
    static public function all()
    {
        $sql = "SELECT * FROM users";
        $users = db::execute($sql);
        return $users;
    }

    static public function dangky($data)
    {
        $sql = 'INSERT INTO users (user, email, password) values (:user, :email, :password)';
        $result = db::execute($sql, $data);

        if (is_array($result)) {
            return count($result) > 0 ? $result[0] : null;
        } else {
            return $result ? true : null;
        }
    }
    static public function find($id)
    {
        $sql = "SELECT * FROM users WHERE id=:id";
        $dataFind = ['id' => $id ];
        $user = DB::execute($sql, $dataFind);

        return count($user) > 0 ? $user[0] : null;
    }

    static public function update($dataUpdate)
    {
        $sql = "UPDATE users SET user=:user, email=:email, password=:password WHERE id=:id";
        return DB::execute($sql, $dataUpdate);
    }

    static public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id=:id";
        $dataDelete = ['id' => $id ];
        return DB::execute($sql, $dataDelete);
    }

    static public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE user = :username";
        $data = ['username' => $username];
        $user = DB::execute($sql, $data);
        return count($user) > 0 ? $user[0] : null;
    }
}

?>