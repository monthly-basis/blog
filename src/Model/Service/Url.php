<?php
namespace LeoGalleguillos\Blog\Model\Service;

use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Service as BlogService;

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
             . '/'
             . $this->rootRelativeUrlService->getRootRelativeUrl($blogEntity);
    }
}
