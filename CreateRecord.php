<?php

namespace Samples\Ignite\Php;

require_once __DIR__ . '/vendor/autoload.php';

use Apache\Ignite\Client;
use Apache\Ignite\ClientConfiguration;
use Apache\Ignite\Exception\ClientException;
use Apache\Ignite\Type\ObjectType;
use Apache\Ignite\Type\ComplexObjectType;

class Record
{
    public $id;
    public $price;
    public $quantity;

    public function __construct(string $id, float $price, int $quantity)
    {
        $this->id = $id;
        $this->price = $price;
        $this->quantity = $quantity;
    }
}

class CreateRecord
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
                ->setValueType((new ComplexObjectType())
                    ->setFieldType('id', ObjectType::STRING)
                    ->setFieldType('price', ObjectType::DOUBLE)
                    ->setFieldType('quantity', ObjectType::INTEGER)
                );

            $r = new Record('item2', 20.0, 2);

            $cache->put($r->id, $r);
        } catch (ClientException $e) {
            echo('ERROR: ' . $e->getMessage() . PHP_EOL);
        } finally {
            $client->disconnect();
        }
    }
}

$app = new CreateRecord();
$app->start();
