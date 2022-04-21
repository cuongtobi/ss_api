<?php
namespace App\Model;

class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "
            SELECT 
                id, firstname, lastname, parent_id
            FROM
                users;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find($id)
    {
        $statement = "
            SELECT 
                id, firstname, lastname, parent_id
            FROM
                users
            WHERE id = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([$id]);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $input)
    {
        $statement = "
            INSERT INTO users
                (firstname, lastname, parent_id)
            VALUES
                (:firstname, :lastname, :parent_id);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'parent_id' => $input['parent_id'] ?? null,
            ]);

            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($id, Array $input)
    {
        $statement = "
            UPDATE users
            SET 
                firstname = :firstname,
                lastname  = :lastname,
                parent_id = :parent_id
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);

            $statement->execute([
                'id' => $id,
                'firstname' => $input['firstname'],
                'lastname'  => $input['lastname'],
                'parent_id' => $input['parent_id'] ?? null,
            ]);

            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $statement = "
            DELETE FROM users
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(['id' => $id]);

            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
