<?php

use Illuminate\Database\Seeder;
use Dcat\Admin\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 8, 'parent_id' => 0, 'order'=>8, 'title'=>'产品管理', 'icon'=> 'fa-dropbox', 'uri'=>'', ],
            ['id' => 9, 'parent_id' => 8, 'order'=>9, 'title'=>'产品列表', 'icon'=> '', 'uri'=>'product', ],
            ['id' => 10, 'parent_id' => 8, 'order'=>10, 'title'=>'分类列表', 'icon'=> '', 'uri'=>'category', ],
            ['id' => 11, 'parent_id' => 0, 'order'=>11, 'title'=>'仓储管理', 'icon'=> 'fa-braille', 'uri'=>'', ],
            ['id' => 12, 'parent_id' => 11, 'order'=>12, 'title'=>'仓库列表', 'icon'=> '', 'uri'=>'warehouse', ],
            ['id' => 13, 'parent_id' => 11, 'order'=>13, 'title'=>'库存列表', 'icon'=> '', 'uri'=>'inventory', ],
            ['id' => 14, 'parent_id' => 0, 'order'=>14, 'title'=>'物流列表', 'icon'=> 'fa-ambulance', 'uri'=>'logistics', ],
        ];
        foreach ($items as $item) {
            Menu::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
