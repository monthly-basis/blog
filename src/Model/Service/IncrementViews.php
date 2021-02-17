<?php
namespace MonthlyBasis\Blog\Model\Service;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Table as BlogTable;

class IncrementViews
{
    /**
     * Construct.
     *
     * @param BlogTable\Blog $blogTable
     */
    public function __construct(
        BlogTable\Blog $blogTable
    ) {
        $this->blogTable = $blogTable;
    }

    /**
     * Increment views.
     *
     * @param BlogEntity\Blog $blogEntity
     * @return bool
     */
    public function incrementViews(BlogEntity\Blog $blogEntity)
    {
        return $this->blogTable->updateViewsWhereBlogId(
            $blogEntity->getBlogId()
        );
    }
}
