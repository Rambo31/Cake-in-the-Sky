<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account $account
 */
echo $this->Html->css("common-page-styles.css");
echo $this->Html->css("registration.css");
echo $this->Html->css("w3schools-toggle-switch.css");

echo $this->Html->script('https://js.hcaptcha.com/1/api.js', ['async' => true, 'defer' => true]);
?>
<div class="row">
    <div class="column column-50">
        <div class="accounts form content reg-form">
            <?= $this->Form->create($account) ?>
            <fieldset class='reg-form__fieldset'>
                <legend class='page__legend'>
                    <?= __('Master Account Register') ?>
                </legend>
                <hr class='page__line'>
                <?php
                    echo $this->Form->control('user_mail', [
                        'label' => 'Email'
                    ]);
                    echo $this->Form->control('password', ['type' => 'password']);
                    echo $this->Form->control('confirmed_password', ['type' => 'password']);
                    echo $this->Form->control('birthday', [
                        'label' => 'Date of birth',
                        'type' => 'date',
                        'value' => new DateTime()
                    ]);
                ?>
                <!-- I dont like that error msg on checkbox is displayed at the middle of the element -->
                <div class='terms-block'>
                    <label class="toggle-switch toggle-switch--mid-size">
                        <?php echo $this->Form->checkbox('accepted_rules', [
                            'class' => 'toggle-switch__input',
                            'label' => ''
                        ])?>
                        <span class="toggle-switch__slider"></span>
                    </label>
                    <label class='terms-block__label--offsetted-left'>
                        I agree with <?php echo $this->Html->link(
                            'Terms of Service',
                            'privacies/index',
                            ['target' => '_blank']
                        )?>
                    </label>
                </div>
                <!--
                <div style="display: flex">
                    <label class="toggle-switch toggle-switch--mid-size">
                        <input type="checkbox" class='toggle-switch__input'>
                        <span class="toggle-switch__slider"></span>
                    </label>
                    <label style="margin-left: 1em;">I agree with Terms of Service</label>
                </div>
                -->
            </fieldset>
            <div class="h-captcha" data-sitekey="372c53b6-0f12-4fe6-9b94-dc42dc16d902"></div>
            <div class="btns-block">
                <?= $this->Form->button(__('Register')) ?>
                <?= $this->Html->link(
                    'Cancel',
                    '/accounts', //it should redirect to accounts/login later
                    [
                        'class' => 'button reg-form__btn
                        reg-form__btn--inverted-classic-colors
                        reg-form__btn--thickened-border
                        reg-form__btn--offsetted-left'
                    ])?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
