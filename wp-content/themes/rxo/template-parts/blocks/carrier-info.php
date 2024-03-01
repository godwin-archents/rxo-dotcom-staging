<?php

/**
 * Block Name: Carrier Info 
 *
 * This is the template for a custom block created with Advanced Custom Fields (ACF).
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */


// create id attribute for specific styling
$uid = 'rxo-acf-container-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'rxo-block ' . str_replace('acf/rxo-acf-', '', $block['name']);

if (!empty($block['className'])) {
    $className .= sprintf(' %s', $block['className']);
}

$url = get_field('url');
$token = get_field('token');

if (isset($_REQUEST['auth-token'])) {
    $token = $_REQUEST['auth-token'];
}
?>
<?php if ($url) : ?>
    <?php
    $datas = '';
    $url = $url . $token;

    $my_curl = curl_init();
    curl_setopt($my_curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($my_curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($my_curl, CURLOPT_URL, $url);
    $result = curl_exec($my_curl);
    $httpcode = curl_getinfo($my_curl, CURLINFO_HTTP_CODE);
    if ($httpcode != 200) {
        if ($_REQUEST['action'] != "edit") {
            echo '<script>location.href = "/dispatch-error/";</script>';
        }
        echo '<script>console.log("tracking_error ' . $httpcode . '", "' . curl_error($my_curl) . '");</script>';
        $datas = '';
    } else {
        $datas = json_decode($result, true);
    }
    curl_close($my_curl);


    if ($datas) {
        $loadnumbervalue = $datas['ordercode'];
        $pickuptimevalue = date('h:i A', strtotime($datas['stops'][0]['scheduledEarlyArrivalTime']));
        $pickupdatevalue = date('d F Y', strtotime($datas['stops'][0]['scheduledEarlyArrivalTime']));
        $originvalue = $datas['stops'][0]['cityName'] . ', ' . $datas['stops'][0]['stateCode'];
        $destinationvalue = $datas['stops'][1]['cityName'] . ', ' . $datas['stops'][1]['stateCode'];
        $equipmenttypevalue = $datas['containingEquipmentTypeName'];
    } else {
        $loadnumbervalue = 'Loading...';
        $pickuptimevalue = 'Loading...';
        $pickupdatevalue = 'Loading...';
        $originvalue = 'Loading...';
        $destinationvalue = 'Loading...';
        $equipmenttypevalue = 'Loading...';
    }

    if ($loadnumbervalue == null || $loadnumbervalue == '') {
        $loadnumbervalue = 'Loading...';
        $pickuptimevalue = 'Loading...';
        $pickupdatevalue = 'Loading...';
        $originvalue = 'Loading...';
        $destinationvalue = 'Loading...';
        $equipmenttypevalue = 'Loading...';
    }

    ?>
<?php endif; ?>
<div class=" <?php echo $uid; ?> <?php echo esc_attr($className); ?>">
    <?php if ($url) : ?>
        <div class="load-info">
            <h3 class="has-text-align-left">Load Details</h3>
            <h5 class="p-0 m-0">Load Number</h5>
            <div id="loadnumbervalue" class="text-black pb-3"><?php echo $loadnumbervalue; ?></div>
            <h5 class="p-0 m-0">Pickup Date And Time</h5>
            <div id="pickuptimevalue" class="text-black"><?php echo $pickuptimevalue; ?></div>
            <div id="pickupdatevalue" class="text-black pb-3"><?php echo $pickupdatevalue; ?></div>
            <h5 class="p-0 m-0">Origin</h5>
            <div id="originvalue" class="text-black pb-3"><?php echo $originvalue; ?></div>
            <h5 class="p-0 m-0">Destination</h5>
            <div id="destinationvalue" class="text-black pb-3"><?php echo $destinationvalue; ?></div>
            <h5 class="p-0 m-0">Equipment Type</h5>
            <div id="equipmenttypevalue" class="text-black pb-3"><?php echo $equipmenttypevalue; ?></div>
        </div>
    <?php elseif (show_block_error()) : ?>
        <div class="toast align-items-center text-white bg-danger border-0 show w-auto my-3">
            <div class="toast-body">
                <?php esc_html_e('No data available to show'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>