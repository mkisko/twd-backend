<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21/07/2019
 * Time: 12:28
 */

namespace App\Helper;


interface ReportInterface
{
    public function getDateTime(): int;
    public function getValue(): float;
}