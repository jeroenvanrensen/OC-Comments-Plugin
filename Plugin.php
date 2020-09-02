<?php

namespace JeroenvanRensen\Comments;

use Backend;
use Event;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * This plugin requires JeroenvanRensen.Blog to work properly
     *
     * @var array
     */
    public $require = [
        'JeroenvanRensen.Blog'
    ];

    /**
     * Returns the details about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Comments',
            'description' => 'An easy way to provide a comments section for your blog.',
            'author' => 'JeroenvanRensen',
            'icon' => 'icon-comments'
        ];
    }

    /**
     * Adds the comments section to the backend menu.
     *
     * @return  void
     */
    public function boot()
    {
        Event::listen('backend.menu.extendItems', function($manager) {
            $manager->addSideMenuItems('JeroenvanRensen.Blog', 'blog', [
                'comments' => [
                    'label' => 'Comments',
                    'url' => Backend::url('jeroenvanrensen/comments/comments'),
                    'icon' => 'icon-comments',
                    'permissions' => [
                        'jeroenvanrensen.comments.manage_comments'
                    ]
                ]
            ]);
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'JeroenvanRensen\Comments\Components\CommentsForm' => 'commentsForm',
        ];
    }

    /**
     * Registers the permissions for this plugin.
     *
     * @return  array
     */
    public function registerPermissions()
    {
        return [
            'jeroenvanrensen.comments.manage_comments' => [
                'label' => 'Manage the Comments (create, edit & delete)',
                'tab' => 'Blog'
            ]
        ];
    }
}
