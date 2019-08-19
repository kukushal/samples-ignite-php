using Apache.Ignite.Core;
using System;

namespace Samples.Ignite.Php
{
    class Program
    {
        static void Main(string[] args)
        {
            Ignition.ClientMode = true;

            using (var ignite = Ignition.StartFromApplicationConfiguration())
            {
                var cache = ignite.GetCache<string, Record>("SQL_PUBLIC_RECORDS");

                // Ignite SQL has a usability issue: the INSERT statement does not fill primary key fields embedded 
                // into value objects. Need to fill the primary key fields manually. 
                const string key = "SQL";
                var sqlRec = cache.Get(key);
                sqlRec.id = key;

                Console.WriteLine($">>>>> {sqlRec}");

                var phpRec = cache.Get("PHP");

                Console.WriteLine($">>>>> {phpRec}");

                var dotnetRec = new Record
                {
                    id = ".NET",
                    price = 30.0,
                    quantity = 3
                };

                cache.Put(dotnetRec.id, dotnetRec);

                Console.WriteLine($">>>>> {cache.Get(dotnetRec.id)}");
            }
        }
    }
}
