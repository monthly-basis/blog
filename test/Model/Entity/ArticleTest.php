<?php
namespace MonthlyBasis\BlogTest\Model\Entity;

use DateTime;
use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\User\Model\Entity as UserEntity;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    protected function setUp(): void
    {
        $this->articleEntity = new BlogEntity\Article();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            BlogEntity\Article::class,
            $this->articleEntity
        );
    }
}
