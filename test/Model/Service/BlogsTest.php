<?php
namespace MonthlyBasis\BlogTest\Model\Service;

use Laminas\Db as LaminasDb;
use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Factory as BlogFactory;
use MonthlyBasis\Blog\Model\Service as BlogService;
use MonthlyBasis\Blog\Model\Table as BlogTable;
use MonthlyBasis\LaminasTest\Hydrator as TestHydrator;
use PHPUnit\Framework\TestCase;

class BlogsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->blogFactoryMock = $this->createMock(
            BlogFactory\Blog::class
        );
        $this->blogTableMock = $this->createMock(
            BlogTable\Blog::class
        );
        $this->blogsService = new BlogService\Blogs(
            $this->blogFactoryMock,
            $this->blogTableMock
        );
    }

    public function test_getBlogs()
    {
        $hydrator = new TestHydrator\CountableIterator();
        $resultSetMock = $this->createMock(
            LaminasDb\ResultSet\ResultSet::class
        );
        $hydrator->hydrate(
            $resultSetMock,
            [
                ['slug' => 'slug1'],
                ['slug' => 'slug2'],
            ]
        );
        $blog1 = new BlogEntity\Blog();
        $blog2 = new BlogEntity\Blog();
        $this->blogTableMock
            ->expects($this->once())
            ->method('select')
            ->willReturn($resultSetMock);
        $this->blogFactoryMock
            ->expects($this->exactly(2))
            ->method('buildFromArray')
            ->withConsecutive(
                [['slug' => 'slug1']],
                [['slug' => 'slug2']]
            )->will(
                $this->onConsecutiveCalls(
                    $blog1,
                    $blog2
                )
            );
        $generator = $this->blogsService->getBlogs();
        $blogs = iterator_to_array($generator);
    }
}
