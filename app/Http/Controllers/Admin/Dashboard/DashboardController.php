<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Training;
use App\Models\Admin\TrainingParticipant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * Create a new controller instance.
   */
  public function __construct()
  {
    $this->active = 'dashboard';
    $this->route  = 'dashboard.dasbor';
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    $data['training'] = Training::all()->count();
    $data['user']  = TrainingParticipant::all()->count();
    $data['certificate']  = TrainingParticipant::where('certificate_code', '!=', '0')->count();

    $active = $this->active;
    $route  = $this->route;

    return view($this->route . '-index', compact('active', 'route', 'data'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
