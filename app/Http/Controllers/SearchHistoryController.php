<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\Auth;

class SearchHistoryController extends Controller
{
    public function index()
    {
        $searchHistories = auth()->user()->searchHistories()->orderBy('search_time', 'desc')->paginate(10);
        return view('search-history.index', compact('searchHistories'));
    }
}
?>
