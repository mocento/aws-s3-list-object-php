<?php
/**
 * Mocento AWS S3 Services.
 *
 * Amazon S3 PHP SDK.
 *
 * File Name : index.php
 * Author    : Manjunath Reddy<manju@mocento.com>
 * Date      : 28-Oct-2015
 * Time      : 10:52 AM
 */

// Require the Composer autoloader.
require 'vendor/autoload.php';
define('KEY', 'xxxx');     // AWS key
define('SECRET', 'xxxx'); // AWS secret
define('REGION', 'ap-southeast-1');
define('VERSION', 'latest');
define('AWS_HOST', 'https://s3-ap-southeast-1.amazonaws.com/<BUCKET_NAME>/'); // replace <BUCKET_NAME> with your bucket name same as BUCKET
define('BUCKET', 'mocento-lovely');


// Use the us-west-2 region and latest version of each client.
$sharedConfig = [
    'region' => REGION,
    'version' => VERSION,
    'credentials' => [
        'key' => KEY,
        'secret' => SECRET,
    ],
];


// Create an SDK class used to share configuration across clients.
$sdk = new Aws\Sdk($sharedConfig);

// Create an Amazon S3 client using the shared configuration data.
$client = $sdk->createS3();

echo "List of Buckets";
echo "<hr>";
$buckets = $client->listBuckets();

foreach ($buckets['Buckets'] as $bucket) {
    echo $bucket['Name'] . "<br>";
}

echo "<br/>";

$iterator = $client->getIterator('ListObjects', [
    'Bucket' => BUCKET,
]);
echo "<hr>";
echo "Objects";
echo "<br>";
foreach ($iterator as $object) {
    echo "<img width=200 height=200 src=" . AWS_HOST . $object['Key'] . ">";
}
