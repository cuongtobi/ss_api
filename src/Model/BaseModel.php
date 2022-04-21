<?php
namespace App\Model;

class BaseModel {
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
}
