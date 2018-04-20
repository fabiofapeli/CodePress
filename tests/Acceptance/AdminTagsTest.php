<?php
namespace CodePress\CodeTag\Testing;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use CodePress\CodeTag\Models\Tag;

class AdminTagsTest extends \TestCase
{
    
 use DatabaseTransactions;	
 
   public function test_can_visit_admin_categories_page()
   {
       $this->visit('admin/tags')// Acessa página
       ->see('Tags'); // Verifica se teste passa
       //->see('Categoriesss'); //Verifica se teste não passa
   }

    public function test_tags_listing()
   {
       Tag::create(['name'=>'Tag 1','active'=>'true']);
       Tag::create(['name'=>'Tag 2','active'=>'true']);
       Tag::create(['name'=>'Tag 3','active'=>'true']);
       Tag::create(['name'=>'Tag 4','active'=>'true']);
 
       $this->visit('admin/tags')
       ->see('Tag 1')
       ->see('Tag 2')
       ->see('Tag 3')
       ->see('Tag 4');
   }
   
   public function test_create_new_tag(){
       $this->visit('admin/tags/create')  
           ->type('Tag Test','name')          
           ->press('Create Tag')
           ->seePageIs('admin/tags')
           ->see('Tag Test'); // Faz o teste passar
           //->see('Category Testher'); Faz o teste falhar
   }

}
