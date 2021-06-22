<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function cursos(Request $request)
    {
        $term = $request->get('term');

        $querys = Curso::where('descripcion', 'LIKE', '%' . $term . '%')->get();

        $data = [];
        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->descripcion
            ];
        }

        return $data;
    }
}
