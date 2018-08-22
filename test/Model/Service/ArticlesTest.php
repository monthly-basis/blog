<?php
namespace LeoGalleguillos\BlogTest\Model\Entity;

use DateTime;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use PHPUnit\Framework\TestCase;

class ArticlesTest extends TestCase
{
    protected function setUp()
    {
        $this->articleFactoryMock = $this->createMock(
            BlogFactory\Article::class
        );
        $this->articleTableMock = $this->createMock(
            BlogTable\Article::class
        );
        $this->articlesService = new BlogService\Articles(
            $this->articleFactoryMock,
            $this->articleTableMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            BlogService\Articles::class,
            $this->articlesService
        );
    }
}
