<?php

namespace Samples\Ignite\Php;

require_once __DIR__ . '/vendor/autoload.php';

use Apache\Ignite\Client;
use Apache\Ignite\ClientConfiguration;
use Apache\Ignite\Exception\ClientException;
use Apache\Ignite\Type\ObjectType;
use Apache\Ignite\Type\ComplexObjectType;

include 'Record.php';

class DisplayRecords
{
    private const IGNITE_ADDR = '127.0.0.1:10800';
    private const CACHE_NAME = 'SQL_PUBLIC_RECORDS';

    public function start(): void
    {
        $client = new Client();
        try {
            $client->connect(new ClientConfiguration(self::IGNITE_ADDR));

            $cache = $client->getCache(self::CACHE_NAME)
                ->setKeyType(ObjectType::STRING)
                ->setValueType(new ComplexObjectType());

            $phpRec = $cache->get('PHP');
            echo('>>>>> ' . $phpRec . PHP_EOL);

            // Ignite SQL has a usability issue: the INSERT statement does not fill primary key fields embedded
            // into value objects. Need to fill the primary key fields manually.
            $sqlRec = $cache->get('SQL');
            $sqlRec->id = 'SQL';
            echo('>>>>> ' . $sqlRec . PHP_EOL);

            $dotnetRec = $cache->get('.NET');
            echo('>>>>> ' . $dotnetRec . PHP_EOL);
        } catch (ClientException $e) {
            echo('ERROR: ' . $e->getMessage() . PHP_EOL);
        } finally {
            $client->disconnect();
        }
    }
}

$app = new DisplayRecords();
$app->start();



