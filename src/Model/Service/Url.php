<?php
namespace MonthlyBasis\Blog\Model\Service;

use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Service as BlogService;

class Url
{
    public function __construct(
        BlogService\RootRelativeUrl $rootRelativeUrlService
    ) {
        $this->rootRelativeUrlService = $rootRelativeUrlService;
    }

    public function getUrl(BlogEntity\Blog $blogEntity): string
    {
        return 'https://'
             . $_SERVER['HTTP_HOST']
             . $this->rootRelativeUrlService->getRootRelativeUrl($blogEntity);
    }
}
