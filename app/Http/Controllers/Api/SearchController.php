<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client([
            'base_uri' => 'https://www.themealdb.com/api/',
            'timeout'  => 4.0,
        ]);

        $response = $client->request('GET', 'json/v1/1/search.php?s='.$request->search);
        $complete = json_decode($response->getBody()->getContents());

        if($complete->meals == null)
        {
            $results = null;
            $warning = "No results found...";
        }else
        {
            $results = $this->paginate($complete->meals, 6, request('page'),
            ['path' => 'search?_token=0Sk8biqg01xgho501HatJ8GQXvyKbb2vKFILdcNZ&search='.$request->search]);
            $warning = null;
        }

        return view('welcome', compact('results', 'warning'));
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}
