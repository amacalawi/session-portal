@if (\Request::is('dashboard'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    Dashboard
                </h3>
            </div>
            <div>
                <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                    <span class="m-subheader__daterange-label">
                        <span class="m-subheader__daterange-title"></span>
                        <span class="m-subheader__daterange-date m--font-brand"></span>
                    </span>
                    <a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="la la-angle-down"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Patent Application
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="{{ url('/applications/add') }}" id="new-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-file-1"></i>New Application
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/add') || \Request::is('applications/edit/*'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Patent Application
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ url('/applications') }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                @if (\Request::is('applications/edit/*'))
                                Edit Application
                                @else
                                New Application
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="#" id="save-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-folder-2"></i>Save Changes
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/patents'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Patents
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="{{ url('/applications/patents/add') }}" id="new-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-file-1"></i>New Application
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/patents/add') || \Request::is('applications/patents/edit/*'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Patents
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ url('/applications/patents') }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                @if (\Request::is('applications/patents/edit/*'))
                                Edit Patent
                                @else
                                New Patent
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                @if ($application->is_completed == 0) 
                <span class="m-subheader__daterange">
                    <a href="#" id="save-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-folder-2"></i>Save Changes
                    </a>
                </span>
                @endif
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/utility-models'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Utility Models
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="{{ url('/applications/utility-models/add') }}" id="new-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-file-1"></i>New Application
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/utility-models/add') || \Request::is('applications/utility-models/edit/*'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Utility Models
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ url('/applications/utility-models') }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                @if (\Request::is('applications/utility-models/edit/*'))
                                Edit Utility Model
                                @else
                                New Utility Model
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="#" id="save-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-folder-2"></i>Save Changes
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/trademarks'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Trademarks
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="{{ url('/applications/trademarks/add') }}" id="new-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-file-1"></i>New Application
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/trademarks/add') || \Request::is('applications/trademarks/edit/*'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Trademarks
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ url('/applications/trademarks') }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                @if (\Request::is('applications/trademarks/edit/*'))
                                Edit Trademark
                                @else
                                New Trademark
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="#" id="save-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-folder-2"></i>Save Changes
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('resources/categories'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Patent Categories
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- <div>
                <span class="m-subheader__daterange">
                    <a href="{{ url('/applications/add') }}" id="new-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-file-1"></i>New Application
                    </a>
                </span>
            </div> -->
        </div>
    </div>
@elseif (\Request::is('resources/categories/add') || \Request::is('resources/categories/edit/*'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Patent Categories
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ url('/resources/categories') }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                @if (\Request::is('resources/categories/edit/*'))
                                Edit Category
                                @else
                                New Category
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="#" id="save-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-folder-2"></i>Save Changes
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('resources/status'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Patent Status
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- <div>
                <span class="m-subheader__daterange">
                    <a href="{{ url('/applications/add') }}" id="new-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-file-1"></i>New Application
                    </a>
                </span>
            </div> -->
        </div>
    </div>
@elseif (\Request::is('resources/status/add') || \Request::is('resources/status/edit/*'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Patent Status
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ url('/resources/status') }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                @if (\Request::is('resources/status/edit/*'))
                                Edit Status
                                @else
                                New Status
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="#" id="save-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-folder-2"></i>Save Changes
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/copyrights'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Copyrights
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="{{ url('/applications/copyrights/add') }}" id="new-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-file-1"></i>New Application
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/copyrights/add') || \Request::is('applications/copyrights/edit/*'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Copyrights
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ url('/applications/copyrights') }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                @if (\Request::is('applications/copyrights/edit/*'))
                                Edit Copyrights
                                @else
                                New Copyright
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="#" id="save-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-folder-2"></i>Save Changes
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/industrial-designs'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Industrial Designs
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="{{ url('/applications/industrial-designs/add') }}" id="new-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-file-1"></i>New Application
                    </a>
                </span>
            </div>
        </div>
    </div>
@elseif (\Request::is('applications/industrial-designs/add') || \Request::is('applications/industrial-designs/edit/*'))  
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Industrial Designs
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ url('/') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ url('/applications/industrial-designs') }}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Manage
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">
                                @if (\Request::is('applications/industrial-designs/edit/*'))
                                Edit Industrial Design
                                @else
                                New Industrial Design
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <span class="m-subheader__daterange">
                    <a href="#" id="save-btn" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="fa flaticon-folder-2"></i>Save Changes
                    </a>
                </span>
            </div>
        </div>
    </div>
@endif
