@inject('daufee', 'App\Http\Controllers\AppController')
<form type="POST" class="m-form m-form--label-align-left- m-form--state-" id="m_form" enctype="multipart/form-data">
    <!-- star of form1 -->
    <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
        <div class="row hidden">
            <div class="col-xl-12">
                <div class="form-group m-form__group">
                    {{ Form::label('exampleInputEmail1', 'Application ID', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'app_id', $value = $application->app_id, 
                        $attributes = array(
                            'class' => 'form-control m-input m-input--solid',
                            'placeholder' => '*****',
                            'disabled' => 'disabled'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group m-form__group required">
                    {{ Form::label('exampleInputEmail1', 'Application No', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'app_no', $value = $application->app_no, 
                        $attributes = array(
                            'class' => 'form-control m-input m-input--solid',
                            'placeholder' => 'Enter application no.'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group m-form__group required">
                    {{ Form::label('app_filing_date', 'Filing Date', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'app_filing_date', $value = $application->app_filing_date, 
                        $attributes = array(
                            'id' => 'app_filing_date',
                            'class' => 'form-control m-input m-input--solid date-picker',
                            'placeholder' => 'Enter filing date'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group m-form__group required">
                    {{ Form::label('app_title', 'Title', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'app_title', $value = $application->app_title, 
                        $attributes = array(
                            'class' => 'form-control m-input m-input--solid',
                            'placeholder' => 'Enter application title'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-group m-form__group required">
                    {{ Form::label('app_applicants', 'Applicants', ['class' => '']) }}
                    {{ 
                        Form::select('app_applicants[]', $application->app_applicants, $application->app_applicants, 
                            [   
                                'id' => 'applicants',
                                'class' => 'form-control m-select2',
                                'multiple' => 'multiple'
                            ]
                        )

                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="form-group m-form__group required">
                    {{ Form::label('app_contact', 'Contact No', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'app_contact', $value = $application->app_contact, 
                        $attributes = array(
                            'class' => 'form-control m-input m-input--solid',
                            'placeholder' => 'Enter contact no'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group m-form__group">
                    {{ Form::label('app_amount', 'Government Fees', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'app_amount', $value = $application->app_amount, 
                        $attributes = array(
                            'id' => 'app_amount',
                            'class' => 'form-control m-input m-input--solid numeric-double',
                            'placeholder' => 'Enter government fees'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group m-form__group">
                    {{ Form::label('professional_fee1', 'Professional Fees', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'professional_fee1', $value = $application->professional_fee1, 
                        $attributes = array(
                            'id' => 'professional_fee1',
                            'class' => 'form-control m-input m-input--solid numeric-double',
                            'placeholder' => 'Enter professional fees'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="form-group m-form__group">
                    {{ Form::label('app_address', 'Address', ['class' => '']) }}
                    {{ 
                        Form::textarea($name = 'app_address', $value = $application->app_address, 
                        $attributes = array(
                            'id' => 'app_address',
                            'rows' => 3,
                            'class' => 'form-control m-input m-input--solid',
                            'placeholder' => ''
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="form-group m-form__group">
                    {{ Form::label('app_remarks', 'Remarks', ['class' => '']) }}
                    {{ 
                        Form::textarea($name = 'app_remarks', $value = $application->app_remarks, 
                        $attributes = array(
                            'id' => 'app_remarks',
                            'rows' => 3,
                            'class' => 'form-control m-input m-input--solid',
                            'placeholder' => ''
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="form-group m-form__group">
                    {{ Form::label('app_file', 'File Browser', ['class' => '']) }}
                    <div class="custom-file">
                        {{ Form::file('app_file', 
                            $attributes = 
                            [   
                                'id' => 'customFile',
                                'class' => 'custom-file-input' 
                            ]) 
                        }}
                        <label class="custom-file-label" for="customFile">
                            {{ $application->app_file_label }}                            
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of form1 -->

    <!-- star of form2 -->
    <div class="m-wizard__form-step" id="m_wizard_form_step_2">
        <div class="row">
            <div class="col-xl-4">
                <div class="form-group m-form__group required">
                    {{ Form::label('pub_date', 'Publication Date', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'pub_date', $value = $application->pub_date, 
                        $attributes = array(
                            'id' => 'pub_date',
                            'class' => 'form-control m-input m-input--solid date-picker',
                            'placeholder' => 'Enter publication date'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group m-form__group">
                    {{ Form::label('pub_amount', 'Government Fees', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'pub_amount', $value = $application->pub_amount, 
                        $attributes = array(
                            'id' => 'pub_amount',
                            'class' => 'form-control m-input m-input--solid numeric-double',
                            'placeholder' => 'Enter government fees'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group m-form__group">
                    {{ Form::label('professional_fee3', 'Professional Fees', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'professional_fee3', $value = $application->professional_fee3, 
                        $attributes = array(
                            'id' => 'professional_fee3',
                            'class' => 'form-control m-input m-input--solid numeric-double',
                            'placeholder' => 'Enter professional fees'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="form-group m-form__group">
                    {{ Form::label('pub_file', 'File Browser', ['class' => '']) }}
                    <div class="custom-file">
                        {{ Form::file('pub_file', 
                            $attributes = 
                            [   
                                'id' => 'customFile',
                                'class' => 'custom-file-input' 
                            ]) 
                        }}
                        <label class="custom-file-label" for="customFile">
                            {{ $application->pub_file_label }}
                        </label>
                    </div>
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- end of form2 -->

    <!-- form 3 -->
    <div class="m-wizard__form-step" id="m_wizard_form_step_3">
        <div class="subsequent-form-1">
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-group m-form__group {{ ($application->fer_yes_no_yes == true) ? '' : 'required' }}">
                        {{ Form::label('sub_paper_no1', 'Paper No', ['class' => '']) }}
                        {{ 
                            Form::text($name = 'sub_paper_no1', $value = $application->sub_paper_no1, 
                            $attributes = array(
                                'id' => 'sub_paper_no1',
                                'class' => 'form-control m-input m-input--solid',
                                'placeholder' => 'Enter paper no'
                            )) 
                        }}
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group m-form__group {{ ($application->fer_yes_no_yes == true) ? '' : 'required' }}">
                        {{ Form::label('sub_mailing_date1', 'Mailing Date', ['class' => '']) }}
                        {{ 
                            Form::text($name = 'sub_mailing_date1', $value = $application->sub_mailing_date1, 
                            $attributes = array(
                                'id' => 'sub_mailing_date1',
                                'class' => 'form-control m-input m-input--solid date-picker',
                                'placeholder' => 'Enter mailing date'
                            )) 
                        }}
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-group m-form__group">
                        {{ Form::label('sub_amount_file1', 'Government Fees', ['class' => '']) }}
                        @if($application->sub_mailing_date1 != '')
                        {{ 
                            Form::text($name = 'sub_amount_file1', $value = $application->sub_amount_file1, 
                            $attributes = array(
                                'id' => 'sub_amount_file1',
                                'class' => 'form-control m-input m-input--solid numeric-double',
                                'placeholder' => 'Enter government fees'
                            )) 
                        }}
                        @else
                        {{ 
                            Form::text($name = 'sub_amount_file1', $value = $application->sub_amount_file1, 
                            $attributes = array(
                                'id' => 'sub_amount_file1',
                                'class' => 'form-control m-input m-input--solid numeric-double',
                                'placeholder' => 'Enter government fees',
                                'disabled' => 'disabled'
                            )) 
                        }}
                        @endif
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group m-form__group">
                        {{ Form::label('professional_fee2_1', 'Professional Fees', ['class' => '']) }}
                        @if($application->sub_mailing_date1 != '')
                        {{ 
                            Form::text($name = 'professional_fee2_1', $value = $application->professional_fee2_1, 
                            $attributes = array(
                                'id' => 'professional_fee2_1',
                                'class' => 'form-control m-input m-input--solid numeric-double',
                                'placeholder' => 'Enter professional fees'
                            )) 
                        }}
                        @else
                        {{  
                            Form::text($name = 'professional_fee2_1', $value = $application->professional_fee2_1, 
                            $attributes = array(
                                'id' => 'professional_fee2_1',
                                'class' => 'form-control m-input m-input--solid numeric-double',
                                'placeholder' => 'Enter professional fees',
                                'disabled' => 'disabled'
                            )) 
                        }}
                        @endif
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group m-form__group">
                        {{ Form::label('sub_file1', 'File Browser', ['class' => '']) }}
                        <div class="custom-file">
                            {{ Form::file('sub_file1', 
                                $attributes = 
                                [   
                                    'id' => 'customFile',
                                    'class' => 'custom-file-input' 
                                ]) 
                            }}
                            <label class="custom-file-label" for="customFile">
                                {{ $application->sub_file1_label }}
                            </label>
                        </div>
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="form-group m-form__group m--margin-top-10 m--margin-bottom-20">
                    <div class="alert m-alert m-alert--default" role="alert">
                        To enable subsequent formality examination report select
                        <code>
                            yes
                        </code>
                        othewise leave it no
                        <label class="m-radio m--margin-left-10 m-radio m-radio--info">
                            {{ Form::radio('fer_yes_no', 'Yes', $application->fer_yes_no_yes) }}
                            Yes
                            <span></span>
                        </label>
                        <label class="m-radio m-radio m-radio--info">
                            {{ Form::radio('fer_yes_no', 'No', $application->fer_yes_no_no) }}
                            No
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="subsequent-form-2 {{ ($application->fer_yes_no_yes == true) ? '' : 'hidden' }}">
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-group m-form__group {{ ($application->fer_yes_no_yes == true) ? 'required' : '' }}">
                        {{ Form::label('sub_paper_no2', 'Paper No', ['class' => '']) }}
                        {{ 
                            Form::text($name = 'sub_paper_no2', $value = $application->sub_paper_no2, 
                            $attributes = array(
                                'id' => 'sub_paper_no2',
                                'class' => 'form-control m-input m-input--solid',
                                'placeholder' => 'Enter paper no'
                            )) 
                        }}
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group m-form__group {{ ($application->fer_yes_no_yes == true) ? 'required' : '' }}">
                        {{ Form::label('sub_mailing_date2', 'Mailing Date', ['class' => '']) }}
                        {{ 
                            Form::text($name = 'sub_mailing_date2', $value = $application->sub_mailing_date2, 
                            $attributes = array(
                                'id' => 'sub_mailing_date2',
                                'class' => 'form-control m-input m-input--solid date-picker',
                                'placeholder' => 'Enter mailing date'
                            )) 
                        }}
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-group m-form__group">
                        {{ Form::label('sub_amount_file2', 'Government Fees', ['class' => '']) }}
                        @if($application->sub_mailing_date2 != '')
                        {{ 
                            Form::text($name = 'sub_amount_file2', $value = $application->sub_amount_file2, 
                            $attributes = array(
                                'id' => 'sub_amount_file2',
                                'class' => 'form-control m-input m-input--solid numeric-double',
                                'placeholder' => 'Enter government fees'
                            )) 
                        }}
                        @else
                        {{ 
                            Form::text($name = 'sub_amount_file2', $value = $application->sub_amount_file2, 
                            $attributes = array(
                                'id' => 'sub_amount_file2',
                                'class' => 'form-control m-input m-input--solid numeric-double',
                                'placeholder' => 'Enter government fees',
                                'disabled' => 'disabled'
                            )) 
                        }}
                        @endif
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group m-form__group">
                        {{ Form::label('professional_fee2_2', 'Professional Fees', ['class' => '']) }}
                        @if($application->sub_mailing_date2 != '')
                        {{ 
                            Form::text($name = 'professional_fee2_2', $value = $application->professional_fee2_2, 
                            $attributes = array(
                                'id' => 'professional_fee2_2',
                                'class' => 'form-control m-input m-input--solid numeric-double',
                                'placeholder' => 'Enter professional fees'
                            )) 
                        }}
                        @else
                        {{  
                            Form::text($name = 'professional_fee2_2', $value = $application->professional_fee2_2, 
                            $attributes = array(
                                'id' => 'professional_fee2_2',
                                'class' => 'form-control m-input m-input--solid numeric-double',
                                'placeholder' => 'Enter professional fees',
                                'disabled' => 'disabled'
                            )) 
                        }}
                        @endif
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-group m-form__group">
                        {{ Form::label('sub_file2', 'File Browser', ['class' => '']) }}
                        <div class="custom-file">
                            {{ Form::file('sub_file2', 
                                $attributes = 
                                [   
                                    'id' => 'customFile',
                                    'class' => 'custom-file-input' 
                                ]) 
                            }}
                            <label class="custom-file-label" for="customFile">
                                {{ $application->sub_file2_label }}
                            </label>
                        </div>
                        <span class="m-form__help form-control-feedback"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of form3 -->

    <!-- start of form4 -->
    <div class="m-wizard__form-step" id="m_wizard_form_step_4">
        <div class="row">
            <div class="col-xl-4">
                <div class="form-group m-form__group required">
                    {{ Form::label('reg_date', 'Registration Date', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'reg_date', $value = $application->reg_date, 
                        $attributes = array(
                            'id' => 'reg_date',
                            'class' => 'form-control m-input m-input--solid date-picker',
                            'placeholder' => 'Enter registration date'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group m-form__group">
                    {{ Form::label('reg_amount', 'Government Fees', ['class' => '']) }}
                    {{
                        Form::text($name = 'reg_amount', $value = $application->reg_amount, 
                        $attributes = array(
                            'id' => 'reg_amount',
                            'class' => 'form-control m-input m-input--solid numeric-double',
                            'placeholder' => 'Enter government fees'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group m-form__group">
                    {{ Form::label('professional_fee4_1', 'Professional Fees', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'professional_fee4_1', $value = $application->professional_fee4_1, 
                        $attributes = array(
                            'id' => 'professional_fee4_1',
                            'class' => 'form-control m-input m-input--solid numeric-double',
                            'placeholder' => 'Enter professional fees'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="form-group m-form__group">
                    {{ Form::label('reg_file', 'File Browser', ['class' => '']) }}
                    <div class="custom-file">
                        {{ Form::file('reg_file', 
                            $attributes = 
                            [   
                                'id' => 'customFile',
                                'class' => 'custom-file-input' 
                            ]) 
                        }}
                        <label class="custom-file-label" for="customFile">
                            {{ $application->reg_file_label }}
                        </label>
                    </div>
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- end of form4 -->

    <!-- start of form5 -->
    <div class="m-wizard__form-step" id="m_wizard_form_step_5">
        <div id="dau_fees_layer" class="row">
            <div class="col-xl-12">
                <h5 class="text-center m--margin-top-5"><strong>*** DAU FEES ***</strong></h5>
            </div>
            <div class="col-xl-12">
                <div class="table-reponsive">
                    <table id="dau_table" class="table">
                        <thead>
                            <th class="text-center"><strong>DAU</strong></th>
                            <th class="text-center"><strong>Due Date</strong></th>
                            <th class="text-center"><strong>DAU Fee</strong></th>
                            <th class="text-center"><strong>is Paid?</strong></th>
                            <th class="text-center">&nbsp;</th>
                        </thead>
                        <tbody>
                            @php
                            $i = 3;
                            @endphp
                            @while ( $i <= 5 )
                                <tr class="init" data-row-id="{{$i}}">
                                    <td class="text-center">
                                        <label class="m--margin-top-7">{{ $i }}th Year</label>
                                    </td> 
                                    <td class="hidden"><input name="dau_identification[]" value="{{$i}}"/></td>
                                    <td class="hidden"><input name="renewal_{{$i}}" value="0"/></td>
                                    <td class="hidden">
                                        @if($application->app_id != '' && $application->reg_date != '')
                                            <input id="dau_due_date_{{$i}}" name="dau_due_date_{{$i}}" value="{{ $daufee->fetchDauFee($i, $application->app_id, $application->reg_date, 'due_dates', 0, 0) }}"/>
                                        @else
                                            <input id="dau_due_date_{{$i}}" name="dau_due_date_{{$i}}" value=""/>
                                        @endif
                                    </td>
                                    <td>
                                        @if($application->app_id != '' && $application->reg_date != '')
                                        {{ 
                                            Form::text($name = 'dau_due_date_clone[]', $value = $daufee->fetchDauFee($i, $application->app_id, $application->reg_date, 'due_date', 0, 0), 
                                            $attributes = array(
                                                'id' => 'dau_due_date_clone_'.$i,
                                                'class' => 'text-center form-control m-input m-input--solid date-picker',
                                                'placeholder' => '',
                                                'disabled' => 'disabled'
                                            )) 
                                        }}
                                        @else
                                        {{ 
                                            Form::text($name = 'dau_due_date_clone[]', $value = '', 
                                            $attributes = array(
                                                'id' => 'dau_due_date_clone_'.$i,
                                                'class' => 'text-center form-control m-input m-input--solid date-picker',
                                                'placeholder' => '',
                                                'disabled' => 'disabled'
                                            )) 
                                        }}
                                        @endif
                                    </td> 
                                    <td>
                                        @if($application->app_id != '' && $application->reg_date != '')
                                        {{ 
                                            Form::text($name = 'dau_fee_'.$i, $value = $value = $daufee->fetchDauFee($i, $application->app_id, $application->reg_date, 'due_date_fee', 0, 0), 
                                            $attributes = array(
                                                'id' => 'dau_fee_'.$i,
                                                'class' => 'text-center form-control m-input m-input--solid numeric-double',
                                                'placeholder' => ''
                                            )) 
                                        }}
                                        @else
                                        {{ 
                                            Form::text($name = 'dau_fee_'.$i, $value = '', 
                                            $attributes = array(
                                                'id' => 'dau_fee_'.$i,
                                                'class' => 'text-center form-control m-input m-input--solid numeric-double',
                                                'placeholder' => '',
                                            )) 
                                        }}
                                        @endif
                                    </td> 

                                    <td class="text-center">
                                        @if($application->app_id != '')
                                            @php 
                                                $paid = $daufee->fetchDauFee($i, $application->app_id, $application->reg_date, 'due_date_is_paid', 0, 0);
                                            @endphp
                                        @endif
                                        <label class="m--margin-top-7 m-radio m-radio m-radio--info">
                                            @if($application->app_id != '')
                                                @if($paid == 1)
                                                    <input type="radio" name="dau_paid_{{$i}}" value="1" checked="checked">
                                                @else
                                                    <input type="radio" name="dau_paid_{{$i}}" value="1">
                                                @endif
                                            @else
                                                <input type="radio" name="dau_paid_{{$i}}" value="1">
                                            @endif
                                            Yes
                                            <span></span>
                                        </label>
                                        <label class="m--margin-top-7 m-radio m-radio m-radio--info m--margin-left-10">
                                            @if($application->app_id != '')
                                                @if($paid == 0)
                                                    <input type="radio" name="dau_paid_{{$i}}" value="0" checked="checked">
                                                @else
                                                    <input type="radio" name="dau_paid_{{$i}}" value="0">
                                                @endif
                                            @else
                                                <input type="radio" name="dau_paid_{{$i}}" value="0" checked="checked">
                                            @endif
                                            No
                                            <span></span>
                                        </label>
                                    </td>
                                    
                                    <td class="text-center">&nbsp;</td>
                                </tr>
                            @php
                            $i = $i + 2;
                            @endphp
                            @endwhile

                            @if($application->app_id != '')
                                @php
                                    $renewals = $daufee->fetchRenewalDauFee($application->app_id, 1, 0);
                                @endphp
                                
                                @if(!empty($renewals))
                                    @foreach ($renewals as $renewal)
                                    <tr data-row-id="{{ $renewal->due_date_year }}">
                                        <td class="text-center">
                                            <label class="m--margin-top-7">Renewal</label>
                                        </td>
                                        <td class="hidden"><input name="dau_identification[]" value="{{ $renewal->due_date_year }}"></td>
                                        <td class="hidden"><input name="renewal_{{ $renewal->due_date_year }}" value="1"></td>
                                        <td class="hidden"><input name="dau_due_date_{{ $renewal->due_date_year }}" class="duedate" value="{{ $renewal->due_date }}"></td>
                                        <td>
                                            <input id="dau_due_date_clone_{{ $renewal->due_date_year }}" class="duedateclone text-center form-control m-input m-input--solid date-picker" placeholder="" name="dau_due_date_clone_{{ $renewal->due_date_year }}" type="text" value="{{ date('d/m/Y', strtotime($renewal->due_date)) }}"></td>
                                        <td>
                                            <input id="dau_fee_{{ $renewal->due_date_year }}" class="text-center form-control m-input m-input--solid numeric-double" placeholder="" name="dau_fee_{{ $renewal->due_date_year }}" type="text" value="{{ $renewal->due_date_fee }}">
                                        </td>
                                        <td class="text-center">
                                            <label class="m--margin-top-7 m-radio m-radio m-radio--info">
                                                @if($renewal->due_date_is_paid == 1)
                                                    <input type="radio" name="dau_paid_{{ $renewal->due_date_year }}" value="1" checked="checked">Yes
                                                @else
                                                    <input type="radio" name="dau_paid_{{ $renewal->due_date_year }}" value="1">Yes
                                                @endif
                                                <span></span>
                                            </label>
                                            <label class="m--margin-top-7 m-radio m-radio m-radio--info m--margin-left-10">
                                                @if($renewal->due_date_is_paid == 0)
                                                    <input type="radio" name="dau_paid_{{ $renewal->due_date_year }}" value="0" checked="checked">No
                                                @else
                                                    <input type="radio" name="dau_paid_{{ $renewal->due_date_year }}" value="0">No
                                                @endif
                                                <span></span>
                                            </label>
                                        </td>
                                        <td><button id="remove-dau" type="button" class="btn"><i class="la la-minus"></i></button></td>
                                    </tr>
                                    @endforeach
                                @endif
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <button id="add-more-renewal" type="button" class="btn btn-brand">
                                        <i class="la la-plus"></i>&nbsp;Add more renewal
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <div id="renewal_dau_fees_layer" class="row">
            <div class="col-xl-12">
                <div class="table-reponsive">
                    <table id="renewal_dau_table" class="table">
                        <thead>
                            <th class="text-center"><strong>DAU</strong></th>
                            <th class="text-center"><strong>Due Date</strong></th>
                            <th class="text-center"><strong>DAU Fee</strong></th>
                            <th class="text-center"><strong>is Paid?</strong></th>
                            <th class="text-center">&nbsp;</th>
                        </thead>
                        <tbody>
                            @if($application->app_id != '')
                                @php
                                    $renewal_daus = $daufee->fetchRenewalDauFee($application->app_id, 0, 1);
                                @endphp

                                @if(!empty($renewal_daus))
                                    @foreach ($renewal_daus as $daus)
                                        <tr data-row-id="{{ $daus->due_date_year }}">
                                            <td class="text-center"><label class="m--margin-top-7">Renewal DAU</label></td>
                                            <td class="hidden"><input name="renewal_dau_identification[]" value="{{ $daus->due_date_year }}"></td>
                                            <td class="hidden"><input name="renewal_dau_{{ $daus->due_date_year }}" value="1"></td>
                                            <td class="hidden"><input name="renewal_dau_due_date_{{ $daus->due_date_year }}" class="duedate_renewal" value="{{ $daus->due_date }}"></td>
                                            <td>
                                                <input id="renewal_dau_due_date_clone_{{ $daus->due_date_year }}" class="duedateclone_renewal text-center form-control m-input m-input--solid date-picker" placeholder="" name="renewal_dau_due_date_clone_{{ $daus->due_date_year }}" type="text" value="{{ date('d/m/Y', strtotime($daus->due_date)) }}">
                                            </td>
                                            <td>
                                                <input id="renewal_dau_fee_{{ $daus->due_date_year }}" class="text-center form-control m-input m-input--solid numeric-double" placeholder="" name="renewal_dau_fee_{{ $daus->due_date_year }}" type="text" value="{{ $daus->due_date_fee }}">
                                            </td>
                                            <td class="text-center">
                                                <label class="m--margin-top-7 m-radio m-radio m-radio--info">
                                                    @if($daus->due_date_is_paid == 1)
                                                        <input type="radio" name="renewal_dau_paid_{{ $daus->due_date_year }}" value="1" checked="checked">Yes
                                                    @else
                                                        <input type="radio" name="renewal_dau_paid_{{ $daus->due_date_year }}" value="1">Yes
                                                    @endif
                                                    <span></span>
                                                </label>
                                                <label class="m--margin-top-7 m-radio m-radio m-radio--info m--margin-left-10">
                                                    @if($daus->due_date_is_paid == 0)
                                                        <input type="radio" name="renewal_dau_paid_{{ $daus->due_date_year }}" value="0" checked="checked">No
                                                    @else
                                                        <input type="radio" name="renewal_dau_paid_{{ $daus->due_date_year }}" value="0">No
                                                    @endif
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td><button id="remove-renewal-dau" type="button" class="btn"><i class="la la-minus"></i></button></td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <button id="add-more-renewal-dau" type="button" class="btn btn-brand">
                                        <i class="la la-plus"></i>&nbsp;Add more renewal DAU
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="form-group m-form__group m--margin-top-10 m--margin-bottom-20">
                    <div class="alert m-alert m-alert--default" role="alert">
                        Note that if selected to 
                        <code>
                            yes
                        </code>
                        the trademark application will serve as completed and cannot be modify othewise leave it no
                        <label class="m-radio m--margin-left-10 m-radio m-radio--info">
                            <input type="radio" name="completed" value="Yes">
                            Yes
                            <span></span>
                        </label>
                        <label class="m-radio m-radio m-radio--info">
                            <input type="radio" name="completed" value="No" checked="checked">
                            No
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of form5 -->

</form>
