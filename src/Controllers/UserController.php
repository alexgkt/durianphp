<?php

namespace App\Controllers;

use Psr\Log\LoggerInterface as Logger;
use App\Repositories\UserRepository as User;
use App\Interfaces\RestInterface;

class UserController implements RestInterface
{
    private $user;
    private $logger;
    private $httpStatus;

    public function __construct(Logger $logger, User $user)
    {
        $this->user = $user;
        $this->httpStatus = 200;
    }

    public function index($request, $response)
    {
        $httpMethod = $request->getMethod();
        $params = $request->getParams();

        switch ($httpMethod)
        {
            case 'GET':
                $result = $this->query($params);
                break;
            case 'POST':
                $result = $this->post($params);
                break;
        }

        return $response->withJson($result, $this->httpStatus);
    }

    public function index2($id, $request, $response)
    {
        $httpMethod = $request->getMethod();
        $params = $request->getParams();
        switch ($httpMethod)
        {
            case 'GET':
                $result = $this->get($id);
                break;
            case 'PUT':
                $result = $this->put($id, $params);
                break;
            case 'DELETE':
                $result = $this->delete($id);
                break;
        }

        return $response->withJson($result, $this->httpStatus);
    }

    public function get($id){
        return $this->user->find($id);
    }

    public function put($id, $args = []){
        /*$user = $this->user->build([
            'id' => $id,
            'name' => $args['name'],
            'password' => password_hash($args['password'], PASSWORD_BCRYPT),
            'email' => $args['email'],
            'status' => $args['status']
        ]);
        return $this->user->update($user);*/
    }

    public function post($args = []){
        /*$user = $this->user->build([
            'name' => $args['name'],
            'password' => password_hash($args['password'], PASSWORD_BCRYPT),
            'email' => $args['email']
        ]);
        return $this->user->insert($args);*/
    }

    public function delete($id){
        /*return $this->user->delete($id);*/
    }

    public function query($args = [], $orderBy = []){

    }

    public function login($args = []){
        $name = $arg['name'];
        $password = $args['password'];
        $this->user->where([
            'name' => $name,
        ]);
    }

    private function startSession(){
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
