<?php

add_action('wpcf7_before_send_mail', 'subscribe_to_mailchimp');
function subscribe_to_mailchimp($contact_form) {

    $submission = WPCF7_Submission::get_instance();

    if (!$submission) {
        return;
    }

    $posted_data = $submission->get_posted_data();
    if (empty($posted_data)) {
        return;
    }

    if (isset($posted_data['further-info']) && $posted_data['further-info'] == 'on') {
        $api_key = '8b40e2b762a4ecd3e42279228aec02b5-us19';
        $list_id = '452df07a7d';
        // $email = sanitize_email($posted_data['your-email']);
        // $name = sanitize_text_field($posted_data['your-name']);

        $email = sanitize_email($posted_data['your-email']);
        $name = isset($posted_data['your-name']) ? sanitize_text_field($posted_data['your-name']) : '';

        $data = array(
            'email_address' => $email,
            'status' => 'subscribed',
            'merge_fields' => array(
                'FNAME' => $name
            )
        );
        $url = 'https://us19.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
        $args = array(
            'method' => 'POST',
            'headers' => array(
                'Authorization' => 'Basic ' . base64_encode('user:' . $api_key),
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode($data),
            'timeout' => 15
        );
        $response = wp_remote_post($url, $args);
        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
        }
    }


}




add_action('wpcf7_before_send_mail', 'subscribe_to_mailchimp');

function subscribe_to_mailchimp($contact_form) {
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) {
        return;
    }

    $posted_data = $submission->get_posted_data();
    if (empty($posted_data)) {
        return;
    }

    // Verifica se o campo autorizacao_mailchimp está presente e marcado
    if (isset($posted_data['further-info']) && $posted_data['further-info'] == 'Autorizo a subscrever no Mailchimp') {
        $api_key = '8b40e2b762a4ecd3e42279228aec02b5-us1'; // Substitua pelo sua chave de API do Mailchimp
        $list_id = '452df07a7d'; // Substitua pelo ID da sua lista no Mailchimp
        $email = sanitize_email($posted_data['your-email']);
        $name = isset($posted_data['your-name']) ? sanitize_text_field($posted_data['your-name']) : '';

        $url = 'https://us19.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
        // Substitua <dc> pelo data center do seu Mailchimp (ex: us5)

        $data = array(
            'email_address' => $email,
            'status' => 'subscribed', // Ou 'pending' se deseja enviar um email de confirmação
            'merge_fields' => array(
                'FNAME' => $name
            )
        );

        $args = array(
            'method' => 'POST',
            'headers' => array(
                'Authorization' => 'Basic ' . base64_encode('user:' . $api_key),
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode($data),
            'timeout' => 15
        );

        $response = wp_remote_post($url, $args);

        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            console.log("ERRO =>". $error_message);
        }
    }
}







?>