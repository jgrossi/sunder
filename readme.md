# Sunder Wordpress Plugin

> Sunder allows you to separate logic and view files inside Wordpress themes, making your code cleaner.

## Installation

Just clone this repo inside a `sunder` folder inside your `wp-content/plugins` folder or install it using Wordpress Plugin page (not yet there). After copy the folder contents just activate the plugin inside your Wordpress Administration area.

```bash
cd wp-content/plugins
git clone git@github.com:jgrossi/sunder.git sunder
```

You can install Sunder downloading the `zip` file and extracting it inside `wp-content/plugins` folder. After that activate the plugin in the Wordpress administration panel.

## Usage

Generally when fetching data from a Wordpress database in a theme you use just one file, like `page.php` for example. In this file you have HTML code and PHP code to query WP posts to be shown in the theme file.

This plugin separates logic from views. The same `page.php` file will be the *logic* file, where you will have only the PHP code like this:

```php
<?php /* Template Name: Services */

$content = str_replace('%AGE%', get_age(), $post->post_content);
$content = wpautop($content);

$topics = get_field('topics');
$video = get_field('video');
$gallery = get_field('gallery');

return render('views/services', compact('content', 'topics', 'video', 'gallery'));
```

Now you are calling the view file - in `views/services.php` this case -, sending `$content`, `$topics`, `$video` and `$gallery` variables to it. By default the `.php` extension is used to load the file, so you can omit it.

In the view file you can get the variables as a `$view` object property, like `$view->gallery`. The `views/services.php` file will look like:

```php
<?php get_header() ?>
<!-- HTML code -->
<p class="content"><?php echo $view->content ?></p>
<ul class="gallery">
    <?php foreach ($view->gallery as $pic): ?>
        <li><?php echo $pic['url'] ?></li>
    <?php endforeach; ?>
</ul>
<!-- more HTML code using $view->var -->
```

I prefer to use the template files inside a `views` folder, but you can use the name you want.

## Contributing

Thank you for considering contributing to the Sunder Wordpress Plugin! Suggest new features, change files and create a pull request to the `dev` branch. Any question just ask in `issues` section. Any help or suggestion is welcome!

Sunder has much to grow. This is the first release and it has a lot to improve. Please, suggest new features to help us to create a cleaner PHP code using Wordpress.

## Licence

[MIT License](http://jgrossi.mit-license.org/) © Junior Grossi

