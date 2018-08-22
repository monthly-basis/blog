<?php
namespace LeoGalleguillos\Blog\Model\Service\Article;

use Generator;
use LeoGalleguillos\Blog\Model\Entity as BlogEntity;
use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\String\Model\Service as StringService;

class RootRelativeUrl
{
    public function __construct(
        BlogFactory\Blog $blogFactory,
        BlogService\RootRelativeUrl $rootRelativeUrlService,
        StringService\UrlFriendly $urlFriendlyService
    ) {
        $this->blogFactory            = $blogFactory;
        $this->rootRelativeUrlService = $rootRelativeUrlService;
        $this->urlFriendlyService     = $urlFriendlyService;
    }

    public function getRootRelativeUrl(BlogEntity\Article $articleEntity): string
    {
        $blogEntity = $this->blogFactory->buildFromBlogId(
            $articleEntity->getBlogId()
        );
        $blogRootRelativeUrl = $this->rootRelativeUrlService->getRootRelativeUrl(
            $blogEntity
        );

        return $blogRootRelativeUrl
             . '/articles/'
             . $articleEntity->getArticleId()
             . '/'
             . $this->urlFriendlyService->getUrlFriendly($articleEntity->getTitle());
    }
}
