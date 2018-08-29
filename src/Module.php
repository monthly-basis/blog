<?php
namespace LeoGalleguillos\Blog;

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
                    'getArticleRootRelativeUrl' => BlogHelper\Article\RootRelativeUrl::class,
                    'getBlogRootRelativeUrl' => BlogHelper\RootRelativeUrl::class,
                ],
                'factories' => [
                    BlogHelper\Article\RootRelativeUrl::class => function ($serviceManager) {
                        return new BlogHelper\Article\RootRelativeUrl(
                            $serviceManager->get(BlogService\Article\RootRelativeUrl::class)
                        );
                    },
                    BlogHelper\RootRelativeUrl::class => function ($serviceManager) {
                        return new BlogHelper\RootRelativeUrl(
                            $serviceManager->get(BlogService\RootRelativeUrl::class)
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
                BlogFactory\Article::class => function ($serviceManager) {
                    return new BlogFactory\Article(
                        $serviceManager->get(BlogTable\Article::class)
                    );
                },
                BlogFactory\Blog::class => function ($serviceManager) {
                    return new BlogFactory\Blog(
                        $serviceManager->get(BlogTable\Blog::class),
                        $serviceManager->get(UserFactory\User::class)
                    );
                },
                BlogService\Article\Delete::class => function ($serviceManager) {
                    return new BlogService\Article\Delete(
                        $serviceManager->get(BlogTable\Article\Deleted::class)
                    );
                },
                BlogService\Article\RootRelativeUrl::class => function ($serviceManager) {
                    return new BlogService\Article\RootRelativeUrl(
                        $serviceManager->get(BlogFactory\Blog::class),
                        $serviceManager->get(BlogService\RootRelativeUrl::class),
                        $serviceManager->get(StringService\UrlFriendly::class)
                    );
                },
                BlogService\Articles::class => function ($serviceManager) {
                    return new BlogService\Articles(
                        $serviceManager->get(BlogFactory\Article::class),
                        $serviceManager->get(BlogTable\Article::class)
                    );
                },
                BlogService\Blogs::class => function ($serviceManager) {
                    return new BlogService\Blogs(
                        $serviceManager->get(BlogFactory\Blog::class),
                        $serviceManager->get(BlogTable\Blog::class)
                    );
                },
                BlogService\Blogs\User\Count::class => function ($serviceManager) {
                    return new BlogService\Blogs\User\Count(
                        $serviceManager->get(BlogTable\Blog::class)
                    );
                },
                BlogService\Blogs\User\Get::class => function ($serviceManager) {
                    return new BlogService\Blogs\User\Get(
                        $serviceManager->get(BlogFactory\Blog::class),
                        $serviceManager->get(BlogTable\Blog::class)
                    );
                },
                BlogService\Create::class => function ($serviceManager) {
                    return new BlogService\Create(
                        $serviceManager->get(FlashService\Flash::class),
                        $serviceManager->get(BlogFactory\Blog::class),
                        $serviceManager->get(BlogTable\Blog::class),
                        $serviceManager->get(StringService\UrlFriendly::class)
                    );
                },
                BlogService\DoesVisitorOwnBlog::class => function ($serviceManager) {
                    return new BlogService\DoesVisitorOwnBlog(
                        $serviceManager->get(UserService\LoggedInUser::class)
                    );
                },
                BlogService\IncrementViews::class => function ($serviceManager) {
                    return new BlogService\IncrementViews(
                        $serviceManager->get(BlogTable\Blog::class)
                    );
                },
                BlogService\RootRelativeUrl::class => function ($serviceManager) {
                    return new BlogService\RootRelativeUrl();
                },
                BlogTable\Blog::class => function ($serviceManager) {
                    return new BlogTable\Blog(
                        $serviceManager->get('main')
                    );
                },
                BlogTable\Article::class => function ($serviceManager) {
                    return new BlogTable\Article(
                        $serviceManager->get('main')
                    );
                },
                BlogTable\Article\Deleted::class => function ($serviceManager) {
                    return new BlogTable\Article\Deleted(
                        $serviceManager->get('main')
                    );
                },
            ],
        ];
    }
}
