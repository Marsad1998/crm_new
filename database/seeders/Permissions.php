<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;

class Permissions extends Seeder
{
    public function run(): void
    {
        Activity::where('id', '>', 0)->delete();
        Permission::where('id', '>', 0)->delete();

        Permission::create(['name' => 'View Dashboard', 'guard_name' => 'web', 'model_name' => 'Dashboard']);

        Permission::create(['name' => 'View Staff', 'guard_name' => 'web', 'model_name' => 'Staff']);
        Permission::create(['name' => 'Add Staff', 'guard_name' => 'web', 'model_name' => 'Staff']);
        Permission::create(['name' => 'Edit Staff', 'guard_name' => 'web', 'model_name' => 'Staff']);
        Permission::create(['name' => 'Delete Staff', 'guard_name' => 'web', 'model_name' => 'Staff']);

        Permission::create(['name' => 'View Role', 'guard_name' => 'web', 'model_name' => 'Role']);
        Permission::create(['name' => 'Add Role', 'guard_name' => 'web', 'model_name' => 'Role']);
        Permission::create(['name' => 'Edit Role', 'guard_name' => 'web', 'model_name' => 'Role']);
        Permission::create(['name' => 'Delete Role', 'guard_name' => 'web', 'model_name' => 'Role']);

        Permission::create(['name' => 'Add Permission', 'guard_name' => 'web', 'model_name' => 'Permission']);
        Permission::create(['name' => 'View Permission', 'guard_name' => 'web', 'model_name' => 'Permission']);
        Permission::create(['name' => 'Edit Permission', 'guard_name' => 'web', 'model_name' => 'Permission']);
        Permission::create(['name' => 'Logs Permission', 'guard_name' => 'web', 'model_name' => 'Permission']);

        Permission::create(['name' => 'Add Services', 'guard_name' => 'web', 'model_name' => 'Services']);
        Permission::create(['name' => 'View Services', 'guard_name' => 'web', 'model_name' => 'Services']);
        Permission::create(['name' => 'Edit Services', 'guard_name' => 'web', 'model_name' => 'Services']);
        Permission::create(['name' => 'Delete Services', 'guard_name' => 'web', 'model_name' => 'Services']);

        Permission::create(['name' => 'View Make n Model', 'guard_name' => 'web', 'model_name' => 'Makes & Models']);
        Permission::create(['name' => 'Add Makes', 'guard_name' => 'web', 'model_name' => 'Makes & Models']);
        Permission::create(['name' => 'Edit Makes', 'guard_name' => 'web', 'model_name' => 'Makes & Models']);
        Permission::create(['name' => 'Add Models', 'guard_name' => 'web', 'model_name' => 'Makes & Models']);
        Permission::create(['name' => 'Edit Models', 'guard_name' => 'web', 'model_name' => 'Makes & Models']);

        Permission::create(['name' => 'Add Category', 'guard_name' => 'web', 'model_name' => 'Category']);
        Permission::create(['name' => 'View Category', 'guard_name' => 'web', 'model_name' => 'Category']);
        Permission::create(['name' => 'Edit Category', 'guard_name' => 'web', 'model_name' => 'Category']);
        Permission::create(['name' => 'Delete Category', 'guard_name' => 'web', 'model_name' => 'Category']);

        Permission::create(['name' => 'Add Option', 'guard_name' => 'web', 'model_name' => 'Options']);
        Permission::create(['name' => 'View Option', 'guard_name' => 'web', 'model_name' => 'Options']);
        Permission::create(['name' => 'Edit Option', 'guard_name' => 'web', 'model_name' => 'Options']);
        Permission::create(['name' => 'Delete Option', 'guard_name' => 'web', 'model_name' => 'Options']);

        Permission::create(['name' => 'Add Option Value', 'guard_name' => 'web', 'model_name' => 'Option Values']);
        Permission::create(['name' => 'View Option Value', 'guard_name' => 'web', 'model_name' => 'Option Values']);
        Permission::create(['name' => 'Edit Option Value', 'guard_name' => 'web', 'model_name' => 'Option Values']);
        Permission::create(['name' => 'Delete Option Value', 'guard_name' => 'web', 'model_name' => 'Option Values']);
    }
}
