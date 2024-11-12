<?php
class App extends Controller
{
    
    protected $adminController = 'adminController';
    protected $action = 'index';
    protected $params = [];

    public function __construct()
    {

        $this->prepareURL();
        if (file_exists(CONTROLLER . $this->adminController .".php")) {
            $this->adminController = new $this->adminController;
            if (method_exists($this->adminController, $this->action)) {
                call_user_func_array([$this->adminController,$this->action], $this->params);
            } else {
                (new view('admin/notfound', []))->render();
            }
        } else {
            (new view('admin/notfound', []))->render();
        }

    }

    public function prepareURL()
    {
        $request = trim($_SERVER['REQUEST_URI'], '/');

        if (!empty($request)) {

            $url = explode("/", $request);

            // echo "<pre>";
            // print_r($url);
            // exit;
            $this->adminController = isset($url[2]) ? $url[2]. "Controller" : "adminController";
            $this->action = isset($url[3]) ? $url[3] : "index";
            array_splice($url, 0, 4);
            $this->params = !empty($url) ? array_values($url) : [];

        }

    } // end of function

} // end of class
