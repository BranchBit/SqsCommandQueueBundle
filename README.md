SqsCommandQueueBundle
=====================




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


### Usage:

