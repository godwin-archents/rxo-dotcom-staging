<?php
/*
 * Template Name: Track
 * description: Template for track page with tracking code
 */
require_once get_template_directory() . '/inc/tracking-codes.php';

get_header();

if ( $post->post_password ) {
    $publish_status = 'protected';
} else {
    $publish_status = 'public';
}
if(($post->post_password && !post_password_required()) || (empty($post->password) && $publish_status == 'public') ) {
?>
<?php
$httpcode = 200;

$trackingNumber = filter_var($_REQUEST['trackingNumber'], FILTER_SANITIZE_STRING);

$orderNumber = filter_var($_REQUEST['orderNumber'], FILTER_SANITIZE_STRING);

$zipcodeNumber = filter_var($_REQUEST['zipcode'], FILTER_SANITIZE_STRING);

$ShipmentNumber = filter_var($_REQUEST['ShipmentNumber'], FILTER_SANITIZE_STRING);

$ProNumber = filter_var($_REQUEST['ProNumber'], FILTER_SANITIZE_STRING);

$JobNumber = filter_var($_REQUEST['JobNumber'], FILTER_SANITIZE_STRING);

$ReferenceNumber = filter_var($_REQUEST['ReferenceNumber'], FILTER_SANITIZE_STRING);

$phoneNumber = filter_var($_REQUEST['phoneNumber'], FILTER_SANITIZE_STRING);


if (!empty($trackingNumber)) {
    /*
    $multiple_track_codes = is_multiple_track_codes($trackingNumber);
    $is_multiple_track_codes = count($multiple_track_codes) ? true : false;

    if (!$is_multiple_track_codes) {
        $is_track_code = is_track_code($trackingNumber);
    } else {
        $is_track_code = true;
    }
    */
    $is_track_code = true;

    if ($is_track_code) {
        $client_id = TRACKING_CLIENT_ID;
        $client_secret = TRACKING_CLIENT_SECRET;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => TRACKING_SECRET_API,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => array(
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'grant_type' => 'client_credentials'
            ),
        ));

        $token = curl_exec($ch);
        $token_httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$token || $token_httpcode != 200) {
            echo '<script>console.log("token_error ' . $token_httpcode . '", "' . curl_error($ch) . '");</script>';
        }
        curl_close($ch);

        $bearer_token = json_decode($token);

        $curl = curl_init();

        if ($is_multiple_track_codes) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_MULTIPLE_API,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
                CURLOPT_POSTFIELDS => json_encode($multiple_track_codes)
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_API . $trackingNumber,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
            ));
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!$response || $httpcode != 200) {
            echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($curl) . '");</script>';
        }
        curl_close($curl);

        $res = json_decode($response);
        $data = std_object_to_array($res);

        if ($data['redirectUrl']) {

            $url = $data['redirectUrl'];
            wp_redirect($url);
            exit;
        }

        if ($data['statusCode'] && $data['statusCode'] == 500) {

            //$url = $data['redirectUrl'];
            //wp_redirect($url);
            //exit;
            $data = [];
        }




        // For debugging purpose
        echo '<script>console.log("tracking_response", ' . $response . ');</script>';
    }
}

if ((!empty($orderNumber)) && (!empty($zipcodeNumber))) {
    /*
    $multiple_track_codes = is_multiple_track_codes($trackingNumber);
    $is_multiple_track_codes = count($multiple_track_codes) ? true : false;

    if (!$is_multiple_track_codes) {
        $is_track_code = is_track_code($trackingNumber);
    } else {
        $is_track_code = true;
    }
    */
    $is_track_code = true;

    $trackingOrder = "order/" . $orderNumber . "/zip/" . $zipcodeNumber;

    //$trackingOrder = "order/12592996/zip/J1N1H3";

    if ($is_track_code) {
        $client_id = TRACKING_CLIENT_ID;
        $client_secret = TRACKING_CLIENT_SECRET;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => TRACKING_SECRET_API,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => array(
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'grant_type' => 'client_credentials'
            ),
        ));

        $token = curl_exec($ch);
        $token_httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$token || $token_httpcode != 200) {
            echo '<script>console.log("token_error ' . $token_httpcode . '", "' . curl_error($ch) . '");</script>';
        }
        curl_close($ch);

        $bearer_token = json_decode($token);

        $curl = curl_init();

        if ($is_multiple_track_codes) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_MULTIPLE_API,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
                CURLOPT_POSTFIELDS => json_encode($multiple_track_codes)
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_WITH_ZIPCODE_API . $trackingOrder,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
            ));
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!$response || $httpcode != 200) {
            echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($curl) . '");</script>';
        }
        curl_close($curl);

        $res = json_decode($response);
        $data = std_object_to_array($res);

        if ($data['statusCode'] && $data['statusCode'] == 500) {

            //$url = $data['redirectUrl'];
            //wp_redirect($url);
            //exit;
            $data = [];
        }

        // For debugging purpose
        echo '<script>console.log("tracking_response", ' . $response . ');</script>';
    }
}

if (!empty($ShipmentNumber)) {
    /*
    $multiple_track_codes = is_multiple_track_codes($trackingNumber);
    $is_multiple_track_codes = count($multiple_track_codes) ? true : false;

    if (!$is_multiple_track_codes) {
        $is_track_code = is_track_code($trackingNumber);
    } else {
        $is_track_code = true;
    }
    */
    $is_track_code = true;

    $trackingOrder = "?number=" . $ShipmentNumber . "&type=NLM";

    //$trackingOrder = $ShipmentNumber;

    ////http://apiconnectdev.xpo.com/XpoDotComApi/shipments?number=11434339&type=NLM'
    //$trackingOrder = "order/12592996/zip/J1N1H3";

    //define('TRACKING_LEGACY_API', 'https://rxoincstg.wpengine.com/wp-content/themes/rxo/json/expedite.json');

    if ($is_track_code) {
        $client_id = TRACKING_CLIENT_ID;
        $client_secret = TRACKING_CLIENT_SECRET;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => TRACKING_SECRET_API,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => array(
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'grant_type' => 'client_credentials'
            ),
        ));

        $token = curl_exec($ch);
        $token_httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$token || $token_httpcode != 200) {
            echo '<script>console.log("token_error ' . $token_httpcode . '", "' . curl_error($ch) . '");</script>';
        }
        curl_close($ch);

        $bearer_token = json_decode($token);

        $curl = curl_init();

        if ($is_multiple_track_codes) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_MULTIPLE_API,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
                CURLOPT_POSTFIELDS => json_encode($multiple_track_codes)
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_LEGACY_API . $trackingOrder,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTP,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
            ));
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!$response || $httpcode != 200) {
            echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($curl) . '");</script>';
        }
        curl_close($curl);

        $res = json_decode($response);
        $data = std_object_to_array($res);

        
        if ($data['redirectUrl']) {

            $url = $data['redirectUrl'];
            wp_redirect($url);
            exit;
        }

        if ($data['statusCode'] && $data['statusCode'] == 500) {

            //$url = $data['redirectUrl'];
            //wp_redirect($url);
            //exit;
            $data = [];
        }

        if ($data['Type']) {

            //var_dump($data);

            //$data = [];
        }

        // For debugging purpose
        echo '<script>console.log("tracking_response", ' . $response . ');</script>';
    }
}

if (!empty($ProNumber)) {
    /*
    $multiple_track_codes = is_multiple_track_codes($trackingNumber);
    $is_multiple_track_codes = count($multiple_track_codes) ? true : false;

    if (!$is_multiple_track_codes) {
        $is_track_code = is_track_code($trackingNumber);
    } else {
        $is_track_code = true;
    }
    */
    $is_track_code = true;

    //$trackingOrder = "?number=" . $ProNumber . "&type=CON_WAY";

    $trackingOrder = $ProNumber;

    //http://legacy-tracking-api.rxo.com/shipments?number=742146720&type=CON_WAY
    //$trackingOrder = "order/12592996/zip/J1N1H3";

    if ($is_track_code) {
        $client_id = TRACKING_CLIENT_ID;
        $client_secret = TRACKING_CLIENT_SECRET;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => TRACKING_SECRET_API,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => array(
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'grant_type' => 'client_credentials'
            ),
        ));

        $token = curl_exec($ch);
        $token_httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$token || $token_httpcode != 200) {
            echo '<script>console.log("token_error ' . $token_httpcode . '", "' . curl_error($ch) . '");</script>';
        }
        curl_close($ch);

        $bearer_token = json_decode($token);

        $curl = curl_init();

        if ($is_multiple_track_codes) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_MULTIPLE_API,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
                CURLOPT_POSTFIELDS => json_encode($multiple_track_codes)
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_LEGACY_API . $trackingOrder,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
            ));
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!$response || $httpcode != 200) {
            echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($curl) . '");</script>';
        }
        curl_close($curl);

        $res = json_decode($response);
        $data = std_object_to_array($res);

        
        if ($data['redirectUrl']) {

            $url = $data['redirectUrl'];
            wp_redirect($url);
            exit;
        }

        if ($data['statusCode'] && $data['statusCode'] == 500) {

            //$url = $data['redirectUrl'];
            //wp_redirect($url);
            //exit;
            $data = [];
        }

        if ($data['Type']) {

            //var_dump($data);

            //$data = [];
        }

        // For debugging purpose
        echo '<script>console.log("tracking_response", ' . $response . ');</script>';
    }
}

if (!empty($JobNumber)) {
    /*
    $multiple_track_codes = is_multiple_track_codes($trackingNumber);
    $is_multiple_track_codes = count($multiple_track_codes) ? true : false;

    if (!$is_multiple_track_codes) {
        $is_track_code = is_track_code($trackingNumber);
    } else {
        $is_track_code = true;
    }
    */
    $is_track_code = true;

    $trackingOrder = "?number=" . $JobNumber . "&type=LAST_MILE";

    //$trackingOrder = $JobNumber;

    //http://legacy-tracking-api.rxo.com/shipments?number=05FD1267&type=LAST_MILE
    //$trackingOrder = "order/12592996/zip/J1N1H3";

    if ($is_track_code) {
        $client_id = TRACKING_CLIENT_ID;
        $client_secret = TRACKING_CLIENT_SECRET;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => TRACKING_SECRET_API,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => array(
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'grant_type' => 'client_credentials'
            ),
        ));

        $token = curl_exec($ch);
        $token_httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$token || $token_httpcode != 200) {
            echo '<script>console.log("token_error ' . $token_httpcode . '", "' . curl_error($ch) . '");</script>';
        }
        curl_close($ch);

        $bearer_token = json_decode($token);

        $curl = curl_init();

        if ($is_multiple_track_codes) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_MULTIPLE_API,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
                CURLOPT_POSTFIELDS => json_encode($multiple_track_codes)
            ));
        } else {
            /*
            CURLOPT_URL => TRACKING_LEGACY_API . $trackingOrder,
            */
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_LEGACY_API . $trackingOrder,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTP,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
            ));
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!$response || $httpcode != 200) {
            echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($curl) . '");</script>';
        }
        curl_close($curl);

        $res = json_decode($response);
        $data = std_object_to_array($res);

        
        if ($data['redirectUrl']) {

            $url = $data['redirectUrl'];
            wp_redirect($url);
            exit;
        }

        if ($data['statusCode'] && $data['statusCode'] == 500) {

            //$url = $data['redirectUrl'];
            //wp_redirect($url);
            //exit;
            $data = [];
        }

        if ($data['Type']) {

            //var_dump($data);

            //$data = [];
        }

        if ($data['IsMatch']) {

            //var_dump($data);

            //$data = [];
        } else {
            $data = [];
        }
 

        // For debugging purpose
        echo '<script>console.log("tracking_response", ' . $response . ');</script>';
    }
}

if ((!empty($ReferenceNumber)) && (!empty($phoneNumber))) {
    /*
    $multiple_track_codes = is_multiple_track_codes($trackingNumber);
    $is_multiple_track_codes = count($multiple_track_codes) ? true : false;

    if (!$is_multiple_track_codes) {
        $is_track_code = is_track_code($trackingNumber);
    } else {
        $is_track_code = true;
    }
    */
    $is_track_code = true;

    $trackingOrder = "?number=" . $ReferenceNumber . "&crossReferenceNumber=" . $phoneNumber . "&type=LAST_MILE";

    //http://legacy-tracking-api.rxo.com/shipments?number=81891523&crossReferenceNumber=7732625040&type=LAST_MILE
    //$trackingOrder = "order/12592996/zip/J1N1H3";

    if ($is_track_code) {
        $client_id = TRACKING_CLIENT_ID;
        $client_secret = TRACKING_CLIENT_SECRET;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => TRACKING_SECRET_API,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => array(
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'grant_type' => 'client_credentials'
            ),
        ));

        $token = curl_exec($ch);
        $token_httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!$token || $token_httpcode != 200) {
            echo '<script>console.log("token_error ' . $token_httpcode . '", "' . curl_error($ch) . '");</script>';
        }
        curl_close($ch);

        $bearer_token = json_decode($token);

        $curl = curl_init();

        if ($is_multiple_track_codes) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_MULTIPLE_API,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
                CURLOPT_POSTFIELDS => json_encode($multiple_track_codes)
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_URL => TRACKING_LEGACY_API . $trackingOrder,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_PROTOCOLS => CURLPROTO_HTTP,
                CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/json",
                    "Content-Type: application/json; charset=utf-8",
                    'Authorization: Bearer ' . $bearer_token->access_token
                ),
            ));
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (!$response || $httpcode != 200) {
            echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($curl) . '");</script>';
        }
        curl_close($curl);

        $res = json_decode($response);
        $data = std_object_to_array($res);

        
        if ($data['redirectUrl']) {

            $url = $data['redirectUrl'];
            wp_redirect($url);
            exit;
        }

        if ($data['statusCode'] && $data['statusCode'] == 500) {

            //$url = $data['redirectUrl'];
            //wp_redirect($url);
            //exit;
            $data = [];
        }

        if ($data['Type']) {

            //var_dump($data);

            //$data = [];
        }

        // For debugging purpose
        echo '<script>console.log("tracking_response", ' . $response . ');</script>';
    }
}
?>
<?php if ($is_multiple_track_codes && $data && count($data) && $httpcode == 200) : ?>

<?php elseif ($is_track_code && $data && count($data) && $data['Type']=='NLM' && $httpcode == 200) : ?>
    <?php

$deliveryInfo = array();
$progressInfo =  array();
$keyInfo =  array();
$groupInfo =  array();
$groupInfoRows = array();
$accordionInfo =  array();
$equipmentInfo =  array();
$shipmentInfo =  array();
$trackingNumber = '';
$componentsData = array();


$deliveryInfo = $data['NlmShipment'];
$componentsData = $data['NlmShipment'];
$keyInfo = $data['NlmShipment'];
//$accordionInfo = $keyInfo['ItemDetails'];
//$groupInfoRows = $keyInfo['History'];

?>
<?php elseif ($is_track_code && $data && count($data) && $data['Type']=='CON_WAY' && $httpcode == 200) : ?>

<?php elseif ($is_track_code && $data && count($data) && $data['Type']=='LAST_MILE' && $httpcode == 200) : ?>
    <?php

$deliveryInfo = array();
$progressInfo =  array();
$keyInfo =  array();
$groupInfo =  array();
$groupInfoRows = array();
$accordionInfo =  array();
$equipmentInfo =  array();
$shipmentInfo =  array();
$trackingNumber = '';
$componentsData = array();
if($data['LastMileShipmentDetails']!=null){
    $deliveryInfo = $data['LastMileShipmentDetails'];
    $componentsData = $data['LastMileShipmentDetails'];
    $keyInfo = $data['LastMileShipmentDetails'];
    $accordionInfo = $keyInfo['ItemDetails'];
    $groupInfoRows = $keyInfo['History'];
} else {
    $data['Type']=='EMPTY';
}
/*
echo "<hr/>";

print_r($keyInfo);

echo "<hr/>";

print_r($accordionInfo);

echo "<hr/>";

print_r($groupInfoRows);

echo "<hr/>";
*/

/*
foreach ($data['LastMileShipmentDetails'] as $componentsData) {

    $keyInfo =  $componentsData;

    $accordionInfo = $componentsData['ItemDetails'];

    $groupInfoRows = $componentsData['History'];


    echo "<hr/>";

    print_r($keyInfo);

    echo "<hr/>";
    
    print_r($accordionInfo);
    
    echo "<hr/>";

    print_r($groupInfoRows);
    
    echo "<hr/>";

}
*/

    /*
    if (!isset($componentsData['component_name'])) {
        $data = [];
    }
    

    if ($componentsData['component_name'] == "track-delivery-details") {
        $deliveryInfo = $componentsData['component_data'];
    }
    if ($componentsData['component_name'] == "track-progress-tracker") {
        $progressInfo = $componentsData['component_data'];
    }
    if ($componentsData['component_name'] == "track-key-value-list") {
        $keyInfo = $componentsData['component_data']['items'];
        $trackingNumber = $keyInfo[0]['item_value'];
    }
    if ($componentsData['component_name'] == "track-group-list") {
        $groupInfo = $componentsData['component_data']['items'];
        if (isset($groupInfo[0]['group_rows'])) {
            $groupInfoRows = $groupInfo[0]['group_rows'];
        }
    }
    if ($componentsData['component_name'] == "track-accordion") {
        if ($componentsData['panel_title'] == "Items") {
            $accordionInfo = $componentsData['component_data']['items'];
        }
        if ($componentsData['panel_title'] == "EQUIPMENT") {
            $equipmentInfo = $componentsData['component_data']['items'];
        }
    }
    if ($componentsData['component_name'] == "track-table") {
        $shipmentInfo = $componentsData['component_data'];
    }
    */
?>
<?php elseif ($is_track_code && $data && count($data) && $data['Type']=='EMPTY' && $httpcode == 200) : ?>

<?php elseif ($is_track_code && $data && count($data) && $httpcode == 200) : ?>
    <?php

    $deliveryInfo = array();
    $progressInfo =  array();
    $keyInfo =  array();
    $groupInfo =  array();
    $groupInfoRows = array();
    $accordionInfo =  array();
    $equipmentInfo =  array();
    $shipmentInfo =  array();
    $trackingNumber = '';

    foreach ($data['components'] as $componentsData) {

        if (!isset($componentsData['component_name'])) {
            $data = [];
        }


        if ($componentsData['component_name'] == "track-delivery-details") {
            $deliveryInfo = $componentsData['component_data'];
        }
        if ($componentsData['component_name'] == "track-progress-tracker") {
            $progressInfo = $componentsData['component_data'];
        }
        if ($componentsData['component_name'] == "track-key-value-list") {
            $keyInfo = $componentsData['component_data']['items'];
            $trackingNumber = $keyInfo[0]['item_value'];
        }
        if ($componentsData['component_name'] == "track-group-list") {
            $groupInfo = $componentsData['component_data']['items'];
            if (isset($groupInfo[0]['group_rows'])) {
                $groupInfoRows = $groupInfo[0]['group_rows'];
            }
        }
        if ($componentsData['component_name'] == "track-accordion") {
            if ($componentsData['panel_title'] == "Items") {
                $accordionInfo = $componentsData['component_data']['items'];
            }
            if ($componentsData['panel_title'] == "EQUIPMENT") {
                $equipmentInfo = $componentsData['component_data']['items'];
            }
        }
        if ($componentsData['component_name'] == "track-table") {
            $shipmentInfo = $componentsData['component_data'];
        }
    }
    ?>
<?php else : ?>

<?php endif; ?>


<main id="primary" class="site-main">
    <div class="container-fluid px-0 bg-black py-7 bg-pattern-right">
        <div class="container">
            <?php if($httpcode==200) { ?>
            <h2 class="text-white">Tracking Results</h2>    
            <?php } else { ?>
            <h2 class="text-white">Tracking Results - Not Found</h2>
            <?php } ?>        
        </div>
    </div>
    <div class="container py-6">
        <div class="row">
            <div class="col-12">
                <form id="track-form" class="track-form align-items-center border-2 border-bottom border-primary-dark d-flex" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                    <input type="text" maxlength="255" placeholder="Tracking Number" name="trackingNumber" id="search-input-track" class="form-control flex-grow-1 order-1 border-0 bg-transparent fw-bold" value="<?= $trackingNumber; ?>" required />
                    <button class="btn btn-link py-0" type="submit" aria-label="search">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6368 11.8022C9.52023 12.6702 8.11723 13.187 6.59352 13.187C2.95202 13.187 0 10.235 0 6.59352C0 2.95202 2.95202 0 6.59352 0C10.235 0 13.187 2.95202 13.187 6.59352C13.187 8.11718 12.6702 9.52013 11.8023 10.6366L16 14.8343L14.8344 15.9998L10.6368 11.8022ZM11.5387 6.59352C11.5387 9.32463 9.32463 11.5387 6.59352 11.5387C3.8624 11.5387 1.64838 9.32463 1.64838 6.59352C1.64838 3.8624 3.8624 1.64838 6.59352 1.64838C9.32463 1.64838 11.5387 3.8624 11.5387 6.59352Z" fill="#1C1C1C"></path>
                        </svg>
                    </button>
                    <button class="btn btn-link py-0 order-3" type="button" aria-label="close searchbar" onclick="document.getElementById('search-input-track').value=''">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.53267 8L15.6633 1.86253C16.0886 1.43681 16.0886 0.745011 15.6633 0.31929C15.2381 -0.10643 14.5471 -0.10643 14.1218 0.31929L7.99114 6.45676L1.86047 0.337029C1.43522 -0.0886917 0.744186 -0.0886917 0.318937 0.337029C-0.106312 0.762749 -0.106312 1.45455 0.318937 1.88027L6.44961 8L0.336656 14.1375C-0.0885936 14.5632 -0.0885936 15.255 0.336656 15.6807C0.761905 16.1064 1.45293 16.1064 1.87818 15.6807L8.00886 9.54324L14.1395 15.6807C14.5648 16.1064 15.2558 16.1064 15.6811 15.6807C16.1063 15.255 16.1063 14.5632 15.6811 14.1375L9.53267 8Z" fill="#1C1C1C"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>


    <?php if ($is_multiple_track_codes && $data && count($data) && $httpcode == 200) : ?>

            
    <?php elseif ($is_track_code && $data && count($data) && $data['Type']=='NLM' && $httpcode == 200) : ?>
        <?php /* * / ?>
        <div id="loaderData" class="container article-width pb-6">
            <div class="row mb-7">
                <div class="col-12">
                    <?php var_dump($data); ?>
                </div>
            </div>
        </div>
        <?php /* */ ?>
        <div id="loaderData" class="container article-width pb-6">
            
            <div class="row mb-7">
                <div class=" col-12 col-lg-8 mx-auto">
                    <?php if (isset($deliveryInfo)) { ?>
                        <p class="mb-0"><span class="text-500">Estimated delivery</span></p>
                    <?php } ?>
                    <?php if (isset($deliveryInfo['CalledIn'])) { ?>
                        <h3 class="my-2">
                        <?php echo date("l, F d",strtotime($deliveryInfo['CalledIn']))." at ".date("h:i A",strtotime($deliveryInfo['CalledIn'])); ?>
                        </h3>
                    <?php } ?>

                    <?php /* ?>
                    <div class="progress-steps col-12 col-lg-10 mx-auto my-5">
                        <?php
                        $progressCurrentStep = $progressInfo['complete_step'];
                        $progressCurrentState = $progressInfo['state'];

                        if (count($progressInfo['progress_items']) > 0) {
                            $p = 0;
                            foreach ($progressInfo['progress_items'] as $progressInfoItemData) {
                                $p++;
                        ?>
                                <div class="steps 
                        <?php
                                if ($progressCurrentStep > $p) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep == 1) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep == 3) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep < 3) {
                                    echo 'inprogress';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "warning") {
                                    echo 'indanger';
                                } else if ($progressCurrentStep == $p + 1) {
                                    echo 'inprogress';
                                } else {
                                }
                        ?> 
                        ">
                                    <?php echo $progressInfoItemData['label']; ?>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                    <p>Tracking number: <strong><?php echo $trackingNumber; ?></strong></p>
                    <?php */ ?>
                    
                    <?php if (isset($deliveryInfo['ShipmentNumber'])) { ?>
                        <p><span class="text-500">Tracking number:</span> <strong><?php echo $deliveryInfo['ShipmentNumber']; ?></strong></p>
                    <?php } ?> 
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php if (count($componentsData) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Details</h4>
                            
                            <p class="mb-2"><span class="text-500">Origin:</span> <strong><?php echo $keyInfo['OriginalShipper']; ?></strong></p>
                            <p class="mb-2"><span class="text-500">Destination:</span> <strong><?php echo $keyInfo['FinalConsignee']; ?></strong></p>
                            <p class="mb-2"><span class="text-500">Order number:</span> <strong><?php echo $keyInfo['ShipmentNumber']; ?></strong></p>
                        </div>
                    <?php } ?>
                    <?php if (count($equipmentInfo) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Equipment</h4>
                            <?php
                            $i = 0;
                            foreach ($equipmentInfo as $equipmentInfoData) {
                                $i++;
                            ?>
                                <p class="mb-2">ID: <strong> <?php echo $equipmentInfoData['item_title']; ?></strong></p>
                                <?php foreach ($equipmentInfoData['item_details'] as $equipmentInfoDetailData) { ?>
                                    <p class="mb-1"><span class="text-500"><?php echo $equipmentInfoDetailData['key']; ?>:</span> <strong><?php echo $equipmentInfoDetailData['value']; ?></strong></p>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if (count($accordionInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Items</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 0;
                                foreach ($accordionInfo as $accordionInfoData) {
                                    $i++;
                                ?>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                            <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                Item <?php echo $accordionInfoData['ItemNumber']; ?>
                                            </button>
                                        </h5>
                                        <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                            <div class="accordion-body">
                                            <p class="mb-1"><span class="text-500">Name:</span> <strong><?php echo $accordionInfoData['ItemName']; ?></strong></p>    
                                            <p class="mb-1"><span class="text-500">Quantity:</span> <strong><?php echo $accordionInfoData['QuantityShipped']; ?></strong></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                    <?php if (count($shipmentInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Shipments</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 1000;
                                $j = 0;
                                foreach ($shipmentInfo['table_head'] as $shipmentInfoData) {
                                    $i++;
                                    if ($shipmentInfoData == "Shipment #") {
                                ?>
                                        <?php foreach ($shipmentInfo['table_rows'] as $shipmentInfoRowData) { ?>
                                            <div class="accordion-item">
                                                <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                                    <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                        <?php echo $shipmentInfoData; ?> <?php echo $shipmentInfoRowData['row_items'][$j]['item_label']; ?>
                                                    </button>
                                                </h5>
                                                <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                                    <div class="accordion-body">
                                                        <?php $k = 0;
                                                        foreach ($shipmentInfoRowData['row_items'] as $shipmentInfoDetailData) { ?>
                                                            <?php if ($shipmentInfo['table_head'][$k] == "Origin" || $shipmentInfo['table_head'][$k] == "Destination") {  ?>
                                                                <p class="mb-1"><span class="text-500"><?php echo $shipmentInfo['table_head'][$k]; ?>:</span> <strong><?php echo $shipmentInfoDetailData['item_label']; ?></strong></p>
                                                            <?php } ?>
                                                            <?php if (trim($shipmentInfo['table_head'][$k]) == "") {  ?>
                                                                <?php
                                                                $item_link = $shipmentInfoDetailData['item_link'];
                                                                $item_track = str_replace("/track/shipment/", "", $item_link);
                                                                //$item_track = "RXONC60SHOGNFHPJ22";
                                                                ?>
                                                                <p class="mb-1"><a href="<?php echo esc_url(home_url('/track')); ?>?trackingNumber=<?php echo $item_track; ?>" class="text-black text-decoration-underline">View Additional Details</a></p>
                                                            <?php } ?>
                                                        <?php $k++;
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                <?php
                                        $j++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <?php if (count($groupInfoRows) > 0) { ?>
                    <div class="col-12 col-lg-6">
                        <h4 class="border-bottom">History</h4>
                        <div class="d-flex flex-column progress-steps progress-vertical">
                            <?php
                            $i = 0;
                            foreach ($groupInfoRows as $groupInfoRowsData) {
                                $i++;

                                $Date = $groupInfoRowsData['Date'];
                                $Description = $groupInfoRowsData['Description'];
                                $Location = $groupInfoRowsData['Location'];
                            ?>
                                <div class="steps active">
                                    <div class="fs-6"><?php echo ucfirst(strtolower($Description)); ?></div>
                                    <div class="text-500"><?php echo $Date . ' ' . ucwords(strtolower($Location)); ?></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-12 col-lg-6"></div>
                <?php } ?>
            </div>
        </div>   
         
    <?php elseif ($is_track_code && $data && count($data) && $data['Type']=='CON_WAY' && $httpcode == 200) : ?>
        <div id="loaderData" class="container article-width pb-6">
            <div class="row mb-7">
                <div class="col-12">
                    <?php var_dump($data); ?>
                </div>
            </div>
        </div> 
    <?php elseif ($is_track_code && $data && count($data) && $data['Type']=='LAST_MILE' && $httpcode == 200) : ?>
        <?php /* ?>
        <div id="loaderData" class="container article-width pb-6">
            <div class="row mb-7">
                <div class="col-12">
                    <?php var_dump($data); ?>
                </div>
            </div>
        </div>
        <?php */ ?>
        <div id="loaderData" class="container article-width pb-6">
            
            <div class="row mb-7">
                <div class=" col-12 col-lg-8 mx-auto">
                    <?php if (isset($deliveryInfo)) { ?>
                        <p class="mb-0"><span class="text-500">Estimated delivery</span></p>
                    <?php } ?>
                    <?php if (isset($deliveryInfo['DeliveryDate'])) { ?>
                        <h3 class="my-2">
                        <?php echo date("l, F d",strtotime($deliveryInfo['DeliveryDate']))." at ".date("h:i A",strtotime($deliveryInfo['DeliveryDate'])); ?>
                        </h3>
                    <?php } ?>

                    <?php /* ?>
                    <div class="progress-steps col-12 col-lg-10 mx-auto my-5">
                        <?php
                        $progressCurrentStep = $progressInfo['complete_step'];
                        $progressCurrentState = $progressInfo['state'];

                        if (count($progressInfo['progress_items']) > 0) {
                            $p = 0;
                            foreach ($progressInfo['progress_items'] as $progressInfoItemData) {
                                $p++;
                        ?>
                                <div class="steps 
                        <?php
                                if ($progressCurrentStep > $p) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep == 1) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep == 3) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep < 3) {
                                    echo 'inprogress';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "warning") {
                                    echo 'indanger';
                                } else if ($progressCurrentStep == $p + 1) {
                                    echo 'inprogress';
                                } else {
                                }
                        ?> 
                        ">
                                    <?php echo $progressInfoItemData['label']; ?>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                    <p>Tracking number: <strong><?php echo $trackingNumber; ?></strong></p>
                    <?php */ ?>
                    
                    <?php if (isset($deliveryInfo['ShipmentNumber'])) { ?>
                        <p><span class="text-500">Tracking number:</span> <strong><?php echo $deliveryInfo['ShipmentNumber']; ?></strong></p>
                    <?php } ?>

                    <?php if (isset($deliveryInfo['Status'])) { ?>
                        <p><span class="text-500">Status:</span> <strong><?php echo $deliveryInfo['Status']; ?></strong></p>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php if (count($componentsData) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Details</h4>
                            <p class="mb-2"><span class="text-500">Destination:</span> <strong><?php echo $keyInfo['DeliverTo']; ?></strong></p>
                            <p class="mb-2"><span class="text-500">Order number:</span> <strong><?php echo $keyInfo['ShipmentNumber']; ?></strong></p>
                        </div>
                    <?php } ?>
                    <?php if (count($equipmentInfo) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Equipment</h4>
                            <?php
                            $i = 0;
                            foreach ($equipmentInfo as $equipmentInfoData) {
                                $i++;
                            ?>
                                <p class="mb-2">ID: <strong> <?php echo $equipmentInfoData['item_title']; ?></strong></p>
                                <?php foreach ($equipmentInfoData['item_details'] as $equipmentInfoDetailData) { ?>
                                    <p class="mb-1"><span class="text-500"><?php echo $equipmentInfoDetailData['key']; ?>:</span> <strong><?php echo $equipmentInfoDetailData['value']; ?></strong></p>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if (count($accordionInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Items</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 0;
                                foreach ($accordionInfo as $accordionInfoData) {
                                    $i++;
                                ?>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                            <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                Item <?php echo $accordionInfoData['ItemNumber']; ?>
                                            </button>
                                        </h5>
                                        <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                            <div class="accordion-body">
                                            <p class="mb-1"><span class="text-500">Name:</span> <strong><?php echo $accordionInfoData['ItemName']; ?></strong></p>    
                                            <p class="mb-1"><span class="text-500">Quantity:</span> <strong><?php echo $accordionInfoData['QuantityShipped']; ?></strong></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                    <?php if (count($shipmentInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Shipments</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 1000;
                                $j = 0;
                                foreach ($shipmentInfo['table_head'] as $shipmentInfoData) {
                                    $i++;
                                    if ($shipmentInfoData == "Shipment #") {
                                ?>
                                        <?php foreach ($shipmentInfo['table_rows'] as $shipmentInfoRowData) { ?>
                                            <div class="accordion-item">
                                                <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                                    <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                        <?php echo $shipmentInfoData; ?> <?php echo $shipmentInfoRowData['row_items'][$j]['item_label']; ?>
                                                    </button>
                                                </h5>
                                                <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                                    <div class="accordion-body">
                                                        <?php $k = 0;
                                                        foreach ($shipmentInfoRowData['row_items'] as $shipmentInfoDetailData) { ?>
                                                            <?php if ($shipmentInfo['table_head'][$k] == "Origin" || $shipmentInfo['table_head'][$k] == "Destination") {  ?>
                                                                <p class="mb-1"><span class="text-500"><?php echo $shipmentInfo['table_head'][$k]; ?>:</span> <strong><?php echo $shipmentInfoDetailData['item_label']; ?></strong></p>
                                                            <?php } ?>
                                                            <?php if (trim($shipmentInfo['table_head'][$k]) == "") {  ?>
                                                                <?php
                                                                $item_link = $shipmentInfoDetailData['item_link'];
                                                                $item_track = str_replace("/track/shipment/", "", $item_link);
                                                                //$item_track = "RXONC60SHOGNFHPJ22";
                                                                ?>
                                                                <p class="mb-1"><a href="<?php echo esc_url(home_url('/track')); ?>?trackingNumber=<?php echo $item_track; ?>" class="text-black text-decoration-underline">View Additional Details</a></p>
                                                            <?php } ?>
                                                        <?php $k++;
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                <?php
                                        $j++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <?php if (count($groupInfoRows) > 0) { ?>
                    <div class="col-12 col-lg-6">
                        <h4 class="border-bottom">History</h4>
                        <div class="d-flex flex-column progress-steps progress-vertical">
                            <?php
                            $i = 0;
                            foreach ($groupInfoRows as $groupInfoRowsData) {
                                $i++;

                                $Date = $groupInfoRowsData['Date'];
                                $Description = $groupInfoRowsData['Description'];
                                $Location = $groupInfoRowsData['Location'];
                            ?>
                                <div class="steps active">
                                    <div class="fs-6"><?php echo ucfirst(strtolower($Description)); ?></div>
                                    <div class="text-500"><?php echo $Date . ' ' . ucwords(strtolower($Location)); ?></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-12 col-lg-6"></div>
                <?php } ?>
            </div>
        </div>   
        
        <?php /* * / ?>
        <div id="loaderData" class="container article-width pb-6">
            <div class="row mb-7">
                <div class="col-12">
                    <?php if (trim($deliveryInfo['title']) != "") { ?>
                        <p class="mb-0"><?php echo $deliveryInfo['title']; ?> </p>
                    <?php } ?>
                    <?php if (trim($deliveryInfo['weekday']) != "") { ?>
                        <h3 class="my-2"><?php echo $deliveryInfo['weekday']; ?>, <?php echo $deliveryInfo['month_day']; ?> at <?php echo $deliveryInfo['time']; ?> </h3>
                    <?php } ?>
                    <div class="progress-steps col-12 col-lg-10 mx-auto my-5">
                        <?php
                        $progressCurrentStep = $progressInfo['complete_step'];
                        $progressCurrentState = $progressInfo['state'];

                        if (count($progressInfo['progress_items']) > 0) {
                            $p = 0;
                            foreach ($progressInfo['progress_items'] as $progressInfoItemData) {
                                $p++;
                        ?>
                                <div class="steps 
                        <?php
                                if ($progressCurrentStep > $p) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep == 1) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep == 3) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep < 3) {
                                    echo 'inprogress';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "warning") {
                                    echo 'indanger';
                                } else if ($progressCurrentStep == $p + 1) {
                                    echo 'inprogress';
                                } else {
                                }
                        ?> 
                        ">
                                    <?php echo $progressInfoItemData['label']; ?>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                    <p>Tracking number: <strong><?php echo $trackingNumber; ?></strong></p>
                    <?php if (isset($deliveryInfo['badge_label'])) { ?>
                        <p>Status:<strong><?php echo $deliveryInfo['badge_label']; ?></strong></p>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php if (count($componentsData) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Details</h4>
                            <p class="mb-2">Destination: <strong><?php echo $keyInfo['DeliverTo']; ?></strong></p>
                            <p class="mb-2">Order number: <strong><?php echo $keyInfo['ShipmentNumber']; ?></strong></p>
                        </div>
                    <?php } ?>
                    <?php if (count($equipmentInfo) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Equipment</h4>
                            <?php
                            $i = 0;
                            foreach ($equipmentInfo as $equipmentInfoData) {
                                $i++;
                            ?>
                                <p class="mb-2">ID: <strong> <?php echo $equipmentInfoData['item_title']; ?></strong></p>
                                <?php foreach ($equipmentInfoData['item_details'] as $equipmentInfoDetailData) { ?>
                                    <p class="mb-1"><?php echo $equipmentInfoDetailData['key']; ?>: <strong><?php echo $equipmentInfoDetailData['value']; ?></strong></p>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if (count($accordionInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Items</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 0;
                                foreach ($accordionInfo as $accordionInfoData) {
                                    $i++;
                                ?>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                            <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                Item <?php echo $accordionInfoData['ItemNumber']; ?>
                                            </button>
                                        </h5>
                                        <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                            <div class="accordion-body">
                                            <p class="mb-1">Name: <strong><?php echo $accordionInfoData['ItemName']; ?></strong></p>    
                                            <p class="mb-1">Quantity: <strong><?php echo $accordionInfoData['QuantityShipped']; ?></strong></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                    <?php if (count($shipmentInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Shipments</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 1000;
                                $j = 0;
                                foreach ($shipmentInfo['table_head'] as $shipmentInfoData) {
                                    $i++;
                                    if ($shipmentInfoData == "Shipment #") {
                                ?>
                                        <?php foreach ($shipmentInfo['table_rows'] as $shipmentInfoRowData) { ?>
                                            <div class="accordion-item">
                                                <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                                    <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                        <?php echo $shipmentInfoData; ?> <?php echo $shipmentInfoRowData['row_items'][$j]['item_label']; ?>
                                                    </button>
                                                </h5>
                                                <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                                    <div class="accordion-body">
                                                        <?php $k = 0;
                                                        foreach ($shipmentInfoRowData['row_items'] as $shipmentInfoDetailData) { ?>
                                                            <?php if ($shipmentInfo['table_head'][$k] == "Origin" || $shipmentInfo['table_head'][$k] == "Destination") {  ?>
                                                                <p class="mb-1"><?php echo $shipmentInfo['table_head'][$k]; ?>: <strong><?php echo $shipmentInfoDetailData['item_label']; ?></strong></p>
                                                            <?php } ?>
                                                            <?php if (trim($shipmentInfo['table_head'][$k]) == "") {  ?>
                                                                <?php
                                                                $item_link = $shipmentInfoDetailData['item_link'];
                                                                $item_track = str_replace("/track/shipment/", "", $item_link);
                                                                //$item_track = "RXONC60SHOGNFHPJ22";
                                                                ?>
                                                                <p class="mb-1"><a href="<?php echo esc_url(home_url('/track')); ?>?trackingNumber=<?php echo $item_track; ?>" class="text-black text-decoration-underline">View Additional Details</a></p>
                                                            <?php } ?>
                                                        <?php $k++;
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                <?php
                                        $j++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <?php if (count($groupInfoRows) > 0) { ?>
                    <div class="col-12 col-lg-6">
                        <h4 class="border-bottom">History</h4>
                        <div class="d-flex flex-column progress-steps progress-vertical">
                            <?php
                            $i = 0;
                            foreach ($groupInfoRows as $groupInfoRowsData) {
                                $i++;

                                $Date = $groupInfoRowsData['Date'];
                                $Description = $groupInfoRowsData['Description'];
                                $Location = $groupInfoRowsData['Location'];
                            ?>
                                <div class="steps active">
                                    <div class="fs-6"><?php echo ucfirst(strtolower($Description)); ?></div>
                                    <div class="text-500"><?php echo $Date . ' ' . ucwords(strtolower($Location)); ?></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-12 col-lg-6"></div>
                <?php } ?>
            </div>
        </div>   
        <?php /* */ ?>
    <?php elseif ($is_track_code && $data && count($data) && $data['Type']=='EMPTY' && $httpcode == 200) : ?>
        <div id="loaderForm" class="container article-width pb-6">
            <div class="row mb-7">
                <div class="col-12 col-md-11 col-lg-10 col-xl-9 mx-auto">
                <?php
                        $tab_title1=' active';
                        $tab_check1= ' checked="checked"';
                        $tab_content1=' show active';

                        $tab_title2=' ';
                        $tab_check2= ' ';
                        $tab_content2=' ';

                        $tab_title3=' ';
                        $tab_check3= ' ';
                        $tab_content3=' ';
                        $tab_title31=' ';
                        $tab_check31= ' ';
                        $tab_content31=' ';
                        $tab_title32=' ';
                        $tab_check32= ' ';
                        $tab_content32=' ';

                        $tab_title4=' ';
                        $tab_check4= ' ';
                        $tab_content4=' ';

                        if(isset($_REQUEST['ShipmentNumber'])) {
                        
                        $tab_title1=' active';
                        $tab_check1= ' checked="checked"';
                        $tab_content1=' show active';

                        $tab_title2=' ';
                        $tab_check2= ' ';
                        $tab_content2=' ';

                        $tab_title3=' ';
                        $tab_check3= ' ';
                        $tab_content3=' ';
                        $tab_title3=' ';
                        $tab_content3=' ';
                        $tab_title31=' ';
                        $tab_check31= ' ';
                        $tab_content31=' ';
                        $tab_content32=' ';
                        $tab_title32=' ';
                        $tab_check32= ' ';
                        $tab_content32=' ';

                        $tab_title4=' ';
                        $tab_check4= ' ';
                        $tab_content4=' ';

                        }

                        if((isset($_REQUEST['orderNumber'])) && (isset($_REQUEST['zipcode']))) {
                        
                            $tab_title1=' ';
                            $tab_check1= ' ';
                            $tab_content1=' ';
    
                            $tab_title2=' active';
                            $tab_check2= ' checked="checked"';
                            $tab_content2=' show active';
    
                            $tab_title3=' ';
                            $tab_check3= ' ';
                            $tab_content3=' ';
                            $tab_title3=' ';
                            $tab_content3=' ';
                            $tab_title31=' ';
                            $tab_check31= ' ';
                            $tab_content31=' ';
                            $tab_content32=' ';
                            $tab_title32=' ';
                            $tab_check32= ' ';
                            $tab_content32=' ';
    
                            $tab_title4=' ';
                            $tab_check4= ' ';
                            $tab_content4=' ';
                            
                        }

                        if(isset($_REQUEST['JobNumber'])) {
                        
                            $tab_title1=' ';
                            $tab_check1= ' ';
                            $tab_content1=' ';
    
                            $tab_title2=' ';
                            $tab_check2= ' ';
                            $tab_content2=' ';
    
                            $tab_title3=' active';
                            $tab_check3= ' checked="checked"';
                            $tab_content3=' show active';
                            $tab_title31=' active';
                            $tab_check31= ' checked="checked"';
                            $tab_content31=' show active';
                            $tab_title32=' ';
                            $tab_check32= ' ';
                            $tab_content32=' ';
    
                            $tab_title4=' ';
                            $tab_check4= ' ';
                            $tab_content4=' ';
                            
                        }

                        
                        if((isset($_REQUEST['ReferenceNumber'])) && (isset($_REQUEST['phoneNumber']))) {
                        
                            $tab_title1=' ';
                            $tab_check1= ' ';
                            $tab_content1=' ';
    
                            $tab_title2=' ';
                            $tab_check2= ' ';
                            $tab_content2=' ';
    
                            $tab_title3=' active';
                            $tab_check3= ' checked="checked"';
                            $tab_content3=' show active';
                            $tab_title31=' ';
                            $tab_check31= ' ';
                            $tab_content31=' ';
                            $tab_title32=' active';
                            $tab_check32= ' checked="checked"';
                            $tab_content32=' show active';
    
                            $tab_title4=' ';
                            $tab_content4=' ';
                            
                        }

                        
                       ?>
                        <!-- TAB : START -->

                        <h3 class="text-black fs-4 fw-normal">That tracking number is not associated with a shipment. If your tracking information does not begin with ‘RXO’, please select your mode or try again</h3>

                        <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3 py-7" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link py-0 <?=$tab_title1?>" id="v-pills-expedite-tab" data-bs-toggle="pill" data-bs-target="#v-pills-expedite" type="button" role="tab" aria-controls="v-pills-expedite" aria-selected="true">
                            <input type="radio" name="wpforms-track" id="wpforms-expedite" value="Expedite" <?=$tab_check1?> > <label class="wpforms-lable" for="wpforms-expedite">Expedite</label>
                            </button>
                            <button class="nav-link py-0 <?=$tab_title2?>" id="v-pills-freight-tab" data-bs-toggle="pill" data-bs-target="#v-pills-freight" type="button" role="tab" aria-controls="v-pills-freight" aria-selected="false">
                            <input type="radio" name="wpforms-track" id="wpforms-freight" value="Freight Brokerage" <?=$tab_check2?> > <label class="wpforms-lable" for="wpforms-freight">Freight Brokerage</label>
                            </button>
                            <button class="nav-link py-0 <?=$tab_title3?>" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="false">
                            <input type="radio" name="wpforms-track" id="wpforms-home" value="Home Delivery" <?=$tab_check3?> > <label class="wpforms-lable" for="wpforms-home">Home Delivery</label>
                            </button>
                            <button class="nav-link py-0 <?=$tab_title4?> d-none" id="v-pills-truckload-tab" data-bs-toggle="pill" data-bs-target="#v-pills-truckload" type="button" role="tab" aria-controls="v-pills-truckload" aria-selected="false">
                            <input type="radio" name="wpforms-track" id="wpforms-truckload" value="Less-than-truckload" <?=$tab_check4?> > <label class="wpforms-lable" for="wpforms-truckload">Less-than-Truckload</label>
                            </button>
                        </div>
                        <div class="tab-content w-100" id="v-pills-tabContent">
                            <div class="tab-pane fade <?=$tab_content1?>" id="v-pills-expedite" role="tabpanel" aria-labelledby="v-pills-expedite-tab">
                            
                            <form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                                <div class="w-100">
                                    <div class="col-12 p-2">
									<h4 class="border-3 border-bottom text-black">Expedite</h4>    
									</div>
									<div class="col-12 p-2">
										<p><strong>Shipment Number</strong></p>
                                        <input type="text" maxlength="255" placeholder="" name="ShipmentNumber" id="search-input-order" class="form-control" required value="<?= $ShipmentNumber; ?>" />
									</div>
                                    <div class="col-12 p-2">
                                        <button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
                                    </div>
                                </div>
                            </form>

                            </div>
                            <div class="tab-pane fade <?=$tab_content2?>" id="v-pills-freight" role="tabpanel" aria-labelledby="v-pills-freight-tab">
    
                            <form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                                <div class="w-100">
                                    <div class="col-12 p-2">
									<h4 class="border-3 border-bottom text-black">Freight Brokerage</h4>    
									</div>
									<div class="col-12 p-2">
										<p><strong>Order Number</strong></p>										
                                        <input type="text" maxlength="255" placeholder="" name="orderNumber" id="search-input-order" class="form-control" required value="<?= $orderNumber; ?>" />
									</div>
                                    <div class="col-12 p-2">
										<p><strong>ZIP Code</strong></p>
                                        <input type="text" maxlength="255" placeholder="" name="zipcode" id="search-input-zipcode" class="form-control" required value="<?= $zipcodeNumber; ?>" />
									</div>
                                    <div class="col-12 p-2">
                                        <button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
                                    </div>
                                </div>
                            </form>
                            
                            </div>
                            <div class="tab-pane fade <?=$tab_content3?>" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                            
                                <div class="w-100">
									<div class="col-12 p-2">
									<h4 class="border-3 border-bottom text-black">Home Delivery</h4>    
									</div>
									<div class="col-12 p-2">
									
										<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
										<button class="nav-link bg-transparent border-0 p-0 w-100 <?=$tab_title31?>" id="v-pills-home1-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home1" type="button" role="tab" aria-controls="v-pills-home1" aria-selected="true">
										<input type="radio" name="wpforms-track-home" id="wpforms-home1" value="RXO Job Number" <?=$tab_check31?> > <label class="wpforms-lable" for="wpforms-home1">RXO Job Number</label>
										</button>
										<button class="nav-link bg-transparent border-0 p-0 w-100 <?=$tab_title32?>" id="v-pills-home2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home2" type="button" role="tab" aria-controls="v-pills-home2" aria-selected="false">
										<input type="radio" name="wpforms-track-home" id="wpforms-home2" value="Retailer’s Reference Number" <?=$tab_check32?> > <label class="wpforms-lable" for="wpforms-home2">Retailer’s Reference Number</label>
										</button>
										</div>
										<div class="tab-content w-100" id="v-pills-tabContent">
											<div class="tab-pane fade <?=$tab_content31?>" id="v-pills-home1" role="tabpanel" aria-labelledby="v-pills-home1-tab">
												<form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
													<div class="w-100">
														<div class="col-12 p-2">
															<p><strong>Shipment Number</strong></p>
															<input type="text" maxlength="255" placeholder="" name="JobNumber" id="search-input-order" class="form-control" required value="<?= $JobNumber; ?>" />
														</div>
														<div class="col-12 p-2">
															<button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
														</div>
													</div>
												</form>
											</div>
											<div class="tab-pane fade <?=$tab_content32?>" id="v-pills-home2" role="tabpanel" aria-labelledby="v-pills-home2-tab">
												<form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
													<div class="w-100">
														<div class="col-12 p-2">
															<p><strong>Retailer’s Reference Number</strong></p>
															<input type="text" maxlength="255" placeholder="" name="ReferenceNumber" id="search-input-order" class="form-control" required value="<?= $ReferenceNumber; ?>"  />
														</div>
														<div class="col-12 p-2">
															<p><strong>Delivery Phone Number</strong></p>
															<input type="text" maxlength="255" placeholder="" name="phoneNumber" id="search-input-order" class="form-control" required value="<?= $phoneNumber; ?>"  />
														</div>
														<div class="col-12 p-2">
															<button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
														</div>
													</div>
												</form>
											</div>
										</div>
										
									
									</div>									
                                     
                                </div>
                             

                            </div>
                            <div class="tab-pane fade <?=$tab_content4?>" id="v-pills-truckload" role="tabpanel" aria-labelledby="v-pills-truckload-tab">

                            <form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                                <div class="w-100">
                                    <div class="col-12 p-2">
									<h4 class="border-3 border-bottom text-black">Less-than-Truckload</h4>    
									</div>
									<div class="col-12 p-2">
										<p><strong>Pro Number</strong></p>
                                        <input type="text" maxlength="255" placeholder="" name="ProNumber" id="search-input-order" class="form-control" required />
									</div>
                                    <div class="col-12 p-2">
                                        <button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
                                    </div>
                                </div>
                            </form>

                            </div>
                        </div>
                        </div>


                        <!-- TAB : END -->
 
                </div>
            </div>
        </div>                  
    <?php elseif ($is_track_code && $data && count($data) && $httpcode == 200) : ?>
        <div id="loaderData" class="container article-width pb-6">
            <div class="row mb-7">
                <div class="col-12">
                    <?php if (trim($deliveryInfo['title']) != "") { ?>
                        <p class="mb-0"><span class="text-500"><?php echo $deliveryInfo['title']; ?></span></p>
                    <?php } ?>
                    <?php if (trim($deliveryInfo['weekday']) != "") { ?>
                        <h3 class="my-2"><?php echo $deliveryInfo['weekday']; ?>, <?php echo $deliveryInfo['month_day']; ?> at <?php echo $deliveryInfo['time']; ?> </h3>
                    <?php } ?>
                    <div class="progress-steps col-12 col-lg-10 mx-auto my-5">
                        <?php
                        $progressCurrentStep = $progressInfo['complete_step'];
                        $progressCurrentState = $progressInfo['state'];

                        if (count($progressInfo['progress_items']) > 0) {
                            $p = 0;
                            foreach ($progressInfo['progress_items'] as $progressInfoItemData) {
                                $p++;
                        ?>
                                <div class="steps 
                        <?php
                                if ($progressCurrentStep > $p) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep == 1) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep == 3) {
                                    echo 'complete';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "success" && $progressCurrentStep < 3) {
                                    echo 'inprogress';
                                } else if ($progressCurrentStep == $p && $progressCurrentState == "warning") {
                                    echo 'indanger';
                                } else if ($progressCurrentStep == $p + 1) {
                                    echo 'inprogress';
                                } else {
                                }
                        ?> 
                        ">
                                    <?php echo $progressInfoItemData['label']; ?>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                    <p><span class="text-500">Tracking number:</span> <strong><?php echo $trackingNumber; ?></strong></p>
                    <?php if (isset($deliveryInfo['badge_label'])) { ?>
                    <p><span class="text-500">Status:</span> <strong><?php echo $deliveryInfo['badge_label']; ?></strong></p>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php if (count($keyInfo) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Details</h4>
                            <?php
                            foreach ($keyInfo as $keyInfoData) {
                            ?>
                                <?php if ($keyInfoData['item_key'] != "Tracking #") { ?>
                                    <p class="mb-2"><span class="text-500"><?php echo $keyInfoData['item_key']; ?>:</span> <strong><?php echo $keyInfoData['item_value']; ?></strong></p>
                                <?php } ?>
                            <?php
                            }
                            ?>
                        </div>
                    <?php } ?>
                    <?php if (count($equipmentInfo) > 0) { ?>
                        <div class="mb-7">
                            <h4 class="border-bottom">Equipment</h4>
                            <?php
                            $i = 0;
                            foreach ($equipmentInfo as $equipmentInfoData) {
                                $i++;
                            ?>
                                <p class="mb-2">ID: <strong> <?php echo $equipmentInfoData['item_title']; ?></strong></p>
                                <?php foreach ($equipmentInfoData['item_details'] as $equipmentInfoDetailData) { ?>
                                    <p class="mb-1"><span class="text-500"><?php echo $equipmentInfoDetailData['key']; ?>:</span> <strong><?php echo $equipmentInfoDetailData['value']; ?></strong></p>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if (count($accordionInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Items</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 0;
                                foreach ($accordionInfo as $accordionInfoData) {
                                    $i++;
                                ?>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                            <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                <?php echo $accordionInfoData['item_title']; ?>
                                            </button>
                                        </h5>
                                        <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                            <div class="accordion-body">
                                                <?php foreach ($accordionInfoData['item_details'] as $accordionInfoDetailData) { ?>
                                                    <p class="mb-1"><span class="text-500"><?php echo $accordionInfoDetailData['key']; ?>:</span> <strong><?php echo $accordionInfoDetailData['value']; ?></strong></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                    <?php if (count($shipmentInfo) > 0) { ?>
                        <div class="mb-5">
                            <h4 class="border-bottom">Shipments</h4>
                            <div class="accordion tracking-accordion" id="tracking-items">
                                <?php
                                $i = 1000;
                                $j = 0;
                                foreach ($shipmentInfo['table_head'] as $shipmentInfoData) {
                                    $i++;
                                    if ($shipmentInfoData == "Shipment #") {
                                ?>
                                        <?php foreach ($shipmentInfo['table_rows'] as $shipmentInfoRowData) { ?>
                                            <div class="accordion-item">
                                                <h5 class="accordion-header my-0" id="item<?= $i ?>">
                                                    <button class="text-capitalize accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details<?= $i ?>" aria-expanded="true" aria-controls="details<?= $i ?>">
                                                        <?php echo $shipmentInfoData; ?> <?php echo $shipmentInfoRowData['row_items'][$j]['item_label']; ?>
                                                    </button>
                                                </h5>
                                                <div id="details<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="item<?= $i ?>" data-bs-parent="#tracking-items">
                                                    <div class="accordion-body">
                                                        <?php $k = 0;
                                                        foreach ($shipmentInfoRowData['row_items'] as $shipmentInfoDetailData) { ?>
                                                            <?php if ($shipmentInfo['table_head'][$k] == "Origin" || $shipmentInfo['table_head'][$k] == "Destination") {  ?>
                                                                <p class="mb-1"><span class="text-500"><?php echo $shipmentInfo['table_head'][$k]; ?>:</span> <strong><?php echo $shipmentInfoDetailData['item_label']; ?></strong></p>
                                                            <?php } ?>
                                                            <?php if (trim($shipmentInfo['table_head'][$k]) == "") {  ?>
                                                                <?php
                                                                $item_link = $shipmentInfoDetailData['item_link'];
                                                                $item_track = str_replace("/track/shipment/", "", $item_link);
                                                                //$item_track = "RXONC60SHOGNFHPJ22";
                                                                ?>
                                                                <p class="mb-1"><a href="<?php echo esc_url(home_url('/track')); ?>?trackingNumber=<?php echo $item_track; ?>" class="text-black text-decoration-underline">View Additional Details</a></p>
                                                            <?php } ?>
                                                        <?php $k++;
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                <?php
                                        $j++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <?php if (count($groupInfoRows) > 0) { ?>
                    <div class="col-12 col-lg-6">
                        <h4 class="border-bottom">History</h4>
                        <div class="d-flex flex-column progress-steps progress-vertical">
                            <?php
                            $i = 0;
                            foreach ($groupInfoRows as $groupInfoRowsData) {
                                $i++;

                                $location = explode(",", $groupInfoRowsData['row_content'][0]);
                            ?>
                                <div class="steps active">
                                    <div class="fs-6"><?php echo ucfirst(strtolower($groupInfoRowsData['row_head'])); ?></div>
                                    <div class="text-500">
                                        <?php if(count($location)>1){ ?>
                                           <?php echo $groupInfoRowsData['row_content'][1] . ' ' . ucwords(strtolower($location[0])) . ', ' . $location[1]; ?>
                                        <?php } else { ?>
                                            <?php echo $groupInfoRowsData['row_content'][1] . ' ' . ucwords(strtolower($location[0])); ?>
                                         <?php } ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-12 col-lg-6"></div>
                <?php } ?>
            </div>
        </div>
    <?php else : ?>
        <div id="loaderForm" class="container article-width pb-6">
            <div class="row mb-7">
                <div class="col-12 col-md-11 col-lg-10 col-xl-9 mx-auto">
                    <?php
                    if (!empty($trackingNumber) || !empty($ShipmentNumber) || !empty($orderNumber) || !empty($zipcode) || !empty($ReferenceNumber) || !empty($phoneNumber) || !empty($JobNumber)) {
                        //echo $is_track_code ? 'No information found' : 'Invalid tracking number';
                    ?>
                      <?php
                        $tab_title1=' active';
                        $tab_check1= ' checked="checked"';
                        $tab_content1=' show active';

                        $tab_title2=' ';
                        $tab_check2= ' ';
                        $tab_content2=' ';

                        $tab_title3=' ';
                        $tab_check3= ' ';
                        $tab_content3=' ';
                        $tab_title31=' ';
                        $tab_check31= ' ';
                        $tab_content31=' ';
                        $tab_title32=' ';
                        $tab_check32= ' ';
                        $tab_content32=' ';

                        $tab_title4=' ';
                        $tab_check4= ' ';
                        $tab_content4=' ';

                        if(isset($_REQUEST['ShipmentNumber'])) {
                        
                        $tab_title1=' active';
                        $tab_check1= ' checked="checked"';
                        $tab_content1=' show active';

                        $tab_title2=' ';
                        $tab_check2= ' ';
                        $tab_content2=' ';

                        $tab_title3=' ';
                        $tab_check3= ' ';
                        $tab_content3=' ';
                        $tab_title3=' ';
                        $tab_content3=' ';
                        $tab_title31=' ';
                        $tab_check31= ' ';
                        $tab_content31=' ';
                        $tab_content32=' ';
                        $tab_title32=' ';
                        $tab_check32= ' ';
                        $tab_content32=' ';

                        $tab_title4=' ';
                        $tab_check4= ' ';
                        $tab_content4=' ';

                        }

                        if((isset($_REQUEST['orderNumber'])) && (isset($_REQUEST['zipcode']))) {
                        
                            $tab_title1=' ';
                            $tab_check1= ' ';
                            $tab_content1=' ';
    
                            $tab_title2=' active';
                            $tab_check2= ' checked="checked"';
                            $tab_content2=' show active';
    
                            $tab_title3=' ';
                            $tab_check3= ' ';
                            $tab_content3=' ';
                            $tab_title3=' ';
                            $tab_content3=' ';
                            $tab_title31=' ';
                            $tab_check31= ' ';
                            $tab_content31=' ';
                            $tab_content32=' ';
                            $tab_title32=' ';
                            $tab_check32= ' ';
                            $tab_content32=' ';
    
                            $tab_title4=' ';
                            $tab_check4= ' ';
                            $tab_content4=' ';
                            
                        }

                        if(isset($_REQUEST['JobNumber'])) {
                        
                            $tab_title1=' ';
                            $tab_check1= ' ';
                            $tab_content1=' ';
    
                            $tab_title2=' ';
                            $tab_check2= ' ';
                            $tab_content2=' ';
    
                            $tab_title3=' active';
                            $tab_check3= ' checked="checked"';
                            $tab_content3=' show active';
                            $tab_title31=' active';
                            $tab_check31= ' checked="checked"';
                            $tab_content31=' show active';
                            $tab_title32=' ';
                            $tab_check32= ' ';
                            $tab_content32=' ';
    
                            $tab_title4=' ';
                            $tab_check4= ' ';
                            $tab_content4=' ';
                            
                        }

                        
                        if((isset($_REQUEST['ReferenceNumber'])) && (isset($_REQUEST['phoneNumber']))) {
                        
                            $tab_title1=' ';
                            $tab_check1= ' ';
                            $tab_content1=' ';
    
                            $tab_title2=' ';
                            $tab_check2= ' ';
                            $tab_content2=' ';
    
                            $tab_title3=' active';
                            $tab_check3= ' checked="checked"';
                            $tab_content3=' show active';
                            $tab_title31=' ';
                            $tab_check31= ' ';
                            $tab_content31=' ';
                            $tab_title32=' active';
                            $tab_check32= ' checked="checked"';
                            $tab_content32=' show active';
    
                            $tab_title4=' ';
                            $tab_content4=' ';
                            
                        }

                        
                       ?>
                        <!-- TAB : START -->

                        <h3 class="text-black fs-4 fw-normal">That tracking number is not associated with a shipment. If your tracking information does not begin with ‘RXO’, please select your mode or try again</h3>

                        <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3 py-7" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link py-0 <?=$tab_title1?>" id="v-pills-expedite-tab" data-bs-toggle="pill" data-bs-target="#v-pills-expedite" type="button" role="tab" aria-controls="v-pills-expedite" aria-selected="true">
                            <input type="radio" name="wpforms-track" id="wpforms-expedite" value="Expedite" <?=$tab_check1?> > <label class="wpforms-lable" for="wpforms-expedite">Expedite</label>
                            </button>
                            <button class="nav-link py-0 <?=$tab_title2?>" id="v-pills-freight-tab" data-bs-toggle="pill" data-bs-target="#v-pills-freight" type="button" role="tab" aria-controls="v-pills-freight" aria-selected="false">
                            <input type="radio" name="wpforms-track" id="wpforms-freight" value="Freight Brokerage" <?=$tab_check2?> > <label class="wpforms-lable" for="wpforms-freight">Freight Brokerage</label>
                            </button>
                            <button class="nav-link py-0 <?=$tab_title3?>" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="false">
                            <input type="radio" name="wpforms-track" id="wpforms-home" value="Home Delivery" <?=$tab_check3?> > <label class="wpforms-lable" for="wpforms-home">Home Delivery</label>
                            </button>
                            <button class="nav-link py-0 <?=$tab_title4?> d-none" id="v-pills-truckload-tab" data-bs-toggle="pill" data-bs-target="#v-pills-truckload" type="button" role="tab" aria-controls="v-pills-truckload" aria-selected="false">
                            <input type="radio" name="wpforms-track" id="wpforms-truckload" value="Less-than-truckload" <?=$tab_check4?> > <label class="wpforms-lable" for="wpforms-truckload">Less-than-Truckload</label>
                            </button>
                        </div>
                        <div class="tab-content w-100" id="v-pills-tabContent">
                            <div class="tab-pane fade <?=$tab_content1?>" id="v-pills-expedite" role="tabpanel" aria-labelledby="v-pills-expedite-tab">
                            
                            <form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                                <div class="w-100">
                                    <div class="col-12 p-2">
									<h4 class="border-3 border-bottom text-black">Expedite</h4>    
									</div>
									<div class="col-12 p-2">
										<p><strong>Shipment Number</strong></p>
                                        <input type="text" maxlength="255" placeholder="" name="ShipmentNumber" id="search-input-order" class="form-control" required value="<?= $ShipmentNumber; ?>" />
									</div>
                                    <div class="col-12 p-2">
                                        <button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
                                    </div>
                                </div>
                            </form>

                            </div>
                            <div class="tab-pane fade <?=$tab_content2?>" id="v-pills-freight" role="tabpanel" aria-labelledby="v-pills-freight-tab">
    
                            <form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                                <div class="w-100">
                                    <div class="col-12 p-2">
									<h4 class="border-3 border-bottom text-black">Freight Brokerage</h4>    
									</div>
									<div class="col-12 p-2">
										<p><strong>Order Number</strong></p>										
                                        <input type="text" maxlength="255" placeholder="" name="orderNumber" id="search-input-order" class="form-control" required value="<?= $orderNumber; ?>" />
									</div>
                                    <div class="col-12 p-2">
										<p><strong>ZIP Code</strong></p>
                                        <input type="text" maxlength="255" placeholder="" name="zipcode" id="search-input-zipcode" class="form-control" required value="<?= $zipcodeNumber; ?>" />
									</div>
                                    <div class="col-12 p-2">
                                        <button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
                                    </div>
                                </div>
                            </form>
                            
                            </div>
                            <div class="tab-pane fade <?=$tab_content3?>" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                            
                                <div class="w-100">
									<div class="col-12 p-2">
									<h4 class="border-3 border-bottom text-black">Home Delivery</h4>    
									</div>
									<div class="col-12 p-2">
									
										<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
										<button class="nav-link bg-transparent border-0 p-0 w-100 <?=$tab_title31?>" id="v-pills-home1-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home1" type="button" role="tab" aria-controls="v-pills-home1" aria-selected="true">
										<input type="radio" name="wpforms-track-home" id="wpforms-home1" value="RXO Job Number" <?=$tab_check31?> > <label class="wpforms-lable" for="wpforms-home1">RXO Job Number</label>
										</button>
										<button class="nav-link bg-transparent border-0 p-0 w-100 <?=$tab_title32?>" id="v-pills-home2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home2" type="button" role="tab" aria-controls="v-pills-home2" aria-selected="false">
										<input type="radio" name="wpforms-track-home" id="wpforms-home2" value="Retailer’s Reference Number" <?=$tab_check32?> > <label class="wpforms-lable" for="wpforms-home2">Retailer’s Reference Number</label>
										</button>
										</div>
										<div class="tab-content w-100" id="v-pills-tabContent">
											<div class="tab-pane fade <?=$tab_content31?>" id="v-pills-home1" role="tabpanel" aria-labelledby="v-pills-home1-tab">
												<form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
													<div class="w-100">
														<div class="col-12 p-2">
															<p><strong>Shipment Number</strong></p>
															<input type="text" maxlength="255" placeholder="" name="JobNumber" id="search-input-order" class="form-control" required value="<?= $JobNumber; ?>" />
														</div>
														<div class="col-12 p-2">
															<button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
														</div>
													</div>
												</form>
											</div>
											<div class="tab-pane fade <?=$tab_content32?>" id="v-pills-home2" role="tabpanel" aria-labelledby="v-pills-home2-tab">
												<form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
													<div class="w-100">
														<div class="col-12 p-2">
															<p><strong>Retailer’s Reference Number</strong></p>
															<input type="text" maxlength="255" placeholder="" name="ReferenceNumber" id="search-input-order" class="form-control" required value="<?= $ReferenceNumber; ?>" />
														</div>
														<div class="col-12 p-2">
															<p><strong>Delivery Phone Number</strong></p>
															<input type="text" maxlength="255" placeholder="" name="phoneNumber" id="search-input-order" class="form-control" required value="<?= $phoneNumber; ?>" />
														</div>
														<div class="col-12 p-2">
															<button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
														</div>
													</div>
												</form>
											</div>
										</div>
										
									
									</div>									
                                     
                                </div>
                             

                            </div>
                            <div class="tab-pane fade <?=$tab_content4?>" id="v-pills-truckload" role="tabpanel" aria-labelledby="v-pills-truckload-tab">

                            <form class="track-form align-items-center" action="<?php echo esc_url(home_url('/track')); ?>" method="GET">
                                <div class="w-100">
                                    <div class="col-12 p-2">
									<h4 class="border-3 border-bottom text-black">Less-than-Truckload</h4>    
									</div>
									<div class="col-12 p-2">
										<p><strong>Pro Number</strong></p>
                                        <input type="text" maxlength="255" placeholder="" name="ProNumber" id="search-input-order" class="form-control" required />
									</div>
                                    <div class="col-12 p-2">
                                        <button class="btn btn-primary" type="submit" aria-label="search">Track a shipment</button>
                                    </div>
                                </div>
                            </form>

                            </div>
                        </div>
                        </div>


                        <!-- TAB : END -->

                    <?php
                    } else {
                        echo '<h3>Enter your tracking number</h3>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="container article-width pb-6">
        <div class="row mb-7">
            <div class="col-12 col-md-11 col-lg-10 col-xl-9 mx-auto">
                <div class="wpforms-submit-container" style="text-align: center;">
                    <img id="loaderImg" src="<?= get_template_directory_uri() . '/images/spinner.svg' ?>" class=" wpforms-submit-spinner" style="display: none;width:50px;" width="26" height="26" alt="Loading">
                </div>
            </div>
        </div>
    </div>
    <?php
    // TO SHOW THE PAGE CONTENTS
    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
            <?php the_content(); ?> <!-- Page Content -->
    <?php
    endwhile; //resetting the page loop
    wp_reset_query(); //resetting the page query
    ?>
</main>
<style>
 
    .nav-pills .nav-link {
        text-align: left;
        width: 250px;
        margin: 10px 0px;
        color: black; 
    }

    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        background: none;
    }


    .wpforms-lable {
        cursor:pointer;
    }

    @media (min-width: 1300px) {
        .article-width {
            max-width: 1100px !important;
        }
    }

    .progress-vertical .steps.active::before {
        background-color: black !important;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('form.track-form').submit(function() {
            $('#loaderData').hide();
            $('#loaderForm').hide();
            $('#loaderImg').show();
            return true;
        });
    });    
</script>
<?php } ?>

<?php while (have_posts()) :
    the_post();

    get_template_part('template-parts/content', get_post_type());

endwhile; // End of the loop.
get_footer(); ?>