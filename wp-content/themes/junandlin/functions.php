<?php
add_action( 'admin_print_scripts', 'timeScript');
function timeScript() {
    $url = esc_url( get_template_directory_uri() );
    echo <<<script
<script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>

script;
}
// <link rel="stylesheet" type="text/css" href="{$url}/css/bootstrap-datetimepicker.min.css">
// <link rel="stylesheet" type="text/css" href="{$url}/css/bootstrap-theme.min.css">

// <script type="text/javascript" src="{$url}/js/bootstrap-datetimepicker.js"></script>
// <script type="text/javascript" src="{$url}/js/bootstrap-datetimepicker.zh-CN.js"></script>
// <script type="text/javascript" src="{$url}/js/bootstrap.min.js"></script>
// <script type="text/javascript">
//     $(function () {
//         // $(".time input").datetimepicker({format: 'yyyy-mm-dd'});
//         console.log($(".time"));
//     })
// </script>
?>