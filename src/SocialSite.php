<?php

namespace Edujugon\SocialAutoPost;


class SocialSite
{

    /**
     * Social Network configuration parameters.
     */
    protected $config;

    /**
     * Post parameters
     */
    protected $params = [];

    /**
     * Social Network Posting Response.
     */
    protected $feedback = null;

    /**
     * Update the values by key on config array from the passed array. If any key doesn't exist, it's added.
     * @param array $config
     */
    public function config(array $config)
    {
        $this->config = array_replace($this->config,$config);
    }

    /**
     * Initialize the configuration for the chosen Social Network // twitter,etc..
     * Check if config_path exist as function
     *
     * @param $socialSite
     * @return mixed
     */
    protected function initializeConfig($socialSite)
    {
        if(function_exists('config_path'))
        {
            if(file_exists(config_path('socialAutoPost.php')))
            {
                $configuration = include(config_path('socialAutoPost.php'));
                return $configuration[$socialSite];
            }
        }

        $configuration = include(__DIR__ . '/Config/Config.php');

        return $configuration[$socialSite];
    }

    /**
     * Create the post params.
     *
     * @param array $data
     */
    public function params(array $data)
    {
        $this->params = array_replace($this->params,$data);
    }

    /**
     * Replay a key of an array with a new value.
     *
     * @param $array
     * @param $old
     * @param $new
     * @return mixed
     */
    protected function replaceKey($array, $old, $new)
    {
        //flatten the array into a JSON string
        $str = json_encode($array);

        // do a simple string replace.
        // variables are wrapped in quotes to ensure only exact match replacements
        // colon after the closing quote will ensure only keys are targeted
        $str = str_replace('"'.$old.'":','"'.$new.'":',$str);

        // restore JSON string to array
        return json_decode($str,true);
    }

    /**
     * Get the Class properties.
     *
     * @param $property
     * @return null
     */
    public function __get($property)
    {
        if(property_exists($this,$property)) return $this->$property;

        return null;
    }
}