<?php
namespace LeoGalleguillos\Blog\View\Helper;

use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use Zend\View\Helper\AbstractHelper;

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
