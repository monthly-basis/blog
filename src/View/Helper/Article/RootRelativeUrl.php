<?php
namespace LeoGalleguillos\Blog\View\Helper\Article;

use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use Zend\View\Helper\AbstractHelper;

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
