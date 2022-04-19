<?php
namespace App\Controller;

class UserController extends BaseController
{
    protected function index()
    {
        return [
            'statusCode' => 200,
            'body' => [
                ['id' => 1, 'name' => 'Name 1'],
                ['id' => 2, 'name' => 'Name 2'],
                ['id' => 3, 'name' => 'Name 3'],
                ['id' => 4, 'name' => 'Name 4'],
                ['id' => 5, 'name' => 'Name 5'],
            ],
        ];
    }

    protected function show($id)
    {
        return [
            'statusCode' => 200,
            'body' => ['id' => $id, 'name' => 'Name ' . $id],
        ];
    }
}
