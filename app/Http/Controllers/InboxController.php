<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use DB;
use Auth;
use Carbon;
use App\Inbox;
use App\ReplyInbox;
use Session;

class InboxController extends Controller
{
    public function index(){

        if(Auth::user()->id == "Administrator") {
            $inbox = DB::table('inbox')
            ->select('inbox.inbox_id', 'type', 'subject', 'inbox.created_at', 'inbox.updated_at', 'users.name', 'st_inbox')
            ->leftJoin('users', 'users.id', '=', 'inbox.f_user_id')
            ->orderBy('inbox.inbox_id', 'DESC')
            ->get();
        } else {
            $inbox = DB::table('inbox')
            ->select('inbox.inbox_id', 'type', 'subject', 'inbox.created_at', 'inbox.updated_at', 'users.name', 'st_inbox')
            ->leftJoin('users', 'users.id', '=', 'inbox.f_user_id')
            ->where('inbox.t_user_id', Auth::user()->id)
            ->orderBy('inbox.inbox_id', 'DESC')
            ->get();
        }

        return view('pages.admin.inbox.index')->with('inbox', $inbox);

        
    }

    public function detail($id){

        $inbox = DB::table('inbox')
        ->leftJoin('users', 'users.id', '=', 'inbox.f_user_id')
        //->where('inbox.t_user_id', Auth::user()->id)
        //->orWhere('inbox.f_user_id', Auth::user()->id)
        ->where('inbox.inbox_id', Crypt::decryptString($id))
        ->first();

        $reply = DB::table('reply_inbox')
        ->select('users.name', 'dealers.images', 'reply', 'reply_inbox.created_at', 'reply_inbox.updated_at', 'reply_inbox.file')
        ->leftJoin('users', 'users.id', '=', 'reply_inbox.user_id')
        ->leftJoin('dealers', 'dealers.user_id', '=', 'users.id')
        ->where('reply_inbox.inbox_id', Crypt::decryptString($id))
        ->get();

        //echo "<pre>"; print_r($inbox); echo Crypt::decryptString($id); echo Auth::user()->id; echo "</pre>";

        //Update status Inbox jika yang buka email sama dengan t_user_id
        if(Auth::user()->id == $inbox->t_user_id){
            DB::table('inbox')->where('inbox_id',Crypt::decryptString($id))->update(['st_inbox' => 1]);
        }

        return view('pages.admin.inbox.detail')->with('inbox', $inbox)->with('replys', $reply);

        
    }

    public function reply(Request $request){
        
        $this->validate($request, [
      
            'reply'          => 'required'
        ]);
        
        if($request->hasFile('file')){

            $featured = $request->file;

            $featured_new_name = time()."_".$featured->getClientOriginalName();

            $featured->move('uploads/inbox', $featured_new_name);
            
            $inbox = ReplyInbox::create([
                'inbox_id'        => $request->id,
                'user_id'         => Auth::user()->id,
                'reply'           => $request->reply,
                'file'           => 'uploads/inbox/'.$featured_new_name,
            ]);

        } else {

            $inbox = ReplyInbox::create([
                'inbox_id'        => $request->id,
                'user_id'         => Auth::user()->id,
                'reply'           => $request->reply
            ]);

        }
        
        Session::flash('success', 'Reply Berhasil Dikirim.');
        
        return redirect()->route('inbox.detail', ['id' => Crypt::encryptString($request->id)]);
    }

    public function sentitem(){
        $inbox = DB::table('inbox')
        ->select('inbox.inbox_id', 'type', 'subject', 'inbox.created_at', 'inbox.updated_at', 'users.name', 'st_inbox')
        ->leftJoin('users', 'users.id', '=', 'inbox.f_user_id')
        ->where('inbox.f_user_id', Auth::user()->id)
        ->orderBy('inbox.inbox_id', 'DESC')
        ->get();

        return view('pages.admin.inbox.sentitem')->with('inbox', $inbox);
    }

    public function delete($id){
    	$inbox = Inbox::find(Crypt::decryptString($id));

    	$inbox->delete();

    	Session::flash('success', 'Surat Berhasil Dihapus');
    	return redirect()->back();
    }
}
