<?php
namespace MonthlyBasis\BlogTest\Model\Factory;

use DateTime;
use Generator;
use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Factory as BlogFactory;
use MonthlyBasis\Blog\Model\Service as BlogService;
use MonthlyBasis\Blog\Model\Table as BlogTable;
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
