<?php


namespace App\Services;

use App\Models\Exercice;
use Exception;
use Illuminate\Support\Facades\Session;

class ExerciceService {

    public function createExercice($data) {
        if(!$exercice = Exercice::create($data)) {
            throw new Exception('Não foi possível cadastrar a modalidade');
        }

        Session::flash('success', 'Modalidade cadastrada com sucesso!');
        return $exercice;
    }

    public function updateExercice(Exercice $exercice, $data) {

        if(!$exercice->fill($data)->save()) {
            throw new Exception('Não foi possível atualizar a modalidade');
        }

        Session::flash('success', 'Modalidade atualizada com sucesso!');
        return $exercice;
    }

    public function deleteExercice(Exercice $exercice) {
        $exercice->delete();
        Session::flash('success', 'Modalidade excluída com sucesso!');
        return true;
    }

    public function listToDataTable() {
        $modalities = Exercice::all();

        $response = [];

        foreach($modalities as $exercice) {

          

            $response[] = [
                'name' => '<a href="'.route('exercice.show', $exercice).'">'.$exercice->name.'</a>' ,
                'created_at' => $exercice->created_at->format('d/m/Y H:i:s'),
                'description' => $exercice->description
            ];
        }

        return ['data' => $response];
    }

}