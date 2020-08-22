<?php

namespace App\Http\Controllers;

use App\Services\CMCService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prstyocode\CMCWrapper\CMCWrapper;

class ListingController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {

    $cmc = new CMCWrapper(env('CMC_API_KEY'));

    $run = $cmc->getCryptocurrencyListingsLatest(['convert' => 'IDR']);

    return view('landing', ['listings' => $run->data]);
  }

  public function indexAPI()
  {

    $cmc = new CMCWrapper(env('CMC_API_KEY'));

    $run = $cmc->getCryptocurrencyListingsLatest(['convert' => 'IDR']);

    return response()->json($run, 200);
  }
}
