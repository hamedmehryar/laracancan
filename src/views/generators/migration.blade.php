<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLaracancanTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('{{ $rolesTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('{{ $roleUserTable }}', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('{{ $userKeyName }}')->on('{{ $usersTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('{{ $rolesTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('{{ $permissionsTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for storing resources
        Schema::create('{{ $resourcesTable }}', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
        $table->string('name');
        $table->string('display_name_en');
        $table->string('display_name_pa');
        $table->string('display_name_pr');
        $table->string('table_name');
        $table->string('model_name');
        $table->string('icon_class')->nullable();
        $table->integer('in_sidemenu')->nullable();
        });

        // Create table for associating resources to each other (Many-to-Many)
        Schema::create('{{ $resourceRelationsTable }}', function (Blueprint $table) {
            $table->integer('resource_id');
            $table->integer('child_id');
            $table->string('pivot')->nullable();

            $table->foreign('resource_id')->references('id')->on('{{$resourcesTable}}')
                ->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('{{$resourcesTable}}')
                ->onDelete('cascade');
        });

        // Create table for associating permissions to resources (Many-to-Many)
        Schema::create('{{ $resourcePermissionTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned()->nullable();
            $table->integer('resource_id')->unsigned()->nullable();
            $table->integer('parent_id')->nullable();

            $table->foreign('permission_id')->references('id')->on('{{$permissionsTable}}');
            $table->foreign('resource_id')->references('id')->on('{{$resourcesTable}}');
        });

        // Create table for assiciating resource-permissions to roles
        Schema::create('{{ $resourcePermissionRoleTable }}', function (Blueprint $table) {
            $table->integer('resourcepermission_id')->unsigned()->nullable();
            $table->foreign('resourcepermission_id')->references('id')->on('{{$resourcePermissionTable}}')
            ->onDelete('cascade');

            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign('role_id')->references('id')->on('{{$rolesTable}}');

            $table->integer('parent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('{{ $resourcePermissionRoleTable }}');
        Schema::drop('{{ $resourcePermissionTable }}');
        Schema::drop('{{ $resourceRelationsTable }}');
        Schema::drop('{{ $resourcesTable }}');
        Schema::drop('{{ $permissionsTable }}');
        Schema::drop('{{ $roleUserTable }}');
        Schema::drop('{{ $rolesTable }}');
    }
}
