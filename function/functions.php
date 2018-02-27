<?php

function get_difference_with_current($old_time) {
    $current = new DateTime('now');
    
    $start_date = new DateTime($old_time);
    $since_start = $start_date->diff($current);
    
    $times = "";
    ($since_start->y > 0) ? $times .= $since_start->y . ' years ' : '';
    ($since_start->m > 0) ? $times .=$since_start->m . ' months ' : '';
    ($since_start->d > 0) ? $times .=$since_start->d . ' days ' : '';
    ($since_start->h > 0) ? $times .=$since_start->h . ' hours ' : '';
    ($since_start->i > 0) ? $times .=$since_start->i . ' minutes ' : '';
    ($since_start->s > 0) ? $times .=$since_start->s . ' seconds ' : '';
    echo $times.' ago';
}
