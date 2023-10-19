<?php


namespace App\Services;

use App\Models\Transaction;
use App\View\Components\TransactionStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransactionService {

    public function find($id) {
        return Transaction::with('category')->with('method')->find($id);
    }

    public function createTransaction($data) {

        if(!$transaction = Transaction::create($data)) {
            throw new Exception('Não foi possível adicionar o lançamento');
        }

        if(isset($data['repeat'])) {
            for($i=1; $i<=$data['repeat']; $i++) {
                $data['date'] = date('Y-m-d', strtotime($data['date'] . ' + '.$data['period']));
                Transaction::create($data);
            }
        }

        Session::flash('success', 'Lançamento cadastrado com sucesso!');
        return $transaction;

    }

    public function updateTransaction(Transaction $transaction, $data) {
        if(!$transaction->fill($data)->save()) {
            throw new Exception('Não foi possível editar o lançamento');
        }

        Session::flash('success', 'Lançamento editado com sucesso!');
        return $transaction;
    }

    public function listResumeReceivableTransactions($dateFrom=null, $dateTo=null) {

        $dateFrom     = Carbon::parse($dateFrom ?? date('Y-m-01'));
        $dateTo       = Carbon::parse($dateTo ?? date('Y-m-t'));
        $transactions = Transaction::where('type', 'R');

        

        $data = $transactions
                ->selectRaw("SUM(CASE WHEN status = 1 THEN value ELSE 0 END) as received")
                ->selectRaw("SUM(CASE WHEN status = 0 THEN value ELSE 0 END) as to_receive")
                ->selectRaw("SUM(CASE WHEN status = 0  AND date < '".date('Y-m-d')."' THEN value ELSE 0 END) as late")
                ->selectRaw("SUM(CASE WHEN status = 0 AND date = '".date('Y-m-d')."' THEN value ELSE 0 END) as pay_today")
                ->selectRaw("SUM(value) as total")
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->first();

                
        return $data;
    }


    public function listReceivableToDataTable($from=null, $to=null) {
        return $this->listToDatatable('R', $from, $to);
    }

    public function listPayableToDataTable($from=null, $to=null) {
        return $this->listToDatatable('R', $from, $to);
    }

    public function listToDatatable($type='R', $from=null, $to=null) {

        $from = Carbon::parse($from);
        $to = Carbon::parse($to);

        $transactions = Transaction::with('category')
                                ->with('method')
                                ->where('type', $type)
                                ->whereBetween('date', [$from, $to])
                                ->orderBy('date')
                                ->get();

        return $this->dataToJson($transactions);

    }

    private function dataToJson($data) {
        $response     = [];

        foreach($data as $transaction) {

            $check = '<div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="transaction-'.$transaction->id.'" name="transactions[]" value="'.$transaction->id.'">
                        <label for="transaction-'.$transaction->id.'" class="custom-control-label"></label>
                    </div>';

                    

            $status = view('components.transaction-status', [
                            'attributes' => ['status' => $transaction->statusCode],
                            'slot' => $transaction->statusDescription]
                        )->render();

                        // $status = $transaction->statusDescription;

            $response[] = [
                'check' =>  $check,
                'date' => $transaction->date->format('d/m/Y'),
                'pay_date' => ($transaction->pay_date) ? $transaction->pay_date->format('d/m/Y') : '-',
                'description'       => '<a href="'.route('receive.show', $transaction).'">'.$transaction->description.'</a>' ,
                'value' => currency($transaction->value),
                'status' => $status,
                'category' =>  $transaction->category->name,
                'method' => $transaction->method->name ?? null,
                'actions' => '
                            <a href="#" class="btn bg-'.theme().' btn-xs receive" onclick="receive('.$transaction->id.')">
                                <i class="fas fa-dollar-sign    "></i> Receber
                            </a>

                         

                            '            
            ];
        }

        return ['data' => $response];
    }

    

}