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
    private $messageRetentionPeriod;
    private $visibilityTimeout;
    private $pollingWaitSeconds;
    private $LoggingEnabled;

    # the following attributes cannot be changed
    private $queueName;
    private $createTime;
    private $lastModifyTime;
    private $activeMessages;
    private $inactiveMessages;
    private $delayMessages;

    public function __construct(
        $delaySeconds = null,
        $maximumMessageSize = null,
        $messageRetentionPeriod = null,
        $visibilityTimeout = null,
        $pollingWaitSeconds = null,
        $queueName = null,
        $createTime = null,
        $lastModifyTime = null,
        $activeMessages = null,
        $inactiveMessages = null,
        $delayMessages = null,
        $LoggingEnabled = null
    ) {
        $this->delaySeconds = $delaySeconds;
        $this->maximumMessageSize = $maximumMessageSize;
        $this->messageRetentionPeriod = $messageRetentionPeriod;
        $this->visibilityTimeout = $visibilityTimeout;
        $this->pollingWaitSeconds = $pollingWaitSeconds;
        $this->loggingEnabled = $LoggingEnabled;

        $this->queueName = $queueName;
        $this->createTime = $createTime;
        $this->lastModifyTime = $lastModifyTime;
        $this->activeMessages = $activeMessages;
        $this->inactiveMessages = $inactiveMessages;
        $this->delayMessages = $delayMessages;
    }

    static public function fromXML(\XMLReader $xmlReader)
    {
        $delaySeconds = null;
        $maximumMessageSize = null;
        $messageRetentionPeriod = null;
        $visibilityTimeout = null;
        $pollingWaitSeconds = null;
        $queueName = null;
        $createTime = null;
        $lastModifyTime = null;
        $activeMessages = null;
        $inactiveMessages = null;
        $delayMessages = null;
        $loggingEnabled = null;

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
                        if ($xmlReader->nodeType == \XMLReader::TEXT) {
                            $loggingEnabled = $xmlReader->value;
                            if ($loggingEnabled == "True") {
                                $loggingEnabled = true;
                            } else {
                                $loggingEnabled = false;
                            }
                        }
                        break;
                }
            }
        }

        $attributes = new QueueAttributes(
            $delaySeconds,
            $maximumMessageSize,
            $messageRetentionPeriod,
            $visibilityTimeout,
            $pollingWaitSeconds,
            $queueName,
            $createTime,
            $lastModifyTime,
            $activeMessages,
            $inactiveMessages,
            $delayMessages,
            $loggingEnabled);
        return $attributes;
    }

    public function getDelaySeconds()
    {
        return $this->delaySeconds;
    }

    public function setDelaySeconds($delaySeconds)
    {
        $this->delaySeconds = $delaySeconds;
    }

    public function getLoggingEnabled()
    {
        return $this->loggingEnabled;
    }

    public function setLoggingEnabled($loggingEnabled)
    {
        $this->loggingEnabled = $loggingEnabled;
    }

    public function getMaximumMessageSize()
    {
        return $this->maximumMessageSize;
    }

    public function setMaximumMessageSize($maximumMessageSize)
    {
        $this->maximumMessageSize = $maximumMessageSize;
    }

    public function getMessageRetentionPeriod()
    {
        return $this->messageRetentionPeriod;
    }

    public function setMessageRetentionPeriod($messageRetentionPeriod)
    {
        $this->messageRetentionPeriod = $messageRetentionPeriod;
    }

    public function getVisibilityTimeout()
    {
        return $this->visibilityTimeout;
    }

    public function setVisibilityTimeout($visibilityTimeout)
    {
        $this->visibilityTimeout = $visibilityTimeout;
    }

    public function getPollingWaitSeconds()
    {
        return $this->pollingWaitSeconds;
    }

    public function setPollingWaitSeconds($pollingWaitSeconds)
    {
        $this->pollingWaitSeconds = $pollingWaitSeconds;
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
        if ($this->delaySeconds != null) {
            $xmlWriter->writeElement(Constants::DELAY_SECONDS, $this->delaySeconds);
        }
        if ($this->maximumMessageSize != null) {
            $xmlWriter->writeElement(Constants::MAXIMUM_MESSAGE_SIZE, $this->maximumMessageSize);
        }
        if ($this->messageRetentionPeriod != null) {
            $xmlWriter->writeElement(Constants::MESSAGE_RETENTION_PERIOD, $this->messageRetentionPeriod);
        }
        if ($this->visibilityTimeout != null) {
            $xmlWriter->writeElement(Constants::VISIBILITY_TIMEOUT, $this->visibilityTimeout);
        }
        if ($this->pollingWaitSeconds != null) {
            $xmlWriter->writeElement(Constants::POLLING_WAIT_SECONDS, $this->pollingWaitSeconds);
        }
        if ($this->loggingEnabled !== null) {
            $xmlWriter->writeElement(Constants::LOGGING_ENABLED, $this->loggingEnabled ? "True" : "False");
        }
    }
}

?>
