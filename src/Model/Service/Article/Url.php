<?php
namespace MonthlyBasis\Blog\Model\Service\Article;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Service as BlogService;

class Url
{
    public function __construct(
        BlogService\Article\RootRelativeUrl $rootRelativeUrlService
    ) {
        $this->rootRelativeUrlService = $rootRelativeUrlService;
    }

    public function getUrl(BlogEntity\Article $articleEntity): string
    {
        return 'https://'
             . $_SERVER['HTTP_HOST']
             . $this->rootRelativeUrlService->getRootRelativeUrl($articleEntity);
    }
}
