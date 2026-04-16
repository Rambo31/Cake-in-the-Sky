<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account $account
 */
echo $this->Html->css("registration.css");
echo $this->Html->css("w3schools-toggle-switch.css");
?>
<div class="row">
    <div class="column column-50">
        <div class="accounts form content reg-form">
            <?= $this->Form->create($account) ?>
            <fieldset>
                <legend class='reg-form__legend'>
                    <?= __('Master Account Register') ?>
                </legend>
                <hr class='reg-form__line'>
                <?php
                    echo $this->Form->control('email', ['type' => 'email']);
                    echo $this->Form->control('password', ['type' => 'password']);
                    echo $this->Form->control('confirm password', ['type' => 'password']);
                    echo $this->Form->control('birthday', [
                        'label' => 'Date of birth',
                        'type' => 'date',
                        'value' => new DateTime()
                    ]);
                    echo $this->Captcha->render(['placeholder' => __('Please solve the riddle')]);
                ?>
                <div style="display: flex">
                    <label class="toggle-switch toggle-switch--mid-size">
                        <input type="checkbox" class='toggle-switch__input'>
                        <span class="toggle-switch__slider"></span>
                    </label>
                    <label style="margin-left: 1em;">I agree with Terms of Service</label>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Register')) ?>
            <?= $this->Html->link(
                'Cancel',
                '/accounts', //it should redirect to accounts/login later
                ['class' => '
                    button
                    reg-form__btn
                    reg-form__btn--inverted-classic-colors
                    reg-form__btn--thickened-border'
                ]
            ) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
