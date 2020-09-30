<form type="POST" class="m-form m-form--label-align-left- m-form--state-" id="m_form" enctype="multipart/form-data">
    <!-- form 1 -->
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
            <div class="col-xl-4">
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
            <div class="col-xl-4">
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
            <div class="col-xl-4">
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
        </div>
        <div class="row">
            <div class="col-xl-4">
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
            <div class="col-xl-4">
                <div class="form-group m-form__group required">
                    {{ Form::label('app_inventors', 'Inventors', ['class' => '']) }}
                    {{ 
                        Form::select('app_inventors[]', $application->app_inventors, $application->app_inventors, 
                            [   
                                'id' => 'inventors',
                                'class' => 'form-control m-select2',
                                'multiple' => 'multiple'
                            ]
                        )

                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
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
        </div>
        <div class="row">
            <div class="col-xl-6">
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
            <div class="col-xl-6">
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

    <!-- form 2 -->
    <div class="m-wizard__form-step" id="m_wizard_form_step_2">
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

    <!-- form 3 -->
    <div class="m-wizard__form-step" id="m_wizard_form_step_3">
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

    <!-- form 5 -->
    <div class="m-wizard__form-step" id="m_wizard_form_step_5">
        <div class="row">
            <div class="col-xl-4">
                <div class="form-group m-form__group required">
                    {{ Form::label('issuance_date', 'Issuance Date', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'issuance_date', $value = $application->issuance_date, 
                        $attributes = array(
                            'id' => 'issuance_date',
                            'class' => 'form-control m-input m-input--solid date-picker',
                            'placeholder' => 'Enter issuance date'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group m-form__group">
                    {{ Form::label('allow_amount_file', 'Government Fees', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'allow_amount_file', $value = $application->allow_amount_file, 
                        $attributes = array(
                            'id' => 'allow_amount_file',
                            'class' => 'form-control m-input m-input--solid numeric-double',
                            'placeholder' => 'Enter government fees'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-group m-form__group">
                    {{ Form::label('professional_fee5', 'Professional Fees', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'professional_fee5', $value = $application->professional_fee5, 
                        $attributes = array(
                            'id' => 'professional_fee5',
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
                    {{ Form::label('allow_remarks', 'Remarks', ['class' => '']) }}
                    {{ 
                        Form::textarea($name = 'allow_remarks', $value = $application->allow_remarks, 
                        $attributes = array(
                            'id' => 'allow_remarks',
                            'class' => 'form-control m-input m-input--solid date-picker',
                            'placeholder' => '',
                            'rows' => 3
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="form-group m-form__group">
                    {{ Form::label('allow_file', 'File Browser', ['class' => '']) }}
                    <div class="custom-file">
                        {{ Form::file('allow_file', 
                            $attributes = 
                            [   
                                'id' => 'customFile',
                                'class' => 'custom-file-input' 
                            ]) 
                        }}
                        <label class="custom-file-label" for="customFile">
                            {{ $application->allow_file_label }}
                        </label>
                    </div>
                    <span class="m-form__help form-control-feedback"></span>
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
                        the patent application will serve as completed and cannot be modify othewise leave it no
                        <label class="m-radio m-radio m-radio--info">
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
</form>
