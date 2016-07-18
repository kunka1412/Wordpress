<?php 
add_filter('upload_size_limit','ashutosh_increase_upload');
    function ashutosh_increase_upload($bytes){
    return 2650000000; 
} ?>