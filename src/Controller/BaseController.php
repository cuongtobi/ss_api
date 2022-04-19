<?php
namespace App\Controller;

class BaseController {
    protected $requestMethod;

    public function __construct($requestMethod) {
        $this->requestMethod = $requestMethod;
    }

    public function handle() {
        // TODO: handle request
        echo json_encode(array(
            'statusCode' => 200,
            'method' => $this->requestMethod
        ));
    }
}
