<?php
namespace LeoGalleguillos\BlogTest;

use LeoGalleguillos\Blog\Module;
use LeoGalleguillos\Test\ModuleTestCase;
use PHPUnit\Framework\TestCase;
use Zend\Mvc\Application;

class ModuleTest extends ModuleTestCase
{
    protected function setUp()
    {
        $this->module = new Module();
    }
}
