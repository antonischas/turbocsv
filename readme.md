# Turbo Csv
by antonischas

Description
----
An easy to use array to CSV library.

Example array to CSV:
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

Example CSV file to array:
```sh
        
$csv = new Csv();

$csv_array = $csv->fileToArray('test.csv', ['delimiter' => ';']

```

Versions
----
- 1.2
     - Add associative array from headers support.
 - 1.1
     - Add CSV file to array conversion.
 - 1.0
     - Simple array to CSV conversion.


License
----

GNU GPL v3.0


**You are welcome 👍**

