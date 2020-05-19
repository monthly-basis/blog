<?php
namespace LeoGalleguillos\Blog;

use Laminas\Db as LaminasDb;
use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\Blog\View\Helper as BlogHelper;
use LeoGalleguillos\Flash\Model\Service as FlashService;
use LeoGalleguillos\String\Model\Service as StringService;
use LeoGalleguillos\User\Model\Factory as UserFactory;
use LeoGalleguillos\User\Model\Service as UserService;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                    'doesVisitorOwnArticle' => BlogHelper\Article\DoesVisitorOwnArticle::class,
                    'doesVisitorOwnBlog' => BlogHelper\DoesVisitorOwnBlog::class,
                    'getArticleRootRelativeUrl' => BlogHelper\Article\RootRelativeUrl::class,
                    'getBlogRootRelativeUrl' => BlogHelper\RootRelativeUrl::class,
                ],
                'factories' => [
                    BlogHelper\Article\DoesVisitorOwnArticle::class => function ($sm) {
                        return new BlogHelper\Article\DoesVisitorOwnArticle(
                            $sm->get(BlogService\Article\DoesVisitorOwnArticle::class)
                        );
                    },
                    BlogHelper\Article\RootRelativeUrl::class => function ($sm) {
                        return new BlogHelper\Article\RootRelativeUrl(
                            $sm->get(BlogService\Article\RootRelativeUrl::class)
                        );
                    },
                    BlogHelper\DoesVisitorOwnBlog::class => function ($sm) {
                        return new BlogHelper\DoesVisitorOwnBlog(
                            $sm->get(BlogService\DoesVisitorOwnBlog::class)
                        );
                    },
                    BlogHelper\RootRelativeUrl::class => function ($sm) {
                        return new BlogHelper\RootRelativeUrl(
                            $sm->get(BlogService\RootRelativeUrl::class)
                        );
                    },
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                BlogFactory\Article::class => function ($sm) {
                    return new BlogFactory\Article(
                        $sm->get(BlogTable\Article::class)
                    );
                },
                BlogFactory\Blog::class => function ($sm) {
                    return new BlogFactory\Blog(
                        $sm->get(BlogTable\Blog::class),
                        $sm->get(UserFactory\User::class)
                    );
                },
                BlogService\Article\Delete::class => function ($sm) {
                    return new BlogService\Article\Delete(
                        $sm->get(BlogTable\Article\Deleted::class)
                    );
                },
                BlogService\Article\DoesVisitorOwnArticle::class => function ($sm) {
                    return new BlogService\Article\DoesVisitorOwnArticle(
                        $sm->get(UserService\LoggedInUser::class)
                    );
                },
                BlogService\Article\IncrementViews::class => function ($sm) {
                    return new BlogService\Article\IncrementViews(
                        $sm->get(BlogTable\Article::class)
                    );
                },
                BlogService\Article\RootRelativeUrl::class => function ($sm) {
                    return new BlogService\Article\RootRelativeUrl(
                        $sm->get(BlogFactory\Blog::class),
                        $sm->get(BlogService\RootRelativeUrl::class),
                        $sm->get(StringService\UrlFriendly::class)
                    );
                },
                BlogService\Article\Url::class => function ($sm) {
                    return new BlogService\Article\Url(
                        $sm->get(BlogService\Article\RootRelativeUrl::class)
                    );
                },
                BlogService\Articles::class => function ($sm) {
                    return new BlogService\Articles(
                        $sm->get(BlogFactory\Article::class),
                        $sm->get(BlogTable\Article::class)
                    );
                },
                BlogService\Blogs::class => function ($sm) {
                    return new BlogService\Blogs(
                        $sm->get(BlogFactory\Blog::class),
                        $sm->get(BlogTable\Blog::class),
                        $sm->get('laminas-db-table-gateway-table-gateway-blog')
                    );
                },
                BlogService\Blogs\User\Count::class => function ($sm) {
                    return new BlogService\Blogs\User\Count(
                        $sm->get(BlogTable\Blog::class)
                    );
                },
                BlogService\Blogs\User\Get::class => function ($sm) {
                    return new BlogService\Blogs\User\Get(
                        $sm->get(BlogFactory\Blog::class),
                        $sm->get(BlogTable\Blog::class)
                    );
                },
                BlogService\Create::class => function ($sm) {
                    return new BlogService\Create(
                        $sm->get(FlashService\Flash::class),
                        $sm->get(BlogFactory\Blog::class),
                        $sm->get(BlogTable\Blog::class),
                        $sm->get(StringService\UrlFriendly::class)
                    );
                },
                BlogService\DoesVisitorOwnBlog::class => function ($sm) {
                    return new BlogService\DoesVisitorOwnBlog(
                        $sm->get(UserService\LoggedInUser::class)
                    );
                },
                BlogService\IncrementViews::class => function ($sm) {
                    return new BlogService\IncrementViews(
                        $sm->get(BlogTable\Blog::class)
                    );
                },
                BlogService\RootRelativeUrl::class => function ($sm) {
                    return new BlogService\RootRelativeUrl();
                },
                BlogService\Url::class => function ($sm) {
                    return new BlogService\Url(
                        $sm->get(BlogService\RootRelativeUrl::class)
                    );
                },
                BlogTable\Blog::class => function ($sm) {
                    return new BlogTable\Blog(
                        $sm->get('blog'),
                        $sm->get('laminas-db-table-gateway-table-gateway-blog')
                    );
                },
                BlogTable\Article::class => function ($sm) {
                    return new BlogTable\Article(
                        $sm->get('blog')
                    );
                },
                BlogTable\Article\Deleted::class => function ($sm) {
                    return new BlogTable\Article\Deleted(
                        $sm->get('blog')
                    );
                },
                'laminas-db-table-gateway-table-gateway-blog' => function ($sm) {
                    return new LaminasDb\TableGateway\TableGateway(
                        'blog',
                        $sm->get('blog')
                    );
                },
            ],
        ];
    }
}
