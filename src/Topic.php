<?php

namespace Aliyun\MNS;

use Aliyun\MNS\Http\HttpClient;
use Aliyun\MNS\Model\SubscriptionAttributes;
use Aliyun\MNS\Model\TopicAttributes;
use Aliyun\MNS\Model\UpdateSubscriptionAttributes;
use Aliyun\MNS\Requests\GetSubscriptionAttributeRequest;
use Aliyun\MNS\Requests\GetTopicAttributeRequest;
use Aliyun\MNS\Requests\ListSubscriptionRequest;
use Aliyun\MNS\Requests\PublishMessageRequest;
use Aliyun\MNS\Requests\SetSubscriptionAttributeRequest;
use Aliyun\MNS\Requests\SetTopicAttributeRequest;
use Aliyun\MNS\Requests\SubscribeRequest;
use Aliyun\MNS\Requests\UnsubscribeRequest;
use Aliyun\MNS\Responses\GetSubscriptionAttributeResponse;
use Aliyun\MNS\Responses\GetTopicAttributeResponse;
use Aliyun\MNS\Responses\ListSubscriptionResponse;
use Aliyun\MNS\Responses\PublishMessageResponse;
use Aliyun\MNS\Responses\SetSubscriptionAttributeResponse;
use Aliyun\MNS\Responses\SetTopicAttributeResponse;
use Aliyun\MNS\Responses\SubscribeResponse;
use Aliyun\MNS\Responses\UnsubscribeResponse;

class Topic
{

    private $topicName;

    private $client;


    public function __construct(HttpClient $client, $topicName)
    {
        $this->client    = $client;
        $this->topicName = $topicName;
    }


    public function getTopicName()
    {
        return $this->topicName;
    }


    public function setAttribute(TopicAttributes $attributes)
    {
        $request  = new SetTopicAttributeRequest($this->topicName, $attributes);
        $response = new SetTopicAttributeResponse();

        return $this->client->sendRequest($request, $response);
    }


    public function getAttribute()
    {
        $request  = new GetTopicAttributeRequest($this->topicName);
        $response = new GetTopicAttributeResponse();

        return $this->client->sendRequest($request, $response);
    }


    public function publishMessage(PublishMessageRequest $request)
    {
        $request->setTopicName($this->topicName);
        $response = new PublishMessageResponse();

        return $this->client->sendRequest($request, $response);
    }


    public function subscribe(SubscriptionAttributes $attributes)
    {
        $attributes->setTopicName($this->topicName);
        $request  = new SubscribeRequest($attributes);
        $response = new SubscribeResponse();

        return $this->client->sendRequest($request, $response);
    }


    public function unsubscribe($subscriptionName)
    {
        $request  = new UnsubscribeRequest($this->topicName, $subscriptionName);
        $response = new UnsubscribeResponse();

        return $this->client->sendRequest($request, $response);
    }


    public function getSubscriptionAttribute($subscriptionName)
    {
        $request  = new GetSubscriptionAttributeRequest($this->topicName, $subscriptionName);
        $response = new GetSubscriptionAttributeResponse();

        return $this->client->sendRequest($request, $response);
    }


    public function setSubscriptionAttribute(UpdateSubscriptionAttributes $attributes)
    {
        $attributes->setTopicName($this->topicName);
        $request  = new SetSubscriptionAttributeRequest($attributes);
        $response = new SetSubscriptionAttributeResponse();

        return $this->client->sendRequest($request, $response);
    }


    public function listSubscription($retNum = null, $prefix = null, $marker = null)
    {
        $request  = new ListSubscriptionRequest($this->topicName, $retNum, $prefix, $marker);
        $response = new ListSubscriptionResponse();

        return $this->client->sendRequest($request, $response);
    }
}
