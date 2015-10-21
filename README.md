SqsCommandQueueBundle
=====================


SqsCommandQueueBundle is a simple bundle, wich you can use, to **queue commands on amazon SQS**.
This bundle then provides a worker, wich can be run on **several servers**, and will execute the commands, on one of the **several workers**.



### Step 1: Download BBITSqsCommandQueueBundle using composer

Add BBITSqsCommandQueueBundle in your composer.json:

```js
{
    "require": {
        "bbit/sqs-command-queue-bundle": "dev-master",
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update bbit/sqs-command-queue-bundlee
```

Composer will install the bundle to your project's `vendor/BBIT` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new BBIT\SqsCommandQueueBundle\BBITSqsCommandQueueBundle(),
    );
}
```

### Step 3: Configure the bundle

```
bbit_sqs_command_queue:
    aws_sqs_key: xxx
    aws_sqs_secret: xxxxxxxxx
    aws_sqs_region: eu-central-1
    aws_sqs_queue: https://sqs.eu-central-1.amazonaws.com/xx11xx11/xx-xx
```

### Usage:

Send a command to the queue: 
```
$container->get('sqs_queue')->addCommand('app/console cache:clear');
```


The worker:
```
app/console bbit:sqs-command-queue:work 
```
