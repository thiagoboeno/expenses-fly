<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ExpensesStoreRequest;
use App\Http\Requests\Api\ExpensesUpdateRequest;
use App\Http\Resources\Api\ExpenseResource;
use App\Models\Expenses;
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
        $expenses = Expenses::where('user_id', auth()->user()->id)->get();

        return ExpenseResource::collection($expenses);
    }

    public function show(Request $request, Expenses $expense)
    {
        return new ExpenseResource($expense);
    }

    public function store(ExpensesStoreRequest $request)
    {
        Expenses::create([
            ...$request->all(),
            'user_id' => auth()->user()->id,
            'date' => Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d'),
        ]);

        return response()->success('Expense successfully created!');
    }

    public function update(ExpensesUpdateRequest $request, Expenses $expense)
    {
        $expense->update([
            ...$request->all(),
            'date' => Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d'),
        ]);

        return response()->success('Expense successfully updated!');
    }

    public function destroy(Request $request, Expenses $expense)
    {
        $expense->delete();

        return response()->success('Expense successfully deleted!');
    }
}
