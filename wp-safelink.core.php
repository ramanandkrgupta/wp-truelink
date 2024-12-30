<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

global $WPSAF;
$WPSAF = new WPSAF();
checkupdatewpsafelink();
class WPSAF
{
    private $delimeter_wp_safelink = "wApbsCadfEeFlgiHnik";
    public function __construct()
    {
        add_action("admin_menu", [$this, "wp_safelink_menu"]);
        add_filter("home_template", [$this, "ch_register_page_template"], 999);
        add_filter("page_template", [$this, "ch_register_page_template"], 999);
        add_filter("single_template", [$this, "ch_register_page_template"], 999);
        add_shortcode("wpsafelink", [$this, "wpsafcode"]);
        add_action("init", [$this, "custom_rewrite"]);
        add_action("in_admin_footer", [$this, "foot_admin"], 999);
        add_action("template_redirect", [$this, "doRewrite"]);
    }
    public function custom_rewrite()
    {
        $wpsaf = json_decode(get_settings("wpsaf_options"));
        if ($wpsaf->permalink == 1) {
            add_rewrite_rule("^" . $wpsaf->permalink1 . "/(.*)?", "index.php", "top");
            flush_rewrite_rules();
            remove_filter("template_redirect", "redirect_canonical");
        }
    }
    public function wpsafcode($link)
    {
        $wpsaf = json_decode(get_settings("wpsaf_options"));
        $link = array_map("trim", $link);
        $link = implode("", $link);
        if ($link[0] == "=") {
            $link = substr($link, 1, 999);
        }
        if ($wpsaf->permalink == 1) {
            $linkout = home_url() . "/" . $wpsaf->permalink1 . "/" . base64_encode($link);
        } else {
            if ($wpsaf->permalink == 2) {
                $linkout = home_url() . "/?" . $wpsaf->permalink2 . "=" . base64_encode($link);
            } else {
                $linkout = home_url() . "/?" . base64_encode($link);
            }
        }
        return $linkout;
    }
    public function wp_safelink_menu()
    {
        add_menu_page("WP Truelink", "WP Truelink", "manage_options", "wp-safelink", [$this, "wp_safelink_options"], "", "25");
    }
    public function ch_register_page_template($page_template)
    {
        global $wpdb;
        $wpsaf = json_decode(get_settings("wpsaf_options"));
        $urls = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $URI = str_replace(["http://", "https://"], "", home_url());
        $URI = str_replace($URI, "", $urls);
        $url = explode("/", $URI);
        if (isset($_GET["redir"]) && !empty($_GET["redir"]) || isset($_GET["wpsafelink"])) {
            $go = "";
            switch ($wpsaf->permalink) {
                case 1:
                    $go = $url[2];
                    break;
                case 2:
                    $go = $_GET[$wpsaf->permalink2];
                    break;
                case 3:
                    $url = explode("?", $url[1]);
                    $go = $url[1];
                    break;
                default:
                    if (isset($_GET["wpsafelink"])) {
                        $go = base64_encode($_GET["wpsafelink"]);
                    }
                    if (empty($_GET["redir"])) {
                        $_GET["redir"] = base64_encode(home_url() . "/");
                    }
                    echo "\t\t\t<html>\r\n\r\n\t\t\t<head>\r\n\t\t\t\t<title>Landing..</title>\r\n\t\t\t\t<meta name=\"referrer\" content=\"no-referrer\">\r\n\t\t\t</head>\r\n\r\n\t\t\t<body>\r\n\t\t\t\t<form id=\"landing\" method=\"POST\" action=\"";
                    echo base64_decode($_GET["redir"]);
                    echo "\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"go\" value=\"";
                    echo $go;
                    echo "\" />\r\n\t\t\t\t</form>\r\n\t\t\t\t<script>\r\n\t\t\t\t\twindow.onload = function() {\r\n\t\t\t\t\t\tdocument.getElementById('landing').submit();\r\n\t\t\t\t\t}\r\n\t\t\t\t</script>\r\n\t\t\t</body>\r\n\r\n\t\t\t</html>\r\n\t\t";
                    exit;
            }
        } else {
            if ($url[1] == $wpsaf->permalink1 && $url[2] != "" && $wpsaf->permalink == 1 || $_GET[$wpsaf->permalink2] != "" && $wpsaf->permalink == 2 || 0 < count($_GET) && !isset($_GET[$wpsaf->permalink2]) && !isset($_GET["safelink_redirect"]) && ($wpsaf->permalink == 4 || $wpsaf->permalink == 3) || isset($_POST["go"])) {
                if (!$this->ceklis()) {
                    echo "Your license is not valid. <a href=\"https://themeson.com/license/\" target=\"_blank\">get license</a>\r\n\t\t\t\tor <a href=\"http://themeson.com/safelink\">buy it!.</a>";
                    exit;
                }
                if (isset($_POST["go"])) {
                    $safe_id = trim(urldecode($_POST["go"]));
                } else {
                    if ($wpsaf->permalink == 1) {
                        $safe_id = $url[2];
                    } else {
                        if ($wpsaf->permalink == 2) {
                            $safe_id = trim(urldecode($_GET[$wpsaf->permalink2]));
                        } else {
                            list($safe_id) = explode("?", $urls);
                        }
                    }
                }
                if (strlen($safe_id) == 8) {
                    $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink WHERE safe_id='" . $safe_id . "'";
                    $cek = $wpdb->get_results($sql, "ARRAY_A");
                    $safe_link = urlencode($cek[0]["link"]);
                } else {
                    if (base64_encode(base64_decode($safe_id, true)) === $safe_id) {
                        $safe_link = base64_decode($safe_id);
                        $safe_link = $this->decrypt_link($safe_link) ? $this->decrypt_link($safe_link) : urldecode($safe_link);
                    } else {
                        if (strpos($safe_id, $this->delimeter_wp_safelink) !== false) {
                            $safe_link = $this->decrypt_link($safe_id);
                        }
                    }
                }
                if ($safe_link != "") {
                    $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink WHERE link='" . urldecode($safe_link) . "'";
                    $cek = $wpdb->get_results($sql, "ARRAY_A");
                    if ($cek) {
                        $data = ["date_view" => date("Y-m-d H:i:s"), "view" => $cek[0]["view"] + 1];
                        $wpdb->update($wpdb->prefix . "wpsafelink", $data, ["ID" => $cek[0]["ID"]]);
                    } else {
                        if ($wpsaf->autosave == 1) {
                            $linkd = urldecode($safe_link);
                            $safeid = substr(md5($linkd . date("His")), 2, 8);
                            $data = ["date" => date("Y-m-d H:i:s"), "safe_id" => $safeid, "link" => $linkd];
                            $wpdb->insert($wpdb->prefix . "wpsafelink", $data, "");
                        }
                    }
                }
                if ($wpsaf->content == "0") {
                    $args = ["post_type" => "post", "orderby" => "rand", "posts_per_page" => 1];
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                        }
                    }
                } else {
                    if ($wpsaf->content == "1") {
                        $ID = explode(",", $wpsaf->contentid);
                        shuffle($ID);
                        foreach ($ID as $id) {
                            $posts = get_post($id);
                            setup_postdata($GLOBALS["post"] =& $posts);
                        }
                    }
                }
                $_GET["ads1"] = $wpsaf->ads1;
                $_GET["ads2"] = $wpsaf->ads2;
                $_GET["logo"] = $wpsaf->logo;
                $_GET["image1"] = $wpsaf->image1;
                $_GET["image2"] = $wpsaf->image2;
                $_GET["image3"] = $wpsaf->image3;
                $_GET["delaytext"] = str_replace("{time}", "<span id=\"wpsafe-time\">" . $wpsaf->delay . "</span>", $wpsaf->delaytext);
                $_GET["delay"] = $wpsaf->delay;
                $_GET["adb"] = $wpsaf->adb;
                $_GET["adb1"] = $wpsaf->adb1;
                $_GET["adb2"] = $wpsaf->adb2;
                $safe_link = ["second_safelink_url" => $wpsaf->second_safelink_url, "safelink" => $safe_link];
                $safe_link = json_encode($safe_link);
                $_GET["linkr"] = home_url() . "?safelink_redirect=" . base64_encode($safe_link);
                $code = base64_encode(json_encode($_GET));
                $_GET["code"] = $code;
                if ($wpsaf->newsafelink == "on") {
                    $page_template = dirname(__FILE__) . "/template/template2.php";
                } else {
                    if (!isset($_POST["newwpsafelink"])) {
                        $page_template = dirname(__FILE__) . "/template/" . $wpsaf->template . ".php";
                    }
                }
            } else {
                if ($_GET["safelink_redirect"] != "") {
                    $safelink_redirect = json_decode(base64_decode($_GET["safelink_redirect"]), true);
                    $link = $safelink_redirect["safelink"];
                    $link = urldecode(urldecode(trim($link)));
                    $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink WHERE link='" . $link . "'";
                    $cek = $wpdb->get_results($sql, "ARRAY_A");
                    if ($cek) {
                        $click = $cek[0]["click"] + 1;
                        $data = ["date_click" => date("Y-m-d H:i:s"), "click" => $click];
                        $wpdb->update($wpdb->prefix . "wpsafelink", $data, ["ID" => $cek[0]["ID"]]);
                    }
                    if (!empty($safelink_redirect["second_safelink_url"])) {
                        $link = $safelink_redirect["second_safelink_url"] . "?wpsafelink=" . $safelink_redirect["safelink"] . "&redir=" . base64_encode($safelink_redirect["second_safelink_url"]);
                    }
                    wp_redirect($link);
                    exit;
                }
                if ($url[1] == "wpsafelinkk.js") {
                    header("Content-type: application/javascript");
                    echo "\t\t\tvar wpsafelink = 'http://themeson.dev/go/';\r\n\t\t\tvar els = document.getElementsByTagName(\"a\");\r\n\t\t\tfor(var i = 0, l = els.length; i < l; i++) { var el=els[i]; el.href=wpsafelink + btoa(el.href); } \r\n\t\t\t";
                    exit;
                }
            }
            return $page_template;
        }
    }
    public function wp_safelink_options()
    {
        global $wpdb;
        if (0 < $_GET["delete"]) {
            $wpdb->delete($wpdb->prefix . "wpsafelink", ["ID" => $_GET["delete"]], "");
        } else {
            if ($_POST["save"] == "Save") {
                $wpsaf = $_POST["wpsaf"];
                $wpsaf = array_map("stripslashes", $wpsaf);
                $wpsaf = json_encode($wpsaf);
                update_option("wpsaf_options", $wpsaf);
                $wpsaf = json_decode(get_settings("wpsaf_options"));
                $dom = explode(PHP_EOL, $wpsaf->domain);
                $dom = array_map("trim", $dom);
                $dom = array_map("strtolower", $dom);
                $dm = "";
                $rep = ["https://", "http://", "www."];
                foreach ($dom as $d) {
                    $dm .= "\"" . $d . "\",";
                }
                $dom_exclude = explode(PHP_EOL, $wpsaf->exclude_domain);
                $dom_exclude = array_map("trim", $dom_exclude);
                $dom_exclude = array_map("strtolower", $dom_exclude);
                $dm_exclude = "";
                $rep = ["https://", "http://", "www."];
                foreach ($dom_exclude as $d) {
                    $dm_exclude .= "\"" . $d . "\",";
                }
                $domain = empty($wpsaf->base_url) ? home_url() : $wpsaf->base_url;
                $domain = substr($domain, -1) != "/" ? $domain . "/" : $domain;
                if ($wpsaf->permalink == 1) {
                    $safe_link = $domain . $wpsaf->permalink1 . "/";
                } else {
                    if ($wpsaf->permalink == 2) {
                        $safe_link = $domain . "?" . $wpsaf->permalink2 . "=";
                    } else {
                        $safe_link = home_url() . "?";
                    }
                }
                $replace = ["{base_url}" => $safe_link, "{domain}" => rtrim($dm, ","), "{exclude_domain}" => rtrim($dm_exclude, ",")];
                $js = file_get_contents(WPSAF_DIR . "/assets/wpsafelink.js");
                $js = str_replace(array_keys($replace), array_values($replace), $js);
                require_once "HunterObfuscator.php";
                $hunter = new HunterObfuscator($js);
                $obsfucated = $hunter->Obfuscate();
                file_put_contents(ABSPATH . "/wpsafelink.js", $obsfucated);
                echo "<div id=\"message\" class=\"updated fade\"><p><strong>Settings have been saved</strong></p></div>";
            } else {
                if ($_POST["reset"] == "Reset") {
                    wpsaf_default();
                    echo "<div id=\"message\" class=\"updated fade\"><p><strong>Settings have been reset</strong></p></div>";
                }
            }
        }
        $wpsaf = json_decode(get_settings("wpsaf_options"));
        if ($_POST["generate"] == "Generate" && trim($_POST["linkd"]) != "") {
            $linkd = trim($_POST["linkd"]);
            $safe_id = substr(md5($linkd . date("His")), 2, 8);
            $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink WHERE link='" . $linkd . "'";
            $cek = $wpdb->get_results($sql, "ARRAY_A");
            if (!$cek) {
                $data = ["date" => date("Y-m-d H:i:s"), "safe_id" => $safe_id, "link" => $linkd];
                $wpdb->insert($wpdb->prefix . "wpsafelink", $data, "");
            } else {
                $linkd = $cek[0]["link"];
                $safe_id = $cek[0]["safe_id"];
            }
            if ($wpsaf->permalink == 1) {
                $generated3 = home_url() . "/" . $wpsaf->permalink1 . "/" . $safe_id;
                $generated2 = home_url() . "/" . $wpsaf->permalink1 . "/" . base64_encode($linkd);
            } else {
                if ($wpsaf->permalink == 2) {
                    $generated3 = home_url() . "/?" . $wpsaf->permalink2 . "=" . $safe_id;
                    $generated2 = home_url() . "/?" . $wpsaf->permalink2 . "=" . base64_encode($linkd);
                } else {
                    $generated2 = home_url() . "/?" . base64_encode($linkd);
                    $generated3 = home_url() . "/?" . $safe_id;
                }
            }
        }
        $sql = "SELECT * FROM " . $wpdb->prefix . "wpsafelink order by date desc";
        $safe_lists = $wpdb->get_results($sql, "ARRAY_A");
        if ($_POST["sub"] == "Change License") {
            $cached = WPSAF_DIR . "assets/wpsaf.script.js";
            if (file_exists($cached)) {
                unlink($cached);
            }
        }
        if ($_POST["lisensi"] && $_POST["submit"] == "Validate License") {
            $lis = $_POST["lisensi"];
            if (strlen($lis) != 29) {
                echo "<div id=\"message\" class=\"error\"><p><strong>Invalid license.</strong></p></div>";
            } else {
                $cek = $this->ceklis($lis);
                if ($cek) {
                    echo "<div id=\"message\" class=\"updated fade\"><p><strong>activation license successfully</strong></p></div>";
                } else {
                    echo "<div id=\"message\" class=\"error\"><p><strong>Invalid license.</strong></p></div>";
                }
            }
        }
        $cek = $this->ceklis("", true) ? true : false;
        $wphar = json_decode(get_option("wphar_setting"));
        $domen = str_replace(["https://", "http://"], "", home_url());
        include WPSAF_DIR . "wp-safelink.options.php";
    }
    public function ceklis($lis = "", $get_license = false)
    {
        $cached = WPSAF_DIR . "assets/wpsaf.script.js";
        $domen = str_replace(["https://", "http://"], "", home_url());
        if (file_exists($cached)) {
            $cek = $lis;
            $time = filemtime($cached);
            $time = date("Y-m-d H:i:s", $time);
            $awal = date_create($time);
            $akhir = date_create();
            $diff = date_diff($awal, $akhir);
            $filecached = file_get_contents($cached);
            $filecached = substr($filecached, 29, 9999);
            $filecached = json_decode(base64_decode($filecached));
            if ($lis == "" && $filecached->msg->domain == $domen) {
                $lis = $filecached->msg->license;
            }
            if ($cek == "key") {
                return substr($filecached->msg->license, 0, 10) . "*********";
            }
            if ($get_license) {
                return $lis;
            }
            if ($diff->h <= 0 && $diff->i <= 1 && $filecached->status == "sakses" && $filecached->msg->domain == $domen) {
                return true;
            }
        }
        if ($lis != "") {
            $satu = base64_decode(substr("dxaHR0cHM6Ly9hcGkudGhlbWVzb24uY29t", 2, 999));
            $dua = base64_decode(substr("dxL3RoZW1lc29uX2xpY2Vuc2U=", 2, 999));
            $tiga = base64_decode(substr("dxL3dwc2FmZWxpbmsv", 2, 999));
            $link = $satu . $dua . $tiga . $lis . "/" . base64_encode($domen);
            $cek = json_decode($this->get_curl($link));
            if ($cek->status == "sakses" && $cek->msg->license == $lis) {
                $res = json_encode($cek);
                $res = base64_encode($res);
                $res = substr($res, 1, 29) . $res;
                file_put_contents($cached, $res);
                return true;
            }
        }
        return false;
    }
    public function ceks()
    {
        if (!$this->ceklis()) {
            echo "<script> location.replace(\"admin.php?page=wp-safelink&tb=lic\"); </script>";
            exit;
        }
        return true;
    }
    public function get_curl($url)
    {
        $response = wp_remote_get($url);
        if (!is_wp_error($response)) {
            $body = $response["body"];
            return $body;
        }
        return false;
    }
    public function foot_admin()
    {
        if ($_GET["page"] == "wp-safelink") {
            echo "<style>#footer-thankyou{font-size:12px !important;}</style><span style=\"font-size:12px;margin-top:14px;padding:10px 0 0 10px;\"><i><b>~ WPSafelink</b></i></span><span style=\"font-size:12px;margin-top:14px;padding:10px 0 0 10px;color:red\"><i>~ Plugin ini hanya dijual di <a href=\"http://themeson.com\" target=\"_blank\">Themeson.com</a>.\r\nJika anda menbeli dari website lain, selamat anda dapat bajakan.</i></span>";
        }
    }
    public function footer_wp_safelink()
    {
        echo "<script src=\"" . get_bloginfo("url") . "/wpsafelink.js\"></script>";
    }
    public function encrypt_link($link, $key = "")
    {
        if (empty($key)) {
            $key ="iujfiniubjdofbhb7df98an6t5";
        }
        $link = base64_encode(openssl_encrypt($link, "AES-256-ECB", $key));
        $link = $key . $this->delimeter_wp_safelink . $link;
        return $link;
    }
    public function decrypt_link($link)
    {
        $key ="iujfiniubjdofbhb7df98an6t5";
        if (strpos($link, $this->delimeter_wp_safelink) !== false) {
            $explode = explode($this->delimeter_wp_safelink, $link);
            $key = $explode[0];
            $link = base64_decode($explode[1]);
            $test = openssl_decrypt($link, "AES-256-ECB", $key);
        }
        return openssl_decrypt($link, "AES-256-ECB", $key);
    } 
    public function doRewrite()
    {
        $wpsaf = json_decode(get_option("wpsaf_options"));
        if (!empty($wpsaf) && (empty($wpsaf->autoconvert) || $wpsaf->autoconvert == 1)) {
            ob_start([$this, "rewrite"]);
        }
    }
    protected function rewrite($html)
    {
        $output = "";
        $wpsaf = json_decode(get_option("wpsaf_options"));
        $str_link = [];
        $links = array_map("trim", explode("\n", $wpsaf->domain));
        if ($wpsaf->autoconvertmethod == "exclude") {
            $links = array_map("trim", explode("\n", $wpsaf->exclude_domain));
            $links[] = get_bloginfo("url");
        }
        $html = str_get_html($html);
        foreach ($html->find("a") as $element) {
            $line = $element->href;
            if (empty($wpsaf->autoconvertmethod) || $wpsaf->autoconvertmethod == "include") {
                if ($this->strposa($line, $links)) {
                    $str_link[$line] = $this->generateLink($line);
                }
            } else {
                if ($wpsaf->autoconvertmethod == "exclude" && !$this->strposa($line, $links)) {
                    $str_link[$line] = $this->generateLink($line);
                }
            }
        }
        $output = str_replace(array_keys($str_link), array_values($str_link), $html);
        return $output;
    }
    public function generateLink($link)
    {
        $output = "";
        $wpsaf = json_decode(get_option("wpsaf_options"));
        $wpsaf_client = json_decode(get_option("wpsaf_options_client"));
        $base_link = $this->encrypt_link($link, $wpsaf->license);
        if ($wpsaf->permalink == 1) {
            $output = rtrim($wpsaf->base_url, "/") . "/" . $wpsaf->permalink1 . "/" . $base_link;
        } else {
            if ($wpsaf->permalink == 2) {
                $output = rtrim($wpsaf->base_url, "/") . "/?" . $wpsaf->permalink2 . "=" . $base_link;
            } else {
                $output = rtrim($wpsaf->base_url, "/") . "/?" . $base_link;
            }
        }
        return $output;
    }
    public function strposa($haystack, $needles = [])
    {
        $chr = [];
        foreach ($needles as $needle) {
            if (strpos($haystack, $needle) !== false) {
                return true;
            }
        }
        return false;
    }
}
function checkUpdateWpSafelink()
{
    $cached = WPSAF_DIR . "assets/wpsaf.script.js";
    $domen = str_replace(["https://", "http://"], "", home_url());
    if (file_exists($cached)) {
        $time = filemtime($cached);
        $time = date("Y-m-d H:i:s", $time);
        $awal = date_create($time);
        $akhir = date_create();
        $diff = date_diff($awal, $akhir);
        $filecached = file_get_contents($cached);
        $filecached = substr($filecached, 29, 9999);
        $filecached = json_decode(base64_decode($filecached));
        $lis = $filecached->msg->license;
        $plugin_update = Puc_v4_Factory::buildUpdateChecker("http://update.themeson.com/?action=get_metadata&slug=wp-safelink&code=" . $lis . "&data=" . base64_encode($domen), WPSAF_FILE, "wp-safelink");
    }
}

?>