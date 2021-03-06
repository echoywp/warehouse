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
            ['id' => 8, 'parent_id' => 0, 'order'=>10, 'title'=>'产品管理', 'icon'=> 'fa-dropbox', 'uri'=>'', ],
            ['id' => 9, 'parent_id' => 8, 'order'=>11, 'title'=>'产品列表', 'icon'=> '', 'uri'=>'product', ],
            ['id' => 10, 'parent_id' => 8, 'order'=>12, 'title'=>'分类列表', 'icon'=> '', 'uri'=>'category', ],
            ['id' => 11, 'parent_id' => 0, 'order'=>13, 'title'=>'仓储管理', 'icon'=> 'fa-braille', 'uri'=>'', ],
            ['id' => 12, 'parent_id' => 11, 'order'=>14, 'title'=>'仓库列表', 'icon'=> '', 'uri'=>'warehouse', ],
            ['id' => 13, 'parent_id' => 11, 'order'=>15, 'title'=>'库存列表', 'icon'=> '', 'uri'=>'inventory', ],
            ['id' => 14, 'parent_id' => 0, 'order'=>16, 'title'=>'物流列表', 'icon'=> 'fa-ambulance', 'uri'=>'logistics', ],
            ['id' => 15, 'parent_id' => 0, 'order'=>8, 'title'=>'配置', 'icon'=> 'fa-gears', 'uri'=>'common', ],
            ['id' => 16, 'parent_id' => 0, 'order'=>9, 'title'=>'员工管理', 'icon'=> 'fa-address-card-o', 'uri'=>'user', ],
            ['id' => 17, 'parent_id' => 0, 'order'=>17, 'title'=>'采购管理', 'icon'=> 'fa-cart-plus', 'uri'=>'', ],
            ['id' => 18, 'parent_id' => 17, 'order'=>18, 'title'=>'供应商管理', 'icon'=> '', 'uri'=>'supplier', ],
        ];
        foreach ($items as $item) {
            Menu::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
