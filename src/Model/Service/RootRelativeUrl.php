<?php
namespace MonthlyBasis\Blog\Model\Service;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;

class RootRelativeUrl
{
    /**
     * Get root-relative URL.
     *
     * @param BlogEntity\Blog $blogEntity
     * @return string
     */
    public function getRootRelativeUrl(BlogEntity\Blog $blogEntity): string
    {
        return '/blogs/'
             . $blogEntity->getBlogId()
             . '/'
             . $blogEntity->getSlug();
    }
}
