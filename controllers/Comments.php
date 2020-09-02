<?php namespace 

JeroenvanRensen\Comments\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Comments extends Controller
{
    /**
     * Behaviors that are implemented by this controller.
     * 
     * @var array
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * Configuration file for the `FormController` behavior.
     * 
     * @var string
     */
    public $formConfig = 'config_form.yaml';

    /**
     * Configuration file for the `ListController` behavior.
     * 
     * @var string
     */
    public $listConfig = 'config_list.yaml';

    /**
     * Sets the required permissions to use this controller.
     *
     * @var array
     */
    public $requiredPermissions = [
        'jeroenvanrensen.comments.manage_comments'
    ];

    /**
     * Set the backend menu
     *
     * @return  null
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('JeroenvanRensen.Blog', 'blog');
    }
}
