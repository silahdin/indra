<?php

namespace App\Filters;

class TestModuleFilters extends QueryFilters
{

    public function q($value = "all") {
        return (!$this->requestAllData($value)) ? $this->builder->where('name', 'LIKE', '%'.$value.'%') : null;
    }

    public function byName($value = '')
    {
        return $this->builder->where('name', 'LIKE', '%'.$value.'%');
    }

}