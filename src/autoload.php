<?php
spl_autoload_register(function($className) {
    if ((strlen($className) > 6) && (strtolower(substr($className, 0, 6)) === "swoole")) {
        if ($className{6} === '\\') {
            include __DIR__ . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
        }
        return true;
    }
    return false;
});
