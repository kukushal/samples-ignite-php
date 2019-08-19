# samples-ignite-php

Apache Ignite PHP/.NET/SQL interoperability. 

The example demonstrates how to manage data in the same cache using Apache Ignite PHP, .NET and SQL APIs. 

## Setup

Prerequisites:
- IGNITE_HOME environment variable points to where Apache Ignite is installed (tested with Ignite 2.7.5).
- PHP 7.2+ and PHP Composer
- .NET Framework 4.x

In a terminal run:
- `cd  samples-ignite-php`
- `composer.phar`

## How To Use

- Run Ignite server node. In a termnal run:

  `%IGNITE_HOME%\platforms\dotnet\bin\Apache.Ignite.exe`

- Create a cache using SQL. In a JDBC tool like sqlline or DBeaver run:
  
  `CREATE TABLE RECORDS (ID VARCHAR PRIMARY KEY, PRICE DOUBLE, QUANTITY INT) WITH "VALUE_TYPE=Samples\Ignite\Php\Record";`
  
- Insert data using SQL:

  `INSERT INTO RECORDS (ID, PRICE, QUANTITY) VALUES ('item1', 10.0, 1);`
  
- Insert data using PHP. In a termimal run:

  `php CreateRecord.php`
  
- Insert data using .NET. In a terminal run:

