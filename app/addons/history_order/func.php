<?php

if (!defined('BOOTSTRAP')) { die('Access denied');}

function fn_history_order_change_order_status($status_to, $status_from, $order_info, $force_notification, $order_statuses, $place_order)
{
    $order_data = array(
        'user_id' => $_SESSION['auth']['user_id'],
        'order_id' => $order_info['order_id'],
        'status_from' => $status_from,
        'status_to' => $status_to,
        'timestamp' => $order_info['updated_at'],
    );
    
    if (!empty($order_data) {
        db_query('INSERT INTO ?:history_orders ?e', $order_data);
    }
}

function fn_history_order_get_order_info(&$order, $additional_data)
{   
    if (!empty($order)) {
        $order['history'] = db_get_array('SELECT ?:history_orders.status_from, ?:history_orders.status_to, ?:users.firstname, ?:users.lastname FROM ?:history_orders
        LEFT JOIN ?:users
        ON ?:history_orders.user_id = ?:users.user_id
        WHERE ?:history_orders.order_id = ?i', $order['order_id']);
    }
}
