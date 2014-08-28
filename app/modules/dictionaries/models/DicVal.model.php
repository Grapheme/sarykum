<?php

class DicVal extends BaseModel {

	protected $guarded = array();

	public $table = 'dictionary_values';
    public $timestamps = false;

	public static $order_by = "name ASC";

    protected $fillable = array(
        'dic_id',
        'slug',
        'name',
        'order',
    );

	public static $rules = array(
		'name' => 'required',
	);

    #public static function rules() {
    #    return self::$rules;
    #}

    public function dic() {
        return $this->belongsTo('Dictionary', 'dic_id')->orderBy('name');
    }

    public function metas() {
        return $this->hasMany('DicValMeta', 'dicval_id', 'id');
    }

    public function meta() {
        return $this->hasOne('DicValMeta', 'dicval_id', 'id')->where('language', Config::get('app.locale'));
    }

    public function allfields() {
        return $this->hasMany('DicFieldVal', 'dicval_id', 'id');
    }

    public function fields() {
        return $this->hasMany('DicFieldVal', 'dicval_id', 'id')->where('language', Config::get('app.locale'))->orWhere('language', NULL);
    }

}