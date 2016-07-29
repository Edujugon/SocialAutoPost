<?php


use Edujugon\SocialAutoPost\SocialAutoPost;

class SocialAutoPostTest extends PHPUnit_Framework_TestCase {

    /** @test */
    function post_on_twitter(){
        $social = new SocialAutoPost('twitterasdf');

        $reply = $social->params(['status' => 'Check out the last trends at netyboxgroup.com','media'=>'http://netyboxgroup.com/wp-content/uploads/2014/03/Netybox_12.03.2014_Black-e1394638539864.png'])
                        ->post()
                        ->withFeedback();
        $this->assertInstanceOf('stdClass',$reply);

        $social->config(['consumerSecret' => 'bI4rN4RcQRHaVtr6DPlsdVmuJ']);
        $social->params(['status' => 'Check out the last trends at netyboxgroup.com','media'=>'http://netyboxgroup.com/wp-content/uploads/2014/03/Netybox_12.03.2014_Black-e1394638539864.png'])
            ->post();
    }
    /** @test */
    function call_methods_separately()
    {
        $social = new SocialAutoPost('twitter');

        $social->params(['status' => 'Check out the last trends at netyboxgroup.com','media'=>'http://netyboxgroup.com/wp-content/uploads/2014/03/Netybox_12.03.2014_Black-e1394638539864.png']);
        $social->post();
        $reply = $social->getFeedback();
        $this->assertInstanceOf('stdClass',$reply);
    }
    /** @test */
    function constructor_create_correct_social_site_instance()
    {
        $social = new SocialAutoPost('twitter');

        $this->assertEquals('twitter',$social->getSite());
    }

    /** @test */
    function add_data_on_the_fly()
    {
        $social = new SocialAutoPost;

        $social->site('twitter');
        $this->assertEquals('twitter',$social->getSite());

        $social->config(['consumerKey' => 'fake_Key']);
        $this->assertContains('fake_Key',$social->getConfig());
    }

    /** @test */
    function before_sending_post_the_feedback_property_is_null()
    {
        $social = new SocialAutoPost;
        $this->assertNull($social->getFeedback());
    }
}