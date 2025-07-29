<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'süperadmin']);
        $admin = Role::create(['name' => 'admin']);
        $kullanici = Role::create(['name' => 'kullanici']);

        $permissions = [
            'admin oluştur',
            'admin sil',
            'ayarları yönet',
            'kullanıcıları görüntüle',
            'makale oluştur',
            'makale düzenle',
            'makale sil',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            'ayarları yönet',
            'kullanıcıları görüntüle',
            'makale oluştur',
            'makale düzenle',
        ]);

        $kullanici->givePermissionTo([
            'makale oluştur',
        ]);

        // Test için bir kullanıcıya süperadmin rolü ata (örnek: id=1)
        $user = User::find(1);
        if ($user) {
            $user->assignRole('süperadmin');
        }
    }
}
