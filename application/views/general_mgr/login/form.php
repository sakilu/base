<?= $this->form->form_open() ?>
<div class="panel" style="margin-bottom:0px">
    <div class="panel-heading">
        <span class="panel-title">變更密碼</span>
    </div>
    <div class="panel-body bg-light dark">
        <div class="form-group">
            <?= $this->form->label('admin_password', [
                'required' => true
            ]) ?>
            <div class="col-lg-8">
                <div class="bs-component">
                    <?= $this->form->password('admin_password') ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="new_password" class="col-lg-3 control-label">*新密碼</label>

            <div class="col-lg-8">
                <div class="bs-component">
                    <input type="password" name="new_password" value="" id="new_password" class="form-control"
                           autocomplete="off">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="new_password_confirm" class="col-lg-3 control-label">*新密碼確認</label>

            <div class="col-lg-8">
                <div class="bs-component">
                    <input type="password" name="new_password_confirm" value="" id="new_password_confirm"
                           class="form-control" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
</div>
</form>