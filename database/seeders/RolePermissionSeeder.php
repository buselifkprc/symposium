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
        // Rolleri oluştur
        $superAdmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $kullanici = Role::create(['name' => 'kullanici']);

        // İzinleri oluştur
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

        // Süperadmin her şeye yetkili
        $superAdmin->givePermissionTo(Permission::all());

        // Admin bazı yönetimsel yetkilere sahip
        $admin->givePermissionTo([
            'ayarları yönet',
            'kullanıcıları görüntüle',
            'makale oluştur',
            'makale düzenle',
        ]);

        // Kullanıcı sadece içerik oluşturabilir
        $kullanici->givePermissionTo([
            'makale oluştur',
        ]);

        // Test için bir kullanıcıya süperadmin rolü ata (örnek: id=1)
        $user = User::find(1);
        if ($user) {
            $user->assignRole('superadmin');
        }
    }
}
