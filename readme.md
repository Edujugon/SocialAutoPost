# Social Auto Post

This is a lightly and easy to use package to post on your favorite social sites.

####Social Sites Available:

* Twitter
* More sites coming soon.

## Installation

type in console:

        composer require edujugon/social-auto-post


Or update your composer.json file.

    "edujugon/social-auto-post": "1.0.*"

Then

    composer install

## Laravel 5.*

Register the Social service by adding it to the providers array.

    'providers' => array(
        ...
        Edujugon\SocialAutoPost\Providers\SocialAutoPostServiceProvider::class
    )

Let's add the Alias facade, add it to the aliases array.

    'aliases' => array(
        ...
        'SocialAutoPost' => Edujugon\SocialAutoPost\Facades\SocialAutoPost::class,
    )

Publish the package's configuration file to the application's own config directory

    php artisan vendor:publish --provider="Edujugon\SocialAutoPost\Providers\SocialAutoPostServiceProvider" --tag="config"


## Configuration

The default configuration for all Social sites is located in Config/Config.php

Before using this package you should create your app in your social site and then update the config values like follows:

    'twitter' => [
            'consumerKey' => 'YOUR_CONSUMER_KEY',
            'consumerSecret' => 'YOUR_CONSUMER_SECRET',
            'accessToken' => 'YOUR_ACCESS_TOKEN',
            'accessTokenSecret' => 'YOUR_ACCESS_TOKEN_SECRET'
        ]

You can dynamically set those values or add new ones calling the method config like follows:

    $social->config(['consumerKey' => 'new_key','accessToken' => 'new_access_token']);

## Usage

    $social = new SocialAutoPost;

By default it will use Twitter as Social Site but you can also pass the name as parameter:

    $social = new SocialAutoPost('twitter');

Now you may use any method what you need. Please see the API List.


## API List

- [site](https://github.com/edujugon/SocialAutoPost#site)
- [params](https://github.com/edujugon/SocialAutoPost#params)
- [post](https://github.com/edujugon/SocialAutoPost#post)
- [withFeedback](https://github.com/edujugon/SocialAutoPost#withfeedback)
- [config](https://github.com/edujugon/SocialAutoPost#config)
- [getSite](https://github.com/edujugon/SocialAutoPost#getsite)
- [getParams](https://github.com/edujugon/SocialAutoPost#getparams)
- [getFeedback](https://github.com/edujugon/SocialAutoPost#getfeedback)
- [getConfig](https://github.com/edujugon/SocialAutoPost#getconfig)

> Or go to [usage-samples](https://github.com/edujugon/SocialAutoPost#usage-samples) directly.

#### site

`site` method sets the social site, which you pass the name through parameter.

**Syntax**

```php
object site($socialName)
```

#### params

`params` method sets the Post parameters, which you pass through parameter as **array**.

**Syntax**

```php
object params(array $data)
```

#### post

`post` method sends the post. This method does not return the post response.
>if you want to get the post response you can use [withFeedback](https://github.com/edujugon/SocialAutoPost#withfeedback) method chained to this method (post)

**Syntax**

```php
object post()
```

#### withFeedback

`withFeedback` method provides the post response just after be sent the post.

**Syntax**

```php
object/array withFeedback()
```

#### config

`config` method sets dynamically the social site app configuration, which you pass through parameter as **array**.

**Syntax**

```php
object config(array $data)
```

#### getSite

`getSite` If you want to get the current social site in used, this method gets the social site name.

**Syntax**

```php
string getSite()
```

#### getParams

`getParams` If you want to get the post parameters, this method may help you. 

**Syntax**

```php
array getParams()
```

#### getFeedback

`getFeedback` If you want to get the very last post feedback, this method may help you. 

**Syntax**

```php
object/null getFeedback()
```

#### getConfig

`getConfig` If you want to get the current social configuration, this method may help you. 

**Syntax**

```php
array getConfig()
```

## Usage samples

>You can chain the methods.

    $social = new SocialAutoPost('twitter');
    
    $social->params(['status' => 'My new post #twitter])
            ->post()
            ->withFeedback();

**NOTICE that Status cannot be over 140 characters for TWITTER.**

or do it separately

    $social = new SocialAutoPost('twitter');
    $social->params(['status' => 'My new post #twitter])
    $social->post();



#### Getting the Social Site response after posting

There are 2 way to get the post response:
 
 1) Chain the method `withFeedback()` to the `post()` method.

    ```php
    $social = new SocialAutoPost('twitter');
    
    $social->params(['status' => 'My new post #twitter])
        ->post()
        ->withFeedback();
    ```

 2) You may call the method `getFeedback()` whenever you want after sending the post.

    ```php
    $social->getFeedback();
    ```
    
### Laravel Alias Facade

After register the Alias Facade for this Package, you can use it like follows:

    SocialAutoPost::site('twitter')
            ->params(['status' => 'My new post #twitter])
            ->post()
            ->withFeedback();

It will return the post response.