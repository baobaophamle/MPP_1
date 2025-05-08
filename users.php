<?php

include_once __DIR__ .'/db.php';
include_once __DIR__ .'/validate.php';
class User
{
    static public function all($search = "", $limit = 5, $offset = 0)
    {
    $sql = "SELECT * FROM users";
    $params = [];
    if ($search != "") {
        $sql .= " WHERE user LIKE :search";
        $params[':search'] = "%" . $search . "%";
    }
    $sql .= " LIMIT :limit OFFSET :offset";
    $params[':limit'] = (int) $limit;
    $params[':offset'] = (int) $offset;
    $users = db::execute($sql, $params);
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

    static public function countAll($search = "")
    {
    $sql = "SELECT COUNT(*) as total FROM users";
    $params = [];
    if ($search != "") {
        $sql .= " WHERE user LIKE :search";
        $params[':search'] = "%" . $search . "%";
    }
    $result = db::execute($sql, $params);
    return $result[0]['total'];
    }
}

?>