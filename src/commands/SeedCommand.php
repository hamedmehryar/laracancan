<?php namespace Hamedmehryar\Laracancan\Commands;

/**
 *
 * @license MIT
 * @package Hamedmehryar\Laracancan
 */

use Hamedmehryar\Laracancan\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SeederCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laracancan:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds the permissions table.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {

        $this->line('');
        $this->info( "Seeding Permissions Table");

        $this->line('');

        if(Permission::count() == 0){
            if ($this->confirm("Proceed with seeding? [Yes|no]", "Yes")) {

                $this->line('');

                $this->info("Seeding Permissions...");
                DB::table('lcc_permissions')->delete();
                Permission::create([
                    'name' => 'create',
                    'display_name' => 'Create',
                    'description' => 'Permission To Create An Object Of A Resource.'
                ]);
                Permission::create([
                    'name' => 'read',
                    'display_name' => 'Read',
                    'description' => 'Permission To View A Resource.'
                ]);
                Permission::create([
                    'name' => 'update',
                    'display_name' => 'Update',
                    'description' => 'Permission To Update An Object Of A Resource.'
                ]);
                Permission::create([
                    'name' => 'delete',
                    'display_name' => 'Delete',
                    'description' => 'Permission To Delete An Object Of A Resource.'
                ]);

                $this->line('');
                $this->info("Done");

            }
        }else{
            $this->error(
                "Table permissions is already filled with data."
            );
        }
    }
}
