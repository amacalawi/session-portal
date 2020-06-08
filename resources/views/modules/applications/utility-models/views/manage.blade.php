@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            All Utility Models - <span class="breadcrumb-title">Manage</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-wizard m-wizard--1 m-wizard--info m-wizard--step-first" id="m_wizard">
                    <div class="row m--margin-top-10">
                        <div class="col-xl-12">
                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-35">
                                <div class="row align-items-center">
                                    <div class="col-xl-12 order-2 order-xl-1">
                                        <div class="form-group m-form__group row align-items-center">
                                            <div class="col-md-6">
                                                <div class="m-input-icon m-input-icon--left">
                                                    <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
                                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-search"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="m-form__group m-form__group--inline">
                                                    <div class="m-form__label">
                                                        <label>
                                                            Status:
                                                        </label>
                                                    </div>
                                                    <div class="m-form__control">
                                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_status">
                                                            <option value="">
                                                                All
                                                            </option>
                                                            <option value="1">
                                                                New
                                                            </option>
                                                            <option value="2">
                                                                Processed
                                                            </option>
                                                            <option value="3">
                                                                Published
                                                            </option>
                                                            <option value="5">
                                                                Finalized
                                                            </option>
                                                            <option value="6">
                                                                Completed
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m--margin-top-0">
                        <div class="col-xl-12">
                            <div class="m_datatable" id="local_data"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/custom/components/datatables/base/data-local-utility-models.js') }}" type="text/javascript"></script>
@endpush
