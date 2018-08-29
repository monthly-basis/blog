<?php
namespace LeoGalleguillos\Blog\Model\Service\Article;

use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Table as BlogTable;

class Delete
{
    public function __construct(
        BlogTable\Article\Deleted $deletedTable
    ) {
        $this->deletedTable = $deletedTable;
    }

    public function delete(BlogEntity\Article $articleEntity): bool
    {
        return $this->deletedTable->updateSetToUtcTimestampWhereArticleId(
            $articleEntity->getArticleId()
        );
    }
}
