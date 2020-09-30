//== Class definition

var DatatableDataLocalDemo = function () {
	//== Private functions
 	console.log(base_url + 'applications/utility-models/all');
	// demo initializer
	var demo = function () {
		
		var datatable = $('.m_datatable').mDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
		          read: {
		            // sample GET method
		            method: 'GET',
		            url: base_url + 'applications/utility-models/all',
		            map: function(raw) {
		              // sample data mapping
		              var dataSet = raw;
		              if (typeof raw.data !== 'undefined') {
		                dataSet = raw.data;
		              }
		              return dataSet;
		            },
		          },
		        },

				pageSize: 10
			},

			// layout definition
			layout: {
				theme: 'default', // datatable theme
				class: '', // custom wrapper class
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				// height: 450, // datatable's body's fixed height
				footer: false // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch')
			},

			// inline and bactch editing(cooming soon)
			// editable: false,

			// columns definition
			columns: [{
				field: "AppID",
				title: "#",
				width: 50,
				sortable: false,
				textAlign: 'center',
        		selector: {class: 'm-checkbox--solid m-checkbox--brand'}
			}, {
				field: "AppNo",
				title: "Application No",
				width: 125,
			}, {
				field: "AppTitle",
				title: "Title",
				// responsive: {visible: 'lg'}
			// }, {
			// 	field: "Type",
			// 	title: "Type",
			// 	width: 125,
			// 	// callback function support for column rendering
			// 	template: function (row) {
			// 		var status = {
			// 			1: {'title': 'Utility Patent', 'state': 'danger'},
			// 			2: {'title': 'Provisional Patent', 'state': 'primary'},
			// 			3: {'title': 'Design Patent', 'state': 'accent'},
			// 			4: {'title': 'Plant Patent', 'state': 'warning'}
			// 		};

			// 		if (row.Type != 0) {
			// 			return '<span class="m--font-bold m--font-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
			// 		} else {
			// 			return '';
			// 		}
			// 	}
			}, {
				field: "AppApplicants",
				title: "Applicants",
				width: 125,
			}, {
				field: "FileDate",
				title: "Filing Date / Expiration Date",
				type: "date",
				format: "MM/DD/YYYY"
			}, {
				field: "PubDate",
				title: "Publication Date",
				type: "date",
				format: "MM/DD/YYYY"
            }, {
				field: "IssueDate",
				title: "Issuance Date",
				type: "date",
				format: "MM/DD/YYYY"
			}, {
				field: "AppModified",
				title: "Last Modified",
				type: "number"
			}, {
				field: "Status",
				title: "Status",
				// callback function support for column rendering
				template: function (row) {
					var status = {
						1: {'title': 'New', 'class': 'new-bg'},
						2: {'title': 'Processed', 'class': 'processed-bg'}, 
						3: {'title': 'Published', 'class': 'published-bg'},
						4: {'title': 'Examined', 'class': 'examined-bg'},
						5: {'title': 'Finalized', 'class': 'finalized-bg'},
						6: {'title': 'Completed', 'class': 'completed-bg'}
					};
					return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
				}
			}, {
				field: "Actions",
				width: 70,
				title: "Actions",
				sortable: false,
				overflow: 'visible',
				template: function (row, index, datatable) {
					var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';

					return '\
						<div class="dropdown ' + dropup + '">\
							<a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                <i class="la la-ellipsis-h"></i>\
                            </a>\
						  	<div class="dropdown-menu dropdown-menu-right">\
						    	<a class="dropdown-item" href="' + base_url + 'applications/utility-models/edit/' + row.AppID + '"><i class="la la-edit"></i> Edit Details</a>\
						    	<a class="dropdown-item" href="' + base_url + 'applications/utility-models/delete/' + row.AppID + '"><i class="la la-remove"></i> Remove Details</a>\
						    	\
						  	</div>\
						</div>\
					';
				}
			}]
        });
        
        // <a class="dropdown-item" href="' + base_url + 'applications/view/' + row.AppID + '"><i class="la la-print"></i> Generate Report</a>

		var query = datatable.getDataSourceQuery();

		$('#m_form_status').on('change', function () {
			datatable.search($(this).val(), 'Status');
		}).val(typeof query.Status !== 'undefined' ? query.Status : '');

		// $('#m_form_type').on('change', function () {
		// 	datatable.search($(this).val(), 'Type');
		// }).val(typeof query.Type !== 'undefined' ? query.Type : '');

		$('#m_form_status, #m_form_type').selectpicker();
	};

	return {
		//== Public functions
		init: function () {
			// init dmeo
			demo();
		}
	};
}();

jQuery(document).ready(function () {
	DatatableDataLocalDemo.init();
});