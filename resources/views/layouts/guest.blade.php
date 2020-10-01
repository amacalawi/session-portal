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
									var image = new Image(); 
									image.src = path + '/' + v + '.jpg';
									if (image.width == 0) {
										$('#custom-pic img').attr('src', path + '/' + v + '.JPG');
									}
								}
                                $('body').find('span[name=' + k + ']').text(v);
                            });
							setTimeout(function(){ 
								location.replace("http://dioceseofantipolo.net/e/position/nsdaps/4");
							}, 4000);
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
				if ($('.camera-layer2').hasClass('hidden')) {
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
				} else {
					if ($('#id_number').val() != '' && $('input[name="otp_1"]').val() != '' && $('input[name="otp_2"]').val() != '' && $('input[name="otp_3"]').val() != '' && $('input[name="otp_4"]').val() != '' && $('input[name="otp_5"]').val() != '') {
						self.toggleClass("active");

						if (self.attr('action-taken') == 'signin') {
							$('.action-btn[action-taken="signout"]').removeClass('active');
						} else {
							$('.action-btn[action-taken="signin"]').removeClass('active');
						}
						
						var action = $('.action-btn.active').attr('action-taken');
						var path = $('#custom-pic img').attr('link');
						var otp = $('input[name="otp_1"]').val() + '' +$('input[name="otp_2"]').val() + '' + $('input[name="otp_3"]').val() + '' + $('input[name="otp_4"]').val() + '' + $('input[name="otp_5"]').val();
						console.log(base_url + 'scan-otp?id='+ $('#id_number').val() +'&action=' + action);
						$.ajax({
							url: base_url + 'scan-otp?id='+ $('#id_number').val() +'&otp=' + otp + '&action=' + action,
							type: "GET",
							success: function (data) { 
								var res = $.parseJSON(data);   
								console.log(res);
								if (res.type == 'success') {
									$('.camera-layer').addClass('hidden');
									$('.camera-layer2').removeClass('hidden');
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
											var image = new Image(); 
											image.src = path + '/' + v + '.jpg';
											if (image.width == 0) {
												$('#custom-pic img').attr('src', path + '/' + v + '.JPG');
											}
										}
										$('body').find('span[name=' + k + ']').text(v);
									});
									setTimeout(function(){ 
										location.replace("http://dioceseofantipolo.net/e/position/nsdaps/4");
									}, 4000);
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
					} else {
						$('#try_again')[0].play();
					}
				}
			});

			$("body #request-otp-btn").click(function(e){
				e.preventDefault();
				if ($('#id_number').val() != '') {
					console.log(base_url + 'request-otp?id_number='+ $('#id_number').val());
					$.ajax({
						url: base_url + 'request-otp?id_number='+ $('#id_number').val(),
						type: "GET",
						success: function (data) { 
							var res = $.parseJSON(data); 
							console.log(res);
							if (res.type == 'success') {
								$('#id_number').prop('disabled', true);
								$('#request-otp-btn').prop('disabled', true);
							}
						}
					});
				}
			})

			$(':input.box').keydown(function(e) {
				if ((e.which == 8 || e.which == 46) && $(this).val() =='') {
					$(this).prev('input').focus();
				}
				if ($(this).val() != '') {
					$(this).next('input').focus();
				}
			});

			$.fn.extend({
				toggleText: function(a, b){
					if (this.text() == b) {
						$('.camera-layer').addClass('hidden');
						$('.camera-layer2').removeClass('hidden');
					} else {
						$('.camera-layer').removeClass('hidden');
						$('.camera-layer2').addClass('hidden');
						$('#id_number').val('').prop('disabled', false);
						$('#request-otp-btn').prop('disabled', false);
						$('input[name="otp_1"]').val(''); $('input[name="otp_2"]').val('');
						$('input[name="otp_3"]').val(''); $('input[name="otp_4"]').val('');
						$('input[name="otp_5"]').val('');
					}
					return this.text(this.text() == b ? a : b);
				}
			});

			$('.qr-problem').click(function(e) {
				var self = $(this);
				$(this).toggleText('use QR Code?', 'having problem with QR Code?');
			});
		  </script>

		@stack('scripts')
	</body>
</html>
