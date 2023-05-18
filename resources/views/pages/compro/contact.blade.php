@extends('layouts.appcompro')

@section('content')

<div class="space-top"></div>
    <section class="section-contactUs">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 pt-4">
                    <br>
                    <p class="opening">@lang('main.contact_us_open')</p>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section class="section-contactUs">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                </div>
                <div class="col-sm-12">
                <form action="{{ route('compro.sendMailOnContact') }}" method="post">
                  {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6>@lang('main.enquiry_about')*</h6>
                                    <select name="enquiry" id="" class="form-control" required>
                                        <option value="">@lang('main.enquiry_detail1')</option>
                                        <option {{ old('enquiry') == 'Assurance Services' ? 'selected' : '' }} value="Assurance Services">@lang('main.enquiry_detail2')</option>
                                        <option {{ old('enquiry') == 'Advisory Services' ? 'selected' : '' }} value="Advisory Services">@lang('main.enquiry_detail3')</option>
                                        <option {{ old('enquiry') == 'Tax Services' ? 'selected' : '' }} value="Tax Services">@lang('main.enquiry_detail4')</option>
                                        <option {{ old('enquiry') == 'M & A Services' ? 'selected' : '' }} value="M & A Services">@lang('main.enquiry_detail5')</option>
                                        <option {{ old('enquiry') == 'Press & Media' ? 'selected' : '' }} value="Press & Media">@lang('main.enquiry_detail6')</option>
                                        <option {{ old('enquiry') == 'Publications & Marketing Materials' ? 'selected' : '' }} value="Publications & Marketing Materials">@lang('main.enquiry_detail7')</option>
                                        <option {{ old('enquiry') == 'Submit Request for Proposal' ? 'selected' : '' }} value="Submit Request for Proposal">@lang('main.enquiry_detail8')</option>
                                    </select>
                                    @if($errors->has('enquiry'))
                                        <span style="color: red; margin-left: 10px;">{{ @$errors->first('enquiry') }}</span>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6>@lang('main.what_name')*</h6>
                                    <div>
                                        <table  class="contact-us">
                                            <tr>
                                                <td>@lang('main.title')</td>
                                                <td>
                                                    :
                                                    <select name="title" id="" class="form-control" required>
                                                        <option value="">@lang('main.title_select')</option>
                                                        <option {{ old('title') == 'Mr.' ? 'selected' : '' }} value="Mr.">Mr.</option>
                                                        <option {{ old('title') == 'Mrs.' ? 'selected' : '' }} value="Mrs.">Mrs.</option>
                                                        <option {{ old('title') == 'Ms.' ? 'selected' : '' }} value="Ms.">Ms.</option>
                                                    </select>
                                                    @if($errors->has('title'))
                                                        <span style="color: red; margin-left: 10px;">{{ @$errors->first('title') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('main.title_first_name')</td>
                                                <td>:
                                                    <input type="text" name="fname" id="" class="form-control" placeholder="Your first name" required value="{{ @old('fname') }}">
                                                    @if($errors->has('fname'))
                                                        <span style="color: red; margin-left: 10px;">{{ @$errors->first('fname') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('main.title_last_name')</td>
                                                <td>:
                                                    <input type="text" name="lname" id="" class="form-control"  placeholder="Your last name"  required value="{{ @old('lname') }}">
                                                    @if($errors->has('lname'))
                                                        <span style="color: red; margin-left: 10px;">{{ @$errors->first('lname') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6>@lang('main.what_company_name')*</h6>
                                    <div>
                                        <table class="contact-us">
                                            <tr>
                                                <td>@lang('main.company_name')</td>
                                                <td>:
                                                    <input type="text" name="company" id="" class="form-control" placeholder="Your company name" required value="{{ @old('company') }}">
                                                    @if($errors->has('company'))
                                                        <span style="color: red; margin-left: 10px;">{{ @$errors->first('company') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('main.email_address')</td>
                                                <td>:
                                                    <input type="text" name="email" id="" class="form-control" placeholder="Email address" required value="{{ @old('email') }}">
                                                    @if($errors->has('email'))
                                                        <span style="color: red; margin-left: 10px;">{{ @$errors->first('email') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('main.phone_num')</td>
                                                <td>:
                                                    <input type="text" name="phone" id="" class="form-control" placeholder="Phone number" required value="{{ @old('phone') }}">
                                                    @if($errors->has('phone'))
                                                        <span style="color: red; margin-left: 10px;">{{ @$errors->first('phone') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- <h6>What is the name of your company?*</h6> -->
                                    <label for="" class="">@lang('main.your_message'):</label>
                                    <textarea class="form-control" name="mes" id="" cols="10" rows="3" placeholder="Your message" required>{{ @old('mes') }}</textarea>
                                    @if($errors->has('mes'))
                                        <span style="color: red;">{{ @$errors->first('mes') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <img class="img-contact" src="{{ asset('assets/compro/assets/frontend_assets/images/contact/img.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-sm-12">
                            <input type="radio" id="reading" name="reading"> <label for="reading">I have read and understand the privacy policy*</label>
                        </div> -->
                        <div class="col-sm-12">
                            <button class="btn btn-primary">@lang('main.button_submit') <span class="fa fa-send"></span></button>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>@lang('main.find_office')</h2>
                            <div class="row">
                                <div class="col-sm-6 ">
                                    <h6>Jakarta</h6>
                                    <div class="wrap">
                                        <label for="">Kantor Akuntan Publik Drs Bernardi & Rekan</label>
                                        <label for="">PT Tridaya Partners</label>
                                        <label for="">PT Reanda Konsultan Indonesia</label>
                                    </div>
                                    <div class="wrap">
                                        <label for="">Cik9 Building</label>
                                        <label for="">Jl. Cikini Raya No. 9</label>
                                        <label for="">Jakarta Pusat 10330</label>
                                    </div>
                                    <div class="wrap">
                                        <label for="">Telp:</label>
                                        <label for="">+62 21 2305569</label>
                                        <label for="">+62 21 39899079</label>
                                        <label for="">+62 21 39899080</label>
                                    </div>
                                    <div class="wrap">
                                        <label for="">Fax:</label>
                                        <label for="">+62 21 319 27546</label>
                                        <label for="">+62 21 316 1202</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <h6>Batam</h6>
                                    <div class="wrap">
                                        <label for="">KAP Drs Bernardi & Rekan (Batam Branch)</label>
                                        <label for="">PT Moores Rowland Consulting</label>
                                    </div>
                                    <div class="wrap">
                                        <label for="">Wisma Batamindo #03-19</label>
                                        <label for="">Jl. Rasamala No. 1</label>
                                        <label for="">Batamindo Industrial Park</label>
                                        <label for="">Mukakuning, Batam 29433</label>
                                    </div>
                                    <div class="wrap">
                                        <label for="">Telp:</label>
                                        <label for="">+62 770 612 861</label>
                                    </div>
                                    <div class="wrap">
                                        <label for="">Fax:</label>
                                        <label for="">+62 770 612 868</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6 style="font-style:italic">@lang('main.contact_general'): enquiry@reandabernardi.com</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>

    <br>
	<br>
	<br>
    @include('pages.compro.follow')

@endsection
