<html>
    <head>
        <style type="text/css">
            .confirm-msg-letter__btn{
                display:inline-block;
                text-decoration:none;
                padding:1em 2em;
                background:#303e77;
                border-radius: 1em;
            }

            .confirm-msg-letter__table{
                /*nothing changes on my screen even without the next style*/
                /*but I dont want the letter to be larger than 70% of screen width*/
                width: 100%;
                max-width: 70vw;
                border-radius:1em;
            }

            .confirm-msg-letter__table--outlined-background{
                background:#f5f5f8;
            }

            /*sometimes I should have different paddings*/
            .confirm-msg-letter__cell{
                padding:2em 1.5em 0.5em;
                text-align:center;
                vertical-align:top;
            }

            /*I need small and greyed out text for my footer*/
            .confirm-msg-letter__text{
                font-family:'Gill Sans', 'sans-serif';
                font-size: 16px;
                /*not sure I should use ems here*/
                line-height: 0.5;
                font-color:#ffffff;
            }
        </style>
    </head>
    <body>
        <table cellspacing="0" cellpadding="0" border="0" class="confirm-msg-letter__table">
            <tr>
                <td align="center" valign="center">
                    <table cellspacing="0" cellpadding="0" border="0" class="confirm-msg-letter__table confirm-msg-letter__table--outlined-background">
                        <!-- Header -->
                        <tr>
                            <td colspan="2" class="confirm-msg-letter__cell">
                                <p class="confirm-msg-letter__text">
                                    <strong>Your account has been successfully registered</strong>
                                </p>
                            </td>
                        </tr>
                        <!-- Header -->
                        <!-- Body -->
                        <tr>
                            <td class="confirm-msg-letter__cell">
                                <p class="confirm-msg-letter__text">
                                    To activate your account, click the button below.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="confirm-msg-letter__cell">
                                <a href="https://translate.google.com/?sl=en&tl=es&op=translate" class="confirm-msg-letter__btn"
                                target="_blank" data-saferedirecturl="https://translate.google.com/?sl=en&tl=es&op=translate">
                                    <p class="confirm-msg-letter__text">
                                        Activate the account
                                    </p>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="confirm-msg-letter__cell">
                                <p class="confirm-msg-letter__text">
                                    Don't forget to download the game client.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="confirm-msg-letter__cell">
                                <a href="https://translate.google.com/?sl=en&tl=es&op=translate" class="confirm-msg-letter__btn"
                                target="_blank" data-saferedirecturl="https://translate.google.com/?sl=en&tl=es&op=translate">
                                    <p class="confirm-msg-letter__text">
                                        Download the client
                                    </p>
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Body -->
            <!-- Footer -->
            <tr>
                <td class="confirm-msg-letter__cell">
                    <p class="confirm-msg-letter__text">
                        This letter was created automatically, you don't need to respond.<br>
                    </p>
                </td>
            </tr>
            <!-- Footer -->
        </table>
    </body>
</html>
