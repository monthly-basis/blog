<?php
namespace MonthlyBasis\Blog\View\Helper\Article;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Service as BlogService;
use Laminas\View\Helper\AbstractHelper;

class RootRelativeUrl extends AbstractHelper
{
    public function __construct(
        BlogService\Article\RootRelativeUrl $rootRelativeUrlService
    ) {
        $this->rootRelativeUrlService = $rootRelativeUrlService;
    }

    public function __invoke(BlogEntity\Article $articleEntity)
    {
        return $this->rootRelativeUrlService->getRootRelativeUrl(
            $articleEntity
        );
    }
}
