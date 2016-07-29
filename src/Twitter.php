<?php

namespace Edujugon\SocialAutoPost;


use Codebird\Codebird;
use Edujugon\SocialAutoPost\Contracts\SocialSiteInterface;

class Twitter extends SocialSite implements SocialSiteInterface
{

    /**
     * CodeBird Instance
     */
    protected $codeBird;

    /**
     * Twitter constructor.
     */
    function __construct()
    {
        $this->config = $this->initializeConfig('twitter');
    }

    /**
     * LogIn to Twitter.
     */
    private function logIn()
    {
        Codebird::setConsumerKey($this->config['consumerKey'], $this->config['consumerSecret']);

        $this->codeBird = Codebird::getInstance();

        $this->codeBird->setToken($this->config['accessToken'], $this->config['accessTokenSecret']);
    }

    /**
     * If set new twitter app credentials, check if we are already login if so then logout the previous user credentials.
     *
     * @param array $config
     * @return mixed|void
     */
    public function config(array $config)
    {
        parent::config($config);

        if($this->codeBird instanceof Codebird) $this->logOut(); //Log out the previous user.
    }

    /**
     *Send the Post to the social site
     */
    public function post()
    {
        $this->logIn();

        $this->feedback = $this->postingMethod();

    }

    /**
     * Depends on what parameters exist in the params array we post on a different way.
     *
     * @return mixed
     */
    private function postingMethod()
    {

        //by default you must give 'media[]' as param to be able to work.
        if(array_key_exists('media',$this->params)) $this->params = $this->replaceKey($this->params,'media','media[]');

        return array_key_exists('media[]',$this->params)
            ?
            $this->codeBird->statuses_updateWithMedia($this->params)
            :
            $this->codeBird->statuses_update($this->params);

    }

    /**
     * Log out to the social network.
     */
    private function logOut()
    {
        $this->codeBird->logout();
    }

}