<?php

namespace app\AdminPanel\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Support\Facades\Response;

class EventsController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			switch ($request->query('action')) {
				case 'delete_item':
					Events::destroy($request->query('id'));
					return Response::json(['success' => true]);
					break;
				default:
					return Response::json(['success' => false, 'error' => 'empty action']);
					break;
			}
		} else {
			return view('ap.events.index', ['events' => Events::all()]);
		}
	}
}