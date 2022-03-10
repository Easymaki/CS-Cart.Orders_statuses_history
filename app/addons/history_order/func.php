<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_history_order_change_order_status($status_to, $status_from, $order_info, $force_notification, $order_statuses, $place_order)
{
    $order_data = array(
        'user_id' => $_SESSION['auth']['user_id'],
        'status_from' => $status_from,
        'status_to' => $status_to,
        'updated' => $order_info['updated_at'],
    );

    $data = array($order_data);

    $old_history = db_get_field('SELECT history FROM ?:orders WHERE order_id = ?i', $order_info['order_id']);
    if (!empty($old_history)) {
        $prev_data = unserialize($old_history);

        foreach ($prev_data as $item) {
            array_push($data, $item);
        }

        db_query("UPDATE ?:orders SET history = ?s WHERE order_id = ?i", serialize($data), $order_info['order_id']);
    } else {
        db_query("UPDATE ?:orders SET history = ?s WHERE order_id = ?i", serialize($data), $order_info['order_id']);
    }
}

function fn_history_order_get_order_info(&$order, $additional_data)
{
    $history = db_get_field('SELECT history FROM ?:orders WHERE order_id = ?i', $order['order_id']);
    $order['history'] = unserialize($history);

    foreach ($order['history'] as &$item) {
        $item['status_from_descr'] = fn_get_status_data($item['status_from'], 'O');
        $item['status_to_descr'] = fn_get_status_data($item['status_to'], 'O');
        $item['user_info'] = fn_get_user_info($item['user_id']);
    }
}
