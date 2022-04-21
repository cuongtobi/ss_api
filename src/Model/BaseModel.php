<?php
namespace App\Model;

class BaseModel
{
    protected $databaseConnection;

    public function __construct($databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    protected function selectAll($fields, $tableName)
    {
        $fields = implode(', ', $fields);
        $statement = "
            SELECT 
                $fields
            FROM
                $tableName;
        ";

        try {
            $statement = $this->databaseConnection->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    protected function selectOne($id, $fields, $tableName)
    {
        $fields = implode(', ', $fields);
        $statement = "
            SELECT
                $fields
            FROM
                $tableName
            WHERE id = ?;
        ";

        try {
            $statement = $this->databaseConnection->prepare($statement);
            
            $statement->execute([$id]);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    protected function insertRecord($input, $fields, $tableName)
    {
        $fillFields = array_map(function ($f) {
            return ':' . $f;
        }, $fields);
        $fillFields = implode(', ', $fillFields);
        $fields = implode(', ', $fields);

        $statement = "
            INSERT INTO $tableName
                ($fields)
            VALUES
                ($fillFields);
        ";

        try {
            $statement = $this->databaseConnection->prepare($statement);
            $statement->execute($input);

            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    protected function updateRecord($id, Array $input, $fields, $tableName)
    {
        $fillFields = array_map(function ($f) {
            return $f . ' = :' . $f;
        }, $fields);
        $fillFields = implode(', ', $fillFields);
        $statement = "
            UPDATE $tableName
            SET 
                $fillFields
            WHERE id = :id;
        ";
        $input['id'] = $id;

        try {
            $statement = $this->databaseConnection->prepare($statement);

            $statement->execute($input);

            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    protected function deleteRecord($id, $tableName)
    {
        $statement = "
            DELETE FROM $tableName
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
