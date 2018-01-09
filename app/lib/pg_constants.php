<?php

define('pg_tbl_vendor', 'pg_vendor');
define('pg_tbl_venue', 'pg_venue');
define('pg_tbl_court', 'pg_court');
define('pg_tbl_address', 'pg_address');
define('pg_tbl_stall', 'pg_stall');
define('pg_tbl_foodcat', 'pg_foodcat');
define('pg_tbl_fooditem', 'pg_fooditem');
define('pg_tbl_stall_food_item', 'pg_stall_food_item');

define('pg_tbl_composite_order', 'pg_composite_order');
define('pg_tbl_stall_order', 'pg_stall_order');
define('pg_tbl_stall_order_item', 'pg_stall_order_item');

define('pg_tbl_order_proc_status', 'pg_order_proc_status');
define('pg_tbl_order_status', 'pg_order_status');
define('pg_tbl_payments', 'pg_payments');


define('pg_json_parse_error', 'Invalid JSON Data');

define('pg_stat_success', 'ok');
define('pg_stat_failed', 'failed');
define('pg_stat_error', 'error');

//ops
define('pg_op_insert', 'I');
define('pg_op_update', 'U');
define('pg_op_delete', 'D');
define('pg_op_list', 'L');

define('pg_ord_stat_new', 'NEW');
define('pg_ord_stat_closed', 'CLOSED');
define('pg_ord_proc_stat_new', 'NEW');
define('pg_ord_proc_stat_delivered', 'DELIVERED');


define('pg_ord_code_min', 1);
define('pg_ord_code_max', 999999999);


//ctx
define('pg_ctx_stall_orders', 'pg_ctx_stall_orders');
define('pg_ctx_stall_orders_history', 'pg_ctx_stall_orders_history');