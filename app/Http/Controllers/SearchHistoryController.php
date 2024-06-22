<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\Auth;

class SearchHistoryController extends Controller
{
    public function index()
    {
        $searchHistories = SearchHistory::where('user_id', Auth::id())->paginate(10);

        return view('search-history.index', ['searchHistories' => $searchHistories]);
    }
}
?>
