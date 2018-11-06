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

    abstract public function amountAlgorithm($vol):int;
    abstract public function interestAlgorithm($vol):int;

    abstract protected function amountFormula($vol):int;
    abstract protected function interestFormula($vol):int;

    protected function getAmount(int $i) {
        if (!isset($this->amounts[$i])) {
            $this->amounts[$i] = $this->amountFormula($i);
        }
        return $this->amounts[$i];
    }

    protected function getInterest(int $i) {
        if (!isset($this->interests[$i])) {
            $this->interests[$i] = $this->interestFormula($i);
        }
        return $this->interests[$i];
    }
}