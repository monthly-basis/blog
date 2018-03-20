<?php
namespace LeoGalleguillos\Blog;

use LeoGalleguillos\Blog\Model\Factory as BlogFactory;
use LeoGalleguillos\Blog\Model\Service as BlogService;
use LeoGalleguillos\Blog\Model\Table as BlogTable;
use LeoGalleguillos\Blog\View\Helper as BlogHelper;
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
                BlogTable\Blog::class => function ($serviceManager) {
                    return new BlogTable\Blog(
                        $serviceManager->get('main')
                    );
                },
            ],
        ];
    }
}
