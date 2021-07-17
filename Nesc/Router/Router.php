<?php

namespace Nesc\Router;
require_once ('RouterTemplate.php');
require_once ('Request.php');
include __DIR__.'/Traits/ControllerParser.php';
include '../config.php';
use Controller\Controller;
use Traits\ControllerParser;


class Router extends RouterTemplate
{
    use ControllerParser;
    private $requestMethod;

    public function __construct(){
        Request::instantiate();
    }

    public function requestMethodChecker($uri , $callback , $methodName){
        $incomingRequestMethod = strtolower($_SERVER['REQUEST_METHOD']);
        if ('/scandiweb' . $uri == $this->uri() && $methodName === $incomingRequestMethod) {
            $this->urlFound = 1;
            $this->requestMethod = $methodName;
            $this->runCallback($callback);
        }
    }

    public function viewChecker($uri , $path){
        if ('/scandiweb' . $uri == $this->uri()) {
            $this->urlFound = 1;
            return include ROOT .$path;
        }
    }

    public function runCallback($callback){
        is_string($callback) ? $this->routeToController($callback) : call_user_func($callback);
    }

    public function routeToController($value){
        $controllerFile = $this->ControllerFile($value);
        $methodName = $this->methodName($value);
        //$data = json_decode(file_get_contents('php://input'), true);
        $this->requestMethod !== 'post' ?  : Request::setData($_POST);

        $controller = new Controller();
        $controller->run($controllerFile , $methodName);

    }

    public function uri(){
        return $_SERVER['REQUEST_URI'];
    }
}