<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        $rows = [
            [
                'parent_id' => '0',
                'menu_name' => 'Dashboard',
                'menu_link' => 'homeIndex',
                'menu_controller' => 'HomeController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-tachometer" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '0'
            ],
            [
                'parent_id' => '0',
                'menu_name' => 'Documents',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-folder" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],
            [
                'parent_id' => '2',
                'menu_name' => 'Incoming Documents',
                'menu_link' => '/documents/incomingDocument',
                'menu_controller' => 'IncomingDocumentController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-arrow-down" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '0'
            ],
            [
                'parent_id' => '0',
                'menu_name' => 'Configuration',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gears" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '8'
            ],

            [
                'parent_id' => '0',
                'menu_name' => 'Roles',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-gear" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '7'
            ],
            [
                'parent_id' => '5',
                'menu_name' => 'Menus',
                'menu_link' => '/roles/menu',
                'menu_controller' => 'MenuController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-list" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],

            [
                'parent_id' => '5',
                'menu_name' => 'Groups',
                'menu_link' => '/roles/group',
                'menu_controller' => 'GroupController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-group" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '2'
            ],

            [
                'parent_id' => '0',
                'menu_name' => 'Users',
                'menu_link' => '/user',
                'menu_controller' => 'UserController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-user-plus" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '6'
            ],

            [
                'parent_id' => '4',
                'menu_name' => 'Document Category',
                'menu_link' => '/configurations/documentCategory',
                'menu_controller' => 'DocumentCategoryController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],

            [
                'parent_id' => '4',
                'menu_name' => 'Department',
                'menu_link' => '/configurations/department',
                'menu_controller' => 'DepartmentController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-building" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '2'
            ],

            [
                'parent_id' => '4',
                'menu_name' => 'Designation',
                'menu_link' => '/configurations/designation',
                'menu_controller' => 'DesignationController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-address-card" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '3'
            ],

            [

                'parent_id' => '4',
                'menu_name' => 'Fiscal Year',
                'menu_link' => '/configurations/fiscalYear',
                'menu_controller' => 'FiscalYearController',

                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '5'
            ],

            [

                'parent_id' => '4',
                'menu_name' => 'Tag',
                'menu_link' => '/configurations/tag',
                'menu_controller' => 'TagController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-tags" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '6'
            ],

            [
                'parent_id' => '4',
                'menu_name' => 'Widget',
                'menu_link' => '/configurations/widget',
                'menu_controller' => 'WidgetController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-braille" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '7'
            ],
            [
                'parent_id' => '2',
                'menu_name' => 'Outgoing Documents',
                'menu_link' => '/documents/outgoingDocument',
                'menu_controller' => 'OutgoingDocumentController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-envelope-open" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '0'
            ],
            [
                'parent_id' => '0',
                'menu_name' => 'Institution',
                'menu_link' => '/institution',
                'menu_controller' => 'InstitutionController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-institution" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '3'
            ],
            [
                'parent_id' => '4',
                'menu_name' => 'Template',
                'menu_link' => 'configurations/template',
                'menu_controller' => 'TemplateController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-newspaper-o" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '5'
            ],

            [
                'parent_id' => '0',
                'menu_name' => 'Logs',
                'menu_link' => '',
                'menu_controller' => '',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-sign-in" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '9'
            ],

            [
                'parent_id' => '18',
                'menu_name' => 'Login Logs',
                'menu_link' => '/logs/loginLog',
                'menu_controller' => 'LoginLogController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-check" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],

            [
                'parent_id' => '18',
                'menu_name' => 'Fail Login Logs',
                'menu_link' => '/logs/failLog',
                'menu_controller' => 'LoginLogController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-times" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '2'
            ],

            [
                'parent_id' => '5',
                'menu_name' => 'Role Access',
                'menu_link' => '/roles/roleAccessIndex',
                'menu_controller' => 'RoleAccessController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-unlock" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '2'
            ],
            [
                'parent_id' => '2',
                'menu_name' => 'Digitized Documents',
                'menu_link' => '/documents/digitizedDocument',
                'menu_controller' => 'DigitizedDocumentController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-calculator" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '3'
            ],
            [
                'parent_id' => '0',
                'menu_name' => 'Reminder',
                'menu_link' => '/reminder',
                'menu_controller' => 'ReminderController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '5'
            ],
            [
                'parent_id' => '0',
                'menu_name' => 'Tool',
                'menu_link' => '/tools',
                'menu_controller' => 'ToolController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-wrench  aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '9'
            ],
            [
                'parent_id' => '4',
                'menu_name' => 'Branding Configuration',
                'menu_link' => 'configurations/branding',
                'menu_controller' => 'BrandingController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-cog  aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '8'
            ],
            [
                'parent_id' => '4',
                'menu_name' => 'UI',
                'menu_link' => 'configurations/ui',
                'menu_controller' => 'UIController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-desktop  aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '9'
            ], [
                'parent_id' => '0',
                'menu_name' => 'Name Card',
                'menu_link' => 'name-card',
                'menu_controller' => 'NameCardController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-id-card  aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '1'
            ],
            [
                'parent_id' => '2',
                'menu_name' => 'Folder',
                'menu_link' => '/documents/folder',
                'menu_controller' => 'FolderController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-folder-open-o" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '4'
            ],
            [
                'parent_id' => '0',
                'menu_name' => 'Widget',
                'menu_link' => '/user-widget',
                'menu_controller' => 'WidgetController',
                'menu_css' => '',
                'menu_icon' => '<i class="fa fa-windows" aria-hidden="true"></i>',
                'menu_status' => '1',
                'menu_order' => '100'
            ],


        ];
        DB::table('menus')->insert($rows);

    }
}
