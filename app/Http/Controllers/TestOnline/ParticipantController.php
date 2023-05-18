<?php

namespace App\Http\Controllers\TestOnline;

use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ParticipantController extends Controller
{
    public function index($mode = 'all')
    {
        $data = [];

        $data['mode'] = $mode;

        return $this->view_page('pages.admin.participant.index', ['data' => $data]);
    }

    public function datatable(Request $request, $mode = 'all')
    {
        $status_interview = null;

        if($mode == 'interview') $status_interview = 0;
        if($mode == 'diterima') $status_interview = 1;
        if($mode == 'ditolak') $status_interview = 2;

        $user = User::whereStatusInterview($status_interview);

        return DataTables::of($user)
                ->addColumn('action', function($item) use ($mode){

                    if($mode == 'all'){
                        return '<a style="color: white;margin-left: 4px;" title="Move to Interview" href="'.route('participant.change', ['mode' => 'interview', Crypt::encrypt($item->id)]).'" class="btn btn-sm btn-primary">Move to Interview</a>';
                    }else if($mode == 'interview'){
                        return '<a style="color: white;margin-left: 4px;" title="Diterima" href="'.route('participant.change', ['mode' => 'diterima', Crypt::encrypt($item->id)]).'" class="btn btn-sm btn-success">Diterima</a>'.
                                '<a style="color: white;margin-left: 4px;" title="Diterima" href="'.route('participant.change', ['mode' => 'ditolak', Crypt::encrypt($item->id)]).'" class="btn btn-sm btn-danger">Ditolak</a>';
                    }else{
                        return '<span style="font-weight: 900; text-transform: uppercase; color: '. (@$item->status_interview == 1 ? 'green' : '') . (@$item->status_interview == 2 ? 'red' : '') .';">' . (@$item->status_interview == 1 ? 'Diterima' : '') . (@$item->status_interview == 2 ? 'Ditolak' : '') . '</span>';
                    }

                    
                })
                ->editColumn('gender', function($item){
                    if($item->gender == 'male' || $item->gender == 'Male' || $item->gender == 'laki-laki' || $item->gender == 'Laki-laki') return 'Laki-laki';

                    return 'Perempuan';
                })
                ->make(true);
    }

    public function change($mode = 'all', $id = '')
    {
        $decUserId = $this->decrypt($id, 'participant.index');

        $user = User::whereId($decUserId)->first();

        if(!$user) return redirect()->route('participant.index');

        $status_interview = null;

        if($mode == 'interview') $status_interview = 0;
        if($mode == 'diterima') $status_interview = 1;
        if($mode == 'ditolak') $status_interview = 2;

        $user->update(['status_interview' => $status_interview]);

        return redirect()->route('participant.index', ['mode' => $mode]);
    }
}
