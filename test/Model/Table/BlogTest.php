<?php
namespace LeoGalleguillos\BlogTest\Model\Table;

use Generator;
use Laminas\Db as LaminasDb;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\Test\TableTestCase;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class BlogTest extends TableTestCase
{
    protected function setUp(): void
    {
        $this->dropAndCreateTable('blog');

        $this->blogTable = new BlogTable\Blog(
            $this->getAdapter(),
            $this->getTableGateway('blog')
        );
    }

    public function testInsertAndSelectCount()
    {
        $this->assertSame(
            0,
            $this->blogTable->selectCount()
        );
        $this->blogTable->insert(1, 'name', 'slug', 'description');
        $this->blogTable->insert(1, 'name', 'slug2', 'description');
        $this->blogTable->insert(1, 'name', 'slug3', 'description');
        $this->assertSame(
            3,
            $this->blogTable->selectCount()
        );
    }

    public function test_select()
    {
        $this->getTableGateway('blog')->insert([
            'user_id' => 1,
            'name' => 'name 1',
            'slug' => 'slug1',
            'description' => 'description',
            'created' => new LaminasDb\Sql\Expression('UTC_TIMESTAMP()'),
        ]);
        $this->getTableGateway('blog')->insert([
            'user_id' => 1,
            'name' => 'name 2',
            'slug' => 'slug2',
            'description' => 'description',
            'created' => new LaminasDb\Sql\Expression('UTC_TIMESTAMP()'),
        ]);
        $this->getTableGateway('blog')->insert([
            'user_id' => 1,
            'name' => 'name 3',
            'slug' => 'slug3',
            'description' => 'description',
            'created' => new LaminasDb\Sql\Expression('UTC_TIMESTAMP()'),
        ]);
        $this->getTableGateway('blog')->update(
            ['deleted_datetime' => new LaminasDb\Sql\Expression('UTC_TIMESTAMP()')],
            ['blog_id' => 2]
        );

        $resultSet = $this->blogTable->select();

        $this->assertCount(
            2,
            $resultSet
        );
        $array = iterator_to_array($resultSet);
        $this->assertSame(
            'name 1',
            $array[0]['name']
        );
        $this->assertSame(
            'name 3',
            $array[1]['name']
        );
    }

    public function testSelectWhereBlogId()
    {
        $this->blogTable->insert(234, 'the name', 'slug', 'description');
        $array = $this->blogTable->selectWhereBlogId(1);
        $this->assertSame(
            $array['blog_id'],
            '1'
        );
        $this->assertSame(
            $array['user_id'],
            '234'
        );
        $this->assertSame(
            $array['name'],
            'the name'
        );
    }
}
