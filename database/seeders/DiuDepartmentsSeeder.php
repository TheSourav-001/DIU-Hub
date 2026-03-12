<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiuDepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            'Faculty of Science & Information Technology (FSIT)' => [
                ['name' => 'Computer Science and Engineering', 'code' => 'CSE'],
                ['name' => 'Software Engineering', 'code' => 'SWE'],
                ['name' => 'Multimedia & Creative Technology', 'code' => 'MCT'],
                ['name' => 'Computing and Information Systems', 'code' => 'CIS'],
                ['name' => 'Information Technology & Management', 'code' => 'ITM'],
            ],
            'Faculty of Engineering (FE)' => [
                ['name' => 'Electrical and Electronic Engineering', 'code' => 'EEE'],
                ['name' => 'Textile Engineering', 'code' => 'TE'],
                ['name' => 'Civil Engineering', 'code' => 'CE'],
                ['name' => 'Architecture', 'code' => 'ARCH'],
                ['name' => 'Robotics and Mechatronics Engineering', 'code' => 'RME'],
                ['name' => 'Information and Communication Engineering', 'code' => 'ICE'],
            ],
            'Faculty of Business & Entrepreneurship (FBE)' => [
                ['name' => 'Business Administration', 'code' => 'BBA'],
                ['name' => 'Innovation & Entrepreneurship', 'code' => 'IE'],
                ['name' => 'Tourism & Hospitality Management', 'code' => 'THM'],
                ['name' => 'Real Estate', 'code' => 'RE'],
                ['name' => 'Management', 'code' => 'MGT'],
                ['name' => 'Accounting', 'code' => 'ACC'],
                ['name' => 'Finance & Banking', 'code' => 'FNB'],
                ['name' => 'Marketing', 'code' => 'MKT'],
            ],
            'Faculty of Health & Life Sciences (FHLS)' => [
                ['name' => 'Pharmacy', 'code' => 'PHR'],
                ['name' => 'Nutrition and Food Engineering', 'code' => 'NFE'],
                ['name' => 'Public Health', 'code' => 'PH'],
                ['name' => 'Agricultural Science', 'code' => 'AGS'],
                ['name' => 'Genetic Engineering and Biotechnology', 'code' => 'GEB'],
                ['name' => 'Environmental Science and Disaster Management', 'code' => 'ESDM'],
                ['name' => 'Physical Education & Sports Science', 'code' => 'PESS'],
            ],
            'Faculty of Humanities & Social Science (FHSS)' => [
                ['name' => 'English', 'code' => 'ENG'],
                ['name' => 'Law', 'code' => 'LAW'],
                ['name' => 'Journalism, Media and Communication', 'code' => 'JMC'],
                ['name' => 'Development Studies', 'code' => 'DS'],
            ],
        ];

        foreach ($faculties as $facultyName => $departments) {
            foreach ($departments as $dept) {
                \App\Models\Department::updateOrCreate(
                    ['code' => $dept['code']],
                    ['name' => $dept['name'], 'faculty' => $facultyName]
                );
            }
        }
    }
}
