<?php

global $sport_options;

//$time_fist      =   $sport_options['sport_notify_time_fist'];
$time_second    =   $sport_options['sport_notify_time_second'];
$loop_end       =   $sport_options['sport_notify_loop_end'];

$data_settings  =   [
    'time_second'   =>  $time_second,
    'loop_end'      =>  $loop_end,
];

?>

<div class="site-notification" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings ) ); ?>'></div>