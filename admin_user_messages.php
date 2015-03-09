<?php
/*
 Plugin Name: Admin-User-Messages
 Text Domain: admin-user-messages
 Description: Plugin for communication between Admin and single User.
 Version: 0.2.0
 Author: Karwalski
 Author URI: http://karwalski.net/
 License: GPLv3
 Depends: EWD_FEUP
 */

/*
Modified version of the original plugin 'Admin User Messages'
Original version at time of modification was 0.1.6
https://wordpress.org/plugins/admin-user-messages/
By Michael Karsten under GPLv3

 */


register_activation_hook( __FILE__, 'pu_create_plugin_tables' );

function pu_create_plugin_tables()
{
    global $wpdb;

    // current blog table prefix

    $table_name = $wpdb->prefix . 'admin_user_message';
    $table_name_settings = $wpdb->prefix . 'admin_user_message_settings';

    $sql = "CREATE TABLE $table_name (
            `auto` int(11) NOT NULL AUTO_INCREMENT,
            `sender` int(11) NOT NULL,
            `receiver` int(11) NOT NULL,
            `time` time NOT NULL,
            `date` date NOT NULL,
            `message` text NOT NULL,
            `status` int(11) NOT NULL,
            `subject` varchar(150) NOT NULL,
            PRIMARY KEY (`auto`)
          );



        CREATE TABLE $table_name_settings (
          `auto` int(11) NOT NULL AUTO_INCREMENT,
          `item` varchar(255) NOT NULL,
          `value` varchar(255) NOT NULL,
          PRIMARY KEY (`auto`)
        );


        INSERT INTO $table_name_settings (`auto`, `item`, `value`) VALUES
        (1, 'table_color_header', '#efefef'),
        (2, 'term_quantity_message', 'Number of messages'),
        (3, 'term_page', 'Page'),
        (4, 'term_From', 'From'),
        (5, 'term_subject', 'Subject'),
        (6, 'term_received', 'Received'),
        (7, 'term_time', 'Time of day'),
        (8, 'term_msg_from', 'Message from'),
        (9, 'term_msg', 'Message'),
        (10, 'term_msg_successfull_sent', 'Message has been sent successfully.'),
        (11, 'term_sent_date', 'Mailing date'),
        (12, 'btn_back_to_inbox', 'www.yourdomain.com/your-inbox-page'),
        (13, 'term_to', 'To'),
        (14, 'btn_back_to_send_msg', 'www.yourdomain.com/your-sent-messages-page'),
        (15, 'btn_send_answer_text', 'Reply to this message'),
        (16, 'btn_send_msg_text', 'Post message'),
        (17, 'btn_back_to_inbox_text', 'Go back to your Inbox'),
        (18, 'mail_sender', 'Max Mustermann'),
        (19, 'mail_subject', 'A message for you'),
        (20, 'mail_message', 'Hello! \r\n\r\nSomeone has left a message just for you. \r\n\r\nClick on the link to read the message.\r\n\r\nBest Regards '),
        (21, 'mail_sender_mail', 'noreply@yourdomain.com'),
        (22, 'btn_post_message', 'www.yourdomain.com/your-post-a-message-page'),
        (23, 'term_link_inbox', 'Inbox'),
        (24, 'term_link_post_a_message', 'Post a message'),
        (25, 'term_link_sent_messages', 'Sent messages'),
        (26, 'btn_read_message', 'www.yourdomain.com/your-read-messages-page'),
        (27, 'btn_answer_message', 'www.yourdomain.com/your-answer-messages-page'),
        (28, 'alert_missing_subject', 'There is no subject for your message'),
        (29, 'alert_missing_receiver', 'Your message must have a receiver'),
        (30, 'alert_missing_message', 'Your message is empty');
         ";


        $sqlUdpate1 = "INSERT INTO $table_name_settings (`auto`, `item`, `value`) VALUES
        (28, 'alert_missing_subject', 'There is no subject for your message'),
        (29, 'alert_missing_receiver', 'Your message must have a receiver'),
        (30, 'alert_missing_message', 'Your message is empty');
        ";

        $sqlUdpate2 = "INSERT INTO $table_name_settings (`auto`, `item`, `value`) VALUES
        (31, 'term_search_string', 'Your search'),
        (32, 'term_search_button', 'Search'),
        (33, 'btn_search', 'www.yourdomain.com/your-search-page');
        ";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        dbDelta( $sqlUdpate1 );
        dbDelta( $sqlUdpate2 );

}

add_action('wp_print_styles', 'add_my_styles2', 100);
function add_my_styles2() {
wp_register_style( 'eigene-css', site_url() .'/wp-content/plugins/admin-user-messages/css/style.css');
wp_enqueue_style( 'eigene-css' );
}
add_action('init', 'add_my_styles2');

include('admin_user_messages_search.php');
include('admin_user_messages_functions.php');
include('admin_user_messages_inbox.php');
include('admin_user_messages_write_message.php');
include('admin_user_messages_read_message.php');
include('admin_user_messages_answer_message.php');
include('admin_user_messages_sent_messages.php');

add_action('admin_menu', 'mt_add_pages');
function mt_add_pages() {
add_options_page(__('Admin User Messages','menu-test'), __('Admin User Messages','menu-test'), 'manage_options', 'testsettings', 'admin_user_msg2');
}








?>