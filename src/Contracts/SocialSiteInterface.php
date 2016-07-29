<?php

namespace Edujugon\SocialAutoPost\Contracts;

interface SocialSiteInterface {

    /**
     * Set the Social Network configuration.
     *
     * @param array $config
     * @return mixed
     */
    function config(array $config);

    /**
     * Create the post parameters.
     *
     * @param array $data
     * @return mixed
     */
    function params(array $data);

    /**
     * Send the post to the social network to be posted.
     *
     * @return mixed
     */
    function post();


}