<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-09-11
 * Time: 11:58
 */

namespace SureYee\Calculator\Contracts;


interface ProjectInterface
{

    /**
     * 获取标的还款期数
     * @return int
     */
    public function getVols();

    /**
     * 获取标的类型
     * @return int
     */
    public function getLoanType();

    /**
     * 获取标的借款期限
     * @param string $unit
     * @return int
     */
    public function getTerm($unit = 'M');

    /**
     * 获取标的金额
     * @return int
     */
    public function getAmount():int;

    /**
     * 获取年化利率
     */
    public function getRate():float;

    /**
     * 获取月利率
     * @return float
     */
    public function getMonthRate():float;
}