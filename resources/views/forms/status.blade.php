<form type="POST" class="m-form m-form--label-align-left- m-form--state-" id="m_form" enctype="multipart/form-data">
    <div class="row hidden">
        <div class="col-xl-12">
            <div class="form-group m-form__group">
                {{ Form::label('exampleInputEmail1', 'ID', ['class' => '']) }}
                {{ 
                    Form::text($name = 'id', $value = $status->id, 
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
                    Form::text($name = 'code', $value = $status->code, 
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
                    Form::text($name = 'name', $value = $status->name, 
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
                        Form::text($name = 'description', $value = $status->description, 
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
