<?php

namespace Edujugon\SocialAutoPost;


/**
 * Class SocialAutoPost
 * @package Edujugon\SocialAutoPost
 */
class SocialAutoPost
{

    /**
     * Social Site Instance
     */
    protected $socialSite;

    /**
     * List of the available Push service providers
     *
     * @var array
     */
    protected $socialSiteList = [
        'twitter' => Twitter::class
    ];

    /**
     * Default social network.
     */
    protected $defaultSocialName = 'twitter';

    /**
     * Social constructor.
     * @param null $socialName
     */
    public function __construct($socialName = null)
    {
        if(!array_key_exists($socialName,$this->socialSiteList)) $socialName = $this->defaultSocialName;

        $this->socialSite = is_null($socialName) ? new $this->socialSiteList[$this->defaultSocialName]
            : new $this->socialSiteList[$socialName];
    }

    /**
     * Set the Social Network to be used.
     *
     * @param $socialName
     * @return $this
     */
    public function site($socialName){

        if(!array_key_exists($socialName,$this->socialSiteList)) $socialName = $this->defaultSocialName;

        $this->socialSite = new $this->socialSiteList[$socialName];

        return $this;
    }

    /**
     * Prepare the post parameters with the data passed
     *
     * @param array $data
     * @return $this
     */
    public function params(array $data)
    {

        $this->socialSite->params($data);
        return $this;
    }


    /**
     * @return $this
     */
    public function post()
    {
        $this->socialSite->post();
        return $this;
    }

    /**
     * Return Social Network posting feedback
     * 
     * @return $feedback SocialSite.
     */
    public function withFeedback()
    {
        return $this->socialSite->feedback;

    }

    /**
     * Set the social site configuration
     *
     * @param array $data
     * @return $this
     */
    public function config(array $data)
    {
        $this->socialSite->config($data);

        return $this;
    }

    /////////////////////////////////////////////////////////////////////////
    //
    //GETTERS
    //
    /////////////////////////////////////////////////////////////////////////

    /**
     * get the social site name. // Twitter, Facebook..
     *
     * @return mixed
     */
    public function getSite()
    {
        return array_search(get_class($this->socialSite),$this->socialSiteList);
    }

    /**
     *
     *
     * @return array $config.
     */
    public function getConfig()
    {
        return $this->socialSite->config;
    }

    /**
     * Get the Post parameters
     *
     * @return mixed
     */
    public function getParams()
    {
        return $this->socialSite->params;
    }

    /**
     * Get the post response
     *
     * @return mixed
     */
    public function getFeedback()
    {
        return $this->socialSite->feedback;
    }
}