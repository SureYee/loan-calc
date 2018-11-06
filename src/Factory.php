<?php
/**
 * Created by PhpStorm.
 * User: sure
 * Date: 2018-09-15
 * Time: 0:40
 */

namespace SureYee\Calculator;


use SureYee\Calculator\Algorithms\AverageCapitalPlusInterest;
use SureYee\Calculator\Contracts\Algorithm;
use SureYee\Calculator\Contracts\ProjectInterface;

class Factory
{
    /**
     *
     * @param ProjectInterface $project
     * @return Algorithm
     */
    public static function make(ProjectInterface $project)
    {
        $algorithm = $project->getLoanType();

        return new $algorithm($project);
    }
}