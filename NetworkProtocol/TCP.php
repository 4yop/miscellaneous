<?php


global $net_secret;
$net_secret = [];
function secure_tcp_sequence_number($saddr,$daddr,$sport,$dport)
{
    global $net_secret;
    $hash = [];
    net_secret_init();
    $hash[0] = $saddr;
    $hash[1] = $daddr;
    $hash[2] = ($sport << 16) + $dport;
    $hash[3] = $net_secret[15];
    return seq_scale($hash[0]);
}
function net_secret_init(){}
function seq_scale($seq)
{
    return $seq + (ktime_to_ns(ktime_get_real()) >> 6);
}
function ktime_get_real(){}
function ktime_to_ns($time){}