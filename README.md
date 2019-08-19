# samples-ignite-php

Apache Ignite and GridGain Community Edition PHP/.NET/SQL interoperability. 

The example demonstrates how to manage data in the same cache using Apache Ignite or GridGain CE PHP, .NET and SQL APIs. 

## Setup

Prerequisites:
- IGNITE_HOME environment variable points to where Apache Ignite or GridGain CE is installed 
  (tested with GridGain 8.7.6).
- PHP 7.2+ and PHP Composer
- .NET Framework 4.x

In a terminal run:
- `cd  samples-ignite-php`
- `composer.phar`

## How To Use

- Run Ignite server node. Build Debug configuration of .NET project `Samples.Ignite.Php` and in a terminal run:

  `cd Samples.Ignite.Php\bin\Debug`

  `%IGNITE_HOME%\platforms\dotnet\bin\Apache.Ignite.exe -ConfigFileName=Samples.Ignite.Php.exe.config -assembly=Samples.Ignite.Php.exe`

- Create a cache using SQL. In a JDBC tool like sqlline or DBeaver run:
  
  `CREATE TABLE RECORDS ("id" VARCHAR PRIMARY KEY, "price" DOUBLE, "quantity" INT) WITH "VALUE_TYPE=Samples\Ignite\Php\Record";`
  
- Insert data using SQL:

  `INSERT INTO RECORDS ("id", "price", "quantity") VALUES ('SQL', 10.0, 1);`
  
- Insert data using PHP. In a termimal run:

  `php CreateRecord.php`
  
- Insert data using .NET and display all the data using .NET. In a terminal run `Samples.Ignite.Php.exe`. The expected
  output is:
```
>>>>> {id: 'SQL', price: 10, quantity: 1}
>>>>> {id: 'PHP', price: 20, quantity: 2}
>>>>> {id: '.NET', price: 30, quantity: 3}
```

- Display all the data using PHP. In a terminal run `php DisplayRecords.php`. The expected output is:
```
>>>>> {id: 'PHP' price: 20 quantity: 2}
>>>>> {id: 'SQL' price: 10 quantity: 1}
>>>>> {id: '.NET' price: 30 quantity: 3}
```

- Display all the data using SQL:

  `SELECT * FROM RECORDS;`
  
  The expected result is:
  ```
  .NET	30	3
  PHP	20	2
  SQL	10	1
  ```