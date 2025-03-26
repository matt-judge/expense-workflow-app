<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Expense;
use Livewire\Livewire;
use App\Livewire\Expenses\Manage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_mounts_with_an_expense()
    {
        $expense = Expense::factory()->create();

        Livewire::test(Manage::class, ['expense' => $expense])
            ->assertSet('expense.id', $expense->id);
    }

    /** @test */
    public function it_dispatches_show_approval_modal_event()
    {
        $expense = Expense::factory()->create();

        Livewire::test(Manage::class, ['expense' => $expense])
            ->call('showApprovalModal')
            ->assertDispatched('showApprovalModal', $expense->id);
    }

    /** @test */
    public function it_dispatches_show_rejection_modal_event()
    {
        $expense = Expense::factory()->create();

        Livewire::test(Manage::class, ['expense' => $expense])
            ->call('showRejectionModal')
            ->assertDispatched('showRejectionModal', $expense->id);
    }

    /** @test */
    public function it_renders_the_manage_view()
    {
        $expense = Expense::factory()->create();

        Livewire::test(Manage::class, ['expense' => $expense])
            ->assertViewIs('livewire.expenses.manage');
    }
}