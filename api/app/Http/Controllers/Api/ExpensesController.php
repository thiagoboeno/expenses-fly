<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ExpensesStoreRequest;
use App\Http\Requests\Api\ExpensesUpdateRequest;
use App\Http\Resources\Api\ExpenseResource;
use App\Models\Expenses;
use App\Notifications\ExpenseCreated;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:isExpenseOwnerUser,expense')->only(['show', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        try {
            $expenses = Expenses::where('user_id', auth()->user()->id)->get();

            return ExpenseResource::collection($expenses);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show(Request $request, Expenses $expense)
    {
        try {
            return new ExpenseResource($expense);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(ExpensesStoreRequest $request)
    {
        try {
            $expense = Expenses::create([
                ...$request->all(),
                'user_id' => auth()->user()->id,
                'date' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
            ]);

            $request->user()->notify(new ExpenseCreated($expense));

            return response()->success('Expense successfully created!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(ExpensesUpdateRequest $request, Expenses $expense)
    {
        try {
            $expense->update([
                ...$request->all(),
                'date' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
            ]);

            return response()->success('Expense successfully updated!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Request $request, Expenses $expense)
    {
        try {
            $expense->delete();

            return response()->success('Expense successfully deleted!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
