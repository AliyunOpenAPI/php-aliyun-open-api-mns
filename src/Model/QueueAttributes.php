<?php

namespace Aliyun\MNS\Model;

use Aliyun\MNS\Constants;

/**
 * Please refer to
 * https://docs.aliyun.com/?spm=#/pub/mns/api_reference/intro&intro
 * for more details
 */
class QueueAttributes
{

    private $delaySeconds;

    private $maximumMessageSize;

    # the following attributes cannot be changed

    private $messageRetentionPeriod;

    private $visibilityTimeout;

    private $pollingWaitSeconds;

    public $activeMessages;

    public $delayMessages;

    public $inactiveMessages;
    private $LoggingEnabled;

    /*
     * 2016-02-02
     * 注意: 阿里云提供的接口为private属性, 为便于查询修改为public
     */

    private $queueName;

    private $createTime;

    private $lastModifyTime;


    public function __construct($delaySeconds = null, $maximumMessageSize = null, $messageRetentionPeriod = null, $visibilityTimeout = null, $pollingWaitSeconds = null, $queueName = null, $createTime = null, $lastModifyTime = null, $activeMessages = null, $inactiveMessages = null, $delayMessages = null, $LoggingEnabled = null)
    {
        $this->delaySeconds           = $delaySeconds;
        $this->maximumMessageSize     = $maximumMessageSize;
        $this->messageRetentionPeriod = $messageRetentionPeriod;
        $this->visibilityTimeout      = $visibilityTimeout;
        $this->pollingWaitSeconds     = $pollingWaitSeconds;
        $this->loggingEnabled = $LoggingEnabled;

        $this->queueName        = $queueName;
        $this->createTime       = $createTime;
        $this->lastModifyTime   = $lastModifyTime;
        $this->activeMessages   = $activeMessages;
        $this->inactiveMessages = $inactiveMessages;
        $this->delayMessages    = $delayMessages;
    }

    public function setDelaySeconds($delaySeconds)
    {
        $this->delaySeconds = $delaySeconds;
    }

    public function getDelaySeconds()
    {
        return $this->delaySeconds;
    }

    public function setLoggingEnabled($loggingEnabled)
    {
        $this->loggingEnabled = $loggingEnabled;
    }

    public function getLoggingEnabled()
    {
        return $this->loggingEnabled;
    }

    public function setMaximumMessageSize($maximumMessageSize)
    {
        $this->maximumMessageSize = $maximumMessageSize;
    }

    public function getMaximumMessageSize()
    {
        return $this->maximumMessageSize;
    }

    public function setMessageRetentionPeriod($messageRetentionPeriod)
    {
        $this->messageRetentionPeriod = $messageRetentionPeriod;
    }

    public function getMessageRetentionPeriod()
    {
        return $this->messageRetentionPeriod;
    }

    public function setVisibilityTimeout($visibilityTimeout)
    {
        $this->visibilityTimeout = $visibilityTimeout;
    }

    public function getVisibilityTimeout()
    {
        return $this->visibilityTimeout;
    }

    public function setPollingWaitSeconds($pollingWaitSeconds)
    {
        $this->pollingWaitSeconds = $pollingWaitSeconds;
    }

    public function getPollingWaitSeconds()
    {
        return $this->pollingWaitSeconds;
    }

    public function getQueueName()
    {
        return $this->queueName;
    }

    public function getCreateTime()
    {
        return $this->createTime;
    }

    public function getLastModifyTime()
    {
        return $this->lastModifyTime;
    }

    public function getActiveMessages()
    {
        return $this->activeMessages;
    }

    public function getInactiveMessages()
    {
        return $this->inactiveMessages;
    }

    public function getDelayMessages()
    {
        return $this->delayMessages;
    }

    public function writeXML(\XMLWriter $xmlWriter)
    {
        if ($this->delaySeconds != NULL)
        {
            $xmlWriter->writeElement(Constants::DELAY_SECONDS, $this->delaySeconds);
        }
        if ($this->maximumMessageSize != NULL)
        {
            $xmlWriter->writeElement(Constants::MAXIMUM_MESSAGE_SIZE, $this->maximumMessageSize);
        }
        if ($this->messageRetentionPeriod != NULL)
        {
            $xmlWriter->writeElement(Constants::MESSAGE_RETENTION_PERIOD, $this->messageRetentionPeriod);
        }
        if ($this->visibilityTimeout != NULL)
        {
            $xmlWriter->writeElement(Constants::VISIBILITY_TIMEOUT, $this->visibilityTimeout);
        }
        if ($this->pollingWaitSeconds != NULL)
        {
            $xmlWriter->writeElement(Constants::POLLING_WAIT_SECONDS, $this->pollingWaitSeconds);
        }
        if ($this->loggingEnabled !== NULL)
        {
            $xmlWriter->writeElement(Constants::LOGGING_ENABLED, $this->loggingEnabled ? "True" : "False");
        }
    }

    static public function fromXML(\XMLReader $xmlReader)
    {
        $delaySeconds           = null;
        $maximumMessageSize     = null;
        $messageRetentionPeriod = null;
        $visibilityTimeout      = null;
        $pollingWaitSeconds     = null;
        $queueName              = null;
        $createTime             = null;
        $lastModifyTime         = null;
        $activeMessages         = null;
        $inactiveMessages       = null;
        $delayMessages          = null;
        $loggingEnabled         = null;

        while ($xmlReader->read()) {
            if ($xmlReader->nodeType == \XMLReader::ELEMENT) {
                switch ($xmlReader->name) {
                    case 'DelaySeconds':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $delaySeconds = $xmlReader->value;
                        }
                        break;
                    case 'MaximumMessageSize':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $maximumMessageSize = $xmlReader->value;
                        }
                        break;
                    case 'MessageRetentionPeriod':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $messageRetentionPeriod = $xmlReader->value;
                        }
                        break;
                    case 'VisibilityTimeout':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $visibilityTimeout = $xmlReader->value;
                        }
                        break;
                    case 'PollingWaitSeconds':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $pollingWaitSeconds = $xmlReader->value;
                        }
                        break;
                    case 'QueueName':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $queueName = $xmlReader->value;
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
                    case 'ActiveMessages':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $activeMessages = $xmlReader->value;
                        }
                        break;
                    case 'InactiveMessages':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $inactiveMessages = $xmlReader->value;
                        }
                        break;
                    case 'DelayMessages':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $delayMessages = $xmlReader->value;
                        }
                        break;
                    case 'LoggingEnabled':
                        $xmlReader->read();
                        if ($xmlReader->nodeType == \XMLReader::TEXT)
                        {
                            $loggingEnabled = $xmlReader->value;
                            if ($loggingEnabled == "True")
                            {
                                $loggingEnabled = True;
                            }
                            else
                            {
                                $loggingEnabled = False;
                            }
                        }
                        break;
                }
            }
        }

        $attributes = new QueueAttributes($delaySeconds, $maximumMessageSize, $messageRetentionPeriod, $visibilityTimeout, $pollingWaitSeconds, $queueName, $createTime, $lastModifyTime, $activeMessages, $inactiveMessages, $delayMessages,$loggingEnabled);

        return $attributes;
    }
}