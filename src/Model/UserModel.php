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
        return $this->insertRecord(
            $input,
            ['firstname', 'lastname', 'parent_id'],
            $this->tableName
        );
    }

    public function update($id, Array $input)
    {
        return $this->updateRecord(
            $id,
            $input,
            ['firstname', 'lastname', 'parent_id'],
            $this->tableName
        );
    }

    public function delete($id)
    {
        return $this->deleteRecord($id, $this->tableName);
    }
}
