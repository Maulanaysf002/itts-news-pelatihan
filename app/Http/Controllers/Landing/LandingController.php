<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Admin\Training;
use Illuminate\Http\Request;

class LandingController extends Controller
{


  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $training['unfinish'] = Training::Unfinish()->get();
    $training['finish'] = Training::Finish()->get();

    return view('home.index', compact('training'));
  }

  /**
   * Display artikel resource.
   */
  public function artikel()
  {
    return view('home.news');
  }
}
