<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-09-14
 * Time: 23:15
 */

namespace SureYee\Calculator\Contracts;


abstract class Algorithm
{
    protected $amounts = [];

    protected $interests = [];
    /**
     * @var ProjectInterface $project
     */
    public $project;

    public function __construct(ProjectInterface $project)
    {
        $this->project = $project;
    }

    /**
     * 计算本金
     * @param $vol
     * @return int
     */
    abstract public function amountAlgorithm($vol):int;

    /**
     * 计算利息
     * @param $vol
     * @return int
     */
    abstract public function interestAlgorithm($vol):int;

    /**
     * 本金计算公式
     * @param $vol
     * @return int
     */
    abstract protected function amountFormula($vol):int;

    /**
     * 利息计算公式
     * @param $vol
     * @return int
     */
    abstract protected function interestFormula($vol):int;

    /**
     * 获取单期本金
     * @param int $i
     * @return mixed
     */
    protected function getAmount(int $i) {
        if (!isset($this->amounts[$i])) {
            $this->amounts[$i] = $this->amountFormula($i);
        }
        return $this->amounts[$i];
    }

    /**
     * 获取单期利息
     * @param int $i
     * @return mixed
     */
    protected function getInterest(int $i) {
        if (!isset($this->interests[$i])) {
            $this->interests[$i] = $this->interestFormula($i);
        }
        return $this->interests[$i];
    }
}