<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product; 

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        $results = product::where('name', 'LIKE', '%' . $query . '%')->get(); 
        return response()->json($results);
    }
}
