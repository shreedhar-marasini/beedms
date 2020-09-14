<?php

use Illuminate\Database\Seeder;

class MasterSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_settings')->truncate();


        $rows = [
            [
                'key_name' => '_COMPANY_NAME_',
                'key_label' => 'Company Name',
                'key_value' => 'Young Minds Pvt. Ltd',
                'key_type' => 'input',
                'key_description' => 'This name is displayed while sending email.',
                'key_display_order' => 1,
                'master_configuration_type' => 'branding'
            ],
            [
                'key_name' => '_COMPANY_LOGO_',
                'key_label' => 'Company Logo',
                'key_value' => 'logo2.jpg',
                'key_type' => 'file',
                'key_description' => 'Company logo for website use also displayed in the top of the website and used while sending email.(IMAGE SIZE: ~57px , ~200px)',
                'key_display_order' => 2,
                'master_configuration_type' => 'branding'
            ],
            ['key_name' => '_COMPANY_DEFAULT_EMAIL_',
                'key_label' => 'Company Default Email',
                'key_value' => 'developer@youngminds.com.np',

                'key_type' => 'input',
                'key_description' => 'This email address is used to contact to the company',
                'key_display_order' => 3,
                'master_configuration_type' => 'email'
            ],
            [
                'key_name' => '_COMPANY_ADDRESS_',
                'key_label' => 'Company Address',
                'key_value' => 'New Baneshwor',

                'key_type' => 'input',
                'key_description' => 'This email address used to contact to the company',
                'key_display_order' => 4,
                'master_configuration_type' => 'email'
            ],
            [
                'key_name' => '_COMPANY_WEBSITE_',
                'key_label' => 'Company Website',

                'key_value' => 'http://dms.youngminds.com.np',
                'key_type' => 'input',
                'key_description' => 'This is website address of company',
                'key_display_order' => 5,
                'master_configuration_type' => 'branding'
            ],
            [
                'key_name' => '_COMPANY_LICENSE_TO',
                'key_label' => 'Company License To',
                'key_value' => 'Young Minds',

                'key_type' => 'input',
                'key_description' => 'Name of the company to which this product is licensed to',
                'key_display_order' => 6,
                'master_configuration_type' => 'branding'
            ],
            [
                'key_name' => '_EMAIL_FOOTER_NOTE_',
                'key_label' => 'Email Footer Note',
                'key_value' => 'Please find the letter attached herewith and kindly provide us Regd.No. and date via email upon registration at your end for our office record.',

                'key_type' => 'textarea',
                'key_description' => 'email footer note',
                'key_display_order' => 7,
                'master_configuration_type' => 'branding'
            ],

            [
                'key_name' => '_DEFAULT_FONT_',
                'key_label' => 'Default Font',
                'key_value' => null,


                'key_type' => 'dropdown',
                'key_description' => 'This font is used in text editor of outgoing document',
                'key_display_order' => 8,
                'master_configuration_type' => 'branding'
            ],
            [
                'key_name' => '_INTEGRATE_UNICODE_',
                'key_label' => 'Integrate Unicode',
                'key_value' => NULL,

                'key_type' => 'radio',
                'key_description' => 'This helps you to read and write in nepali. If this field has value=yes then the default font will be freeserif',
                'key_display_order' => 9,
                'master_configuration_type' => 'branding'
            ],
            [
                'key_name' => '_LETTER_HEADER_IMAGE_',
                'key_label' => 'Letter Header Image',
                'key_value' => null,

                'key_type' => 'file',
                'key_description' => 'This image is used as letter head. Please upload image of width:1240px and height: 249px',
                'key_display_order' => 10,
                'master_configuration_type' => 'letter_head'
            ],
            [
                'key_name' => '_LETTER_FOOTER_IMAGE_',
                'key_label' => 'Letter Footer Image',
                'key_value' => null,

                'key_type' => 'file',
                'key_description' => 'This image is used as letter head. Please upload image of width:431px and height: 64px',
                'key_display_order' => 10,
                'master_configuration_type' => 'letter_head'
            ],
            [
                'key_name' => '_LETTER_STAMP_IMAGE_',
                'key_label' => 'Letter Stamp Image',
                'key_value' => null,

                'key_type' => 'file',
                'key_description' => 'This image is used as letter stamp. Please upload 82 px x 84 px ',
                'key_display_order' => 11,
                'master_configuration_type' => 'letter_head'
            ],
            [
                'key_name' => '_EMAIL_ADDRESS_',
                'key_label' => 'Email Address',
                'key_value' => 'developers.youngminds@gmail.com',

                'key_type' => 'input',
                'key_description' => 'Email address used to send email from this system',
                'key_display_order' => 12,
                'master_configuration_type' => 'email'
            ],
            [
                'key_name' => '_EMAIL_PASSWORD_',
                'key_label' => 'Email Password',
                'key_value' => 'snsxdfhxzomgysan',

                'key_type' => 'password',
                'key_description' => 'Password of above Email address used to send email from the system. Use app password.',
                'key_display_order' => 13,
                'master_configuration_type' => 'email'
            ],
            [
                'key_name' => '_EMAIL_PORT_',
                'key_label' => 'Email Port',
                'key_value' => 587,

                'key_type' => 'input',
                'key_description' => 'Email port to send email from this system.Default:587 for gmail',
                'key_display_order' => 14,
                'master_configuration_type' => 'email'
            ],
            [
                'key_name' => '_UI_SKIN_',
                'key_label' => 'ui skin',
                'key_value' => 'skin-blue',

                'key_type' => 'color',
                'key_description' => '',
                'key_display_order' => 15,
                'master_configuration_type' => 'ui'
            ],
            [
                'key_name' => '_FIXED_LAYOUT_',
                'key_label' => ' Fixed layout',
                'key_value' => 0,

                'key_type' => 'radio',
                'key_description' => 'Activate the fixed layout. You can\'t use fixed and boxed layouts together',
                'key_display_order' => 16,
                'master_configuration_type' => 'ui'
            ],
            [
                'key_name' => '_BOXED_LAYOUT_',
                'key_label' => 'Boxed Layout',
                'key_value' => 0,

                'key_type' => 'radio',
                'key_description' => 'Activate the boxed layout',
                'key_display_order' => 0,
                'master_configuration_type' => 'ui'
            ],
            [
                'key_name' => '_TOGGLE_SIDEBAR_',
                'key_label' => 'Toggole Sidebar',
                'key_value' => 0,

                'key_type' => 'radio',
                'key_description' => 'Toggle the left sidebar\'s state (open or collapse)',
                'key_display_order' => 0,
                'master_configuration_type' => 'ui'
            ],
//            ['key_name' => '_SIDEBAR_EXPAND_ON_HOVER_',
//                'key_label' => 'Sidebar Expand on Hover',
//                'key_value' => null,
//
//                'key_type' => 'radio',
//                'key_description' => 'Let the sidebar mini expand on hover',
//                'key_display_order' => 0,
//                'master_configuration_type' => 'ui'
//            ],
            [
                'key_name' => '__GOOGLE_CALENDER_ID__',
                'key_label' => 'Google Calender id',
                'key_value' => 'pk0h6bnanf4crp5cocunu2d2g0@group.calendar.google.com',

                'key_type' => 'input',
                'key_description' => 'This id is used for identifying Google Calender.',
                'key_display_order' => 16,
                'master_configuration_type' => 'calender'
            ]
            ,
            [
                'key_name' => '__GOOGLE_CALENDER_SERVICE_ACCOUNT__',
                'key_label' => 'Google Calender Service Account',
                'key_value' => null,

                'key_type' => 'input',
                'key_description' => 'This account is used for Google Calender',
                'key_display_order' => 17,
                'master_configuration_type' => 'calender'
            ],
            [
                'key_name' => '__GOOGLE_CALENDER_IFRAME__',
                'key_label' => 'Google Calender iframe',
                'key_value' => '<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTz=0&amp;height=300&amp;wkst=1&amp;bgcolor=%23999999&amp;src=pk0h6bnanf4crp5cocunu2d2g0%40group.calendar.google.com&amp;color=%23711616&amp;ctz=Asia%2FKatmandu" style="border:solid 1px #777" width="500" height="300" frameborder="0" scrolling="no"></iframe>',

                'key_type' => 'textarea',
                'key_description' => 'Iframe to display the google Calender in Dashboard',
                'key_display_order' => 18,
                'master_configuration_type' => 'calender'
            ],

            [
                'key_name' => '__GOOGLE_DRIVE_CLIENT_ID__',
                'key_label' => 'Google Drive Client id',
                'key_value' => NULL,

                'key_type' => 'input',
                'key_description' => 'This id is used for identifying Google Drive Click here for reference https://github.com/ivanvermeyen/laravel-google-drive-demo/blob/master/README/1-getting-your-dlient-id-and-secret.md',
                'key_display_order' => 19,
                'master_configuration_type' => 'calender'
            ],
[
                'key_name' => '__GOOGLE_DRIVE_CLIENT_SECRET__',
                'key_label' => 'Google Drive Client Secret id',
                'key_value' => NULL,

                'key_type' => 'input',
                'key_description' => 'This id is used for authenticate Google drive client Id For reference click https://github.com/ivanvermeyen/laravel-google-drive-demo/blob/master/README/1-getting-your-dlient-id-and-secret.md',
                'key_display_order' => 20,
                'master_configuration_type' => 'calender'
            ],[
                'key_name' => '__GOOGLE_DRIVE_REFRESH_TOKEN__',
                'key_label' => 'Google Drive Refresh Token',
                'key_value' => NULL,

                'key_type' => 'input',
                'key_description' => 'Reference: https://github.com/ivanvermeyen/laravel-google-drive-demo/blob/master/README/2-getting-your-refresh-token.md',
                'key_display_order' => 21,
                'master_configuration_type' => 'calender'
            ],[
                'key_name' => '__GOOGLE_DRIVE_FOLDER_ID__',
                'key_label' => 'Google Drive Folder Id',
                'key_value' => NULL,
         
                'key_type' => 'input',
                'key_description' => 'Reference: https://github.com/ivanvermeyen/laravel-google-drive-demo/blob/master/README/3-getting-your-root-folder-id.md',
                'key_display_order' => 22,
                'master_configuration_type' => 'calender'
            ]

        ];
        DB::table('master_settings')->insert($rows);
    }
}
