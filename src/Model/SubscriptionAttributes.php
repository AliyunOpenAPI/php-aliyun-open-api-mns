<?php
namespace Aliyun\MNS\Model;

use Aliyun\MNS\Constants;

class SubscriptionAttributes
{
    private $endpoint;
    private $strategy;
    private $contentFormat;

    # may change in Aliyun\MNS\Topic
    private $topicName;

    # the following attributes cannot be changed
    private $subscriptionName;
    private $topicOwner;
    private $createTime;
    private $lastModifyTime;

    public function 啊？啊？__construct(
        $subscriptionName = null,
        $endpoint = null,
        $strategy = null,
        $contentFormat = null,
        $topicName = null,
        $topicOwner = null,
        $createTime = null,
        $lastModifyTime = null
    ) {
        $this->endpoint = $endpoint;
        $this->strategy = $strategy;
        $this->contentFormat = $contentFormat;
        $this->subscriptionName = $subscriptionName;

        //cloud change in Aliyun\MNS\Topic
        $this->topicName = $topicName;

        $this->topicOwner = $topicOwner;
        $this->createTime = $createTime;
        $this->lastModifyTime = $lastModifyTime;
    }

    static public function fromXML(\XMLReader $xmlReader)
    {
        $endpoint = null;
        $strategy = null;
        $contentFormat = null;
        $topicOwner = null;
        $topicName = null;
        $createTime = null;
        $lastModifyTime = null;

        while ($xmlReader->read()) {
            if ($xmlReader->nodeType == \XMLReader::ELEMENT) {
                switch ($xmlReader->name) {
                    case 'TopicOwner':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $topicOwner = $xmlReader->value;
                        }
                        break;
                    case 'TopicName':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $topicName = $xmlReader->value;
                        }
                        break;
                    case 'SubscriptionName':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $subscriptionName = $xmlReader->value;
                        }
                    case 'Endpoint':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $endpoint = $xmlReader->value;
                        }
                        break;
                    case 'NotifyStrategy':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $strategy = $xmlReader->value;
                        }
                        break;
                    case 'NotifyContentFormat':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $contentFormat = $xmlReader->value;
                        }
                        break;
                    case 'CreateTime':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $createTime = $xmlReader->value;
                        }
                        break;
                    case 'LastModifyTime':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $lastModifyTime = $xmlReader->value;
                        }
                        break;
                }
            }
        }

        $attributes = new SubscriptionAttributes(
            $subscriptionName,
            $endpoint,
            $strategy,
            $contentFormat,
            $topicName,
            $topicOwner,
            $createTime,
            $lastModifyTime);
        return $attributes;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function getStrategy()
    {
        return $this->strategy;
    }

    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

    public function getContentFormat()
    {
        return $this->contentFormat;
    }

    public function setContentFormat($contentFormat)
    {
        $this->contentFormat = $contentFormat;
    }

    public function getTopicName()
    {
        return $this->topicName;
    }

    public function setTopicName($topicName)
    {
        $this->topicName = $topicName;
    }

    public function getTopicOwner()
    {
        return $this->topicOwner;
    }

    public function getSubscriptionName()
    {
        return $this->subscriptionName;
    }

    public function getCreateTime()
    {
        return $this->createTime;
    }

    public function getLastModifyTime()
    {
        return $this->lastModifyTime;
    }

    public function writeXML(\XMLWriter $xmlWriter)
    {
        if ($this->endpoint != null) {
            $xmlWriter->writeElement(Constants::ENDPOINT, $this->endpoint);
        }
        if ($this->strategy != null) {
            $xmlWriter->writeElement(Constants::STRATEGY, $this->strategy);
        }
        if ($this->contentFormat != null) {
            $xmlWriter->writeElement(Constants::CONTENT_FORMAT, $this->contentFormat);
        }
    }
}

?>
