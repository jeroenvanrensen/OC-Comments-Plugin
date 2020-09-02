# OctoberCMS Comments Plugin

An easy way to provide a comments section for your blog.

# Contents

- Features
- Installation & Setup
  - Installation
  - Managing comments
  - Showing comments
- Components
  - Comments Form
- Available languages
- Support

# Features

- You can easily add a comments section
- It uses AJAX, so no ugly page refreshes
- You can approve comments manually or automatically

# Installation & Setup

Follow these steps to get this comments plugin up and running.

## Installation

Follow these steps to install this plugin.

**Note:** This plugin requires the [JeroenvanRensen Blog Plugin](https://octobercms.com/plugin/jeroenvanrensen-blog).

1. Login to your OctoberCMS Admin Area
2. Navigate to **Settings** > **Updates & Plugins**
3. Click **Install plugins**
4. Search for "JeroenvanRensen Comments"
5. Click at the first result to install
6. Wait for the installation to complete

## Managing comments

If you navigate to **Blog** and then click **Comments**. Here you can see all the comments. You can approve them by clicking them and change the Approved column.

## Showing comments

You can use this component:

- `commentsForm`: A new comment form & a comment list

**Note:** To use this component, you have to use **jQuery** and `{% framework extras %}`.

*Please take a look at the **Components** section for further details.*

# Components
All components and their documentation.

## Comments Form
A new comment form & a comment list.

### Usage
```
[commentsForm]
postAttribute = "{{ :slug }}"
defaultApproved = "false"
==
{% component 'commentsForm' %}
```

### Running Process
The component will get all comments by the current post from the DB. They will be rendered in an extra partial.

If a user leaves a new comment, the comment will be saved in the DB and the partial will be refreshed.

### Properties
Name | Type | Default value | Description
--- | --- | --- | ---
`postAttribute` | string | {{ :slug }} | The URL section for the post
`defaultApproved` | dropdown | false | Select if new comments should be approved by default or not

### Default HTML Markup

`default.htm`
```
{% set comments = __SELF__.comments %}

<h3>Leave a Comment</h3>

<form
    data-request="{{ __SELF__ }}::onAddComment"
    data-request-validate
    data-request-success="
        $('#user_name').val('');
        $('#user_email').val('');
        $('#body').val('');
    "
    data-request-update="'{{ __SELF__ }}::_comments': '#comments'"
>
    <div class="form-group mb-3">
        <div class="row">
            <div class="col-md-6">
                <label for="user_name" class="form-label">Name</label>
                <input type="text" name="user_name" id="user_name" class="form-control mb-1" />
                <small class="text-danger" data-validate-for="user_name"></small>
            </div>

            <div class="col-md-6">
                <label for="user_email" class="form-label">Email</label>
                <input type="text" name="user_email" id="user_email" class="form-control" />
                <small class="text-danger" data-validate-for="user_email"></small>
            </div>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea name="body" id="body" class="form-control"></textarea>
        <small class="text-danger" data-validate-for="body"></small>
    </div>

    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form>

<h3>All Comments</h3>

<ul id="comments">
    {% partial __SELF__ ~ '::_comments' comments=comments %}
</ul>
```

`_comments.htm`
```
{% for comment in comments %}
    <li><b>{{ comment.user_name }}</b>: {{ comment.body }}</li>
{% endfor %}
```

# Available languages

This plugin is currently available in these languages:

- English (en)

# Support

If you have some questions, found a bug, or have a feature request, please create a new Issue at [GitHub](https://github.com/JeroenvanRensen/OC-Comments-Plugin).
