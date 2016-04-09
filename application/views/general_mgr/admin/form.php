<?= $this->form->form_open() ?>
<div class="panel-body">
    <?php if (!$this->form->get_primary_key()) { ?>
        <div class="form-group">
            <?= $this->form->label('admin_mail', [
                'required' => true
            ]) ?>
            <div class="col-lg-8">
                <div class="bs-component">
                    <?= $this->form->input('admin_mail') ?>
                    <span class="help-block mt5">可免填密碼 使用 FB/Google 用此信箱登入</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= $this->form->label('admin_password', [
                'required' => false
            ]) ?>
            <div class="col-lg-8">
                <div class="bs-component">
                    <?= $this->form->password('admin_password') ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= $this->form->label('admin_password_confirm', [
                'required' => false
            ]) ?>
            <div class="col-lg-8">
                <div class="bs-component">
                    <?= $this->form->password('admin_password_confirm') ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="form-group">
            <?= $this->form->label('admin_mail', [
                'required' => true,
            ]) ?>
            <div class="col-lg-8">
                <div class="bs-component">
                    <?= $this->form->input('admin_mail', ['readonly' => true]) ?>
                    <span class="help-block mt5">可免填密碼 使用 FB/Google 用此信箱登入</span>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="form-group">
        <?= $this->form->label('admin_name', [
            'required' => true
        ]) ?>
        <div class="col-lg-8">
            <div class="bs-component">
                <?= $this->form->input('admin_name') ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= $this->form->label('admin_role', [
            'required' => true
        ]) ?>
        <div class="col-lg-8">
            <div class="bs-component">
                <?= $this->form->multiselect('admin_role') ?>
            </div>
        </div>
    </div>
</div>
</form>