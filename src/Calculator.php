<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-09-15
 * Time: 0:36
 */

namespace SureYee\Calculator;


use SureYee\Calculator\Contracts\Algorithm;
use SureYee\Calculator\Contracts\ProjectInterface;

class Calculator
{
    public $project;

    public $algorithm;

    public function __construct(ProjectInterface $project, Algorithm $algorithm = null)
    {
        $this->project = $project;
        $this->algorithm = $algorithm ?? Factory::make($this->project);
    }

    /**
     * 计算所有的列表
     * @return array
     */
    public function calculate()
    {
        $schedules = [];
        $vols = $this->project->getVols();
        for ($i = 1; $i <= $vols; $i++) {
            $amount = $this->algorithm->amountAlgorithm($i);
            $interest = $this->algorithm->interestAlgorithm($i);
            $schedules[$i]['amount'] = $amount;
            $schedules[$i]['interest'] = $interest;
        }
        return $schedules;
    }

    public function repayList()
    {
        $schedules = [];
        $vols = $this->project->getVols();
        for ($i = 1; $i <= $vols; $i++) {
            $schedules[$i] = $this->algorithm->amountAlgorithm($i) + $this->algorithm->interestAlgorithm($i);
        }
        return $schedules;
    }

    public function amountList()
    {
        $schedules = [];
        $vols = $this->project->getVols();
        for ($i = 1; $i <= $vols; $i++) {
            $schedules[$i] = $this->algorithm->amountAlgorithm($i);
        }
        return $schedules;
    }

    public function interestList()
    {
        $schedules = [];
        $vols = $this->project->getVols();
        for ($i = 1; $i <= $vols; $i++) {
            $schedules[$i] = $this->algorithm->interestAlgorithm($i);
        }
        return $schedules;
    }

    public function calc($i)
    {
        $amount = $this->algorithm->amountAlgorithm($i);
        $interest = $this->algorithm->interestAlgorithm($i);
        $schedules['amount'] = $amount;
        $schedules['interest'] = $interest;
        return $schedules;
    }

    public function repay($i)
    {
        return  $this->algorithm->amountAlgorithm($i) + $this->algorithm->interestAlgorithm($i);
    }

    public function amount($i)
    {
        return $this->algorithm->amountAlgorithm($i);
    }

    public function interest($i)
    {
        return $this->algorithm->interestAlgorithm($i);
    }
}