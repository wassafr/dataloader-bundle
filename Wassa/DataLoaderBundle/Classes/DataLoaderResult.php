<?php
/*
 * DataLoadResult.php
 *
 * Copyright (C) WASSA SAS - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * 09/06/2015
 */

namespace Wassa\DataLoaderBundle\Classes;


/**
 * Class DataLoaderResult
 * @package Wassa\DataLoaderBundle\Classes
 */
class DataLoaderResult
{
    /**
     * @var int
     */
    protected $returnCode;

    /**
     * @var string
     */
    protected $returnMessage;

    /**
     * @var boolean
     */
    protected $success;


    /**
     * @param $returnCode
     * @param $returnMessage
     * @param $success
     */
    public function __construct($returnCode, $returnMessage, $success)
    {
        $this->returnCode = $returnCode;
        $this->returnMessage = $returnMessage;
        $this->success = $success;
    }

    /**
     * @return int
     */
    public function getReturnCode()
    {
        return $this->returnCode;
    }

    /**
     * @param int $returnCode
     */
    public function setReturnCode($returnCode)
    {
        $this->returnCode = $returnCode;
    }

    /**
     * @return string
     */
    public function getReturnMessage()
    {
        return $this->returnMessage;
    }

    /**
     * @param string $returnMessage
     */
    public function setReturnMessage($returnMessage)
    {
        $this->returnMessage = $returnMessage;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }
}