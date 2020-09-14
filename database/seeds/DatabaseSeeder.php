<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      
       $this->call(MasterSettingTableSeeder::class);
       $this->call(MenusTableSeeder::class);
       $this->call(DesignationsTableSeeder::class);
       $this->call(DepartmentsTableSeeder::class);

       $this->call(UserGroupsTableSeeder::class);
       $this->call(FiscalYearsTableSeeder::class);
       $this->call(UserTableSeeder::class);

        $this->call(CalendarTableSeeder::class);
       $this->call(InstitutionTableSeeder::class);
       $this->call(DocumentCategoryTableSeeder::class);
       $this->call(TemplateTableSeeder::class);
       $this->call(TagTableSeeder::class);
       $this->call(IncomingLetterSeeder::class);
       $this->call(IncomingLetterSeeder::class);
       $this->call(OutgoingLetterSeeder::class);
       $this->call(DigitizedDocumentTableSeeder::class);
       $this->call(OutgoingLetterSeeder::class);
       $this->call(DigitizedDocumentTableSeeder::class);
       $this->call(OutgoingLetterSeeder::class);
       $this->call(DigitizedDocumentTableSeeder::class);
       $this->call(SkinTableSeeder::class);
       $this->call(UserRolesSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
