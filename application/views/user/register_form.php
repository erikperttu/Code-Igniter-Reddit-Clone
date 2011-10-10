<div id="register_form">
    <h2>Register here</h2>
    <fieldset>
        <legend>User information</legend>
        <?php
            echo form_open('user/create_user');
        echo form_input('username', set_value('username','Username'));
        echo form_input('user_email', set_value('user_email','Valid Email'));

        ?>
    </fieldset>

    <fieldset>
        <legend>Password</legend>
        <?php
            echo form_input('user_password', 'Password' );
        echo form_input('user_password_same', 'Re-Type Password' );
        echo form_submit('submit', 'Register');
        echo validation_errors('<p class="error">');
        ?>
    </fieldset>



</div>