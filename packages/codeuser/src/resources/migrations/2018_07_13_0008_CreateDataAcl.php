<?php 

use CodePress\CodeUser\Models\Permission;
use CodePress\CodeUser\Models\Role;
use Illuminate\Database\Migrations\Migration;

class CreateDataAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = Role::create([
            'name' => Role::ROLE_ADMIN
        ]);

        $roleEditor = Role::create([
            'name' => Role::ROLE_EDITOR
        ]);

        $roleRedator = Role::create([
            'name' => Role::ROLE_REDATOR
        ]);

        $permissionPublishPost = Permission::create([
           'name' => 'publish_post',
            'description' => 'Permissão para publicação posts que estão em rascunho'
        ]);

        $permissionAccessCategories = Permission::create([
           'name' => 'access_categories',
            'description' => 'Permissão para acesso a área de categorias'
        ]);

        $permissionAccessTags = Permission::create([
           'name' => 'access_tags',
            'description' => 'Permissão para acesso a área de tags'
        ]);

        $permissionAccessPosts = Permission::create([
            'name' => 'access_posts',
            'description' => 'Permissão para acesso a área de posts'
        ]);

        //access_users também valerá para as permissões de roles
        $permissionAcessUsers = Permission::create([
           'name' => 'access_users',
            'description' => 'Permissão para acesso a área de usuários'
        ]);
        
        $roleEditor->permissions()->save($permissionPublishPost);
        $roleEditor->permissions()->save($permissionAccessPosts);
        $roleRedator->permissions()->save($permissionAccessPosts);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}