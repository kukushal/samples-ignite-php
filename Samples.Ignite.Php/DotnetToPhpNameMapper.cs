using Apache.Ignite.Core.Binary;
using System;

namespace Samples.Ignite.Php
{
    public class DotnetToPhpNameMapper : IBinaryNameMapper
    {
        /// <summary>
        /// Convert .NET property name to PHP naming style by converting first letter to lower case.
        /// </summary>
        public string GetFieldName(string name)
        {
            if (name == null)
                throw new ArgumentNullException(nameof(name));

            return char.ToLowerInvariant(name[0]) + name.Substring(1);
        }

        /// <summary>
        /// Convert .NET fully qualified type name to PHP style by replacing dots with back slashes.
        /// </summary>
        public string GetTypeName(string name)
        {
            if (name == null)
                throw new ArgumentNullException(nameof(name));

            // Remove assembly info and convert full name. Generics are not supported.
            var res = name;
            var i = res.IndexOf(',');
            if (i > 0)
                res = res.Substring(0, i);

            res = res.Replace('.', '\\');

            return res;
        }
    }
}