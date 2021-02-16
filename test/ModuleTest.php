<?php
namespace LeoGalleguillos\BlogTest;

use LeoGalleguillos\Blog\Module;
use LeoGalleguillos\Test\ModuleTestCase;
use PHPUnit\Framework\TestCase;
use Laminas\Mvc\Application;

class ModuleTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        $this->module = new Module();
    }
}
