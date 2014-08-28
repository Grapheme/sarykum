<?php

class AdminDicvalsController extends BaseController {

    public static $name = 'dicvalues';
    public static $group = 'dictionaries';
    public static $entity = 'dic';
    public static $entity_name = 'словарь';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        $entity = self::$entity;
        Route::group(array('before' => 'auth', 'prefix' => $prefix . "/" . $class::$group), function() use ($class, $entity) {
            Route::post($entity.'/ajax-order-save', $class."@postAjaxOrderSave");
            Route::resource('dic.val', $class,
                array(
                    'except' => array('show'),
                    'names' => array(
                        'index' => 'dicval.index',
                        'create' => 'dicval.create',
                        'store' => 'dicval.store',
                        'edit' => 'dicval.edit',
                        'update' => 'dicval.update',
                        'destroy' => 'dicval.destroy',
                    )
                )
            );
        });
    }

    ## Shortcodes of module
    public static function returnShortCodes() {
        ##
    }
    
    ## Actions of module (for distribution rights of users)
    public static function returnActions() {
        ##
    }

    ## Info about module (now only for admin dashboard & menu)
    public static function returnInfo() {
        ##
    }
        
    /****************************************************************************/
    
	public function __construct(){

        $this->locales = Config::get('app.locales');

        $this->module = array(
            'name' => self::$name,
            'group' => self::$group,
            'rest' => self::$group,
            'tpl' => static::returnTpl('admin/dicvals'),
            'gtpl' => static::returnTpl(),

            'entity' => self::$entity,
            'entity_name' => self::$entity_name,
        );

        View::share('module', $this->module);
        View::share('CLASS', __CLASS__);
	}

	#public function getIndex(){

	public function index($dic_id){

        Allow::permission($this->module['group'], 'dicval');

        $dic = Dictionary::find((int)$dic_id);
        if (!is_object($dic))
            App::abort(404);

        $elements = DicVal::where('dic_id', $dic_id)->orderBy('order', 'ASC')->orderBy('name', 'ASC')->paginate(30);
        #Helper::dd($elements);
		return View::make($this->module['tpl'].'index', compact('elements', 'dic'));
	}

    /************************************************************************************/

	#public function getCreate($entity){
	public function create($dic_id){

        Allow::permission($this->module['group'], 'dicval');

        $dic = Dictionary::find((int)$dic_id);
        if (!is_object($dic))
            App::abort(404);

        $locales = $this->locales;

        $fields = Config::get('dic.fields.' . $dic->slug);

        $element = new Dictionary;

		return View::make($this->module['tpl'].'edit', compact('element', 'dic', 'locales', 'fields'));
	}
    

	#public function getEdit($entity, $id){
	public function edit($dic_id, $id){

        Allow::permission($this->module['group'], 'dicval');

        $dic = Dictionary::find((int)$dic_id);
        if (!is_object($dic))
            App::abort(404);

        $locales = $this->locales;

        $fields = Config::get('dic.fields.' . $dic->slug);
        #Helper::dd($fields);

        $element = DicVal::where('id', $id)
            ->with('metas')
            #->with('meta')
            ->with('allfields')
            ->first();

        #Helper::tad($element);

		return View::make($this->module['tpl'].'edit', compact('element', 'dic', 'locales', 'fields'));
	}


    /************************************************************************************/


	public function store($dic_id) {

		return $this->postSave($dic_id);
	}


	public function update($dic_id, $id) {

		return $this->postSave($dic_id, $id);
	}


	public function postSave($dic_id, $id = false){

        #Helper::dd($entity);

        Allow::permission($this->module['group'], 'dicval');

		if(!Request::ajax())
            return App::abort(404);

        $dic = Dictionary::find((int)$dic_id);
        if (!is_object($dic))
            App::abort(404);

        #Helper::tad($dic);

        $input = Input::all();
        $locales = Input::get('locales');
        $fields = Input::get('fields');
        $fields_i18n = Input::get('fields_i18n');

        $json_request['responseText'] = "<pre>" . print_r($_POST, 1) . "</pre>";
        #return Response::json($json_request,200);

        $json_request = array('status'=>FALSE, 'responseText'=>'', 'responseErrorText'=>'', 'redirect'=>FALSE);
		$validator = Validator::make($input, array('name' => 'required'));
		if($validator->passes()) {

            $redirect = false;

            if ($id > 0 && NULL !== DicVal::find($id)) {

                ## UPDATE DICVAL
                DicVal::find($id)->update($input);

            } else {

                ## CREATE DICVAL
                $element = DicVal::insert($input);
                $id = $element->id;
                $redirect = true;
            }

            ## FIELDS
            if (@is_array($fields) && count($fields)) {
                #Helper::d($fields);
                foreach ($fields as $key => $value) {

                    ## If handler of field is defined
                    if (is_callable($handler = Config::get('dic.fields.' . $dic->slug . '.general.' . $key . '.handler'))) {
                        #Helper::dd($handler);
                        $value = $handler($value);
                    }

                    $field = DicFieldVal::firstOrNew(array('dicval_id' => $id, 'key' => $key, 'language' => NULL));
                    $field->value = $value;
                    $field->save();
                    unset($field);
                }
            }

            ## FIELDS I18N
            if (@is_array($fields_i18n) && count($fields_i18n)) {
                #Helper::d($fields_i18n);
                foreach ($fields_i18n as $locale_sign => $locale_values) {
                    #Helper::d($locale_values);
                    foreach ($locale_values as $key => $value) {

                        #Helper::d($value);

                        ## If handler of field is defined
                        if (is_callable($handler = Config::get('dic.fields.' . $dic->slug . '.i18n.' . $key . '.handler'))) {
                            #Helper::dd($handler);
                            $value = $handler($value);
                        }

                        #Helper::d($value);

                        $field = DicFieldVal::firstOrNew(array('dicval_id' => $id, 'key' => $key, 'language' => $locale_sign));
                        $field->value = $value;
                        $field->save();
                        #Helper::ta($field);
                        unset($field);
                    }
                }
            }

            ## LOCALES
            if (@is_array($locales) && count($locales)) {
                #Helper::dd($locales);
                foreach ($locales as $locale_sign => $array) {

                    $element_meta = DicValMeta::firstOrNew(array('dicval_id' => $id, 'language' => $locale_sign));
                    $element_meta->update($array);
                    $element_meta->save();
                    unset($element_meta);
                }
            }

			$json_request['responseText'] = 'Сохранено';
            if ($redirect && Input::get('redirect'))
			    $json_request['redirect'] = Input::get('redirect');
			$json_request['status'] = TRUE;
		} else {
			$json_request['responseText'] = 'Неверно заполнены поля';
			$json_request['responseErrorText'] = $validator->messages()->all();
		}
		return Response::json($json_request, 200);
	}

    /************************************************************************************/

	#public function deleteDestroy($entity, $id){
	public function destroy($id){

        Allow::permission($this->module['group'], 'dicval');

		if(!Request::ajax())
            return App::abort(404);

		$json_request = array('status'=>FALSE, 'responseText'=>'');

        if (NULL !== DicVal::find($id))
            DicVal::find($id)->delete();

		$json_request['responseText'] = 'Удалено';
		$json_request['status'] = TRUE;
		return Response::json($json_request,200);
	}


    public function postAjaxOrderSave() {

        $poss = Input::get('poss');

        $pls = DicVal::whereIn('id', $poss)->get();

        if ( $pls ) {
            foreach ( $pls as $pl ) {
                $pl->order = array_search($pl->id, $poss);
                $pl->save();
            }
        }

        return Response::make('1');
    }

}


