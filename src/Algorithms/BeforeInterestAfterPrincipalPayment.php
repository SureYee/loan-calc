<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-11-06
 * Time: 17:44
 */

namespace SureYee\Calculator\Algorithms;


use SureYee\Calculator\Contracts\Algorithm;

class BeforeInterestAfterPrincipalPayment extends Algorithm
{

    public function amountAlgorithm($vol):int
    {
        return $this->amountFormula($vol);
    }

    public function interestAlgorithm($vol):int
    {
        return $this->interestFormula($vol);
    }

    protected function amountFormula($vol):int
    {
        return $vol == $this->project->getVols() ? intval($this->project->getAmount()) : 0;
    }

    protected function interestFormula($vol):int
    {
        return round($this->project->getAmount() * $this->project->getMonthRate());
    }
}