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
                            Industrial Design Form - <span class="breadcrumb-title">Client Information</span>
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
                                                    Formality Examination Report
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
                                                    Publication
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-wizard__step {{ ($application->app_status == 'finalized' || $application->app_status == 'completed') ? 'm-wizard__step--current' : '' }}" data-wizard-target="#m_wizard_form_step_5">
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
                                                    Allowance
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-wizard__form">
                        @include('forms.industrial-design')
                    </div><!--m-wizzard__form-->
                </div>
            </div>
        </div>
        <!--end:: Widgets/Best Sellers-->
    </div>
    <div class="col-xl-3">
        <!--begin:: Widgets/Top Products-->
        <div class="m-portlet m-portlet--full-height m-portlet--fit" style="min-height: 225px !important; position: relative;">
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
                    @include('modules.applications.industrial-designs.views.info')        
                </div>
                <!--end::Widget 5-->
            </div>
        </div>
        <!--end:: Widgets/Top Products-->
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/custom/components/forms/wizard/industrial-design-wizard.js') }}" type="text/javascript"></script>
@endpush