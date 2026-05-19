<?php
echo $this->Html->css("common-page-styles.css");
?>
<div class='row'>
    <div class='column column-70'>
        <div class='content'>
            <legend class='page__legend'>
                <?= __('Email Confirmation') ?>
            </legend>
            <hr class='page__line'>
            <div style="text-align: justify;">
                Thank you for registration, at your specified email has been sent a letter with instructions
                on how to activate your account. You should check the spam folder if you don't see the letter from us.
                After receiving the letter, <b>you must confirm your account</b> by visiting the URL specified in the letter.
                <b>Only confirmed accounts are allowed to enter the game.</b>
            </div>
        </div>
    </div>
</div>
