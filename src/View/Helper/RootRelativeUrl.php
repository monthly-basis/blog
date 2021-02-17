<?php
namespace MonthlyBasis\Blog\View\Helper;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Service as BlogService;
use Laminas\View\Helper\AbstractHelper;

class RootRelativeUrl extends AbstractHelper
{
    public function __construct(
        BlogService\RootRelativeUrl $rootRelativeUrlService
    ) {
        $this->rootRelativeUrlService = $rootRelativeUrlService;
    }

    public function __invoke(BlogEntity\Blog $blogEntity)
    {
        return $this->rootRelativeUrlService->getRootRelativeUrl(
            $blogEntity
        );
    }
}
