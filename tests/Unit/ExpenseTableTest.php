<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Expense;
use Livewire\Livewire;
use App\Livewire\Expenses\ExpenseTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\Expense\ExpenseApproved;
use App\Mail\Expense\ExpenseRejected;

class ExpenseTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_approve_an_expense()
    {
        Mail::fake();

        $user = User::factory()->create();
        $this->actingAs($user);

        $expense = Expense::factory()->create(['status' => 'pending']);

        Livewire::test(ExpenseTable::class)
            ->call('approve', $expense->id);

        $this->assertEquals('approved', $expense->fresh()->status);

        Mail::assertSent(ExpenseApproved::class);
    }

    /** @test */
    public function it_can_reject_an_expense()
    {
        Mail::fake();

        $user = User::factory()->create();
        $this->actingAs($user);

        $expense = Expense::factory()->create(['status' => 'pending']);

        Livewire::test(ExpenseTable::class)
            ->call('reject', $expense->id);
 
        $this->assertEquals('rejected', $expense->fresh()->status);

        Mail::assertSent(ExpenseRejected::class);
    }

    /** @test */
    public function it_displays_expenses_for_admin()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $expense = Expense::factory()->create(['description' => 'Admin Expense', 'user_id' => $admin->id]);
        
        Livewire::test(ExpenseTable::class, ['expense' => $expense])
            ->assertSee('Admin Expense');
    }

    /** @test */
    public function it_displays_expenses_for_regular_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $expense = Expense::factory()->create(['description' => 'User Expense', 'user_id' => $user->id]);

        Livewire::test(ExpenseTable::class, ['expense' => $expense])
            ->assertSee('User Expense');
    }
}