<?= $this->form->form_open() ?>
<div class="panel-body">
    <div class="form-group">
        <?= $this->form->label('user_name', [
            'required' => true
        ]) ?>
        <div class="col-lg-8">
            <div class="bs-component">
                <?= $this->form->input('user_name') ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= $this->form->label('user_phone') ?>
        <div class="col-lg-8">
            <div class="bs-component">
                <?= $this->form->input('user_phone') ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= $this->form->label('user_mail') ?>
        <div class="col-lg-8">
            <div class="bs-component">
                <?= $this->form->input('user_mail') ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= $this->form->label('user_password') ?>
        <div class="col-lg-8">
            <div class="bs-component">
                <input id="user_password" name="user_password" type="password" class="form-control"/>
                <span class="help-block mt5">不更新/設置密碼 請留空</span>
            </div>
        </div>
    </div>
</div>
</form>