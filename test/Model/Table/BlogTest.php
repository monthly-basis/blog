<?php
namespace LeoGalleguillos\BlogTest\Model\Table;

use Generator;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\BlogTest\TableTestCase;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class BlogTest extends TableTestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/test/blog/';

    protected function setUp(): void
    {
        $configArray     = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray     = $configArray['db']['adapters']['test'];
        $this->adapter   = new Adapter($configArray);
        $this->blogTable = new BlogTable\Blog($this->adapter);

        $this->dropTable();
        $this->createTable();
    }

    protected function dropTable()
    {
        $sql = file_get_contents($this->sqlPath . 'drop.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    protected function createTable()
    {
        $sql = file_get_contents($this->sqlPath . 'create.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            BlogTable\Blog::class,
            $this->blogTable
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
