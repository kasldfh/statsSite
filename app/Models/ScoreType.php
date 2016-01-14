<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ScoreType extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

    //we expect 1 to be best of 5
    //we expect 2 to be forfeit


	protected $table = 'score_type';

}

