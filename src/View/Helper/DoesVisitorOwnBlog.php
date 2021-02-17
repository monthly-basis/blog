<?php
namespace MonthlyBasis\Blog\View\Helper;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Service as BlogService;
use Laminas\View\Helper\AbstractHelper;

class DoesVisitorOwnBlog extends AbstractHelper
{
    public function __construct(
        BlogService\DoesVisitorOwnBlog $doesVisitorOwnBlogService
    ) {
        $this->doesVisitorOwnBlogService = $doesVisitorOwnBlogService;
    }

    public function __invoke(BlogEntity\Blog $blogEntity)
    {
        return $this->doesVisitorOwnBlogService->doesVisitorOwnBlog(
            $blogEntity
        );
    }
}
