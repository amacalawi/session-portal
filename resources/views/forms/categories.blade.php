<form type="POST" class="m-form m-form--label-align-left- m-form--state-" id="m_form" enctype="multipart/form-data">
    <div class="row hidden">
        <div class="col-xl-12">
            <div class="form-group m-form__group">
                {{ Form::label('exampleInputEmail1', 'ID', ['class' => '']) }}
                {{ 
                    Form::text($name = 'category_id', $value = $categories->category_id, 
                    $attributes = array(
                        'class' => 'form-control m-input m-input--solid',
                        'placeholder' => '*****',
                        'disabled' => 'disabled'
                    )) 
                }}
                <span class="m-form__help form-control-feedback"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="form-group m-form__group required">
                {{ Form::label('exampleInputEmail1', 'Code', ['class' => '']) }}
                {{ 
                    Form::text($name = 'category_code', $value = $categories->category_code, 
                    $attributes = array(
                        'class' => 'form-control m-input m-input--solid',
                        'placeholder' => 'Enter catgory code'
                    )) 
                }}
                <span class="m-form__help form-control-feedback"></span>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="form-group m-form__group required">
                {{ Form::label('exampleInputEmail1', 'Name', ['class' => '']) }}
                {{ 
                    Form::text($name = 'category_name', $value = $categories->category_name, 
                    $attributes = array(
                        'class' => 'form-control m-input m-input--solid',
                        'placeholder' => 'Enter category name'
                    )) 
                }}
                <span class="m-form__help form-control-feedback"></span>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="form-group m-form__group required">
                    {{ Form::label('exampleInputEmail1', 'Description', ['class' => '']) }}
                    {{ 
                        Form::text($name = 'category_desc', $value = $categories->category_desc, 
                        $attributes = array(
                            'class' => 'form-control m-input m-input--solid',
                            'placeholder' => 'Enter category description'
                        )) 
                    }}
                    <span class="m-form__help form-control-feedback"></span>
                </div>
            </div>
        </div>
    </div>
</form>
