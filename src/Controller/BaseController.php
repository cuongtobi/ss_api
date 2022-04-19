<?php
namespace App\Controller;

use App\Handlers\HttpHandler;

class BaseController {
    protected $id;
    protected $requestMethod;
    protected $httpHandler;

    public function __construct($requestMethod, $id = null) {
        $this->httpHandler = new HttpHandler;
        $this->requestMethod = $requestMethod;
        $this->id = $id;
    }

    public function handle() {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->id) {
                    $response = $this->show($this->id);
                } else {
                    $response = $this->index();
                }
                break;
            case 'POST':
                $response = $this->create();
                break;
            case 'PUT':
                $response = $this->update($this->id);
                break;
            case 'DELETE':
                $response = $this->delete($this->id);
                break;
            default:
                $response = $this->httpHandler->notFoundResponse();
                break;
        }

        header(HttpHandler::HTTP_HEADERS[$response['statusCode']]);

        if ($response['body']) {
            echo json_encode($response['body']);
        }
    }

    protected function index() {
        return $this->httpHandler->methodNotAllowedResponse();
    }

    protected function show($id) {
        return $this->httpHandler->methodNotAllowedResponse();
    }

    protected function create() {
        return $this->httpHandler->methodNotAllowedResponse();
    }

    protected function update() {
        return $this->httpHandler->methodNotAllowedResponse();
    }

    protected function delete() {
        return $this->httpHandler->methodNotAllowedResponse();
    }
}
