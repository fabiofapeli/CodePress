<?php
namespace CodePress\CodeCategory\Testing;

use CodePress\CodeCategory\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCategoriesTest extends \TestCase
{
	
	use DatabaseTransactions;
	
    public function test_sample(){
        $this->visit('admin/categories')// Acessa página
        ->see('Categories'); // Verifica se teste passa
        //->see('Categoriesss'); //Verifica se teste não passa
    }

    public function test_categories_listing()
    {
        Category::create(['name'=>'Category 1','active'=>'true']);
        Category::create(['name'=>'Category 2','active'=>'true']);
        Category::create(['name'=>'Category 3','active'=>'true']);
        Category::create(['name'=>'Category 4','active'=>'true']);

        $this->visit('admin/categories')
            ->see('Category 1')
            ->see('Category 2')
            ->see('Category 3')
            ->see('Category 4');
    }
    
    public function test_create_new_category(){
       $this->visit('admin/categories/create')  
           ->type('Category Test','name')          
           ->check('active')
           ->press('Create Category')
           ->seePageIs('admin/categories')
           ->see('Category Test'); // Faz o teste passar
           //->see('Category Testher'); Faz o teste falhar
   }

    
    
}
