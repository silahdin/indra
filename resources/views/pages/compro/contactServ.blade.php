@extends('layouts.appcompro')

@section('content')

<div class="space-top" style="height: 40px !important;"></div>
<div class="space-top"></div>
    <section class="section-contactUs">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
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
                <form action="{{ route('compro.sendMailOnContactServ') }}" method="post">
                  {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div>
                                        <table  class="contact-us">
                                            <tr>
                                                <td>Contact name</td>
                                                <td>:

                                                    <input type="text" name="cmail" id="" class="form-control" placeholder="" value="{{ $post->email}}" hidden>

                                                    <input type="text" name="cname" id="" class="form-control" placeholder="" value="{{ $post->name}}" readonly>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h6>@lang('main.enquiry_about')*</h6>
                                    <select name="enquiry" id="" class="form-control" readonly>
                                        <option value="{{ $sername }}" selected>{{ $sername }} </option>
                                        <!-- <option value="Assurance Services">Assurance Services</option>
                                        <option value="Advisory Services">Advisory Services</option>
                                        <option value="Tax Services">Tax Services</option>
                                        <option value="M & A Services">M & A Services</option>
                                        <option value="Press & Media">Press & Media</option>
                                        <option value="Publications & Marketing Materials">Publications & Marketing Materials</option>
                                        <option value="Submit Request for Proposal">Submit Request for Proposal</option> -->
                                    </select>
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
                                                        <option value="Mr.">Mr.</option>
                                                        <option value="Mrs.">Mrs.</option>
                                                        <option value="Ms.">Ms.</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('main.title_first_name')</td>
                                                <td>:
                                                    <input type="text" name="fname" id="" class="form-control" placeholder="Your first name" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('main.title_last_name')</td>
                                                <td>:
                                                    <input type="text" name="lname" id="" class="form-control"  placeholder="Your last name"  required>
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
                                                    <input type="text" name="company" id="" class="form-control" placeholder="Your company name" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('main.email_address')</td>
                                                <td>:
                                                    <input type="text" name="email" id="" class="form-control" placeholder="Email address" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('main.phone_num')</td>
                                                <td>:
                                                    <input type="text" name="phone" id="" class="form-control" placeholder="Phone number" required>
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
                                    <textarea class="form-control" name="mes" id="" cols="10" rows="3" placeholder="Your message" required></textarea>
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
                                    <h6 style="font-style:italic">For general inquiries, please contact: enquiry@reandabernardi.com</h6>
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

@endsection
