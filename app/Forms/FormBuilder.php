<?php


namespace App\Forms;



abstract class FormBuilder
{
    public function __construct()
    {
        $this->setFields();
    }

    protected abstract function setFields();

    protected abstract function getFields();

    public abstract function getMethod();

}
