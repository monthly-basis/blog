<?php
namespace LeoGalleguillos\BlogTest\Model\Service;

use DateTime;
use Generator;
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

    public function testGetArticles()
    {
        $blogEntity = new BlogEntity\Blog();
        $blogEntity->setBlogId(123);
        $articleEntities  = $this->articlesService->getArticles(
            $blogEntity
        );
        $this->articleTableMock->method('selectWhereBlogIdAndDeletedIsNullOrderByCreatedDesc')->willReturn(
            $this->yieldArrays()
        );
        $this->assertInstanceOf(
            Generator::class,
            $articleEntities
        );
        $articleEntities = iterator_to_array($articleEntities);
        $this->assertSame(
            3,
            count($articleEntities)
        );
    }

    protected function yieldArrays()
    {
        yield [];
        yield [];
        yield [];
    }
}
