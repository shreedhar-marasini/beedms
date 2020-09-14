<?php

use Illuminate\Database\Seeder;

class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dms_institutions')->truncate();
        $rows = [
            [
                'institution_name' => 'Nepal health Research',
                'institution_address' => 'kathmandu',
                'institution_email_address' => 'nhrc@gmail.com',
                'institution_contact_number'=>'1121212',
                'institution_website'=>'nhrc.com.np',
                'institution_pan_number'=>'1212121',
            ],
            [
                'institution_name' => 'OIRS',
                'institution_address' => 'kathmandu',
                'institution_email_address' => 'oirs@gmail.com',
                'institution_contact_number'=>'253545646',
                'institution_website'=>'oirs.com.np',
                'institution_pan_number'=>'145345345',
            ],
            [
                'institution_name' => 'mis',
                'institution_address' => 'kathmandu',
                'institution_email_address' => 'mis@gmail.com.np',
                'institution_contact_number'=>'3234234234',
                'institution_website'=>'mis.com.np',
                'institution_pan_number'=>'154353',
            ]

        ];
        DB::table('dms_institutions')->insert($rows);
    }
}
