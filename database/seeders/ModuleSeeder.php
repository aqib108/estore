<?php

namespace Database\Seeders;

use App\Models\Admin\Module;
use App\Models\Admin\Right;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //_________________Dashboard Rights_____________//
        $dashboard = Module::create([
            'name' => 'Dashboard',
            'status' => 1,
        ]);

        Right::create([
            'module_id' => $dashboard->id,
            'name' => 'Access-Dashboard',
            'status' => 1,
        ]);
        //_________________Admin Rights_____________//
        $admin_module = Module::create([
            'name' => 'Admin',
            'status' => 1,
        ]);

        Right::create([
            'module_id' => $admin_module->id,
            'name' => 'Access-Admin',
            'status' => 1,
        ]);

        // //_________________User Rights_____________//
        $user_rights_module = Module::create([
            'name' => 'User',
            'status' => 1,
        ]);

        Right::create([
            'module_id' => $user_rights_module->id,
            'name' => 'Access-User',
            'status' => 1,
        ]);
        // //_________________Roles Rights_____________//
        $roles_module = Module::create([
            'name' => 'Roles Managment',
            'status' => 1,
        ]);

        Right::create([
            'module_id' => $roles_module->id,
            'name' => 'Access-Roles-Managment',
            'status' => 1,
        ]);
        //_______________Slider in Home Settings____________//
        $slider_module = Module::create([
            'name' => 'Slider',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $slider_module->id,
            'name' => 'Access-Slider',
            'status' => 1,
        ]);
        
        //_______________ceo message in Home Settings____________//
        $ceo_message_module = Module::create([
            'name' => 'Ceo Message',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $ceo_message_module->id,
            'name' => 'Access-Message',
            'status' => 1,
        ]);


        //_______________Contacts in Quries____________//
        $contacts_module = Module::create([
            'name' => 'Contacts',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $contacts_module->id,
            'name' => 'Access-Contacts',
            'status' => 1,
        ]);
       
        
        //_______________Library Image Module____________//
        $library_image_module = Module::create([
            'name' => 'Library Image',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $library_image_module->id,
            'name' => 'Access-Library-Image',
            'status' => 1,
        ]);

        //_______________Library Video Module____________//
        $library_video_module = Module::create([
            'name' => 'Library Video',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $library_video_module->id,
            'name' => 'Access-Library-Video',
            'status' => 1,
        ]);
        //_______________Library audio Module____________//
        $library_audio_module = Module::create([
            'name' => 'Library Audio',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $library_audio_module->id,
            'name' => 'Access-Library-Audio',
            'status' => 1,
        ]);
        //_______________Library Book Module____________//
        $library_book_module = Module::create([
            'name' => 'Library Book',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $library_book_module->id,
            'name' => 'Access-Library-Book',
            'status' => 1,
        ]);
        //_______________Library Document Module____________//
        $library_document_module = Module::create([
            'name' => 'Library Document',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $library_document_module->id,
            'name' => 'Access-Library-Document',
            'status' => 1,
        ]);

        //_______________Pages Module____________//
        $pages_module = Module::create([
            'name' => 'Pages',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $pages_module->id,
            'name' => 'Access-Pages',
            'status' => 1,
        ]);

        //_______________Doantions Sections____________//
        $doantions_module = Module::create([
            'name' => 'Doantions',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $doantions_module->id,
            'name' => 'Access-Doantions',
            'status' => 1,
        ]);
        //_______________ Posts Sections____________//
        $posts_module = Module::create([
            'name' => 'Posts',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $posts_module->id,
            'name' => 'Access-Posts',
            'status' => 1,
        ]);
    
        //_______________ Categories Sections____________//
        $categories_module = Module::create([
            'name' => 'Categories',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $categories_module->id,
            'name' => 'Access-Categories',
            'status' => 1,
        ]);

        //_______________ Tags Sections____________//
        $tag_module = Module::create([
            'name' => 'Tags',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $tag_module->id,
            'name' => 'Access-Tags',
            'status' => 1,
        ]);
        //_______________ News Feed Sections____________//
        $news_module = Module::create([
            'name' => 'News Feed',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-News-Feed',
            'status' => 1,
        ]);
        //_______________ Subscription Sections____________//
        $news_module = Module::create([
            'name' => 'Subscription',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-Subscription',
            'status' => 1,
        ]);
        //_______________ Magazine Categories Sections____________//
        $news_module = Module::create([
            'name' => 'Magazine Categories',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-Magazine-Categories',
            'status' => 1,
        ]);
        //_______________ Magazine Sections____________//
        $news_module = Module::create([
            'name' => 'Magazine',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-Magazine',
            'status' => 1,
        ]);
        //_______________ Courses Sections____________//
        $news_module = Module::create([
            'name' => 'Courses',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-Courses',
            'status' => 1,
        ]);
        //_______________ Classes Sections____________//
        $news_module = Module::create([
            'name' => 'Classes',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-Classes',
            'status' => 1,
        ]);
        //_______________ Our Aims Sections____________//
        $news_module = Module::create([
            'name' => 'Our Aims',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-Our-Aims',
            'status' => 1,
        ]);
        //_______________ Our Testimonials Sections____________//
        $news_module = Module::create([
            'name' => 'Our Testimonials',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-Our-Testimonials',
            'status' => 1,
        ]);
        //_______________ Our Locations Sections____________//
        $news_module = Module::create([
            'name' => 'Our Locations',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-Our-Locations',
            'status' => 1,
        ]);
        //_______________ Our Departments Sections____________//
        $news_module = Module::create([
            'name' => 'Our Departments',
            'status' => 1,
        ]);
        Right::create([
            'module_id' => $news_module->id,
            'name' => 'Access-Our-Departments',
            'status' => 1,
        ]);
    
    }
}
