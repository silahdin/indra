<?php

namespace App\Models;

use App\Filters\QueryFilters;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class BaseModel extends Model
{

	public function __construct(array $attributes = []){
		parent::__construct($attributes);
		parent::setPerPage(10);
	}

	public function isNewRecord()
	{
		return empty($this->id);
	}
	
	public function fillAndValidate($customData = null, $rule = null)
	{
		$rule = $rule ?? static::rule($this);
		$data = $customData ?? request()->all();
		$attributes = method_exists(static::class, 'attributes') ? static::attributes() : [];

		$validatedData = \Validator::make($data, $rule, [], $attributes)->validate();

		return parent::fill($validatedData);
	}

	/**
     * Filtering Berdasarakan Request User
     * @param $query
     * @param QueryFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, QueryFilters $filters)
    {
        return $filters->apply($query);
    }

	public static function findBySlug($value, $field = 'name')
	{
		return static::where($field, str_replace('-', ' ', $value))->firstOrFail();
	}

	public function scopeSimple($query){
		// if($query->count() <= request()->limit_page) return $query->get();
		return $query->simplePaginate(request()->limit_page)->appends(request()->all());
	}

	public static function checkRelation($class, $id)
	{
		if(isset(config('relation')['\\'.$class])){
			foreach (config('relation')['\\'.$class] as $classSearch => $foreignKey) {
				if($classSearch::where($foreignKey, $id)->first()) return true;
			}
		}

		return false;
	}
}