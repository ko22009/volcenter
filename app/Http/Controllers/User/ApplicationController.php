<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Http\Requests;
use App\Models\Event;
use Illuminate\Http\Request;
use Response;
use Validator;

class ApplicationController extends Controller
{

    private $upgradeableUserFields = ['status_id'];

    public function index(Event $event)
    {
        $event->load('getRespon.getResponsibility');
        return view('admin_panel.events.applications',['event'=>$event]);
    }

    public function initial_application(Event $event, Request $req)
    {
        $data = $req->all();

        $application = Application::where('responsibility_event_id', $data['responsibility_event_id'])->last();
        /*if ($application) {
           $application->getStatus
        }*/
        /*
        if ($val->fails()) {
            return Response::json(['success' => false, 'error' => $val->errors()->all()]);
        }*/
        Application::create([
            'user_id' => $data['user_id'], 'responsibility_event_id' => $data['responsibility_event_id'], 'status_id' => $data['status_id']
        ]);
        return Response::json(['success' => true]);
        //return view('user_panel.events.applications.index');
    }

    public function update(Application $id, Request $request)
    {
        if (is_null($id)) {
            return ['success' => false, 'error' => 'user not found'];
        }
        // todo запилить разрешения
        $val = Validator::make($request->all(), [
            'status_id' => 'exists:statuses,id'
        ]);
        if ($val->fails()) {
            return Response::json(['success' => false, 'error' => $val->errors()->all()]);
        }
        $updated = [];
        foreach ($request->all() as $key => $value) {
            if (in_array($key, $this->upgradeableUserFields)) {
                try {
                    $id->{$key} = $value;
                    $id->save();
                } finally {
                    $updated[] = $key;
                }
            }
        }
        return ['success' => count($updated) != 0, 'fields' => $updated];
    }

    public function delete(Application $id)
    {
        if (is_null($id)) {
            return Response::json(['success' => false, 'error' => 'application not found']);
        }
        $id->delete();
        return Response::json(['success' => true]);
    }
}