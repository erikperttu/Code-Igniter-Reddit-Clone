<div id="create_link_form">
    <h2>Create here</h2>
    <fieldset>
        <legend>Link information</legend>
        <?php
            echo form_open('user/create_link');
        echo form_input('link', set_value('link','Content'));
        echo form_input('link_description', set_value('link_description','What is this?'));
        echo form_submit('submit', 'Create');
        echo validation_errors('<p class="error">');
        ?>
    </fieldset>
</div>