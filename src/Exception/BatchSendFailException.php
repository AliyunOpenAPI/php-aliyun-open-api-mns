<?php

namespace Aliyun\MNS\Exception;

use Aliyun\MNS\Constants;
use Aliyun\MNS\Model\SendMessageResponseItem;

/**
 * BatchSend could fail for some messages,
 *     and BatchSendFailException will be thrown.
 * Results for messages are saved in "$sendMessageResponseItems"
 */
class BatchSendFailException extends MnsException
{

    protected $sendMessageResponseItems;


    public function __construct($code, $message, $previousException = null, $requestId = null, $hostId = null)
    {
        parent::__construct($code, $message, $previousException, Constants::BATCH_SEND_FAIL, $requestId, $hostId);

        $this->sendMessageResponseItems = array();
    }


    public function addSendMessageResponseItem(SendMessageResponseItem $item)
    {
        $this->sendMessageResponseItems[] = $item;
    }


    public function getSendMessageResponseItems()
    {
        return $this->sendMessageResponseItems;
    }
}
