<?php
namespace LeoGalleguillos\Blog;

use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\Blog\View\Helper as BlogHelper;
use LeoGalleguillos\Flash\Model\Service as FlashService;
use LeoGalleguillos\String\Model\Service as StringService;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                ],
                'factories' => [
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                BlogFactory\Blog::class => function ($serviceManager) {
                    return new BlogFactory\Blog(
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
                BlogTable\Blog::class => function ($serviceManager) {
                    return new BlogTable\Blog(
                        $serviceManager->get('main')
                    );
                },
            ],
        ];
    }
}
