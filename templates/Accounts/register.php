<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account $account
 */
?>
<html>
    <head>
        <?php echo $this->Html->css("registration.css"); ?>
    </head>
    <body>
        <div class="row">
            <div class="column column-50">
                <div class="accounts form content">
                    <?= $this->Form->create($account) ?>
                    <fieldset>
                        <legend>
                            <?= __('Master Account Register') ?>
                        </legend>
                        <hr class='colorful-line'>
                        <?php
                            echo $this->Form->control('email');
                            echo $this->Form->control('password');
                            echo $this->Form->control('confirm password');
                            echo $this->Form->control('birth day');
                            echo $this->Form->control('I agree to be bound by Terms of Service', ['type' => 'checkbox']);
                            echo $this->Form->control('Capcha', ['type' => 'checkbox']);
                        ?>
                    </fieldset>
                    <?= $this->Form->button(__('Register')) ?>
                    <?= $this->Html->link(
                        'Cancel',
                        '/accounts', //accounts/login later
                        ['class' => 'button inverted-colors-btn']
                    ) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </body>
</html>
