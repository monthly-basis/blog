<?php
namespace LeoGalleguillos\BlogTest\Model\Factory;

use DateTime;
use Generator;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    protected function setUp(): void
    {
        $this->articleTableMock = $this->createMock(
            BlogTable\Article::class
        );
        $this->articleFactory = new BlogFactory\Article(
            $this->articleTableMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            BlogFactory\Article::class,
            $this->articleFactory
        );
    }
}
