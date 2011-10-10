<div id="login_form">
    <h2>Login here</h2>
    <?php
    echo form_open('user/validate_credentials');
    echo form_input('username', 'Username');
    echo form_password('user_password', 'Password' );
    echo form_submit('submit', 'Login');
    ?>
</div>