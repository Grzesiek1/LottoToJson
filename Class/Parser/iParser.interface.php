<?php

/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2019-01-06
 * Time: 02:50
 */
interface iParser
{
    public function extract(string $pageSource);
}