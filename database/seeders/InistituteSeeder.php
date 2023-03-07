<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inistitute;

class InistituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inistitute::truncate();
        $heading = true;
        $input_file = fopen(base_path("database/data/inistitute.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {

                $datalist = array(
            'MADRASAH_NAME'=> $record['0'],
            'MAD_EIIN'=> $record['1'],
             'CENTER_CODE'=> $record['2'],
              'CENTER_EIIN'=> $record['3'],
                 'SESSION'=> $record['4'],   
                 'GROUP_CODE'=> $record['5'],
              'GROUP_NAME'=> $record['6'],
              'DIVISION'=> $record['7'],
               'DISTRICT'=> $record['8'],
               'THANA'=> $record['9'],
               'PHONE'=> $record['10'],
                'TOTAL_STUDENTS'=> $record['11'],
                        );
                Inistitute::create($datalist);    
            }
            $heading = false;
        }
        fclose($input_file);
    }
}

