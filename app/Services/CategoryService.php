<?php


namespace App\Services;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Session;

class CategoryService {

    public function createCategory($data) {
        if(!$category = Category::create($data)) {
            throw new Exception('Não foi possível cadastrar a categoria');
        }

        Session::flash('success', 'Categoria cadastrada com sucesso!');
        return $category;
    }

    public function updateCategory(Category $category, $data) {

        if(!$category->fill($data)->save()) {
            throw new Exception('Não foi possível atualizar a categoria');
        }

        Session::flash('success', 'Categoria atualizada com sucesso!');
        return $category;
    }

    public function deleteCategory(Category $category) {
        $category->delete();
        Session::flash('success', 'Categoria excluída com sucesso!');
        return true;
    }

    public function listToDataTable() {
        $modalities = Category::all();

        $response = [];

        foreach($modalities as $category) {

          

            $response[] = [
                'name' => '<a href="'.route('category.show', $category).'">'.$category->name.'</a>' ,
                'created_at' => $category->created_at->format('d/m/Y H:i:s')
            ];
        }

        return ['data' => $response];
    }

}