<?php


namespace Controller;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;


/**
 * Class Router
 * @package Controller
 */
class Router extends Controller
{
    /**
     *
     */
    const DEFAULT_PATH = 'Controller\\';

    /**
     *
     */
    const DEFAULT_CONTROLLER = 'HomeController';

    /**
     *
     */
    const DEFAULT_ACTION = 'indexAction';
    /**
     * @var null
     */
    protected $twig = null;
    /**
     * @var string
     */
    protected $controller = self::DEFAULT_CONTROLLER;
    /**
     * @var string
     */
    protected $action = self::DEFAULT_ACTION;


    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->setTemplate();
        $this->parseUrl();
        $this->setController();
        $this->setAction();
    }


    /**
     *
     */
    public function setTemplate()
    {
        $loader = new FilesystemLoader('../src/View');
        $this->twig = new Environment($loader, array(
            'cache' => false,
            'debug' => true

        ));
        $this->twig->addGlobal('session', filter_var_array($_SESSION));

    }


    /**
     *
     */
    public function parseUrl()
    {
        $access = filter_input(INPUT_GET, 'access');
        if (!isset($access)) {
            $access = 'home';
        }
        $access = explode('!', $access);
        $this->controller = $access[0];
        $this->action = count($access) == 1 ? 'index' : $access[1];
    }


    /**
     *
     */
    public function setController()
    {
        $this->controller = ucfirst(strtolower($this->controller)) . 'Controller';
        $this->controller = self::DEFAULT_PATH . $this->controller;
        if (!class_exists($this->controller)) {
            $this->controller = self::DEFAULT_PATH . self::DEFAULT_CONTROLLER;
        }
    }


    /**
     *
     */
    public function setAction()
    {
        $this->action = strtolower($this->action) . 'Action';
        if (!method_exists($this->controller, $this->action)) {
            $this->action = self::DEFAULT_ACTION;
        }
    }


    /**
     *
     */
    public function run()
    {
        $this->controller = new $this->controller($this->twig);
        $response = call_user_func([$this->controller, $this->action]);
        echo filter_var($response);
    }

}