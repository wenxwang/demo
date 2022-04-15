<?php
namespace mvc;

define('CORE_PATH', __DIR__);

/**
 * 框架核心
 */
class Mvc
{
    // 配置内容
    protected $config = array();

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function run()
    {
        ini_set('register_globals', 'Off');

        spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();
        // $this->removeMagicQuotes();
        // $this->unregisterGlobols();
        $this->setDbConfig();
        $this->route();
    }

    // 路由处理
    public function route()
    {
        $controllerName = $this->config['defaultController'];
        $actionName = $this->config['defaultAction'];

        $param = array();
        $uri = $_SERVER['REQUEST_URI']; // 资源路径，域名后面的部分

        $position = strpos($uri, '?'); // 定位参数部分
        $uri = $position === false ? $uri : substr($uri, 0, $position); 
        $uri = trim($uri, '/');

        if ($uri) {
            $uriArray = explode('/', $uri);
            $uriArray = array_filter($uriArray);

            // 控制器名
            $controllerName = ucfirst($uriArray[0]);

            // 获取方法名
            array_shift($uriArray);
            $actionName = $uriArray ? $uriArray[0] : $actionName;

            // 获取参数
            array_shift($uriArray);
            $param = $uriArray ? $uriArray : array();
        }

        $controller = $this->config['defaultApp'] . '\\controllers\\' . $controllerName . 'Controller';
        if (!class_exists($controller)) {
            die($controller . '控制器不存在');
        }

        if (!method_exists($controller, $actionName)) {
            die($actionName . '方法不存在');
        }
        
        $dispatch = new $controller($controllerName, $actionName);

        // 调用控制器方法
        call_user_func_array(array($dispatch, $actionName), $param);
    }

    // 检测开发环境
    public function setReporting()
    {
        if (APP_DEBUG == true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
        }
    }

    // 删除敏感字符
    public function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);

        return $value;
    }

    // 检测敏感字符并删除
    // public function removeMagicQuotes()
    // {
    //     if (get_magic_quotes_gpc()) {
    //         $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
    //         $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
    //         $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
    //         $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
    //     }
    // }

    // 配置数据库
    public function setDbConfig()
    {
        if ($this->config['db']) {
            define('DB_HOST', $this->config['db']['host']);
            define('DB_NAME', $this->config['db']['database']);
            define('DB_USER', $this->config['db']['username']);
            define('DB_PASS', $this->config['db']['password']);
        }
    }

    // 自动加载类
    public function loadClass($className)
    {
        $classMap = $this->classMap();

        if (isset($classMap[$className])) {
            $file = $classMap[$className];
        } else if (strpos($className, '\\') !== false) {
            $file = APP_PATH . str_replace('\\', '/', $className) . '.php';
            if (!is_file($file)) {
                return;
            }
        } else {
            return;
        }
        require_once($file);
    }

    // 内核文件命名空间映射关系
    protected function classMap()
    {
        return [
            'mvc\base\Controller' => CORE_PATH . '/base/Controller.php',
            'mvc\base\Model' => CORE_PATH . '/base/Model.php',
            'mvc\base\View' => CORE_PATH . '/base/View.php',
            'mvc\db\Db' => CORE_PATH . '/db/Db.php',
            'mvc\db\Sql' => CORE_PATH . '/db/Sql.php'
        ];
    }
}
