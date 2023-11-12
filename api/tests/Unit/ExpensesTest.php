<?php

namespace Tests\Unit;

use App\Models\Expenses;
use App\Models\Users;
use Tests\TestCase;

class ExpensesTest extends TestCase
{
    public function testCreateExpenseWithMiddleware()
    {
        $userFactory = Users::factory(1)->create()[0];
        $data = [
            'user_id' => $userFactory->id,
            'description' => 'Testando',
            'date' => '01/01/2022',
            'value' => 10.20,
        ];

        $response = $this->json('POST', '/api/expenses', $data);
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
    }

    public function testCreateExpense()
    {
        $userFactory = Users::factory(1)->create()[0];
        $data = [
            'user_id' => $userFactory->id,
            'description' => 'Testando',
            'date' => '01/01/2022',
            'value' => 10.20,
        ];


        $response = $this->actingAs($userFactory)->json('POST', '/api/expenses', $data);
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => "Expense successfully created!"]);
    }

    public function testGettingAllExpenses()
    {
        $expenseFactory = Expenses::factory(1)->create()[0];
        $response = $this->actingAs($expenseFactory->user)->json('GET', '/api/expenses');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'data' => [
                    '*' => [
                        'id',
                        'user',
                        'description',
                        'value',
                        'date',
                    ]
                ]
            ]
        );
    }

    public function testUpdateProduct()
    {
        $expenseFactory = Expenses::factory(1)->create()[0];
        $response = $this->actingAs($expenseFactory->user)->json('GET', '/api/expenses');
        $response->assertStatus(200);

        $expense = $response->getData()->data[0];

        $data = [
            'description' => 'Testando Teste',
            'date' => '01/01/2023',
            'value' => 15.20,
        ];

        $update = $this->actingAs($expenseFactory->user)->json('PUT', '/api/expenses/'. $expense->id, $data);
        $update->assertStatus(200);
        $update->assertJson(['success' => true, 'message' => "Expense successfully updated!"]);
    }

    public function testDeleteProduct()
    {
        $expenseFactory = Expenses::factory(1)->create()[0];
        $response = $this->actingAs($expenseFactory->user)->json('GET', '/api/expenses');
        $response->assertStatus(200);

        $expense = $response->getData()->data[0];

        $delete = $this->actingAs($expenseFactory->user)->json('DELETE', '/api/expenses/'.$expense->id);
        $delete->assertStatus(200);
        $delete->assertJson(['success' => true, 'message' => "Expense successfully deleted!"]);
    }
}
