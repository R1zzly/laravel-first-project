<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {

        $super = Role::findByName('super-user');
        $super->givePermissionTo(Permission::all());

        $client = Role::findByName('client');
        $client->givePermissionTo([
            'show products',
            'review products',
            'show category',
            'show cart',
            'add to cart',
            'delete cart',
            'increase cart',
            'decrease cart',
            'order',
        ]);

//        Permission::create(['name'=>'show products']);
//        Permission::create(['name'=>'add products']);
//        Permission::create(['name'=>'edit products']);
//        Permission::create(['name'=>'review products']);
//        Permission::create(['name'=>'delete products']);
//
//        Permission::create(['name'=>'show category']);
//        Permission::create(['name'=>'add category']);
//        Permission::create(['name'=>'edit category']);
//        Permission::create(['name'=>'delete category']);
//
//        Permission::create(['name'=>'show cart']);
//        Permission::create(['name'=>'add to cart']);
//        Permission::create(['name'=>'delete cart']);
//        Permission::create(['name'=>'increase cart']);
//        Permission::create(['name'=>'decrease cart']);
//
//        Permission::create(['name'=>'order']);
    }

//    ['name' => 'view-dashboard', 'module' => 'Dashboard'],
//    ['name' => 'view-any-dashboard', 'module' => 'Dashboard'],
//
//    ['name' => 'view-lead', 'module' => 'Leads'],
//    ['name' => 'view-any-lead', 'module' => 'Leads'],
//    ['name' => 'create-lead', 'module' => 'Leads'],
//    ['name' => 'update-lead', 'module' => 'Leads'],
//    ['name' => 'delete-lead', 'module' => 'Leads'],
//    ['name' => 'delete-any-lead', 'module' => 'Leads'],
//
//    ['name' => 'view-project', 'module' => 'Project'],
//    ['name' => 'view-any-project', 'module' => 'Project'],
//    ['name' => 'create-project', 'module' => 'Project'],
//    ['name' => 'update-project', 'module' => 'Project'],
//    ['name' => 'delete-project', 'module' => 'Project'],
//    ['name' => 'delete-any-project', 'module' => 'Project'],
//
//    ['name' => 'view-document', 'module' => 'Document'],
//    ['name' => 'view-any-document', 'module' => 'Document'],
//    ['name' => 'create-document', 'module' => 'Document'],
//    ['name' => 'update-document', 'module' => 'Document'],
//    ['name' => 'delete-document', 'module' => 'Document'],
//    ['name' => 'delete-any-document', 'module' => 'Document'],
//
//    ['name' => 'view-provider', 'module' => 'Provider'],
//    ['name' => 'view-any-provider', 'module' => 'Provider'],
//    ['name' => 'create-provider', 'module' => 'Provider'],
//    ['name' => 'update-provider', 'module' => 'Provider'],
//    ['name' => 'delete-provider', 'module' => 'Provider'],
//    ['name' => 'delete-any-provider', 'module' => 'Provider'],
//
//    ['name' => 'view-payment', 'module' => 'Payments'],
//    ['name' => 'view-any-payment', 'module' => 'Payments'],
//    ['name' => 'create-payment', 'module' => 'Payments'],
//    ['name' => 'update-payment', 'module' => 'Payments'],
//    ['name' => 'delete-payment', 'module' => 'Payments'],
//    ['name' => 'delete-any-payment', 'module' => 'Payments'],

//    $client = Role::findByName('client');
//    $client->givePermissionTo([
//    'view-dashboard',
//    ]);
//
//    $manager = Role::findByName('manager');
//    $manager->givePermissionTo([
//        'view-dashboard',
//        'view-any-dashboard',
//
//        'view-document',
//        'view-any-document',
//        'create-document',
//        'update-document',
//        'delete-document',
//        'delete-any-document'
//
//        'view-project',
//        'view-any-project',
//        'create-project',
//        'update-project',
//        'delete-project',
//        'delete-any-project',
//        ]);
//
//    $accountant = Role::findByName('accountant');
//    $accountant->givePermissionTo([
//    'view-dashboard',
//    'view-any-dashboard',
//
//    'view-document',
//    'view-any-document',
//    'create-document',
//    'update-document',
//    'delete-document',
//    'delete-any-document'
//
//    'view-project',
//    'view-any-project',
//    'create-project',
//    'update-project',
//    'delete-project',
//    'delete-any-project',
//
//    'view-payment',
//    'view-any-payment',
//    'create-payment',
//    'update-payment',
//    'delete-payment',
//    'delete-any-payment',
//    ]);
//
//    $developer = Role::findByName('developer');
//    $developer->givePermissionTo([
//    'view-dashboard',
//    'view-any-dashboard',
//
//    'view-project',
//    'view-any-project',
//    'create-project',
//    'update-project',
//    'delete-project',
//    'delete-any-project',
//    ]);
}
