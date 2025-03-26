<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Livewire\Livewire;
use App\Livewire\Expenses\ExpenseForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\Expense\ExpenseSubmitted;

class ExpenseFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_submit_an_expense()
    {
        Mail::fake();

        $user = User::factory()->create();
        $category = ExpenseCategory::factory()->create();
        $this->actingAs($user);

        Livewire::test(ExpenseForm::class)
            ->set('description', 'Test Expense')
            ->set('category_id', $category->id)
            ->set('amount', 100)
            ->set('receipt_image', \Illuminate\Http\UploadedFile::fake()->image('receipt.jpg'))
            ->call('submit')
            ->assertSessionHas('message', 'Expense submitted successfully.');

        $this->assertDatabaseHas('expenses', [
            'description' => 'Test Expense',
            'category_id' => $category->id,
            'amount' => 100,
            'user_id' => $user->id,
        ]);

        Mail::assertSent(ExpenseSubmitted::class);
    }

    /** @test */
    public function it_requires_a_description()
    {
        $user = User::factory()->create();
        $category = ExpenseCategory::factory()->create();
        $this->actingAs($user);

        Livewire::test(ExpenseForm::class)
            ->set('category_id', $category->id)
            ->set('amount', 100)
            ->set('receipt_image', \Illuminate\Http\UploadedFile::fake()->image('receipt.jpg'))
            ->call('submit')
            ->assertHasErrors(['description' => 'required']);
    }

    /** @test */
    public function it_requires_a_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(ExpenseForm::class)
            ->set('description', 'Test Expense')
            ->set('amount', 100)
            ->set('receipt_image', \Illuminate\Http\UploadedFile::fake()->image('receipt.jpg'))
            ->call('submit')
            ->assertHasErrors(['category_id' => 'required']);
    }

    /** @test */
    public function it_requires_an_amount()
    {
        $user = User::factory()->create();
        $category = ExpenseCategory::factory()->create();
        $this->actingAs($user);

        Livewire::test(ExpenseForm::class)
            ->set('description', 'Test Expense')
            ->set('category_id', $category->id)
            ->set('receipt_image', \Illuminate\Http\UploadedFile::fake()->image('receipt.jpg'))
            ->call('submit')
            ->assertHasErrors(['amount' => 'required']);
    }

    /** @test */
    public function it_requires_a_receipt_image()
    {
        $user = User::factory()->create();
        $category = ExpenseCategory::factory()->create();
        $this->actingAs($user);

        Livewire::test(ExpenseForm::class)
            ->set('description', 'Test Expense')
            ->set('category_id', $category->id)
            ->set('amount', 100)
            ->call('submit')
            ->assertHasErrors(['receipt_image' => 'required']);
    }

    /** @test */
    public function it_requires_authentication_to_submit_an_expense()
    {
        $category = ExpenseCategory::factory()->create();

        Livewire::test(ExpenseForm::class)
            ->set('description', 'Test Expense')
            ->set('category_id', $category->id)
            ->set('amount', 100)
            ->set('receipt_image', \Illuminate\Http\UploadedFile::fake()->image('receipt.jpg'))
            ->call('submit')
            ->assertForbidden();
    }

    /** @test */
    public function it_redirects_unauthenticated_users_to_login()
    {
        $response = $this->get(route('expenses.create'));

        $response->assertRedirect(route('login'));
    }
}