<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-09-14
 * Time: 22:38
 */

namespace SureYee\Calculator\Algorithms;

use SureYee\Calculator\Contracts\Algorithm;

/**
 * 等额本息
 * Class AverageCapitalPlusInterest
 * @package SureYee\Calculator\Algorithms
 */
class AverageCapitalPlusInterest extends Algorithm
{

    protected  $repay;
    /**
     * @param $vol
     * @return float|int
     */
    public function amountAlgorithm($vol):int
    {
        if ($vol < $this->project->getVols()) {
            return $this->getAmount($vol);
        }

        return isset($this->amounts[$vol]) ? $this->amounts[$vol] : $this->getLastAmount();
    }

    /**
     * 利息列表
     * @param $vol
     */
    public function interestAlgorithm($vol):int
    {
        return $this->getInterest($vol);
    }

    /**
     * 本金计算公式
     * @param $n
     * @return int
     */
    protected function amountFormula($n):int
    {
        $A = $this->project->getAmount();
        $b = $this->project->getMonthRate();
        $k = $this->project->getVols();
        return round((($A * $b * pow(1 + $b, $k)) / (pow(1 + $b, $k) - 1) - $A * $b) * pow(1 + $b, $n - 1));
    }

    protected function interestFormula($n):int
    {
        $A = $this->project->getAmount();
        $b = $this->project->getMonthRate();
        $k = $this->project->getVols();
        $this->repay = round(($A * $b * pow(1 + $b, $k)) / (pow(1 + $b, $k) - 1));
        return  $this->repay - $this->amountAlgorithm($n) ;
    }

    protected function getLastAmount()
    {
        $vol = $this->project->getVols();
        $amount = 0;
        for ($i = 1; $i < $vol; $i++) {
            $amount += $this->getAmount($i);
        }
        return $this->project->getAmount() - $amount;
    }
}