@extends('layouts.applte')

@section('content')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

<script src="{{ asset('assets/lte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(function () {
    $('#example1').DataTable({
      'pageLength'  : 50
    })
    $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    'pageLength'  : 50,
    })
})
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('result.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Peserta</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$titles}}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width: 50px">Posisi</th>
                        <th style="width: 50px">Level</th>
                        <th>English</th>
                        <th>Tech 1A</th>
                        <th>Tax</th>
                        <th>Tech 3</th>
                        <th>Tech 4</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php $no=1; ?>
                          @foreach($users as $user)
                          <?php 
                          $tj_engl = DB::table('bank_question')
                            ->select('id_test_user')
                            ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
                            ->whereIn('category', ['english_step1', 'english_step2', 'english_step3'])
                            ->whereRaw('bank_question.key = english_question.jwb')
                            ->where('users_id', $user->id)
                            ->where('id_career', $user->idcareer)
                            ->count();

                          $t_engl = DB::table('bank_question')
                            ->select('id_test_user')
                            ->whereIn('category', ['english_step1', 'english_step2', 'english_step3'])
                            ->count();

                          $tj_tech = DB::table('bank_question')
                            ->select('id_test_user')
                            ->leftJoin('technical_question', 'technical_question.id_question', '=', 'bank_question.id_question')
                            ->whereIn('category', ['technical_step1a', 'technical_step1b', 'technical_step1c', 'technical_step1d', 'technical_step1e', 'technical_step17', 
                            'technical_step18', 'technical_step19', 'technical_step1g', 'technical_step23', 'technical_step24', 'technical_step25', 'technical_step26', 
                            'technical_step27', 'technical_step1h', 'technical_step30', 'technical_step31', 'technical_step32', 'technical_step33', 'technical_step1j'])
                            ->whereRaw('bank_question.key = technical_question.jwb')
                            ->where('users_id', $user->id)
                            ->where('id_career', $user->idcareer)
                            ->count();

                          $t_tech = DB::table('bank_question')
                            ->select('id_test_user')
                            ->whereIn('category', ['technical_step1a', 'technical_step1b', 'technical_step1c', 'technical_step1d', 'technical_step1e', 'technical_step17', 
                            'technical_step18', 'technical_step19', 'technical_step1g', 'technical_step23', 'technical_step24', 'technical_step25', 'technical_step26', 
                            'technical_step27', 'technical_step1h', 'technical_step30', 'technical_step31', 'technical_step32', 'technical_step33', 'technical_step1j'])
                            ->count();

                            $tj_tech3 = DB::table('bank_question')
                            ->select('id_test_user')
                            ->leftJoin('technical_question', 'technical_question.id_question', '=', 'bank_question.id_question')
                            ->whereIn('category', ['technical_test31', 'technical_test34', 'technical_test35', 'technical_test36', 'technical_test37', 'technical_test38', 'technical_test39'
                            , 'technical_test310', 'technical_test311', 'technical_test312', 'technical_test313', 'technical_test314', 'technical_test315'])
                            ->whereRaw('bank_question.key = technical_question.jwb')
                            ->where('users_id', $user->id)
                            ->where('id_career', $user->idcareer)
                            ->count();

                          $t_tech3 = DB::table('bank_question')
                            ->select('id_test_user')
                            ->whereIn('category', ['technical_test31', 'technical_test34', 'technical_test35', 'technical_test36', 'technical_test37', 'technical_test38', 'technical_test39'
                            , 'technical_test310', 'technical_test311', 'technical_test312', 'technical_test313', 'technical_test314', 'technical_test315'])
                            ->count();

                          $tj_tax = DB::table('bank_question')
                            ->select('id_test_user')
                            ->leftJoin('tax_question', 'tax_question.id_question', '=', 'bank_question.id_question')
                            ->whereIn('category', ['tax1', 'tax5', 'tax6', 'tax7'])
                            ->whereRaw('bank_question.key = tax_question.jwb')
                            ->where('users_id', $user->id)
                            ->where('id_career', $user->idcareer)
                            ->count();

                          $t_tax = DB::table('bank_question')
                            ->select('id_test_user')
                            ->whereIn('category', ['tax1', 'tax5', 'tax6', 'tax7'])
                            ->count();

                            $no_add = 0;
                            $t_add = DB::table('technical_additional')
                            ->where('users_id', $user->id)
                            ->where('id_career', $user->idcareer)
                            ->first();
                            if($t_add) {
                                  if($t_add->jwb_1_1_1=="10.000.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_1_2=="12.500.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_1_3=="220.000.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_1_4=="212.500.000.000") {
                                  $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_2_1=="30.000.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_2_2=="18.750.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_2_3=="60.000.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_2_4=="93.750.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_3_1=="40.000.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_3_2=="31.250.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_3_3=="280.000.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_3_4=="306.250.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_1_4_1=="8.750.000.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_1_4_2=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_1_4_3=="26.250.000.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_1_4_4=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_2_1_1=="84.664.800.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_2_1_2=="84.664.800.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_2_2_1=="7.260.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_2_2_2=="7.260.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_2_3_1=="2.795.000.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_2_3_2=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_2_4_1=="74.609.800.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_2_4_2=="77.404.800.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_2_5_1=="2.795.000.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_2_5_2=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_3_1_1=="15.168.730.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_3_1_2=="15.168.730.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_3_2_1=="97.630.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_3_2_2=="97.630.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_3_3_1=="1.507.110.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_3_3_2=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_3_4_1=="13.563.990.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_3_4_2=="15.071.100.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_3_5_1=="1.507.110.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_3_5_2=="0") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_4_1_1=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_1_2=="2.128.749.186") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_2_1=="0") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_4_2_2=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_3_1=="9.750.000.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_3_2=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_4_1=="750.000.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_4_2=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_5_1=="7.000.000.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_5_2=="0") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_4_6_1=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_6_2=="17.500.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_4_7_1=="8.750.000.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_7_2=="0") {
                                  $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_8_1=="240.000.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_8_2=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_9_1=="502.370.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_9_2=="0") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_4_10_1=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_10_2=="9.492.370.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_11_1=="0") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_4_11_2=="24.863.620.814") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_4_12_1=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_12_2=="21.728.536.675") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_13_1=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_13_2=="3.135.084.139") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_14_1=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_14_2=="3.135.084.000") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_15_1=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_15_2=="783.771.000") {
                                  $no_add = $no_add + 1;
                                }  if($t_add->jwb_4_16_1=="783.771.000") {
                                  $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_4_16_2=="0") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_4_17_1=="0") {
                                  $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_4_17_2=="783.771.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_1_1=="280.000.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_1_2=="306.250.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_1_3=="26.250.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_1_4=="6.562.500.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_2_1=="74.609.800.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_2_2=="77.404.800.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_2_3=="2.795.000.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_2_4=="698.750.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_3_1=="13.563.990.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_3_2=="15.071.100.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_3_3=="1.507.110.000") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_3_4=="376.777.500") {
                                    $no_add = $no_add + 1;
                                }  /*if($t_add->jwb_5_4_1=="0") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_4_2=="0") {
                                    $no_add = $no_add + 1;
                                }  if($t_add->jwb_5_4_3=="0") {
                                    $no_add = $no_add + 1;
                                }*/  if($t_add->jwb_5_4_4=="7.638.027.500") {
                                    $no_add = $no_add + 1;
                                }
                            }
                            ?>
                            <?php 
                            $c_eng = DB::table('tbl_list_test_job')
                            ->where('id_career', $user->idcareer)
                            ->where('id_test', 2)
                            ->count();

                            $c_tech1 = DB::table('tbl_list_test_job')
                            ->where('id_career', $user->idcareer)
                            ->where('id_test', 3)
                            ->count();

                            $c_tax = DB::table('tbl_list_test_job')
                            ->where('id_career', $user->idcareer)
                            ->where('id_test', 7)
                            ->count();

                            $c_tech3 = DB::table('tbl_list_test_job')
                            ->where('id_career', $user->idcareer)
                            ->where('id_test', 6)
                            ->count();

                            $c_tech4 = DB::table('tbl_list_test_job')
                            ->where('id_career', $user->idcareer)
                            ->where('id_test', 8)
                            ->count();
                            ?>
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->position }}</td>
                        <td>{{$user->jobdesk_in}}</td>
                        <td>@if($c_eng > 0) {{$tj_engl}}/{{$t_engl}} @endif</td>
                        <td>@if($c_tech1 > 0) {{$tj_tech}}/{{$t_tech}} @endif</td>
                        <td>@if($c_tax > 0) {{$tj_tax}}/{{$t_tax}} @endif</td>
                        <td>@if($c_tech3 > 0) {{$tj_tech3}}/{{$t_tech3}} @endif</td>
                        <td>@if($c_tech4 > 0) {{$no_add}}/59 @endif</td>
                        <td>
                            @if($user->st_target==1) <span class="label label-primary" style="font-size: 14px">Baru</span>
                            @elseif($user->st_target==2) <span class="label label-success" style="font-size: 14px">Submit</span>
                            @elseif($user->st_target==3) <span class="label label-warning" style="font-size: 14px">Interview</span>
                            @elseif($user->st_target==4) <span class="label label-danger" style="font-size: 14px">Di Tolak</span>
                            @elseif($user->st_target==5) <span class="label label-danger" style="font-size: 14px">Waktu Habis</span>
                            @endif
                        </td>
                        <td>
                                      
                          <div class="btn-group dropleft">
                            <button type="button" class="btn btn-primary">Detail</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a target="_blank" href="{{route('result.english.summary', ['iduser' => $user->id, 'jobid' => $user->idcareer])}}">English Essay</a></li>
                              <li><a target="_blank" href="{{route('result.summary', ['iduser' => $user->id, 'jobid' => $user->idcareer])}}">Per. Information</a></li>
                              <li><a target="_blank" href="{{route('result.personality_test', ['iduser' => $user->id, 'jobid' => $user->idcareer])}}">Personality Test</a></li>
                              <li><a target="_blank" href="{{route('result.health.step1', ['iduser' => $user->id, 'jobid' => $user->idcareer])}}">Health Disclosure</a></li>
                              @if($user->idcareer == 19)
                              <li><a target="_blank" href="{{route('result.tax.step2', ['iduser' => $user->id, 'jobid' => $user->idcareer])}}">Soal Ketelitian</a></li>
                              @endif
                              <li role="presentation" class="divider"></li>
                              <li><a href="{{route('result.acttolak', ['iduser' => $user->id, 'jobid' => $user->idcareer])}}">Tolak</a></li>
                              <li><a href="{{route('result.actinterview', ['iduser' => $user->id, 'jobid' => $user->idcareer])}}">Interview</a></li>
                            </ul>
                          </div>

                        </td>
                      </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width: 50px">Posisi</th>
                        <th style="width: 50px">Level</th>
                        <th>English</th>
                        <th>Tech 1A</th>
                        <th>Tax</th>
                        <th>Tech 3</th>
                        <th>Tech 4</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
            
          </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
