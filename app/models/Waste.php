<?php

class Waste extends Eloquent {

	public $timestamps = false;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'wasted';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password');

	/**
	 * Table unique key
	 * @var string
	 */
	protected $primaryKey = 'id';

	public function item() {
		return $this->hasOne('Item', 'id', 'item_id');
	}
}
