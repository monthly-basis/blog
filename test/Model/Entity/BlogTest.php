<?php
namespace LeoGalleguillos\BlogTest\Model\Entity;

use DateTime;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use PHPUnit\Framework\TestCase;

class BlogTest extends TestCase
{
    protected function setUp()
    {
        $this->questionEntity = new BlogEntity\Blog();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            BlogEntity\Blog::class,
            $this->questionEntity
        );
    }

    public function testGettersAndSetters()
    {
        $userId = 123;
        $this->questionEntity->setUserId($userId);
        $this->assertSame(
            $userId,
            $this->questionEntity->getUserId()
        );

        $created = new DateTime();
        $this->questionEntity->setCreated($created);
        $this->assertSame(
            $created,
            $this->questionEntity->getCreated()
        );
    }
}
