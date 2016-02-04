<?php namespace Hamedmehryar\Laracancan\Commands;

/**
 *
 * @license MIT
 * @package Hamedmehryar\Laracancan
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class MigrationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laracancan:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration for creating Laracancan tables.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->laravel->view->addNamespace('laracancan', substr(__DIR__, 0, -8).'views');

        $rolesTable                 = 'lcc_roles';
        $roleUserTable              = 'lcc_role_user';
        $permissionsTable           = 'lcc_permissions';
        $resourcesTable             = 'lcc_resources';
        $resourceRelationsTable     = 'lcc_resourcerelations';
        $resourcePermissionTable    = 'lcc_resourcepermissions';
        $resourcePermissionRoleTable= 'lcc_resourcepermission_role';

        $this->line('');
        $this->info( "Tables: '$rolesTable', '$roleUserTable', '$permissionsTable', '$resourcesTable', '$resourceRelationsTable', '$resourcePermissionTable', '$resourcePermissionRoleTable'" );

        $message = "A migration that creates '$rolesTable', '$roleUserTable', '$permissionsTable', '$resourcesTable', '$resourceRelationsTable', '$resourcePermissionTable', '$resourcePermissionRoleTable'".
        " tables will be created in database/migrations directory";

        $this->comment($message);
        $this->line('');

        if ($this->confirm("Proceed with the migration creation? [Yes|no]", "Yes")) {

            $this->line('');

            $this->info("Creating migration...");
            if ($this->createMigration($rolesTable, $roleUserTable, $permissionsTable, $resourcesTable, $resourceRelationsTable, $resourcePermissionTable, $resourcePermissionRoleTable)) {

                $this->info("Migration successfully created!");
            } else {
                $this->error(
                    "Couldn't create migration.\n Check the write permissions".
                    " within the database/migrations directory."
                );
            }

            $this->line('');

        }
    }

    /**
     * Create the migration.
     *
     * @param $rolesTable
     * @param $roleUserTable
     * @param $permissionsTable
     * @param $resourcesTable
     * @param $resourceRelationsTable
     * @param $resourcePermissionTable
     * @param $resourcePermissionRoleTable
     * @return bool
     * @internal param string $name
     *
     */
    protected function createMigration($rolesTable, $roleUserTable, $permissionsTable, $resourcesTable, $resourceRelationsTable, $resourcePermissionTable, $resourcePermissionRoleTable)
    {
        $migrationFile = base_path("/database/migrations")."/".date('Y_m_d_His')."_create_laracancan_tables.php";

        $usersTable  = Config::get('auth.table');
        $userModel   = Config::get('auth.model');
        $userKeyName = (new $userModel())->getKeyName();

        $data = compact('rolesTable', 'roleUserTable', 'permissionsTable', 'resourcesTable', 'resourceRelationsTable', 'resourcePermissionTable', 'resourcePermissionRoleTable', 'usersTable', 'userKeyName');

        $output = $this->laravel->view->make('laracancan::generators.migration')->with($data)->render();

        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            return true;
        }

        return false;
    }
}
