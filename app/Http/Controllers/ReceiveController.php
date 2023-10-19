<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceiveRequest;
use App\Http\Requests\UpdateReceiveRequest;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Student;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class ReceiveController extends Controller
{

    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()) {
            return response()->json($this->transactionService->listReceivableToDataTable($request->get('from'), $request->get('to')));
        }

        $resume = $this->transactionService->listResumeReceivableTransactions($request->get('from'), $request->get('to'));
        

        return view('receive.index', compact('resume'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $transaction = new Transaction();
        $payments = PaymentMethod::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');
        $students = Student::with('user')->get()->pluck('user.name', 'id');

        if(request()->ajax()) {
            return view('receive.form-modal', compact('transaction', 'payments', 'categories', 'students'))->render();
        }

        return view('receive.create', compact('transaction', 'payments', 'categories', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceiveRequest $request)
    {
        $data = $request->except('_token');

        $this->transactionService->createTransaction($data);

        return redirect()->route('receive.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = $this->transactionService->find($id);

        return view('receive.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = $this->transactionService->find($id);
        $payments = PaymentMethod::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');
        $students = Student::with('user')->get()->pluck('user.name', 'id');


        if(request()->ajax()) {
            return view('receive.form-modal', compact('transaction', 'payments', 'categories', 'students'))->render();
        }

        return view('receive.edit', compact('transaction', 'payments', 'categories', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceiveRequest $request, $id)
    {
        $transaction = $this->transactionService->find($id);
        $data = $request->except(['_method', '_token']);

        $this->transactionService->updateTransaction($transaction, $data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = $this->transactionService->find($id);
        $transaction->delete();
        return redirect()->route('receive.index');
    }

    public function pay($id) {
        $transaction = $this->transactionService->find($id);
        $payments = PaymentMethod::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');

        return view('receive.receive', compact('transaction', 'payments', 'categories'))->render();
    }




    public function receive(Request $request) {
        // dd($request->all());

        $data = $request->except('_method', '_token');
        

        if(!empty($data['data'])) {
            return Transaction::whereIn('id', $data['data'])->where('status', 0)->update(['status' => 1, 'pay_date' => now()]);
        }

        $transaction = $this->transactionService->find($data['id']);

        $data['value'] = currency($data['value'], true);
        $transaction->fill($data)->update(['status' => 1, 'pay_date' => now()]);

        return redirect()->back();
    }

    public function delete(Request $request) {
        // dd($request->all());

        $data = $request->get('data');

        return Transaction::whereIn('id', $data)->delete();
    }
}
