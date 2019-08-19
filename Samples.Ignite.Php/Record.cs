namespace Samples.Ignite.Php
{
    public class Record
    {
        // Ignite usability issue: must keep the field names same as PHP's - all camelCase.
        public string id { get; set; }

        public double price { get; set; }

        public int quantity { get; set; }

        public override string ToString()
        {
            return $"{{{nameof(id)}: '{id}', {nameof(price)}: {price}, {nameof(quantity)}: {quantity}}}";
        }
    }
}
