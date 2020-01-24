<?php

namespace Router;
require_once 'Request.php';

class Router{
    protected $request;
    protected $routes;

    function __construct(){
        $this->request = new Request();
    }

    /*
     * Add route to availables routes into application
     *
     * @route_path : string
     * @callback : function
     * @methods : array
     * */
    public function Route($route_path, $callback, $methods=['GET']){
        $this->routes[$route_path] = [
            'methods' => $methods,
            'callback' => $callback
        ];

        return $this;
    }

    public function Listen(){
        $current_uri = $this->request->requestUri;
        $current_method = $this->request->requestMethod;

        if(array_key_exists($current_uri, $this->routes)){
            $route = $this->routes[$current_uri];
            $route_methods = $route['methods'];
            $route_callback = $route['callback'];

            if(in_array($current_method, $route_methods)){
                $route_callback($this->request);
            }else{
                header("{$this->request->serverProtocol} 405 Method Not Allowed");
                exit();
            }
        }else{
            //header("{$this->request->serverProtocol} 404 Not Found");
            echo "No encontrado";
            exit();
        }
    }
}