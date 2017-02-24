<form action="" method="post" class="ajax_form af_example">

    <div class="form-group">
        <label class="control-label" for="af_name">[[%af_label_name]]</label>
        <div class="controls">
            <input type="text" id="af_name" name="name" value="[[+fi.name]]" placeholder="" class="form-control"/>
            <span class="error_name">[[+fi.error.name]]</span>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label" for="af_email">Электронная почта</label>
        <div class="controls">
            <input type="email" id="af_email" name="email" value="[[+fi.email]]" placeholder="" class="form-control"/>
            <span class="error_email">[[+fi.error.email]]</span>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label" for="af_message">[[%af_label_message]]</label>
        <div class="controls">
            <textarea id="af_message" name="message" class="form-control" rows="5">[[+fi.message]]</textarea>
            <span class="error_message">[[+fi.error.message]]</span>
        </div>
    </div>

    <div class="form-group">
        <div class="controls">
            <button type="reset" class="btn btn-default">[[%af_reset]]</button>
            <button type="submit" class="btn btn-primary">[[%af_submit]]</button>
        </div>
    </div>
    <!-- HIDDEN INFO -->
    Данная форма будет отправлена на электронную почту: [[+email]]<br>
    Номер телефона пользователя, оставившего информацию: [[+mobilephone]]
    <input type="hidden" name="uid" value="[[+uid]]"/>
    <input type="hidden" name="email" value="[[+email]]"/>
    <!-- HIDDEN INFO END -->
    [[+fi.success:is=`1`:then=`
    <div class="alert alert-success">[[+fi.successMessage]]</div>
    `]]
    [[+fi.validation_error:is=`1`:then=`
    <div class="alert alert-danger">[[+fi.validation_error_message]]</div>
    `]]
</form>