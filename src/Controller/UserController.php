<?php
namespace App\Controller;

class UserController extends BaseController {
    protected function index() {
        return array(
            'statusCode' => 200,
            'body' => array(
                array('id' => 1, 'name' => 'Name 1'),
                array('id' => 2, 'name' => 'Name 2'),
                array('id' => 3, 'name' => 'Name 3'),
                array('id' => 4, 'name' => 'Name 4'),
                array('id' => 5, 'name' => 'Name 5'),
            ),
        );
    }

    protected function show($id) {
        return array(
            'statusCode' => 200,
            'body' => array('id' => $id, 'name' => 'Name ' . $id),
        );
    }
}
