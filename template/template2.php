<?php
$wpsaf = json_decode(get_settings('wpsaf_options'));
if(empty($_GET['redir'])) {
    $_GET['redir'] = base64_encode(home_url() . '/');
}
if($wpsaf->adlinkfly_enable == 1) {
    $urls = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $URI = str_replace(array('http://', 'https://'), '', home_url());
    $URI = str_replace($URI, '', $urls);
    $url = explode('/', $URI);
    if ($wpsaf->permalink == 1) {
        $safe_id = $url[2];
    } else if ($wpsaf->permalink == 2) {
        $safe_id = trim(urldecode($_GET[$wpsaf->permalink2]));
    } else {
        $safe_id = explode('?', $urls)[1];
    }

    $safe_link = rtrim($wpsaf->adlinkfly_domain, '/') . '/' . $safe_id;
    $safe_link = array(
        'second_safelink_url' => $wpsaf->second_safelink_url,
        'safelink' => $safe_link
    );
    $safe_link = json_encode($safe_link);
    $code = json_decode(base64_decode($_GET['code']), true);
    $code['linkr'] = home_url() . '?safelink_redirect=' . base64_encode($safe_link);

    $_GET['code'] = base64_encode(json_encode($code));
}
?>
<html>

<head>
    <title>Landing..</title>
    <meta name="referrer" content="no-referrer">
</head>

<body>
    <form id="landing" method="POST" action="<?php echo base64_decode($_GET['redir']); ?>">
        <input type="hidden" name="humanverification" value="1">
        <input type="hidden" name="newwpsafelink" value="<?php echo $_GET['code'] ?>">
    </form>
    <script>
        window.onload = function() {
            document.getElementById('landing').submit();
        }
    </script>
</body>

</html>
