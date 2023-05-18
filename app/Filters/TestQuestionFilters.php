<?php

namespace App\Filters;

class TestQuestionFilters extends QueryFilters
{

    public function q($value = "all") {
        return (!$this->requestAllData($value)) ? $this->builder : null;
    }

}