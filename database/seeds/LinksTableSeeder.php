<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
            'link_name' => '后盾网',
            'link_title' => '国内最好的php培训机构',
            'link_url' => 'http://www.houdunwang.com',
            'link_order' => 1
           ],
        	[
            'link_name' => '兄弟连',
            'link_title' => '国内最好的php培训机构',
            'link_url' => 'http://www.houdunwang.com',
            'link_order' => 2
           ],        
        	[
            'link_name' => '云知梦',
            'link_title' => '国内最好的php培训机构',
            'link_url' => 'http://www.houdunwang.com',
            'link_order' => 3
           ],            
        ];

        DB::table('links')->insert($data);        
    }
}
