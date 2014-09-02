<?php

class AdminSystemController extends BaseController {

    public static $name = 'system';
    public static $group = 'system';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        /*
        $class = __CLASS__;
        Route::group(array('before' => 'auth', 'prefix' => $prefix), function() use ($class) {
        	Route::controller($class::$group, $class);
        });
        */
    }

    ## Actions of module (for distribution rights of users)
    ## return false;   # for loading default actions from config
    ## return array(); # no rules will be loaded
    public static function returnActions() {
        return array(
            'modules' => 'Работа с модулями',
            'groups'  => 'Работа с группами пользователей',
            'users'   => 'Работа с пользователями',
            'locales' => 'Работа с редактором языков',
        );
    }

    ## Info about module (now only for admin dashboard & menu)
    public static function returnInfo() {
        return array(
        	'name' => self::$name,
        	'group' => self::$group,
        	'title' => 'Система', 
            'visible' => 0,
        );
    }
        
    /****************************************************************************/

	public function __construct(){
        #
	}
    
}
