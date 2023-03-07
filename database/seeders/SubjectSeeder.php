<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Subject::truncate();
        $heading = true;
        $input_file = fopen(base_path("database/data/SUBJECT.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $datalist = array(
            'SUBJECT_CODE'=> $record['0'],
            'SUBJECT_NAME'=> $record['1'],
            'GROUP_CODE'=> $record['2'],
                        );
                Subject::create($datalist);    
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
