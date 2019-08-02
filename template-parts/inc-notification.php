<?php

global $sport_options;

$on_off_notification    =   $sport_options['sport_on_off_notification'];
$time_second            =   $sport_options['sport_notify_time_second'];
$loop_end               =   $sport_options['sport_notify_loop_end'];

$data_settings  =   [
    'time_second'   =>  $time_second,
    'loop_end'      =>  $loop_end,
];

if ( $on_off_notification == 1 ) :
?>

<div class="site-notification" data-settings='<?php echo esc_attr( wp_json_encode( $data_settings ) ); ?>'></div>

<?php endif; ?>