<?php
namespace Aliyun\MNS\Requests;

class ReceiveMessageRequest extends BaseRequest
{
    private $queueName;
    private $waitSeconds;

    public function __construct($queueName, $waitSeconds = null)
    {
        parent::__construct('get', 'queues/' . $queueName . '/messages');

        $this->queueName = $queueName;
        $this->waitSeconds = $waitSeconds;
    }

    public function getQueueName()
    {
        return $this->queueName;
    }

    public function getWaitSeconds()
    {
        return $this->waitSeconds;
    }

    public function generateBody()
    {
        return null;
    }

    public function generateQueryString()
    {
        if ($this->waitSeconds != null) {
            return http_build_query(array("waitseconds" => $this->waitSeconds));
        }
    }
}

?>
