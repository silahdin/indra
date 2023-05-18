<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
Use Session;
use Auth;
use App\PelamarPribadi;
use App\PelamarKeluarga;
use App\PelamarExperience;
use App\PelamarReferences;
use App\PelamarData;
use App\PelamarTraining;
use App\PelamarComputer;
use App\PelamarEducation;
use App\PelamarCertification;
use App\PelamarLanguage;
use Validator;
use Crypt;

class PelamarpribadiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function wizard($jobid) {

        $dpribadi = DB::table('pelamar_pribadi')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();

        if(isset($dpribadi->id_pribadi) && $dpribadi->id_pribadi != "") {
            return view('pages.wizard.indexedit')->with('dpribadi', $dpribadi)->with('jobid', $jobid);
        } else {
            return view('pages.wizard.index')->with('jobid', $jobid);
        }
        
    }

    public function wizard_step2($jobid) {
        $ddata = DB::table('pelamar_data')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();

        if(isset($ddata->latest_compensation) && $ddata->latest_compensation != "") {
            return view('pages.wizard.step2edit')->with('ddata', $ddata)->with('jobid', $jobid);
        } else {
            return view('pages.wizard.step2')->with('jobid', $jobid);
        }
    }

    public function wizard_step3($jobid) {
        $cek = DB::table('pelamar_education')
        ->select('id_education')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();

        $ddata = DB::table('pelamar_education')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->get();

        if(isset($cek->id_education) && $cek->id_education != "") {
            return view('pages.wizard.step3edit')->with('ddata', $ddata)->with('jobid', $jobid);
        } else {
            return view('pages.wizard.step3')->with('jobid', $jobid);
        }
    }

    public function wizard_post(Request $request) {
        //dd($request->all());

        if($request->step=="1e") {
            $validator = \Validator::make($request->all(), [
                'full_name'             => 'required',
                'job_position'          => 'required',
                'gender'                => 'required',
                'marital_status'        => 'required',
                'religion'              => 'required',
                'address'               => 'required',
                'place_birth'           => 'required',
                'date_birth'            => 'required',
                'date_availability'     => 'required',
                'contact_home'          => 'required',
                'contact_cellular'      => 'required',
                'contact_email'         => 'required',
            ]);
        } else {
            
            $attributeNames = array(
                'name.0'                    => 'name of family',
                'relationship.0'            => 'relationship of family',
                'dob.0'                     => 'date of birth of family',
                'education.0'               => 'education of family',
                'occupation.0'              => 'occupation of family',
             );

            $validator = \Validator::make($request->all(), [
                'full_name'             => 'required',
                'job_position'          => 'required',
                'gender'                => 'required',
                'marital_status'        => 'required',
                'religion'              => 'required',
                'address'               => 'required',
                'place_birth'           => 'required',
                'date_birth'            => 'required',
                'date_availability'     => 'required',
                'contact_home'          => 'required',
                'contact_cellular'      => 'required',
                'contact_email'         => 'required',
                'name.0'                => 'required',
                'relationship.0'        => 'required',
                'dob.0'                 => 'required',
                'education.0'           => 'required',
                'occupation.0'          => 'required',
            ]);

            $validator->setAttributeNames($attributeNames);
        }
        

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if($request->step=="1e") { //Jika ada datanya =======================================================

            DB::table('pelamar_pribadi')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada

            $pelamar = PelamarPribadi::create([
                'users_id'             => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'full_name'            => $request->full_name,
                'job_position'         => $request->job_position,
                'gender'               => $request->gender,
                'marital_status'       => $request->marital_status,
                'religion'             => $request->religion,
                'address'              => $request->address,
                'place_birth'          => $request->place_birth,
                'date_birth'           => $request->date_birth,
                'date_availability'    => $request->date_availability,
                'contact_home'         => $request->contact_home,
                'contact_cellular'     => $request->contact_cellular,
                'contact_email'        => $request->contact_email,
            ]);
    
            
            DB::table('pelamar_keluarga')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada

            $count = count($request->name);
    
            for ($i=0; $i < $count; $i++) {
                if($request->name[$i] != "") {
                    $keluarga = PelamarKeluarga::create([
                        'users_id'          => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'name'              => $request->name[$i],
                        'relationship'      => $request->relationship[$i],
                        'dob'               => $request->dob[$i],
                        'education'         => $request->education[$i],
                        'occupation'        => $request->occupation[$i]
                    ]);
                }
            }

        } else { //Jika tidak ada datanya =======================================================
            $pelamar = PelamarPribadi::create([
                'users_id'             => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'full_name'            => $request->full_name,
                'job_position'         => $request->job_position,
                'gender'               => $request->gender,
                'marital_status'       => $request->marital_status,
                'religion'             => $request->religion,
                'address'              => $request->address,
                'place_birth'          => $request->place_birth,
                'date_birth'           => $request->date_birth,
                'date_availability'    => $request->date_availability,
                'contact_home'         => $request->contact_home,
                'contact_cellular'     => $request->contact_cellular,
                'contact_email'        => $request->contact_email,
            ]);
    
            
            $count = count($request->name);
    
            for ($i=0; $i < $count; $i++) {
                if($request->name[$i] != "") {
                    $keluarga = PelamarKeluarga::create([
                        'users_id'          => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'name'              => $request->name[$i],
                        'relationship'      => $request->relationship[$i],
                        'dob'               => $request->dob[$i],
                        'education'         => $request->education[$i],
                        'occupation'        => $request->occupation[$i]
                    ]);
                }
            }
        }
        
        if($pelamar) { $status = "success"; $msg = "Data have been success to saved"; } 
        else { $status = "failed"; $msg = "Data have been failed to saved"; }
        
        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 
    }
    
    public function wizard_post_step2(Request $request) {

        $latest_compensation = str_replace('.', '', $request->latest_compensation);

        if($request->step=="2e") { //Jika ada datanya =======================================================
           /* $attributeNames = array(
                'name.0'                    => '1st name of professional references',
                'relationship.0'            => '1st relationship of professional references',
                'contact.0'                 => '1st contact  of professional references',
                'name.1'                    => '2nd name of professional references',
                'relationship.1'            => '2nd relationship of professional references',
                'contact.1'                 => '2nd contact  of professional references',
             );

            $validator = \Validator::make($request->all(), [
                'latest_compensation'      => 'required',
                'name.0'                   => 'required',
                'relationship.0'           => 'required',
                'contact.0'                => 'required',
                'name.1'                   => 'required',
                'relationship.1'           => 'required',
                'contact.1'                => 'required',
            ]);
            $validator->setAttributeNames($attributeNames);
    
            if($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }*/
            
            DB::table('pelamar_data')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada

            $pelamar = PelamarData::create([
                'users_id'             => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'latest_compensation'  => $latest_compensation
            ]);
    
            
            DB::table('pelamar_experience')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada
            $count = count($request->company);
            
            for ($i=0; $i < $count; $i++) {
                if($request->company[$i] != "") {
                    $company = PelamarExperience::create([
                        'users_id'              => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'from'                  => $request->from[$i],
                        'to'                    => $request->to[$i],
                        'company'               => $request->company[$i],
                        'position'              => $request->position[$i],
                        'job_responsibilities'  => $request->job_responsibilities[$i],
                        'achievements'          => $request->achievements[$i],
                        'reason'                => $request->reason[$i]
                    ]);
                }
            }
            
            DB::table('pelamar_references')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada

            $countref = count($request->name);
            for ($r=0; $r < $countref; $r++) {
                if($request->name[$r] != "") {
                    $company = PelamarReferences::create([
                        'users_id'              => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'name'                  => $request->name[$r],
                        'relationship'          => $request->relationship[$r],
                        'contact'               => $request->contact[$r]
                    ]);
                }
            }
        } else { //Jika tidak ada datanya =======================================================
            /*$attributeNames = array(
                'from.0'                    => 'from year of work experience',
                'to.0'                      => 'to year of work experience',
                'company.0'                 => 'company of work experience',
                'position.0'                => 'position of work experience',
                'job_responsibilities.0'    => 'job responsibilities of work experience',
                'achievements.0'            => 'achievements of work experience',
                'reason.0'                  => 'reason of work experience',
                'name.0'                    => '1st name of professional references',
                'relationship.0'            => '1st relationship of professional references',
                'contact.0'                 => '1st contact  of professional references',
                'name.1'                    => '2nd name of professional references',
                'relationship.1'            => '2nd relationship of professional references',
                'contact.1'                 => '2nd contact  of professional references',
             );

            $validator = \Validator::make($request->all(), [
                'latest_compensation'      => 'required',
                'from.0'                   => 'required',
                'to.0'                     => 'required',
                'company.0'                => 'required',
                'position.0'               => 'required',
                'job_responsibilities.0'   => 'required',
                'achievements.0'           => 'required',
                'reason.0'                 => 'required',
                'name.0'                   => 'required',
                'relationship.0'           => 'required',
                'contact.0'                => 'required',
                'name.1'                   => 'required',
                'relationship.1'           => 'required',
                'contact.1'                => 'required',
            ]);
            $validator->setAttributeNames($attributeNames);
    
            if($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }*/
    
            $pelamar = PelamarData::create([
                'users_id'             => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'latest_compensation'  => $latest_compensation
            ]);
    
            
            $count = count($request->company);
            for ($i=0; $i < $count; $i++) {
                if($request->company[$i] != "") {
                    $company = PelamarExperience::create([
                        'users_id'              => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'from'                  => $request->from[$i],
                        'to'                    => $request->to[$i],
                        'company'               => $request->company[$i],
                        'position'              => $request->position[$i],
                        'job_responsibilities'  => $request->job_responsibilities[$i],
                        'achievements'          => $request->achievements[$i],
                        'reason'                => $request->reason[$i]
                    ]);
                }
            }
    
            $countref = count($request->name);
            for ($r=0; $r < $countref; $r++) {
                if($request->name[$r] != "") {
                    $company = PelamarReferences::create([
                        'users_id'              => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'name'                  => $request->name[$r],
                        'relationship'          => $request->relationship[$r],
                        'contact'               => $request->contact[$r]
                    ]);
                }
            }
        }

        
        if($pelamar) { $status = "success"; $msg = "Data have been success to saved"; } 
        else { $status = "failed"; $msg = "Data have been failed to saved"; }
        
        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function wizard_post_step3(Request $request) {
        //dd($request->all());

        if($request->step=="3e") { //Jika ada datanya =======================================================

            $validator = \Validator::make($request->all(), [
                'ms_word'               => 'required',
                'ms_excel'              => 'required',
                'ms_powerpoint'         => 'required',
                'ms_access'             => 'required',
            ]);
    
            if($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }
            
            DB::table('pelamar_education')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada

            $countedu = count($request->nameedu);
            for ($e=0; $e < $countedu; $e++) {
                if($request->nameedu[$e] != "") {
                    $peducation = PelamarEducation::create([
                        'users_id'      => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'tipe'          => $request->tipeedu[$e],
                        'name'          => $request->nameedu[$e],
                        'major'         => $request->majoredu[$e],
                        'ipk'           => $request->ipkedu[$e],
                    ]);
                }
            }
            
            DB::table('pelamar_training')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada
            $counttrain = count($request->subject);
            for ($t=0; $t < $counttrain; $t++) {
                if($request->subject[$t] != "") {
                    $ptraining = PelamarTraining::create([
                        'users_id'      => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'subject'       => $request->subject[$t],
                        'host'          => $request->host[$t],
                        'year'          => $request->yeartraining[$t],
                        'result'        => $request->result[$t],
                    ]);
                }
    
            }
            
            DB::table('pelamar_computer')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada
            //Application MS. Word
            $pcomputerw = PelamarComputer::create([
                'users_id'              => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'application'           => 'Microsoft Word',
                'nilai'                 => $request->ms_word
            ]);
    
            //Application MS. Excel
            $pcomputere = PelamarComputer::create([
                'users_id'              => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'application'           => 'Microsoft Excel',
                'nilai'                 => $request->ms_excel
            ]);
    
            //Application MS. PP
            $pcomputerp = PelamarComputer::create([
                'users_id'              => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'application'           => 'Microsoft Power Point',
                'nilai'                 => $request->ms_powerpoint
            ]);
    
            //Application MS. Access
            $pcomputera = PelamarComputer::create([
                'users_id'              => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'application'           => 'Microsoft Access',
                'nilai'                 => $request->ms_access
            ]);
            
            DB::table('pelamar_certification')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada
            $countcer = count($request->namecert);
            for ($ce=0; $ce < $countcer; $ce++) {
                if($request->namecert[$ce] != "") {
                    $pcertification = PelamarCertification::create([
                        'users_id'          => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'name'              => $request->namecert[$ce],
                        'issuear'           => $request->institusi[$ce],
                        'year'              => $request->yearcert[$ce]
                    ]);
                }
                
            }
    
            //language ============================================================
            DB::table('pelamar_language')->where('users_id', '=', Auth::user()->id)->delete(); //Hapus data yang ada
            $countlang = $request->tlang + 1;
    
            for ($ce=0; $ce < $countlang; $ce++) {
                $bhs = "language".$ce;
                $nil = "nilai".$ce;
                if($request->$bhs != "") {
                    $plang = PelamarLanguage::create([
                        'users_id'          => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'language'          => $request->$bhs,
                        'nilai'             => $request->$nil
                    ]);
                }
            }

        } else { //Jika tidak ada datanya =======================================================

            $attributeNames = array(
                //'subject.0'             => 'training subject of external trainings',
                //'host.0'                => 'host of external trainings',
                //'yeartraining.0'        => 'year training of external trainings',
                //'result.0'              => 'result of external trainings',
                //'namecert.0'            => 'name of certificates of professional certifications',
                //'institusi.0'           => 'issuer of professional certifications',
                //'yearcert.0'            => 'year of professional certifications',
                'nilai0'                => 'value bahasa Indonesia of language ability',
                'nilai1'                => 'value bahasa Inggris of language ability',
             );

            $validator = \Validator::make($request->all(), [
                //'subject.0'             => 'required',
                //'host.0'                => 'required',
                //'yeartraining.0'        => 'required',
               // 'result.0'              => 'required',
                //'namecert.0'            => 'required',
                //'institusi.0'           => 'required',
                //'yearcert.0'            => 'required',
                'ms_word'               => 'required',
                'ms_excel'              => 'required',
                'ms_powerpoint'         => 'required',
                'ms_access'             => 'required',
                'language0'             => 'required',
                'nilai0'                => 'required',
                'nilai1'                => 'required',
            ]);
            $validator->setAttributeNames($attributeNames);
    
            if($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }
    
            $countedu = count($request->nameedu);
            for ($e=0; $e < $countedu; $e++) {
                if($request->nameedu[$e] != "") {
                    $peducation = PelamarEducation::create([
                        'users_id'      => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'tipe'          => $request->tipeedu[$e],
                        'name'          => $request->nameedu[$e],
                        'major'         => $request->majoredu[$e],
                        'ipk'           => $request->ipkedu[$e],
                    ]);
                }
            }
    
            $counttrain = count($request->subject);
            for ($t=0; $t < $counttrain; $t++) {
                if($request->subject[$t] != "") {
                    $ptraining = PelamarTraining::create([
                        'users_id'      => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'subject'       => $request->subject[$t],
                        'host'          => $request->host[$t],
                        'year'          => $request->yeartraining[$t],
                        'result'        => $request->result[$t],
                    ]);
                }
    
            }
            
    
            //Application MS. Word
            $pcomputerw = PelamarComputer::create([
                'users_id'              => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'application'           => 'Microsoft Word',
                'nilai'                 => $request->ms_word
            ]);
    
            //Application MS. Excel
            $pcomputere = PelamarComputer::create([
                'users_id'              => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'application'           => 'Microsoft Excel',
                'nilai'                 => $request->ms_excel
            ]);
    
            //Application MS. PP
            $pcomputerp = PelamarComputer::create([
                'users_id'              => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'application'           => 'Microsoft Power Point',
                'nilai'                 => $request->ms_powerpoint
            ]);
    
            //Application MS. Access
            $pcomputera = PelamarComputer::create([
                'users_id'              => Auth::user()->id,
                'id_career'            => Crypt::decryptString($request->idjob),
                'application'           => 'Microsoft Access',
                'nilai'                 => $request->ms_access
            ]);
    
            $countcer = count($request->namecert);
            for ($ce=0; $ce < $countcer; $ce++) {
                if($request->namecert[$ce] != "") {
                    $pcertification = PelamarCertification::create([
                        'users_id'          => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'name'              => $request->namecert[$ce],
                        'issuear'           => $request->institusi[$ce],
                        'year'              => $request->yearcert[$ce]
                    ]);
                }
                
            }
    
            //language ============================================================
            //dd($request->all());

            $countlang = $request->tlang + 5;
    
            for ($ce=0; $ce < $countlang; $ce++) {
                $bhs = "language".$ce;
                $nil = "nilai".$ce;
                if($request->$bhs != "") {
                    $plang = PelamarLanguage::create([
                        'users_id'          => Auth::user()->id,
                        'id_career'            => Crypt::decryptString($request->idjob),
                        'language'          => $request->$bhs,
                        'nilai'             => $request->$nil
                    ]);
                }
            }

        }
        
        if($plang) { $status = "success"; $msg = "Data have been success to saved"; } 
        else { $status = "failed"; $msg = "Data have been failed to saved"; }
        
        $response = array(
            'status' => $status,
            'msg' => $msg,
        );
        return response()->json($response); 

    }

    public function wizard_summary($jobid) {

        $dpribadi = DB::table('pelamar_pribadi')
        ->where('users_id', Auth::user()->id)
        ->where('id_career', Crypt::decryptString($jobid))
        ->first();
        
        return view('pages.wizard.summary')->with('dpribadi', $dpribadi)->with('jobid', $jobid);
    }

    public function lock($jobid) {
        //lock jawaban kandidat
        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 1)->where('id_career', Crypt::decryptString($jobid))->update(['st_test' => 1, 'updated_at' => NOW()]);
        
        return redirect()->route('hometest', ['id' => $jobid]);
    }

    public function truncate(){

        PelamarPribadi::truncate();
        PelamarKeluarga::truncate();
        PelamarExperience::truncate();
        PelamarReferences::truncate();
        PelamarData::truncate();
        PelamarTraining::truncate();
        PelamarComputer::truncate();
        PelamarEducation::truncate();
        PelamarCertification::truncate();
        PelamarLanguage::truncate();
        PelamarLanguage::truncate();

        DB::table('tbl_test_user')->where('users_id', Auth::user()->id)->where('id_test', 1)->delete();

        return redirect()->route('home');
    }
    
}
