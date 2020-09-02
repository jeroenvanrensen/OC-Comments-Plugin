<?php

namespace JeroenvanRensen\Comments\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use JeroenvanRensen\Blog\Models\Post;
use JeroenvanRensen\Comments\Models\Comment;

class CommentsForm extends ComponentBase
{
    /**
     * An array with all the comments.
     *
     * @var array
     */
    public $comments;

    /**
     * Returns the details about this component.
     *
     * @return  array
     */
    public function componentDetails()
    {
        return [
            'name' => 'Comments Form',
            'description' => 'A new comment form & a comment list'
        ];
    }

    /**
     * Defines the properties for this component.
     *
     * @return  array
     */
    public function defineProperties()
    {
        return [
            'postAttribute' => [
                'title' => 'Post URL Attribute',
                'description' => 'The URL section for the post',
                'type' => 'string',
                'default' => '{{ :slug }}',
                'validationPattern' => '^[a-z:]*$',
                'validationMessage' => 'You can only use lowercase letters (a-z) and colon (:)'
            ],
            'defaultApproved' => [
                'title' => 'Default Approved',
                'description' => 'Select if new comments should be approved by default or not',
                'type' => 'dropdown',
                'default' => 'false',
                'options' => [
                    'true' => 'True',
                    'false' => 'False'
                ]
            ]
        ];
    }

    /**
     * Fill the $comments variable with all the comments.
     *
     * @return  void
     */
    public function onRun()
    {
        $this->comments = $this->getComments();
    }

    /**
     * Adds a new comment to the DB.
     *
     * @return  void
     */
    public function onAddComment()
    {
        Comment::create([
            'jeroenvanrensen_blog_post_id' => $this->getPostId(),
            'user_name' => post('user_name'),
            'user_email' => post('user_email'),
            'body' => post('body'),
            'approved' => $this->approved()
        ]);

        $this->page['comments'] = $this->getComments();
    }

    /**
     * Returns all the comments for this post.
     *
     * @return  array
     */
    protected function getComments()
    {
        return Comment::where('jeroenvanrensen_blog_post_id', $this->getPostId())
            ->where('approved', true)
            ->get();
    }

    /**
     * Returns the ID of the current post.
     *
     * @return  int
     */
    protected function getPostId()
    {
        return Post::where('published_at', '<=', Carbon::now())
            ->where('slug', $this->param('slug'))
            ->first()
            ->id;
    }

    /**
     * Returns if a new comments should be approved by default or not.
     *
     * @return  int
     */
    protected function approved()
    {
        return $this->property('defaultApproved') == 'true' ? true : false;
    }
}
