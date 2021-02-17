<?php
namespace MonthlyBasis\Blog\Model\Service\Article;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Table as BlogTable;

class IncrementViews
{
    public function __construct(
        BlogTable\Article $articleTable
    ) {
        $this->articleTable = $articleTable;
    }

    public function incrementViews(
        BlogEntity\Article $articleEntity
    ): bool {
        return (bool) $this->articleTable->updateSetViewsViewsPlusOneWhereArticleId(
            $articleEntity->getArticleId()
        );
    }
}
