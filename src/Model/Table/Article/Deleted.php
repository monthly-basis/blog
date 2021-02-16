<?php
namespace LeoGalleguillos\Blog\Model\Table\Article;

use Laminas\Db\Adapter\Adapter;

class Deleted
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return bool
     */
    public function updateSetToUtcTimestampWhereArticleId(
        int $articleId
    ): bool {
        $sql = '
            UPDATE `article`
               SET `article`.`deleted` = UTC_TIMESTAMP()
             WHERE `article`.`article_id` = ?
                 ;
        ';
        $parameters = [
            $articleId,
        ];
        return (bool) $this->adapter
                           ->query($sql)
                           ->execute($parameters)
                           ->getAffectedRows();
    }
}
