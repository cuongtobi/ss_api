<?php
namespace App\Model;

class UserModel extends BaseModel
{
    private $tableName = 'users';
    private $defaultFields = ['id', 'firstname', 'lastname', 'parent_id'];

    public function findAll()
    {
        return $this->selectAll($this->defaultFields, $this->tableName);
    }

    public function find($id)
    {
        return $this->selectOne($id, $this->defaultFields, $this->tableName);
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
            $statement = $this->databaseConnection->prepare($statement);
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
            $statement = $this->databaseConnection->prepare($statement);

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
            $statement = $this->databaseConnection->prepare($statement);
            $statement->execute(['id' => $id]);

            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
