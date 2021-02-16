<?php
namespace LeoGalleguillos\BlogTest\Model\Table;

use Generator;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\BlogTest\TableTestCase;
use Laminas\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TableTestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/test/article/';

    protected function setUp(): void
    {
        $configArray     = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray     = $configArray['db']['adapters']['test'];
        $this->adapter   = new Adapter($configArray);
        $this->articleTable = new BlogTable\Article($this->adapter);

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
            BlogTable\Article::class,
            $this->articleTable
        );
    }

    public function testInsert()
    {
        $articleId = $this->articleTable->insert(
            1,
            2,
            'title',
            'body'
        );
        $this->assertSame(
            1,
            $articleId
        );
    }
}
