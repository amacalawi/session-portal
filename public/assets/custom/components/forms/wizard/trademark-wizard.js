!function($) {
    "use strict";

    var wizzardS = function() {
        this.$body = $("body");
    };

    var $required = 0; var files = []; var filesName = [];
    var $renewal_dau_iteration = 0, $dau_iteration = 5;

    if (parseFloat($('#dau_table tbody tr:last-child').attr('data-row-id')) > 5) {
        $dau_iteration = parseFloat($('#dau_table tbody tr:last-child').attr('data-row-id')); 
    } else {
        $dau_iteration = 5;    
    }

    if (parseFloat($('#renewal_dau_table tbody tr:last-child').attr('data-row-id')) > 0) {
        $renewal_dau_iteration = parseFloat($('#renewal_dau_table tbody tr:last-child').attr('data-row-id')); 
    } else {
        $renewal_dau_iteration = 0; 
    }

    wizzardS.prototype.validates = function($form)
    {   
        $required = 0;

        $.each($('body .m-wizard__form-step--current').find("input[type='text'], select, textarea"), function(){
               
            if (!($(this).attr("name") === undefined || $(this).attr("name") === null)) {
                if($(this).hasClass("required")){
                    if($(this).is("[multiple]")){
                        if( !$(this).val() || $(this).find('option:selected').length <= 0 ){
                            $(this).closest(".form-group").addClass("has-danger").find(".m-form__help").text("this field is required.");
                            $required++;
                        }
                    } else if($(this).val()=="" || $(this).val()=="0"){
                        if(!$(this).is("select")) {
                            $(this).closest(".form-group").addClass("has-danger").find(".m-form__help").text("this field is required.");
                            $required++;
                        } else {
                            $(this).closest(".form-group").addClass("has-danger").find(".m-form__help").text("this field is required.");
                            $required++;                                          
                        }
                    } 
                }
            }
        });

        $('body').stop().animate({
            scrollTop: $('.has-danger').top - 100
        }, 1500, 'easeInOutExpo');

        return $required;
    },

    wizzardS.prototype.required_fields = function() {

        $('.form-group span.c-red').remove();

        $.each(this.$body.find(".form-group"), function(){
            
            if ($(this).hasClass('required')) {
                $(this).find('label').append('<span class="pull-right c-red">*</span>');            
                $(this).find("input[type='text'], select, textarea").addClass('required');
            } else {
                $(this).find("input[type='text'], select, textarea").removeClass('required');
            }  

        });

    },
    
    wizzardS.prototype.validate_progressbar = function($init) {
        if ($init == 1) {
            var $requires = this.$body.find(".form-group.required").length - 1;
        } else {
            var $requires = this.$body.find(".form-group.required").length;
        }
        var $formgroup = this.$body.find(".form-group.required");
        var $count = 0;
        $.each($formgroup.find('input[type="text"], select, textarea'), function(){
            if ($(this).val() != '') {
                $count++;
            }
        });

        var $percentage = (parseFloat($count) / parseFloat($requires)) * 100;
        if ($percentage > 100) { $percentage = 100; }
        $('.m-widget25__progress-number').text(parseFloat($percentage).toFixed(2) + '%');
        $('.col-xl-3 .progress-bar').css('width', parseFloat($percentage).toFixed(2) +'%').attr('aria-valuenow', parseFloat($percentage).toFixed(2));

        if ($percentage <= 25) { 
            $('.col-xl-3 .progress-bar').removeClass("m--bg-warning").addClass("m--bg-success");
        } else if ($percentage <= 50) {
            $('.col-xl-3 .progress-bar').removeClass("m--bg-success").addClass("m--bg-info");
        } else if ($percentage <= 75) {
            $('.col-xl-3 .progress-bar').removeClass("m--bg-info").addClass("m--bg-warning");
        } else {
            $('.col-xl-3 .progress-bar').removeClass("m--bg-warning").addClass("m--bg-danger");
        }
    },

    wizzardS.prototype.price_separator = function (input) {
        var output = input
        if (parseFloat(input)) {
            input = new String(input); // so you can perform string operations
            var parts = input.split("."); // remove the decimal part
            parts[0] = parts[0].split("").reverse().join("").replace(/(\d{3})(?!$)/g, "$1,").split("").reverse().join("");
            output = parts.join(".");
        }

        return output;
    },

    wizzardS.prototype.do_uploads = function($id) {
        var params = false;
        var data = new FormData();
        $.each(files, function(key, value)
        {   
            data.append(key, value);
        }); 
        
        console.log(data);
        $.ajax({
            type: "POST",
            url: base_url + 'applications/uploads?files=trademarks&id=' + $id,
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);         
                params = true;              
            },
            async: false
        });

        return params;
    },

    wizzardS.prototype.init = function()
    {   
        var wizardEl = $('#m_wizard');
        var formEl = $('#m_form');
        var validator;
        var wizard;
        var stepCurrent = stepStart;
        

        var initWizard = function () {
            //== Initialize form wizard
            console.log(stepStart);
            wizard = wizardEl.mWizard({
                startStep: stepStart,
                clickableSteps: true
            }); 

            //== Validation before going to next page
            wizard.on('beforeNext', function(wizard) {
                var d1 = $.wizzardS.validates('validate');
                if (d1 != 0) {
                    console.log(d1);
                    return false; return false;
                }
                
            });

            //== Change event
            wizard.on('change', function(wizard) {
                console.log(wizard.currentStep);
                var breadcrumb = $.trim($('body .m-wizard__steps .m-wizard__step--current .m-wizard__step-label').html());
                $('.breadcrumb-title').text(breadcrumb);
                mApp.scrollTop();
            });

        }

        var initValidation = function() {
            validator = formEl.validate({
                //== Validate only visible fields
                ignore: ":hidden",

                //== Validation rules
                rules: {
                    //=== Client Information(step 1)
                    //== Client details
                    // application_no: {
                    //     required: true 
                    // },
                    // application_title: {
                    //     required: true 
                    // },
                    // application_filing_date: {
                    //     required: true 
                    // },
                    // application_category: {
                    //     required: true 
                    // },
                    email: {
                        required: true,
                        email: true 
                    },       
                    phone: {
                        required: true,
                        phoneUS: true 
                    },     

                    //== Mailing address
                    address1: {
                        required: true 
                    },
                    city: {
                        required: true 
                    },
                    state: {
                        required: true 
                    },
                    city: {
                        required: true 
                    },
                    country: {
                        required: true 
                    },

                    //=== Client Information(step 2)
                    //== Account Details
                    account_url: {
                        required: true,
                        url: true
                    },
                    account_username: {
                        required: true,
                        minlength: 4
                    },
                    account_password: {
                        required: true,
                        minlength: 6
                    },                

                    //== Client Settings
                    account_group: {
                         required: true
                    },                
                    'account_communication[]': {
                        required: true
                    },

                    //=== Client Information(step 3)
                    //== Billing Information
                    billing_card_name: {
                        required: true
                    },
                    billing_card_number: {
                        required: true,
                        creditcard: true
                    },
                    billing_card_exp_month: {
                        required: true
                    },
                    billing_card_exp_year: {
                        required: true
                    },
                    billing_card_cvv: {
                        required: true,
                        minlength: 2,
                        maxlength: 3
                    },

                    //== Billing Address
                    billing_address_1: {
                        required: true
                    },
                    billing_address_2: {
                        
                    },
                    billing_city: {
                        required: true
                    },
                    billing_state: {
                        required: true
                    },
                    billing_zip: {
                        required: true,
                        number: true
                    },
                    billing_delivery: {
                        required: true
                    },

                    //=== Confirmation(step 4)
                    accept: {
                        required: true
                    }
                },

                //== Validation messages
                messages: {
                    'account_communication[]': {
                        required: 'You must select at least one communication option'
                    },
                    accept: {
                        required: "You must accept the Terms and Conditions agreement!"
                    } 
                },
                
                //== Display error  
                invalidHandler: function(event, validator) {     
                    mApp.scrollTop();

                    swal({
                        "title": "", 
                        "text": "There are some errors in your submission. Please correct them.", 
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                    });
                },

                //== Submit valid form
                submitHandler: function (form) {
                    
                }
            });   
        }

        var initSubmit = function() {
            var btn = formEl.find('[data-wizard-action="submit"]');

            btn.on('click', function(e) {
                e.preventDefault();

                if (validator.form()) {
                    //== See: src\js\framework\base\app.js
                    mApp.progress(btn);
                    //mApp.block(formEl); 

                    //== See: http://malsup.com/jquery/form/#ajaxSubmit
                    formEl.ajaxSubmit({
                        success: function() {
                            mApp.unprogress(btn);
                            //mApp.unblock(formEl);

                            swal({
                                "title": "", 
                                "text": "The application has been successfully submitted!", 
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                            });
                        }
                    });
                }
            });
        }

        initWizard(); 
        initValidation();
        initSubmit();
            
        function readURL(input) {
            if (input.files && input.files[0]) {
                var self = input.files[0];
                var closeFile = $('.close-file');
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
        
                console.log(self);
                if (self.length != 0) {
                    closeFile.removeClass('hidden');
                } else {
                    closeFile.addClass('hidden');
                }
            }
        }

        $("#imageUpload").change(function() {
            readURL(this);
        });
        
        $('body').on('click', '.close-file', function (e) {
            e.preventDefault();
            var $self = $(this);
            $self.addClass('hidden');
            
            var file = document.querySelector('#imageUpload');
            var emptyFile = document.createElement('input');
            emptyFile.type = 'file';
            file.files = emptyFile.files;

            $('#imagePreview').css('background-image', '');

            $.each(filesName, function (ix) {
                if (filesName[ix] == 'avatar') {
                    filesName.splice(ix, 1);
                    files.splice(ix, 1);
                    return false;
                }
            });
            console.log(filesName);
        });

        
        $('input[type="file"]').on('change', prepareUpload);                 
        function prepareUpload(event)
        {       
            var self = event.target;
            if (event.target.files[0] != '' && event.target.files[0] !== undefined) {
                var found = false;
                for (var i = 0; i < filesName.length; i++) {
                    if (filesName[i] == event.target.name) {
                        found = true;
                        break; break;
                    }
                }

                if (found == true) {
                    files[i] = event.target.files[0];
                } else {
                    filesName.push(event.target.name);
                    files.push(event.target.files[0]);
                }
            } else {
                $.each(filesName, function (ix) {
                    if (filesName[ix] == event.target.name) {
                        filesName.splice(ix, 1);
                        files.splice(ix, 1);
                        console.log(self);
                        return false;
                    }
                });
            }

            if (event.target.name != 'avatar') {
                prepend_file();
            }
            console.log(filesName);
            console.log(files);
        } 

        function prepend_file() {
            var $counter = 0; $('.attachments').empty();
            $.each($('input[type="file"]'), function (ix) {
                var $files = $(this);
                var text = $(this).val();
                var $filename = text.substring(text.lastIndexOf("\\") + 1, text.length);
                
                if ($files.val() != '') {
                    $counter++;
                    if ($counter > 1) {
                        $('.attachments').append('<a class="download-file" title="' + $filename + '" href="javascript:;">, file ' + (ix + 1) + '</a>');
                    } else {
                        $('.attachments').append('<a class="download-file" title="' + $filename + '" href="javascript:;">file ' + (ix + 1) + '</a>');
                    }
                }
            });
        }

        /*
        | ---------------------------------
        | # select, input, and textarea on change or keyup remove error
        | ---------------------------------
        */
        this.$body.on('keypress', '.numeric-double', function (event) {
            var $this = $(this);
            if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
                ((event.which < 48 || event.which > 57) &&
                    (event.which != 0 && event.which != 8))) {
                event.preventDefault();
            }
    
            var text = $(this).val();
            if ((event.which == 46) && (text.indexOf('.') == -1)) {
                setTimeout(function () {
                    if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                        $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                    }
                }, 1);
            }
    
            if ((text.indexOf('.') != -1) &&
                (text.substring(text.indexOf('.')).length > 2) &&
                (event.which != 0 && event.which != 8) &&
                ($(this)[0].selectionStart >= text.length - 2)) {
                event.preventDefault();
            }
        });

        this.$body.on('blur', '.numeric-double', function (event) {
            var $total = 0;
            $.each($('.numeric-double'), function(){
                var $self = $(this);
                if ($self.val() != '' && $self.val() > 0) {
                    $total += parseFloat($self.val());
                }
            });
            $('#totalAppAmount').text($.wizzardS.price_separator(parseFloat($total).toFixed(2)));
            console.log($total);
        });


        this.$body.on('change', 'select, input', function (e) {
            e.preventDefault();
            var self = $(this);
            self.closest(".form-group").removeClass("has-danger").find(".form-control-feedback").text("");
        });
        this.$body.on('dp.change', '.date-picker, .time-picker', function (e){
            e.preventDefault();
            var self = $(this);
            $(this).closest(".form-group").removeClass("has-danger").find(".form-control-feedback").text("");
            $.wizzardS.validate_progressbar(0);
        });

        this.$body.on('keyup', 'input, textarea', function (e) {
            e.preventDefault();
            var self = $(this);
            $(this).closest(".form-group").removeClass("has-danger").find(".form-control-feedback").text("");
        });
        this.$body.on('blur', 'input, textarea', function (e) {
            e.preventDefault();
            var self = $(this);
            self.closest(".form-group").removeClass("has-danger").find(".form-control-feedback").text("");
            $.wizzardS.validate_progressbar(0);
        });

        /*
        | ---------------------------------
        | # formality examination report mailing date on blur
        | ---------------------------------
        */
        this.$body.on('blur', 'input[name="sub_mailing_date1"]', function (e){
            var self = $(this);
            if (self.val() != '') {
                $('input[name="sub_amount_file1"]').prop('disabled', false).closest('.form-group').removeClass('required');
                $('input[name="professional_fee2_1"]').prop('disabled', false).closest('.form-group').removeClass('required');
                $.wizzardS.required_fields();
            }
        });

        /*
        | ---------------------------------
        | # formality examination report subsequent input checkbox
        | ---------------------------------
        */
        this.$body.on('click', 'input[name="fer_yes_no"]', function (e) {
            var self = $(this);
            if (self.val() == 'Yes') {
                $('.subsequent-form-2').removeClass('hidden');
                $('.subsequent-form-1').find('input').prop('disabled', true);
                $('input[name="sub_paper_no1"], input[name="sub_mailing_date1"], input[name="sub_filing_date1"]').closest('.form-group').removeClass('required').find('.m-form__help').text('');
                $('input[name="sub_paper_no2"], input[name="sub_mailing_date2"]').closest('.form-group').addClass('required').find('.m-form__help').text('');
                if ($('input[name="sub_mailing_date2"]').val() != '') {
                    $('input[name="sub_filing_date2"]').closest('.form-group').addClass('required').find('.m-form__help').text('');
                }
                $.wizzardS.required_fields();
            } else {
                $('.subsequent-form-2').addClass('hidden');
                $('.subsequent-form-1').find('input').prop('disabled', false);
                $('input[name="sub_paper_no1"], input[name="sub_mailing_date1"]').closest('.form-group').addClass('required').find('.m-form__help').text('');
                $('input[name="sub_paper_no2"], input[name="sub_mailing_date2"], input[name="sub_filing_date2"]').closest('.form-group').removeClass('required').find('.m-form__help').text('');
                if ($('input[name="sub_mailing_date1"]').val() != '') {
                    $('input[name="sub_filing_date1"]').closest('.form-group').addClass('required').find('.m-form__help').text('');
                }
                $.wizzardS.required_fields();
            }
        });

        /*
        | ---------------------------------
        | # formality examination report subsequent mailing date on blur
        | ---------------------------------
        */
        this.$body.on('blur', 'input[name="sub_mailing_date2"]', function (e){
            var self = $(this);
            if (self.val() != '') {
                $('input[name="sub_amount_file2"]').prop('disabled', false).closest('.form-group').removeClass('required');
                $('input[name="professional_fee2_1"]').prop('disabled', false).closest('.form-group').removeClass('required');
                $.wizzardS.required_fields();
            }
        });

        /*
        | ---------------------------------
        | # substantive examination report filing date on blur
        | ---------------------------------
        */
        this.$body.on('blur', 'input[name="subs_filing_date1"]', function (e){
            var self = $(this);
            if (self.val() != '') {
                $('input[name="subs_paper_no1"]').prop('disabled', false).closest('.form-group').removeClass('required');
                $('input[name="subs_mailing_date1"]').prop('disabled', false).closest('.form-group').addClass('required');
                $.wizzardS.required_fields();
            }
        });

        /*
        | ---------------------------------
        | # substantive examination report subsequent input checkbox
        | ---------------------------------
        */
        this.$body.on('click', 'input[name="subsequent_checklist_form_4"]', function (e) {
            var self = $(this);
            if (self.val() == 'Yes') {
                $('.subsequent-form-4-2').removeClass('hidden');
                $('.subsequent-form-4-1').find('input').prop('disabled', true);
                $('input[name="subs_amount_file2"], input[name="subs_filing_date2"]').closest('.form-group').addClass('required');
                $('input[name="subs_amount_file2"], input[name="subs_filing_date2"]').prop('disabled', false);
                $.wizzardS.required_fields();
            } else {
                $('.subsequent-form-4-2').addClass('hidden');
                $('.subsequent-form-4-1').find('input').prop('disabled', false);
                $('input[name="subs_amount_file2"], input[name="subs_filing_date2"]').closest('.form-group').removeClass('required');
                $('input[name="subs_amount_file2"], input[name="subs_filing_date2"]').prop('disabled', true);
                $.wizzardS.required_fields();
            }
        });

        /*
        | ---------------------------------
        | # substantive examination report filing date on blur
        | ---------------------------------
        */
        this.$body.on('blur', 'input[name="subs_filing_date2"]', function (e){
            var self = $(this);
            if (self.val() != '') {
                $('input[name="subs_paper_no2"]').prop('disabled', false).closest('.form-group').removeClass('required');
                $('input[name="subs_mailing_date2"]').prop('disabled', false).closest('.form-group').addClass('required');
                $.wizzardS.required_fields();
            }
        });

        /*
        | ---------------------------------
        | # save button click
        | ---------------------------------
        */
        this.$body.on('click', '#save-btn', function (e){
            e.preventDefault();
            var btn = $(this);
            var $form = $('#m_form');
            var appID = $('input[name="app_id"]');
            var inputfile1 = ($('input[name="app_file"]').val() != '') ? $('input[name="app_file"]').get(0).files[0].name : '';
            var inputfile2 = ($('input[name="pub_file"]').val() != '') ? $('input[name="pub_file"]').get(0).files[0].name : ''; 
            var inputfile3 = ($('input[name="sub_file1"]').val() != '') ? $('input[name="sub_file1"]').get(0).files[0].name : '';
            var inputfile4 = ($('input[name="sub_file2"]').val() != '') ? $('input[name="sub_file2"]').get(0).files[0].name : '';
            var inputfile5 = ($('input[name="reg_file"]').val() != '') ? $('input[name="reg_file"]').get(0).files[0].name : '';
            var inputfile6 = ($('input[name="avatar"]').val() != '') ? $('input[name="avatar"]').get(0).files[0].name : '';

            if ($('input[name="app_no"]').val() == '') { 
                $.wizzardS.validates('validates');
                swal({
                    title: "Oops...",
                    text: "Something went wrong! \nPlease fill the application no to continue..",
                    type: "warning",
                    showCancelButton: false,
                    closeOnConfirm: true
                }, function(isConfirm){ 
    
                    window.onkeydown = null;
                    window.onfocus = null;    
    
                });
            } else {

                /*
                | ---------------------------------
                | # uploads ajax
                | ---------------------------------
                */   
                btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                var d1 = $.wizzardS.do_uploads(appID.val());

                $.when( d1 ).done(function ( v1 ) 
                {   
                    if (v1 > 0) {

                        setTimeout(function(){

                            /*
                            | ---------------------------------
                            | # save ajax
                            | ---------------------------------
                            */
                            var $url = (appID.val() != '') ? 
                            base_url + 'applications/trademarks/update/' + appID.val() + '?file1=' + inputfile1 + '&file2=' + inputfile2 + '&file3=' + inputfile3 + '&file4=' + inputfile4 + '&file5=' + inputfile5 + '&file6=' + inputfile6 : 
                            base_url + 'applications/trademarks/store?file1=' + inputfile1 + '&file2=' + inputfile2 + '&file3=' + inputfile3 + '&file4=' + inputfile4 + '&file5=' + inputfile5 + '&file6=' + inputfile6;
  
                            console.log($url);
                            $.ajax({
                                type: (appID.val() != '') ? 'PUT' : 'POST',
                                url: $url,
                                data: $form.serialize(),
                                success: function(response) {
                                    console.log(response);
                                    setTimeout(function() {
                                        var data = $.parseJSON(response);   
                                        if (appID.val() == '') {
                                            appID.val(data.id);
                                        }
                                        swal({
                                            title: 'Sweet!',
                                            text: 'The information has been successfully saved.',
                                            imageUrl: base_url + 'img/thumbs-up.png',
                                            imageWidth: 120,
                                            imageHeight: 120,
                                            imageAlt: 'thumbs up',
                                            animation: false,
                                            confirmButtonClass: "btn btn-info btn-focus m-btn m-btn--pill m-btn--air"
                                        });
                                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                    }, 1000);
                                }, 
                                complete: function() {
                                    window.onkeydown = null;
                                    window.onfocus = null;
                                }
                            });

                        }, 500);
                    }
                });
            }
        });

        /*
        | ---------------------------------
        | # application no on blur
        | ---------------------------------
        */
        this.$body.on('blur', 'input[name="app_no"]', function (e){
            var self = $(this);
            var className = $(this).attr('name');
            var infoWidget = $('.app-widget-info');

            if (self.val() != '') {
                infoWidget.find('.' + className).text(self.val());
            } else {
                infoWidget.find('.' + className).text('');
            }
        });

        /*
        | ---------------------------------
        | # application no on blur
        | ---------------------------------
        */
        this.$body.on('blur', 'input[name="app_title"]', function (e){
            var self = $(this);
            var className = $(this).attr('name');
            var infoWidget = $('.app-widget-info');

            if (self.val() != '') {
                infoWidget.find('.' + className).text(self.val());
            } else {
                infoWidget.find('.' + className).text('');
            }
        });

        /*
        | ---------------------------------
        | # application category on change
        | ---------------------------------
        */
        this.$body.on('change', 'select[name="app_category"]', function (e){
            var self = $(this);
            var className = $(this).attr('name');
            var infoWidget = $('.app-widget-info');

            if (self.val() != 0) {
                infoWidget.find('.' + className).text(self.find('option:selected').text());
            } else {
                infoWidget.find('.' + className).text('');
            }
        });

        /*
        | ---------------------------------
        | # application no on change
        | ---------------------------------
        */
        this.$body.on('blur', '#applicants', function (e){
            var self = $(this);
            var className = $(this).attr('name');
            var infoWidget = $('.app-widget-info');

            // self.val();
            // if (self.val() != 0) {
            //     infoWidget.find('.' + className).text(self.find('option:selected').text());
            // } else {
            //     infoWidget.find('.' + className).text('');
            // }
        });

        $('#app_filing_date, #pub_date, #reg_date').datepicker().on('changeDate', function (ev) {
            var self = $(this);
            var className = $(this).attr('name');
            var infoWidget = $('.app-widget-info');
            
            if (self.val() != '') {
                infoWidget.find('.' + className).text(self.val());
            } else {
                infoWidget.find('.' + className).text('');
            }

            if (self.attr('name') == 'reg_date') {
                $.each($('body #dau_table').find("tbody tr.init"), function(){   
                    var $row = $(this);
                    var $id = $row.attr('data-row-id');
                    var $m = moment(self.val(), 'MM/DD/YYYY');
                    var $dau = $m.add($id, 'year');
                    console.log($dau.format('MM/DD/YYYY'));
                    $row.find('input#dau_due_date_'+ $id).attr('value', $dau.format('YYYY-MM-DD'));
                    $row.find('input#dau_due_date_'+ $id).val($dau.format('YYYY-MM-DD'));
                    $row.find('input#dau_due_date_clone_'+ $id).val($dau.format('MM/DD/YYYY'));
                });
            }
            $.wizzardS.validate_progressbar(0);
        });

        this.$body.on('click', '.download-file', function (e){
            e.preventDefault();
            var $self = $(this);
            var $filename = $self.attr('title'); 
            var $id = $('input[name="app_id"]').val();
            var $url = base_url + 'applications/downloads?files=trademarks&id=' + $id + '&filename=' + $filename;
            
            if ($id > 0) {
                window.open($url, '_blank');
            } else {
                swal({
                    title: "Oops...",
                    text: "Unable to download! \nPlease save the application form first.",
                    type: "warning",
                    showCancelButton: false,
                    closeOnConfirm: true
                }, function(isConfirm){ 
                    window.onkeydown = null;
                    window.onfocus = null;    
                });
            }
        });

        
        this.$body.on('click', '#add-more-renewal', function (e){
            e.preventDefault();
            var $self = $(this);
            var $table = $('#dau_table');
            var $reg_date = $('#reg_date');
            var $m = moment($reg_date.val(), 'MM/DD/YYYY');
            var $succeeding = $m.add(succeedingRenewal, 'year');

            $dau_iteration++;
            console.log($dau_iteration);

            var $renewal_dau = '<tr data-row-id="' + $dau_iteration + '">' +
            '<td class="text-center">' +
            '<label class="m--margin-top-7">Renewal</label>' +
            '</td>' + 
            '<td class="hidden"><input name="dau_identification[]" value="' + $dau_iteration + '"></td>' +
            '<td class="hidden"><input name="renewal_' + $dau_iteration + '" value="1"/></td>' +
            '<td class="hidden"><input name="dau_due_date_' + $dau_iteration + '" class="duedate" value="' + $succeeding.format('YYYY-MM-DD') + '"></td>' +
            '<td>' +
            '<input id="dau_due_date_clone_' + $dau_iteration + '" disabled="disabled" class="duedateclone text-center form-control m-input m-input--solid date-picker" placeholder="" name="dau_due_date_clone_' + $dau_iteration + '" type="text" value="' + $succeeding.format('MM/DD/YYYY') + '">' +
            '</td>' + 
            '<td>' +
            '<input id="dau_fee_' + $dau_iteration + '" class="text-center form-control m-input m-input--solid numeric-double" placeholder="" name="dau_fee_' + $dau_iteration + '" type="text" value="">' +
            '</td>' +
            '<td class="text-center">' +
            '<label class="m--margin-top-7 m-radio m-radio m-radio--info">' +
            '<input type="radio" name="dau_paid_' + $dau_iteration + '" value="1">' +
            'Yes' +
            '<span></span>' +
            '</label>' +
            '<label class="m--margin-top-7 m-radio m-radio m-radio--info m--margin-left-10">' +
            '<input type="radio" name="dau_paid_' + $dau_iteration + '" value="0" checked="checked">' +
            'No' +
            '<span></span>' +
            '</label>' +
            '</td>' +
            '<td>' +
            '<button id="remove-dau" type="button" class="btn">' +
            '<i class="la la-minus"></i>' +
            '</button>' +
            '</td>' +
            '</tr>';

            $table.find('tbody').append($renewal_dau);
            $('.date-picker').datepicker();

            succeedingRenewal++;
        });

        this.$body.on('click', '#add-more-renewal-dau', function (e){
            e.preventDefault();
            var $self = $(this);
            var $table = $('#renewal_dau_table');
            var $reg_date = $('#reg_date');
            var $m = moment($reg_date.val(), 'MM/DD/YYYY');
            var $succeedingDau = $m.add(succeedingRenewalDau, 'year');
            console.log(succeedingRenewalDau);

            $renewal_dau_iteration++;
            console.log($renewal_dau_iteration);

            var $renewal_dau = '<tr data-row-id="' + $renewal_dau_iteration + '">' +
            '<td class="text-center">' +
            '<label class="m--margin-top-7">Renewal DAU</label>' +
            '</td>' + 
            '<td class="hidden"><input name="renewal_dau_identification[]" value="' + $renewal_dau_iteration + '"></td>' +
            '<td class="hidden"><input name="renewal_dau_' + $renewal_dau_iteration + '" value="1"/></td>' +
            '<td class="hidden"><input name="renewal_dau_due_date_' + $renewal_dau_iteration + '" class="duedate_renewal" value="' + $succeedingDau.format('YYYY-MM-DD') + '"></td>' +
            '<td>' +
            '<input id="renewal_dau_due_date_clone_' + $renewal_dau_iteration + '" disabled="disabled" class="duedateclone_renewal text-center form-control m-input m-input--solid date-picker" placeholder="" name="renewal_dau_due_date_clone_' + $renewal_dau_iteration + '" type="text" value="' + $succeedingDau.format('MM/DD/YYYY') + '">' +
            '</td>' + 
            '<td>' +
            '<input id="renewal_dau_fee_' + $renewal_dau_iteration + '" class="text-center form-control m-input m-input--solid numeric-double" placeholder="" name="renewal_dau_fee_' + $renewal_dau_iteration + '" type="text" value="">' +
            '</td>' +
            '<td class="text-center">' +
            '<label class="m--margin-top-7 m-radio m-radio m-radio--info">' +
            '<input type="radio" name="renewal_dau_paid_' + $renewal_dau_iteration + '" value="1">' +
            'Yes' +
            '<span></span>' +
            '</label>' +
            '<label class="m--margin-top-7 m-radio m-radio m-radio--info m--margin-left-10">' +
            '<input type="radio" name="renewal_dau_paid_' + $renewal_dau_iteration + '" value="0" checked="checked">' +
            'No' +
            '<span></span>' +
            '</label>' +
            '</td>' +
            '<td>' +
            '<button id="remove-renewal-dau" type="button" class="btn">' +
            '<i class="la la-minus"></i>' +
            '</button>' +
            '</td>' +
            '</tr>';

            $table.find('tbody').append($renewal_dau);
            $('.date-picker').datepicker();
            succeedingRenewalDau++;
        });


        this.$body.on('click', '#remove-renewal-dau, #remove-dau', function (e){
            e.preventDefault();
            var $self = $(this);
            var $rows = $self.closest('tr');
            $rows.remove();
            setTimeout(function(){
                if ($self.attr('id') == 'remove-dau') {
                    if ($('#dau_table tbody tr').length == 2) {
                        succeedingRenewal = 10;
                    } else {
                        succeedingRenewal--;
                    }
                } else {
                    if ($('#renewal_dau_table tbody tr').length == 0) {
                        succeedingRenewalDau = 5;
                    } else {
                        succeedingRenewalDau--;
                    }
                }
            });
        });

        this.$body.on('changeDate', '.duedateclone', function (e){
            var $self = $(this);
            var $rows = $self.closest('tr');
            var $dau = moment($self.val(), 'MM/DD/YYYY');
            console.log($dau);
            $rows.find('input.duedate').attr('value', $dau.format('YYYY-MM-DD'));
            $rows.find('input.duedate').val($dau.format('YYYY-MM-DD'));
            $.wizzardS.validate_progressbar(0);
        });

        this.$body.on('changeDate', '.duedateclone_renewal', function (e){
            var $self = $(this);
            var $rows = $self.closest('tr');
            var $dau = moment($self.val(), 'MM/DD/YYYY');
            $rows.find('input.duedate_renewal').attr('value', $dau.format('YYYY-MM-DD'));
            $rows.find('input.duedate_renewal').val($dau.format('YYYY-MM-DD'));
            $.wizzardS.validate_progressbar(0);
        });

        
    }

    //init wizzardS
    $.wizzardS = new wizzardS, $.wizzardS.Constructor = wizzardS

}(window.jQuery),

//initializing wizzardS
function($) {
    "use strict";
    $.wizzardS.required_fields();
    $.wizzardS.init();
    $.wizzardS.validate_progressbar(1);
}(window.jQuery);
