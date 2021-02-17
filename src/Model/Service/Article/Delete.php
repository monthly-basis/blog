<?php
namespace MonthlyBasis\Blog\Model\Service\Article;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Table as BlogTable;

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
