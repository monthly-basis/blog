<?php
namespace MonthlyBasis\BlogTest\Model\Service\Article;

use DateTime;
use Generator;
use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Factory as BlogFactory;
use MonthlyBasis\Blog\Model\Service as BlogService;
use MonthlyBasis\Blog\Model\Table as BlogTable;
use MonthlyBasis\String\Model\Service as StringService;
use PHPUnit\Framework\TestCase;

class RootRelativeUrlTest extends TestCase
{
    protected function setUp(): void
    {
        $this->blogFactoryMock = $this->createMock(
            BlogFactory\Blog::class
        );
        $this->rootRelativeUrlServiceMock = $this->createMock(
            BlogService\RootRelativeUrl::class
        );
        $this->urlFriendlyServiceMock = $this->createMock(
            StringService\UrlFriendly::class
        );

        $this->rootRelativeUrlService = new BlogService\Article\RootRelativeUrl(
            $this->blogFactoryMock,
            $this->rootRelativeUrlServiceMock,
            $this->urlFriendlyServiceMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            BlogService\Article\RootRelativeUrl::class,
            $this->rootRelativeUrlService
        );
    }
}
