@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-9">
            <!--begin:: Widgets/Best Sellers-->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Trademarks Form - <span class="breadcrumb-title">Client Information</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-wizard m-wizard--1 m-wizard--info" id="m_wizard">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="m-wizard__head">
                                    <div class="m-wizard__progress">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="m-wizard__nav">
                                        <div class="m-wizard__steps">
                                            <div class="m-wizard__step {{ ($application->app_status == 'new') ? 'm-wizard__step--current' : '' }}" data-wizard-target="#m_wizard_form_step_1">
                                                <div class="m-wizard__step-info">
                                                    <a href="javascript:;" class="m-wizard__step-number">
                                                        <span>
                                                            <span>
                                                                1
                                                            </span>
                                                        </span>
                                                    </a>
                                                    <div class="m-wizard__step-line">
                                                        <span></span>
                                                    </div>
                                                    <div class="m-wizard__step-label">
                                                        Client Information
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-wizard__step {{ ($application->app_status == 'processed') ? 'm-wizard__step--current' : '' }}" data-wizard-target="#m_wizard_form_step_2">
                                                <div class="m-wizard__step-info">
                                                    <a href="javascript:;" class="m-wizard__step-number">
                                                        <span>
                                                            <span>
                                                                2
                                                            </span>
                                                        </span>
                                                    </a>
                                                    <div class="m-wizard__step-line">
                                                        <span></span>
                                                    </div>
                                                    <div class="m-wizard__step-label">
                                                        Publication
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-wizard__step {{ ($application->app_status == 'published') ? 'm-wizard__step--current' : '' }}" data-wizard-target="#m_wizard_form_step_3">
                                                <div class="m-wizard__step-info">
                                                    <a href="javascript:;" class="m-wizard__step-number">
                                                        <span>
                                                            <span>
                                                                3
                                                            </span>
                                                        </span>
                                                    </a>
                                                    <div class="m-wizard__step-line">
                                                        <span></span>
                                                    </div>
                                                    <div class="m-wizard__step-label">
                                                        Registrability Report
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-wizard__step {{ ($application->app_status == 'examined') ? 'm-wizard__step--current' : '' }}" data-wizard-target="#m_wizard_form_step_4">
                                                <div class="m-wizard__step-info">
                                                    <a href="javascript:;" class="m-wizard__step-number">
                                                        <span>
                                                            <span>
                                                                4
                                                            </span>
                                                        </span>
                                                    </a>
                                                    <div class="m-wizard__step-line">
                                                        <span></span>
                                                    </div>
                                                    <div class="m-wizard__step-label">
                                                        Registration
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-wizard__step {{ ($application->app_status == 'finalized') ? 'm-wizard__step--current' : '' }}" data-wizard-target="#m_wizard_form_step_5">
                                                <div class="m-wizard__step-info">
                                                    <a href="javascript:;" class="m-wizard__step-number">
                                                        <span>
                                                            <span>
                                                                5
                                                            </span>
                                                        </span>
                                                    </a>
                                                    <div class="m-wizard__step-line">
                                                        <span></span>
                                                    </div>
                                                    <div class="m-wizard__step-label">
                                                        Declaration of Actual Use
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-wizard__form">
                            @include('forms.trademark')
                        </div><!--m-wizzard__form-->
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Best Sellers-->
        </div>
        <div class="col-xl-3">
            <!--begin:: Widgets/Top Products-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Logo
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Widget5-->
                    <div class="m-widget4 m-widget4--chart-bottom app-widget-info" style="height: 192px">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        @if ($application->logo_file != '')
                                            <div id="imagePreview" style="background-image: url({{ asset('images/trademarks/'.$application->app_id.'/'.$application->logo_file) }})">
                                            </div>
                                        @else
                                            <div id="imagePreview">
                                            </div>
                                        @endif
                                    </div>
                                    <a href="#" class="btn btn-danger close-file {{ ($application->logo_file != '') ? '' : 'hidden' }}"><i class="fa fa-close"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Widget 5-->
                </div>
            </div>
            <!--end:: Widgets/Top Products-->

            <!--begin:: Widgets/Top Products-->
            <div class="m-portlet" style="min-height: 225px !important; position: relative;">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Others
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Widget5-->
                    <div class="m-widget4 m-widget4--chart-bottom app-widget-info">
                        @include('modules.applications.trademarks.views.info')        
                    </div>
                    <!--end::Widget 5-->
                </div>
            </div>
            <!--end:: Widgets/Top Products-->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/custom/components/forms/wizard/trademark-wizard.js') }}" type="text/javascript"></script>
@endpush