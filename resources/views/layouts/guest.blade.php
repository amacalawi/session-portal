<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>
			Session Portal
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--begin::Base Styles -->  
		<link href="{{ asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/demo/demo7/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{ asset('assets/demo/demo7/media/img/logo/favicon.ico') }}" />
		@stack('styles')
		<script>
            var base_url = "{{ url('/') }}/";
            var _token = "{{ csrf_token() }}";
        </script>
	</head>
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<main>
			@yield('content')
		</main>
		<!-- end:: Page -->

    	<!--begin::Base Scripts -->
		<script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/demo/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
		<!--end::Base Scripts -->   
        <!--begin::Page Snippets -->
		<script src="{{ asset('assets/demo/demo/snippets/pages/user/login.js') }}" type="text/javascript"></script>
		<!--end::Page Snippets -->
		<script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/instascan.min.js') }}" type="text/javascript"></script>
		<script type="text/javascript">
			let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
			scanner.addListener('scan', function (content) {
				console.log('scanned: ' + content);
				var action = $('.action-btn.active').attr('action-taken');
				var path = $('#custom-pic img').attr('link');
				console.log(base_url + 'scan?id='+ content +'&action=' + action);
			 	$.ajax({
					url: base_url + 'scan?id='+ content +'&action=' + action,
					type: "GET",
					success: function (data) { 
						var res = $.parseJSON(data);   
						console.log(res);
						if (res.type == 'success') {
							$('#access_granted')[0].play();
							$('#preview').addClass("hidden");
							$('#custom-pic').removeClass('hidden');
							$('#dummy-pic').removeClass('hidden');
							if (action == 'signin') {
								$('span.actions').text('signed in');
							} else {
								$('span.actions').text('signed off');
							}
							$('div.alert-danger').fadeIn();
							$.each(res.data[0], function (k, v) {
								if (k == 'stud_no') {
									$('#custom-pic img').attr('src', path + '/' + v + '.jpg');
									// check if image is exist
									var image = new Image(); 
									image.src = path + '/' + v + '.jpg';
									if (image.width == 0) {
										$('#custom-pic img').attr('src', path + '/' + v + '.JPG');
									}
								}
                                $('body').find('span[name=' + k + ']').text(v);
                            });
							// setTimeout(function(){ 
							// 	location.replace("http://dioceseofantipolo.net/e/position/nsdaps/4");
							// }, 4000);
						} else {
							$('#try_again')[0].play();
							$('#preview').addClass("hidden");
							$('#custom-pic').addClass('hidden');
							$('#dummy-pic').removeClass('hidden');
						}
					},
					complete: function (data) {
						Instascan.Camera.getCameras().then(function (cameras) {
							if (cameras.length > 0) {
								scanner.stop(cameras[0]);
								$('.action-btn').removeClass('active');
							} else {
								console.error('No cameras found.');
							}
						}).catch(function (e) {
							console.error(e);
						});
					},	
					async: false
				});
			});
			$( "body .action-btn" ).click(function() {
				var self = $(this);
				self.toggleClass("active");
				$('#custom-pick').addClass("hidden");
				$('div.alert-danger').fadeOut();

				if (self.attr('action-taken') == 'signin') {
					$('.action-btn[action-taken="signout"]').removeClass('active');
				} else {
					$('.action-btn[action-taken="signin"]').removeClass('active');
				}

				if (self.hasClass('active')) {
					Instascan.Camera.getCameras().then(function (cameras) {
						if (cameras.length > 0) {
							scanner.start(cameras[0]); 
							$('#preview').removeClass("hidden");
							$('#dummy-pic').addClass('hidden');
							$('#custom-pic').addClass('hidden');
						} else {
							console.error('No cameras found.');
						}
					}).catch(function (e) {
						console.error(e);
					});
				} else {
					Instascan.Camera.getCameras().then(function (cameras) {
						if (cameras.length > 0) {
							scanner.stop(cameras[0]);
							$('#preview').addClass("hidden");
							$('#dummy-pic').removeClass('hidden');
							$('#custom-pic').addClass('hidden');
						} else {
							console.error('No cameras found.');
						}
					}).catch(function (e) {
						console.error(e);
					});
				}
			});
		  </script>

		@stack('scripts')
	</body>
</html>
