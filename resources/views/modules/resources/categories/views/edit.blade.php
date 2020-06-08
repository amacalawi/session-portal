@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <!--begin:: Widgets/Best Sellers-->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Category Form
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                @include('forms.categories')
            </div>
        </div>
        <!--end:: Widgets/Best Sellers-->
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/categories.js') }}" type="text/javascript"></script>
@endpush
