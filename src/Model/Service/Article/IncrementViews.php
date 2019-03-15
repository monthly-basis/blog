<?php
namespace LeoGalleguillos\Blog\Model\Service\Article;

use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Table as BlogTable;

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
