<?php

namespace BBIT\SqsCommandQueueBundle\Service;

use Aws\Sqs\SqsClient;

class SqsQueueService
{

    private $awsSqsKey;
    private $awsSqsSecret;
    private $awsSqsRegion;
    private $awsSqsQueue;

    public function __construct($awsSqsKey, $awsSqsSecret, $awsSqsRegion, $awsSqsQueue)
    {
        $this->awsSqsKey = $awsSqsKey;
        $this->awsSqsSecret = $awsSqsSecret;
        $this->awsSqsRegion = $awsSqsRegion;
        $this->awsSqsQueue = $awsSqsQueue;
    }

    public function getClient()
    {
        $client = SqsClient::factory(
            array(
                'region' => $this->awsSqsRegion,
                'version' => '2012-11-05',
                'credentials' => array(
                    'key' => $this->awsSqsKey,
                    'secret' => $this->awsSqsSecret
                )
            )
        );

        return $client;
    }

    public function addCommand($command)
    {
        $message = base64_encode(json_encode(
            array('command' => $command)
        ));

        $this->getClient()->sendMessage(array(
            'QueueUrl'    => $this->awsSqsQueue,
            'MessageBody' => $message,
        ));
    }

    public function processCommand()
    {

        $client = $this->getClient();

        $res = $client->receiveMessage(array(
            'QueueUrl'          => $this->awsSqsQueue,
            'WaitTimeSeconds'   => 1
        ));
        if ($res->getPath('Messages')) {

            foreach ($res->getPath('Messages') as $msg) {
//                var_dump($msg);
                $cmd = json_decode(base64_decode($msg['Body']));
                if (null !== $cmd && property_exists($cmd, 'command')) {
                    $cmd = $cmd->command;
                    $out = shell_exec($cmd);
//                    var_dump($cmd);
//                    var_dump($out);
                }

            }


            $res = $client->deleteMessage(array(
                'QueueUrl'      => $this->awsSqsQueue,
                'ReceiptHandle' => $msg['ReceiptHandle']
            ));
        }
    }

}
