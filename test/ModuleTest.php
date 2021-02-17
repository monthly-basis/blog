<?php
namespace MonthlyBasis\BlogTest;

use MonthlyBasis\Blog\Module;
use MonthlyBasis\LaminasTest\ModuleTestCase;
use PHPUnit\Framework\TestCase;
use Laminas\Mvc\Application;

class ModuleTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        $this->module = new Module();
    }
}
