<?php

namespace App\Traits;

use App\Models\Menu;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

trait MenuTrait
{
    public function addPermision($id, $name, $available)
    {
        $menu = Menu::where('id', $id)->first();
        $roleadmin = Role::find('1');
        foreach ($available as $key => $value) {
            $permission = Permission::create(['name' => $value.'-'.$name]);
            $roleadmin->givePermissionTo($permission);
        }

        $menu->available = $available;
        $menu->permision = 'read-'.$name;
        $menu->save();
    }

    public function addPermisionByText($text, $name, $available)
    {
        $menu = Menu::where('text', $text)->first();
        $roleadmin = Role::find('1');
        foreach ($available as $key => $value) {
            $permission = Permission::create(['name' => $value.'-'.$name]);
            $roleadmin->givePermissionTo($permission);
        }

        $menu->avaible = $available;
        $menu->permision = 'read-'.$name;
        $menu->save();
    }

    public function addPermisionByUrl($url, $name, $available)
    {
        $menu = Menu::where('url', $url)->first();
        $roleadmin = Role::find('1');
        foreach ($available as $key => $value) {
            $permission = Permission::create(['name' => $value.'-'.$name]);
            $roleadmin->givePermissionTo($permission);
        }

        $menu->available = $available;
        $menu->permision = 'read-'.$name;
        $menu->save();
    }

    /**
     *  Tambahkan menu.
     *
     * @param int    $id
     * @param array  $attributes    // tambahkan atribut, seperti id_parent dll
     * @param string $namePermision // nama rule nya
     * @param array  $permision     // permision nya, ["read","create", "update", "delete"]
     *
     * @return void
     */
    public function addNewMenu($id, $attributes, $namePermision, $permision)
    {
        Menu::create([...['id' => $id], ...$attributes, ['permision' => $namePermision], ...$permision]);

        // tambahkan permision dan defaultkan ke role admin
        $this->addPermision($id, $namePermision, $permision);
    }

    private function updateMenu($text, $data, $conditions = [])
    {
        // Check if the menu already exists
        $menu = Menu::where('text', $text)->where($conditions)->first();

        if ($menu) {
            // Menu exists, update it only if the desired ID is not already taken
            if (! $this->isIdTaken($data['id'])) {
                $menu->update($data);
            }
        } else {
            // Menu doesn't exist, insert it
            Menu::create(array_merge(['text' => $text], $data, $conditions));
        }
    }

    private function isIdTaken($desiredId)
    {
        return Menu::where('id', $desiredId)->exists();
    }
}
