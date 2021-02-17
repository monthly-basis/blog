<?php
namespace MonthlyBasis\Blog\Model\Service\Article;

use Generator;
use MonthlyBasis\Blog\Model\Entity as BlogEntity;
use MonthlyBasis\Blog\Model\Factory as BlogFactory;
use MonthlyBasis\Blog\Model\Service as BlogService;
use MonthlyBasis\Blog\Model\Table as BlogTable;
use MonthlyBasis\String\Model\Service as StringService;

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
