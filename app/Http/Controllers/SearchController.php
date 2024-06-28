<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    function cari(Request $request)
    {
    if($request->get('query'))
    {
        $query = $request->get('query');
        $data = DB::table('barangs')
        ->where('nama_barang', 'LIKE', "%{$query}%")
        ->get();
        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
        $output .= '
        <li><a class="p-2" href="/produk/'.$row->id.'">'.$row->nama_barang.'</a></li>
        ';
        }
        $output .= '</ul>';
        echo $output;
    }
    }
}
