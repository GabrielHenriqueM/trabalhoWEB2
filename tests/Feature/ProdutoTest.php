<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Produto;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProdutoTest extends TestCase
{
    use RefreshDatabase; 

    /**
     
     */
    private function loginAsAdmin()
    {
        $user = User::factory()->create([
            'email' => 'usera@example.com',
        ]);

        $adminRole = Role::create(['name' => 'Administrator']);
        $user->assignRole($adminRole);

        $permissions = ['product-list', 'product-create', 'product-edit', 'product-delete'];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole->syncPermissions($permissions); 

        $this->actingAs($user); 
    }

    /**
    
     */
    private function loginAsManager()
    {
        $user = User::factory()->create([
            'email' => 'userb@example.com',
        ]);

        $managerRole = Role::create(['name' => 'Manager']);
        $user->assignRole($managerRole);

        $permissions = ['product-list', 'product-create']; 
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $managerRole->syncPermissions($permissions); 

        $this->actingAs($user); 
    }

    /**
   
     */
    private function createProduct()
    {
        return Produto::create([
            'nome' => 'Produto A',
            'preco' => 100.00,
            'quantidade' => 10,
            'marca' => 'Marca A',
            'modelo' => 'Modelo A',
            'processador' => 'Intel i7',
            'ram' => '16GB',
            'armazenamento' => '512GB SSD',
            'tela' => '15.6"',
            'sistema' => 'Windows 10',
        ]);
    }

    /**
     *
     */
    public function test_acesso_nao_logado()
    {
        
        $response = $this->get(route('produtos.index'));
        $response->assertStatus(302); 
        $response->assertRedirect(route('login')); 
    }

    /**
    
     */
    public function test_admin_can_access_product_list()
    {
        $this->loginAsAdmin();
        $product = $this->createProduct();

        $response = $this->get(route('produtos.index'));

        $response->assertStatus(200); 
        $response->assertSeeText($product->nome); 
    }

    /**
      
     */
    public function test_manager_can_access_product_list()
    {
        $this->loginAsManager();
        $product = $this->createProduct();

        $response = $this->get(route('produtos.index'));

        $response->assertStatus(200); 
        $response->assertSeeText($product->nome); 
    }

    /**
     *
     */
    public function test_admin_can_create_product()
    {
        $this->loginAsAdmin();

        $productData = [
            'nome' => 'Produto Teste',
            'preco' => 150.00,
            'quantidade' => 5,
            'marca' => 'Marca Teste',
            'modelo' => 'Modelo Teste',
            'processador' => 'Intel i5',
            'ram' => '8GB',
            'armazenamento' => '256GB SSD',
            'tela' => '14"',
            'sistema' => 'Windows 11',
        ];

        $response = $this->post(route('produtos.store'), $productData);

        $response->assertRedirect(route('produtos.create')); 
        $this->assertDatabaseHas('produtos', $productData); 
    }

    /**
     
     */
    public function test_manager_can_create_product()
    {
        $this->loginAsManager();

        $productData = [
            'nome' => 'Produto Gerente Teste',
            'preco' => 200.00,
            'quantidade' => 8,
            'marca' => 'Marca Gerente',
            'modelo' => 'Modelo Gerente',
            'processador' => 'AMD Ryzen',
            'ram' => '16GB',
            'armazenamento' => '1TB SSD',
            'tela' => '13.3"',
            'sistema' => 'Linux',
        ];

        $response = $this->post(route('produtos.store'), $productData);

        $response->assertRedirect(route('produtos.create')); 
        $this->assertDatabaseHas('produtos', $productData); 
    }

    /**
     
     */
    public function test_admin_can_update_product()
    {
        $this->loginAsAdmin();
        $product = $this->createProduct();

        $updatedData = [
            'nome' => 'Produto Atualizado',
            'preco' => 180.00,
            'quantidade' => 15,
            'marca' => 'Marca Atualizada',
            'modelo' => 'Modelo Atualizado',
            'processador' => 'Intel i9',
            'ram' => '32GB',
            'armazenamento' => '1TB SSD',
            'tela' => '17"',
            'sistema' => 'Windows 11',
        ];

        $response = $this->put(route('produtos.update', $product->id), $updatedData);

        $response->assertRedirect(route('produtos.index')); 
        $this->assertDatabaseHas('produtos', $updatedData); 
    }

    /**
    
     */
    public function test_manager_cannot_update_product()
    {
        $this->loginAsManager();
        $product = $this->createProduct();

        $updatedData = [
            'nome' => 'Produto Atualizado pelo Gerente',
            'preco' => 200.00,
            'quantidade' => 20,
            'marca' => 'Marca Atualizada',
            'modelo' => 'Modelo Atualizado',
            'processador' => 'Intel i9',
            'ram' => '32GB',
            'armazenamento' => '1TB SSD',
            'tela' => '17"',
            'sistema' => 'Windows 11',
        ];

        $response = $this->put(route('produtos.update', $product->id), $updatedData);

        $response->assertStatus(403); 
    }

    /**
     
     */
    public function test_admin_can_delete_product()
    {
        $this->loginAsAdmin();
        $product = $this->createProduct();

        $response = $this->delete(route('produtos.destroy', $product->id));

        $response->assertRedirect(route('produtos.index'));
        $this->assertDatabaseMissing('produtos', ['id' => $product->id]); 
    }

    /**
    
     */
    public function test_manager_cannot_delete_product()
    {
        $this->loginAsManager();
        $product = $this->createProduct();

        $response = $this->delete(route('produtos.destroy', $product->id));

        $response->assertStatus(403); 
    }
}