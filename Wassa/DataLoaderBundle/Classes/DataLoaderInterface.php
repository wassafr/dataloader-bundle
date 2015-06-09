<?php
/*
 * DataLoaderInterface.php
 *
 * Copyright (C) WASSA SAS - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * 09/06/2015
 */

namespace Wassa\DataLoaderBundle\Classes;


/**
 * Interface DataLoaderInterface
 * @package Wassa\DataLoaderBundle\Classes
 */
interface DataLoaderInterface
{
    /**
     * @return DataLoaderResult
     */
    public function run();
}