<?php
namespace App\Controller;

use App\System\DatabaseConnector;
use App\Model\UserModel;

class UserController extends BaseController
{
    private $userModel;

    public function __construct($requestMethod, $id = null)
    {
        parent::__construct($requestMethod, $id);
        $db = (new DatabaseConnector)->getConnection();
        $this->userModel = new UserModel($db);
    }

    protected function index()
    {
        $users = $this->userModel->findAll();

        return [
            'statusCode' => 200,
            'body' => $users,
        ];
    }

    protected function show($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->httpHandler->notFoundResponse();
        }

        return [
            'statusCode' => 200,
            'body' => $user,
        ];
    }

    protected function create()
    {
        $this->userModel->insert([
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'parent_id' => $_POST['parent_id'],
        ]);
       
        return [
            'statusCode' => 201,
            'body' => null,
        ];
    }

    protected function update($id)
    {
        if (!$id) {
            return $this->httpHandler->notFoundResponse();
        }

        $input = $this->getPutFormData();

        $this->userModel->update($id, [
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'parent_id' => $input['parent_id'],
        ]);

        return [
            'statusCode' => 200,
            'body' => null,
        ];
    }

    protected function delete($id)
    {
        if (!$id) {
            return $this->httpHandler->notFoundResponse();
        }

        $this->userModel->delete($id);

        return [
            'statusCode' => 200,
            'body' => null,
        ];
    }

    private function getPutFormData()
    {

        $lines = file('php://input');
        $keyLinePrefix = 'Content-Disposition: form-data; name="';
    
        $data = [];
    
        foreach ($lines as $num => $line) {
            if (strpos($line, $keyLinePrefix) !== false) {
                $key = substr($line, 38, -3);
                $value = trim($lines[$num + 2]);
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
