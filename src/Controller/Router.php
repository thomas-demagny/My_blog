<?php


namespace Controller;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;


/**
 * Class Router
 * @package Controller
 */
class Router extends Controller
{
    /**
     *path par défaut à tous les controllers
     */
    const DEFAULT_PATH = 'Controller\\';

    /**
     *
     */
    const DEFAULT_CONTROLLER = 'HomeController';

    /**
     *Methode par default
     */
    const DEFAULT_ACTION = 'indexAction';
    /**
     * @var null
     */
    protected $twig = null;
    /**
     * @var string
     * renvoi vers le Controlleur requis
     */
    protected $controller = self::DEFAULT_CONTROLLER;
    /**
     * renvoi la méthode requise
     * @var string
     */
    protected $action = self::DEFAULT_ACTION;


    /**
     * Router constructor.
     * Analyse l'URL, définit le contrôleur et sa méthode
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
        $this->twig->addGlobal('session', $this->session = filter_var_array($_SESSION));
        $this->twig->addExtension(new DebugExtension());


    }


    /**
     *Analyse de l'url et va chercher le controller et sa méthode
*/
    public function parseUrl()
    {
        $access = filter_input(INPUT_GET, 'access');
        if (!isset($access)) {
            $access = 'home!index';
        }
        $access = explode('!', $access);
        $this->controller = $access[0];
        $this->action = count($access) == 1 ? 'error' : $access[1];
    }


    /**
     *Définit le controlleur demandé
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
     *Définit la méthode demandée
     */
    public function setAction()
    {
        $this->action = strtolower($this->action) . 'Action';
        if (!method_exists($this->controller, $this->action)) {
            $this->action = self::DEFAULT_ACTION;
        }
    }


    /**
     *pour créer l'objet du controller et appeler sa méthode
     */
    public function run()
    {
        $this->controller = new $this->controller($this->twig);
        $response = call_user_func([$this->controller, $this->action]);
        echo filter_var($response);
    }

}