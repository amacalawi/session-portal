<h6 class="m--margin-bottom-10">
    <i class="flaticon-interface-4"></i> 
    <strong>Application No.:</strong> 
    <strong class="m--font-warning app_no">{{ $application->app_no }}</strong>
</h6>
<h6 class="m--margin-bottom-10">
	<i class="flaticon-information"></i> <strong>Title:</strong> 
	<em class="m--font-metal app_title">{{ $application->app_title }}</em>
</h6>
<h6 class="m--margin-bottom-10">
	<i class="flaticon-calendar-3"></i> 
	<strong>Filing Date:</strong> 
	<span class="app_filing_date">
		{{ (!empty($application->app_filing_date)) ? date('d-M-Y', strtotime($application->app_filing_date)) : '' }}
	</span>
</h6>
<h6 class="m--margin-bottom-10">
	<i class="flaticon-users"></i> 
	<strong>Applicants:</strong> 
	<em class="m--font-info app_applicants">{{ !empty($application->app_applicants) ? implode(', ', json_decode($application->app_applicants)) : '' }}</em>
</h6>
<h6 class="m--margin-bottom-10">
	<i class="flaticon-users"></i> 
	<strong>inventors:</strong> 
	<em class="m--font-info app_inventors">{{ !empty($application->app_inventors) ? implode(', ', json_decode($application->app_inventors)) : '' }}</em>
</h6>
<h6 class="m--margin-bottom-10">
	<i class="flaticon-calendar-3"></i> 
	<strong>Publication Date:</strong> 
	<span class="pub_date">
		{{ (!empty($application->pub_date)) ? date('d-M-Y', strtotime($application->pub_date)) : '' }}
	</span>
</h6>
<h6 class="m--margin-bottom-10">
	<i class="flaticon-attachment"></i> 
	<strong>Attachments:</strong> 
	<em class="m--font-info attachments">
		@if(!empty($application->attached_files)) 
			@php $i = count($application->attached_files); @endphp
			@foreach($application->attached_files as $link)
				<a class="download-file" title="{{ $link['filename'] }}" href="javascript:;">
					{{ $link['filecode'] }} 
				</a>
				@php $last_iteration = !(--$i); print ($last_iteration == 0) ? ',' : '';@endphp
			@endforeach
		@endif
	</em>
</h6>

<div class="m-widget25--progress m--margin-top-25 m--margin-bottom-5">
	<div class="m-widget25__progress">
		<span class="m-widget25__progress-number">
			0%
		</span>
		<div class="m--space-10"></div>
		<div class="progress m-progress--sm">
			<div class="progress-bar m--bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<span class="m-widget25__progress-sub">
			Progress Growth
		</span>
	</div>
</div>

<div class="m-widget4 m-widget4--chart-bottom" style="min-height: 230px">
	<div class="m-widget4__item">
		<div class="m-widget4__ext">
			<a href="#" class="m-widget4__icon m--font-brand">
				<i class="flaticon-coins"></i>
			</a>
		</div>
		<div class="m-widget4__info">
			<span class="m-widget4__text">
				Amount Revenue
			</span>
		</div>
		<div class="m-widget4__ext">
			<span class="m-widget4__stats m--font-danger">
				<span id="totalAppAmount" class="m-widget4__number m--font-danger">
					₱{{ $application->total_amount }}
				</span>
			</span>
		</div>
	</div>
	<div class="m-widget4__item">
		<div class="m-widget4__ext">
			<a href="#" class="m-widget4__icon m--font-brand">
				<i class="flaticon-line-graph"></i>
			</a>
		</div>
		<div class="m-widget4__info">
			<span class="m-widget4__text">
				Status
			</span>
		</div>
		<div class="m-widget4__ext">
			<span class="m-widget4__stats m--font-info">
				<span class="m-widget4__number {{ $application->app_status }}-text text-capitalize">
					{{ $application->app_status }}
				</span>
			</span>
		</div>
	</div>
	<div class="m-widget4__chart m-portlet-fit--sides m--margin-top-20 m-portlet-fit--bottom1" style="height:120px;">
		<div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
		<canvas id="m_chart_latest_updates" width="477" height="150" class="chartjs-render-monitor" style="display: block; height: 120px; width: 382px;"></canvas>
	</div>
</div>