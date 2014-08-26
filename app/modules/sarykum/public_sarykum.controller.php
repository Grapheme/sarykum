<?php

class PublicSarykumController extends BaseController {

    public static $name = 'sarykum_public';
    public static $group = 'sarykum';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {

        Route::post('/ajax/reserve-room', array('as' => 'ajax-reserve-room', 'uses' => __CLASS__.'@postAjaxReserveRoom'));
    }

    ## Shortcodes of module
    public static function returnShortCodes() {
    }

    ## Extended Form elements of module
    public static function returnExtFormElements() {

    }
    
    ## Actions of module (for distribution rights of users)
    public static function returnActions() {
    }

    ## Info about module (now only for admin dashboard & menu)
    public static function returnInfo() {
    }

    ## Menu elements of the module
    public static function returnMenu() {
        /*
        return array(
            array(
            	'title' => 'Галереи',
                'link' => self::$group,
                'class' => 'fa-picture-o',
                'permit' => 'view',
            ),
        );
        */
    }

    /****************************************************************************/
    
	public function __construct(){
        ##
	}
	
}


