<?php
namespace LeoGalleguillos\BlogTest\Model\Service\Article;

use DateTime;
use Generator;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\String\Model\Service as StringService;
use PHPUnit\Framework\TestCase;

class RootRelativeUrlTest extends TestCase
{
    protected function setUp()
    {
        $this->blogFactoryMock = $this->createMock(
            BlogFactory\Blog::class
        );
        $this->rootRelativeUrlServiceMock = $this->createMock(
            BlogService\RootRelativeUrl::class
        );
        $this->urlFriendlyService = new StringService\UrlFriendly();

        $this->rootRelativeUrlService = new BlogService\Article\RootRelativeUrl(
            $this->blogFactoryMock,
            $this->rootRelativeUrlServiceMock,
            $this->urlFriendlyService
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
