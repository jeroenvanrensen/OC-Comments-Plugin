<?php 

namespace JeroenvanRensen\Comments\Models;

use Model;
use October\Rain\Database\Traits\Validation;

class Comment extends Model
{
    use Validation;

    /**
     * The database table used by the model.
     * 
     * @var string
     */
    public $table = 'jeroenvanrensen_comments_comments';

    /**
     * Guarded fields
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * Validation rules for attributes.
     * 
     * @var array
     */
    public $rules = [
        'user_name' => ['required', 'max:255'],
        'user_email' => ['required', 'max:255', 'email'],
        'body' => ['required']
    ];

    /**
     * Casts the approved column to a boolean
     *
     * @var array
     */
    public $casts = [
        'approved' => 'boolean'
    ];

    public $belongsTo = [
        'post' => ['JeroenvanRensen\Blog\Models\Post', 'key' => 'jeroenvanrensen_blog_post_id']
    ];

    public function getApprovedOptions()
    {
        return [
            'False', 'True'
        ];
    }
}
