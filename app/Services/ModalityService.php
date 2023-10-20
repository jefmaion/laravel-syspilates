<?php


namespace App\Services;

use App\Models\Modality;
use Exception;
use Illuminate\Support\Facades\Session;

class ModalityService {

    public function createModality($data) {
        if(!$modality = Modality::create($data)) {
            throw new Exception('Não foi possível cadastrar a modalidade');
        }

        Session::flash('success', 'Modalidade cadastrada com sucesso!');
        return $modality;
    }

    public function updateModality(Modality $modality, $data) {

        if(!$modality->fill($data)->save()) {
            throw new Exception('Não foi possível atualizar a modalidade');
        }

        Session::flash('success', 'Modalidade atualizada com sucesso!');
        return $modality;
    }

    public function deleteModality(Modality $modality) {
        $modality->delete();
        Session::flash('success', 'Modalidade excluída com sucesso!');
        return true;
    }

    public function listToSelectBox() {
        return Modality::get()->sortBy('nameWithNick')->pluck('nameWithNick', 'id');
    }

    public function listToDataTable() {
        $modalities = Modality::all();

        $response = [];

        foreach($modalities as $modality) {

          

            $response[] = [
                'name' => '<a href="'.route('modality.show', $modality).'">'.$modality->name.'</a>' ,
                'created_at' => $modality->created_at->format('d/m/Y H:i:s')
            ];
        }

        return ['data' => $response];
    }

}