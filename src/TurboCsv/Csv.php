<?php

namespace TurboCsv;

class Csv{


    /**
     * @param array $data
     * @param bool $filepath
     * @param array $args
     * @return string
     * @throws \TurboCsv\TurboException
     */
    public function create(Array $data, $filepath = false, Array $args = []){

        $is_assoc = $this->isAssoc($data);

        if(!$is_assoc){
            throw new TurboException('Array must be associative.', 10);
        }

        $options = $this->getOptions($args, 'create');

        $title = [];
        $body  = [];
        $index = 0;
        foreach ($data as $column => $column_data){

            if($options['use_headers']){
                $title[] = $column;
            }

            foreach ($column_data as $column_datum){
                $body[$index][] = $column_datum;
            }

            $index++;

        }

        $csv = '';

        if($options['use_headers']){
            $csv = implode($options['delimiter'], $title) . $options['new_line'];
        }

        foreach ($body as $row){

            $csv .= implode($options['delimiter'], $row) . $options['new_line'];

        }

        return $csv;
    }

    /**
     * @param string $file
     * @return array
     * @throws TurboException
     */
    public function fileToArray($file, $options = []){

        $file_pointer = fopen($file, 'r');
        $options = $this->getOptions($options, 'parse');

        if(!$file_pointer){
            throw new TurboException('File was not found or lack of rights.', 10);
        }

        $csv = [];

        if($options['use_headers'] === true){
            $is_first = true;
            $headers = [];
            while (($line = fgetcsv($file_pointer, 0, $options['delimiter'])) !== FALSE) {

                // detect headers
                if($is_first){
                    $headers = $line;
                    $is_first = false;
                    continue;
                }

                foreach ($line as $index => $value){

                    $csv[$headers[$index]][] = $value;

                }
            }

        }else{

            while (($line = fgetcsv($file_pointer, 0, $options['delimiter'])) !== FALSE) {
                $csv[] = $line;
            }

        }

        fclose($file_pointer);

        return $csv;

    }

    /**
     * @param array $args
     * @return array
     */
    private function getOptions(Array $args, $use){

        if($use === 'create'){

            $args['delimiter']   = isset($args['delimiter'])?$args['delimiter']:',';
            $args['new_line']    = isset($args['new_line'])?$args['new_line']:"\r\n";
            $args['enclosure']   = isset($args['enclosure'])?$args['enclosure']:'"';
            $args['escape_char'] = isset($args['escape_char'])?$args['escape_char']:"\\";
            $args['use_headers'] = isset($args['use_headers'])?$args['use_headers']:true;

        }elseif ($use === 'parse'){

            $args['delimiter']   = isset($args['delimiter'])?$args['delimiter']:',';
            $args['use_headers']   = isset($args['use_headers'])?$args['use_headers']:false;

        }

        return $args;

    }


    /**
     * @param array $data
     * @return bool
     */
    private function isAssoc(Array $data){

        return count(array_filter(array_keys($data), 'is_string')) > 0;

    }

    /**
     * @param array $data
     * @return int
     */
    private function getColumnCount(Array $data){

        return count($data);

    }



}