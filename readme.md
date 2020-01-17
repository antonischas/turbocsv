# Turbo Csv
by antonischas

Description
----
An easy to use array to CSV library.

Example:
```sh
$data = [
            'names' => ['Antonis', 'Giannis', 'Teo'],
            'ages'  => [21,24,43]
        ];
        
$options = [
            'delimiter' => ';',
            'new_line' => "\n",
            'enclosure' => '"',
            'escape_char' => "\\",
            'use_headers' => true
        ];
        
$csv = new Csv();

$csv_content = $csv->create($data, $options);

```

Versions
----
 - 1.0
     - Simple array to CSV conversion.

License
----

GNU GPL v3.0


**You are welcome 👍**

