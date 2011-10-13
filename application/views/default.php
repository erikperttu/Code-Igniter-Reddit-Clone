<!DOCTYPE HTML>
<html>
<head>
    <title>
        <?php //echo $title; ?>
    </title>

    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css"
          media="screen" title="no title" charset="utf-8">
    <?php
    //echo "\n". link_tag('assets/stylesheets/style.css');
    //echo "\n". link_tag('assets/stylesheets/'. $theme .'.css');
    ?>

</head>

<body>

<div id="wrapper">
    <div id="header">
        <?php echo $header; ?>
    </div>
    <div id="div_torso_wrapper">

        <div id="div_user_menu">
            <?php echo $user_menu_view;?>
        </div>
        <div id="div_navigation_menu">
            <?php echo $navigation_menu_view;?>
        </div>
        <div id="div_main_content">
            <?php echo $main_content_view;  ?>
        </div>
    </div>
    <div id="footer">
        <?php echo $footer; ?>
    </div>
</div>

</body>
</html>