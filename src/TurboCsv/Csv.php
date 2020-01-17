<?php

namespace TurboCsv;

use  TurboCsv\TurboException;

class Csv{


    /**
     * @param array $data
     * @param bool $filepath
     * @param array $args
     * @throws \TurboCsv\TurboException
     */
    public function create(Array $data, $filepath = false, Array $args = []){

        $is_assoc = $this->isAssoc($data);

        if(!$is_assoc){
            throw new TurboException('Array must be associative.', 10);
        }

        $options = $this->getOptions($args);


        $columnCount = $this->getColumnCount($data);

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
     * @param array $args
     * @return array
     */
    private function getOptions(Array $args){

        $args['delimiter']   = isset($args['delimiter'])?$args['delimiter']:',';
        $args['new_line']    = isset($args['new_line'])?$args['new_line']:"\r\n";
        $args['enclosure']   = isset($args['enclosure'])?$args['enclosure']:'"';
        $args['escape_char'] = isset($args['escape_char'])?$args['escape_char']:"\\";
        $args['use_headers'] = isset($args['use_headers'])?$args['use_headers']:true;

        return $args;

    }


    private function isAssoc(Array $data){

        return count(array_filter(array_keys($data), 'is_string')) > 0;

    }

    private function getColumnCount(Array $data){

        return count($data);

    }

}