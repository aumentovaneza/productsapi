<?php

namespace App\Traits;

trait FileReaderTrait
{
    public function readCSV($url): array
    {
        // Read file into array
        $file = file_get_contents($url);
        // Separate lines
        $rows = explode("\n", $file);
        // Turn headings on first line into array
        $headings = explode(',', str_replace('"','',$rows[0]));
        // Remove headings from data set
        unset($rows[0]);
        $csvData = [];

        //Populate array
        foreach ($rows AS $row){
            $rowArray = explode(',', $row);

            if(count($rowArray) === count($headings)){
                $csvData[] = array_combine($headings, $rowArray);
            }
            $rowArray=null;
        }

        return $csvData;
    }
}
