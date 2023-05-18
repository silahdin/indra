<?php

namespace App\Filters;

class TestStepFilters extends QueryFilters
{

    public function q($value = "all") {

    	if($this->requestAllData($value)) return null;

        return $this->builder->where(function($q) use ($value){
	        		return $q->whereHas('module', function($q2) use ($value){
	        			return $q2->where('test_modules.name', 'LIKE', '%'.$value.'%');
	        		});
        		});
    }

    public function byName($value = '')
    {
        return $this->builder->where('name', 'LIKE', '%'.$value.'%');
    }

}