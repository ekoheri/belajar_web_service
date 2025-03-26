<?php
class Service {
    private static $instances = [];

    public static function singleton($path, $class, $callback) {
        include_once $path."/".$class.".php";
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = $callback();
        }
        return self::$instances[$class];
    }
}
?>