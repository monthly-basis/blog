<?php
namespace LeoGalleguillos\BlogTest\Model\Entity;

use DateTime;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\User\Model\Entity as UserEntity;
use PHPUnit\Framework\TestCase;

class BlogTest extends TestCase
{
    protected function setUp(): void
    {
        $this->blogEntity = new BlogEntity\Blog();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            BlogEntity\Blog::class,
            $this->blogEntity
        );
    }

    public function testGettersAndSetters()
    {
        $userEntity = new UserEntity\User();
        $this->assertSame(
            $this->blogEntity->setUser($userEntity),
            $this->blogEntity
        );
        $this->assertSame(
            $userEntity,
            $this->blogEntity->getUser()
        );

        $created = new DateTime();
        $this->blogEntity->setCreated($created);
        $this->assertSame(
            $created,
            $this->blogEntity->getCreated()
        );
    }
}
