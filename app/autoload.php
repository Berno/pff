<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'index_controller' => '/controllers/Index_Controller.php',
                'pff\\models\\address' => '/models/Address.php',
                'pff\\models\\test' => '/models/Test.php',
                'pff\\proxies\\__cg__\\pff\\models\\address' => '/proxies/__CG__pffmodelsAddress.php',
                'test_controller' => '/controllers/Test_Controller.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd