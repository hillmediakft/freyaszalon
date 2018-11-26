<?php

class Util {

    /**
     * Redirects to another page.
     *
     * @param string $location The path to redirect to
     * @param int $status Status code to use
     * @return bool False if $location is not set
     */
    public static function redirect($location, $status = 302) {
        $registry = Registry::get_instance();
        $request = $registry->request;

        if ($location == '') {
            header("Location: " . $request->get_uri('site_url'), true, $status);
            exit;
        }

        header("Location: " . $request->get_uri('site_url') . $location, true, $status);
        exit;
    }

    /**
     * Ellenőrzi, hogy a Ajax hívás történt-e
     *
     * @return bool true|false
     */
    public static function is_ajax() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            return true;
        }
        return false;
    }

    /**
     * 	File törlése
     *
     * 	@param	$filename	a törlendő file elérésiútja mappa/filename.ext
     * 	@return	true|false
     */
    public static function del_file($filename) {
        if (is_file($filename)) {
            //ha a file megnyitható és írható
            if (is_writable($filename)) {
                unlink($filename);
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Egy kép elérési útvonalából generál egy elérési útvonalat a bélyegképéhez
     * Minta: path/to/file/filename.jpg -> path/to/file/filename_thumb.jpg
     * 
     * @param	string	$path (a file elérési útja)
     * @param	bool	$thumb (hozzárak az elérési út végéhez egy thumb mappát)
     * @return	string	a bélyegkép elérési útvonala
     */
    public static function thumb_path($path, $thumb = false) {
        $path_parts = pathinfo($path);
        $dirname = (isset($path_parts['dirname'])) ? $path_parts['dirname'] : '';
        $filename = (isset($path_parts['filename'])) ? $path_parts['filename'] : '';
        $extension = (isset($path_parts['extension'])) ? $path_parts['extension'] : '';

        if (!$thumb) {
            if (($dirname == '.') || ($dirname == '\\')) {
                $path_with_thumb = $filename . '_thumb.' . $extension;
            } else {
                $path_with_thumb = $dirname . '/' . $filename . '_thumb.' . $extension;
            }
        } else {
            if (($dirname == '.') || ($dirname == '\\')) {
                $path_with_thumb = 'thumb/' . $filename . '_thumb.' . $extension;
            } else {
                $path_with_thumb = $dirname . '/thumb/' . $filename . '_thumb.' . $extension;
            }
        }
        return $path_with_thumb;
    }

    /**
     * Egy kép elérési útvonalából generál egy elérési útvonalat a nagyobb bélyegképéhez (small
     * Minta: path/to/file/filename.jpg -> path/to/file/filename_small.jpg
     * 
     * @param   string  $path (a file elérési útja)
     * @param   bool    $small (hozzárak az elérési út végéhez egy thumb mappát)
     * @return  string  a bélyegkép elérési útvonala
     */
    public static function small_path($path, $small = false) {
        $path_parts = pathinfo($path);
        $dirname = (isset($path_parts['dirname'])) ? $path_parts['dirname'] : '';
        $filename = (isset($path_parts['filename'])) ? $path_parts['filename'] : '';
        $extension = (isset($path_parts['extension'])) ? $path_parts['extension'] : '';

        if (!$small) {
            if (($dirname == '.') || ($dirname == '\\')) {
                $path_with_small = $filename . '_small.' . $extension;
            } else {
                $path_with_small = $dirname . '/' . $filename . '_small.' . $extension;
            }
        } else {
            if (($dirname == '.') || ($dirname == '\\')) {
                $path_with_thumb = 'small/' . $filename . '_small.' . $extension;
            } else {
                $path_with_small = $dirname . '/small/' . $filename . '_small.' . $extension;
            }
        }
        return $path_with_small;
    }

    /**
     * 	Visszaadja a jelenlegi url-t a paraméterben megadott nyelvi kóddal módosítva
     *
     * 	@param	String	$lang_code	(nyelvi kód)
     * 	@return	String
     */
    public static function url_with_language($lang_code = 'hu') {
        $registry = Registry::get_instance();
        $lang = ($lang_code == 'hu') ? '' : $lang_code . '/';
        $area = ($registry->area == 'site') ? '' : $registry->area . '/';
        return BASE_URL . $area . $lang . $registry->uri;
    }

    /**
     * Spamektől védett e-mail linket generál Javascripttel
     *
     * @param	string	$email: e-mail cím
     * @param	string	$title: title
     * @param	mixed	$attributes: attribútumok
     * @return	string
     */
    public static function safe_mailto($email, $title = '', $attributes = '') {
        $title = (string) $title;

        if ($title == "") {
            $title = $email;
        }

        for ($i = 0; $i < 16; $i++) {
            $x[] = substr('<a href="mailto:', $i, 1);
        }

        for ($i = 0; $i < strlen($email); $i++) {
            $x[] = "|" . ord(substr($email, $i, 1));
        }

        $x[] = '"';

        if ($attributes != '') {
            if (is_array($attributes)) {
                foreach ($attributes as $key => $val) {
                    $x[] = ' ' . $key . '="';
                    for ($i = 0; $i < strlen($val); $i++) {
                        $x[] = "|" . ord(substr($val, $i, 1));
                    }
                    $x[] = '"';
                }
            } else {
                for ($i = 0; $i < strlen($attributes); $i++) {
                    $x[] = substr($attributes, $i, 1);
                }
            }
        }

        $x[] = '>';

        $temp = array();
        for ($i = 0; $i < strlen($title); $i++) {
            $ordinal = ord($title[$i]);

            if ($ordinal < 128) {
                $x[] = "|" . $ordinal;
            } else {
                if (count($temp) == 0) {
                    $count = ($ordinal < 224) ? 2 : 3;
                }

                $temp[] = $ordinal;
                if (count($temp) == $count) {
                    $number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);
                    $x[] = "|" . $number;
                    $count = 1;
                    $temp = array();
                }
            }
        }

        $x[] = '<';
        $x[] = '/';
        $x[] = 'a';
        $x[] = '>';

        $x = array_reverse($x);
        ob_start();
        ?><script type="text/javascript">
            //<![CDATA[
            var l = new Array();
        <?php
        $i = 0;
        foreach ($x as $val) {
            ?>l[<?php echo $i++; ?>] = '<?php echo $val; ?>';<?php } ?>

                for (var i = l.length - 1; i >= 0; i = i - 1) {
                    if (l[i].substring(0, 1) == '|')
                        document.write("&#" + unescape(l[i].substring(1)) + ";");
                    else
                        document.write(unescape(l[i]));
                }
                //]]>
        </script><?php
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }

    /**
     * 	Ékezetes karaktereket és a szóközt cseréli le ékezet nélkülire és alulvonásra
     * 	minden karaktert kisbetűre cserél
     */
    public static function string_to_slug($string) {
        $accent = array(".", ",", "?", "!", ":", "&", " ", "-", "á", "é", "í", "ó", "ö", "ő", "ú", "ü", "ű", "Á", "É", "Í", "Ó", "Ö", "Ő", "Ú", "Ü", "Ű");
        $no_accent = array('', '', '', '', '-', 'and', '-', '-', 'a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u', 'A', 'E', 'I', 'O', 'O', 'O', 'U', 'U', 'U');
        $string = str_replace($accent, $no_accent, $string);
        $string = strtolower($string);
        return $string;
    }

    /**
     * A fájl nevéhez hozzáilleszt egy query stringet (pl: style.css?v=2314564321
     * A szám a fájl utolsó módosításának timestamp-je
     *  
     * @param   string  $uri  a file elérési útvonala pl.: valami,hu/public/site_assets/css/style.css
     * @return  string  a fájl verzióval ellátott elérési útvonala
     */
    public static function auto_version($uri) {
        if (substr($uri, 0, 1) == "/") {
            // relatív URI
            $fname = $_SERVER["DOCUMENT_ROOT"] . $uri;
        } else {
            // abszolút URI
            $fname = $uri;
        }
        $ftime = filemtime($fname);
        return $uri . '?v=' . $ftime;
    }

    /**
     * Megállapítja, hogy a filter paraméter létezik-e a filter session tömbben
     * Ha megyegyezik a paraméterként átadott értékkel, akkor true-t ad vissza 
     * 
     * @param	string	$filter_name a filter neve (pl: megye
     * @param	string	$value a filter elem értéke
     * @return	boolean	true, false
     */
    public static function in_filter($filter_name, $value) {

        $filter = Session::get('ingatlan_filter');

        //       var_dump($filter);
        //      die;
        if (isset($filter)) {
            if (isset($filter[$filter_name])) {
                if (is_array($filter[$filter_name])) {
                    if (in_array($value, $filter[$filter_name])) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    if ($filter[$filter_name] == $value) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Egy szövegből az elejétől kezdődően adott karakterszámú rész ad vissza szóra kerekítve
     *  
     * @param   string  $string  szöveg
     * @param   int  $char  karakterek száma
     * @return  string  a levágott szöveg
     */
    public static function substr_word($string, $char) {
        $s = mb_substr($string, 0, $char, 'UTF-8');
        $result = substr($s, 0, strrpos($s, ' '));
        return $result;
    }

    /**
     * Egy szövegből az elejétől adott számú mondatot ad vissza
     *  
     * @param   string  $body  szöveg
     * @param   int  $sentencesToDisplay  a mondatk száma
     * @return  string  a levágott szöveg
     */
    static function sentence_trim($body, $sentencesToDisplay = 1) {
        $nakedBody = preg_replace('/\s+/', ' ', strip_tags($body));
        $sentences = preg_split('/(\.|\?|\!)(\s)/', $nakedBody);

        if (count($sentences) <= $sentencesToDisplay)
            return $nakedBody;

        $stopAt = 0;
        foreach ($sentences as $i => $sentence) {
            $stopAt += strlen($sentence);

            if ($i >= $sentencesToDisplay - 1)
                break;
        }

        $stopAt += ($sentencesToDisplay * 2);
        return trim(substr($nakedBody, 0, $stopAt));
    }

    /**
     * Sorrendbe rendezéshez az aktuális URL-hez adja a rendezési feltételeket
     *
     * Hosszú leírás
     *
     * @param int 		$order		DESC vagy ASC
     * @param string 	$order_by	mi szerint rendezzen
     * @return string 	az új URL rendezés infókkal
     */
    public static function add_order_to_url($order, $order_by) {

        if ((isset($_GET['order'])) && $_GET['order'] != '') {

            $string = $_SERVER['REQUEST_URI'];
            $explode_string = explode('?', $string);

            if (strpos($string, '&') === false) {
                parse_str($explode_string[1], $params);

                if (array_key_exists('order', $params)) {
                    unset($params['order']);
                }
                if (array_key_exists('order_by', $params)) {
                    unset($params['order_by']);
                }
                $url = urldecode(http_build_query($params)) . '?order=' . $order . '&order_by=' . $order_by;
                return $url;
            } else {
                parse_str($_SERVER['QUERY_STRING'], $params);
                if (array_key_exists('order', $params)) {
                    unset($params['order']);
                }
                if (array_key_exists('order_by', $params)) {
                    unset($params['order_by']);
                }

                if (empty($params)) {
                    $url = $explode_string[0] . '?order=' . $order . '&order_by=' . $order_by;
                } else {
                    $url = $explode_string[0] . '?' . urldecode(http_build_query($params)) . '&order=' . $order . '&order_by=' . $order_by;
                }
                return $url;
            }
        } else {
            $string = $_SERVER['REQUEST_URI'];
            if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {
                $url_with_order = $string . '&order=' . $order . '&order_by=' . $order_by;
                return $url_with_order;
            } else {
                $url_with_order = $string . '?order=' . $order . '&order_by=' . $order_by;
                return $url_with_order;
            }
        }
    }

    /**
     * Közösségi média megosztási gombok
     *  
     * @return  string  a html
     */
    static function social_media_share() {
        $html = '';

        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // a megjelenített URL

        $html .= "<div  style='height: 20px; float: left; margin-top: 0px; margin-left: 0px; border-right-width: 0px; margin-right: 10px'>";
        $html .= "<div class='fb-like' data-href='$url' data-send='false' data-layout='button_count' data-width='130' data-show-faces='false' data-font='arial' data-action='recommend'></div>";
        $html .= "</div>";

        $html .= "<div  style='height: 20px; float: left; margin-bottom: 0px; margin-left: 0px; border-right-width: 0px; margin-left: 10px'>";
        $html .= "<div class='g-plusone' data-size='medium'></div>";
        $html .= "<script type='text/javascript'>
  window.___gcfg = {lang: 'hu'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>";
        $html .= "</div>";
        return $html;
    }

    public static function clean_input($input) {

        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );

        $output = preg_replace($search, '', $input);
        return $output;
    }

    public static function convert_array_to_utf8($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = self::convert_array_to_utf8($v);
            }
        } else if (is_string($d)) {
            return mb_convert_encoding($d, "UTF8", "auto");
        }
        return $d;
    }

    /*
     * Tömböt valamelyik mező alapján csoportokba rendez
     * @param   array a rendezendő tömb
     * @return  array a csoportokba rendezett tömb 
     */

    public static function sort_array_by_field($array, $key) {
        $return = array();
        foreach ($array as $v) {
            $return[$v[$key]][] = $v;
        }
        return $return;
    }

    /*
     * array (size=2)
     * 0 => array (size=1)
     *      'term_id' => string '3' (length=1)
     * 1 => array (size=1)
     *      'term_id' => string '4' (length=1)
     * eredmény. array('3', '4') 
     * @param   array az átalakítandó tömb
     * @return  array átalakított tömb
     */

    public static function convertArrayToOneDimensional($array) {
        $newArray = array();
        if (!empty($array)) {
            foreach ($array as $subArray) {
                foreach ($subArray as $val) {
                    $newArray[] = $val;
                }
            }
        }
        return $newArray;
    }

    public static function call_us($phone, $icon = true, $button = true) {
        $button = ($button) ? 'class="btn btn-warning btn-style-outlined"' : '';
        $icon = ($icon) ? '<i class="fa fa-phone"></i> ' : '';
        $phone_filtered = preg_replace('/\D+/', '', $phone);
        $html = '';
        $html .= '<a ' . $button . ' href="tel:' . $phone_filtered . '">' . $icon . $phone . '</a>';
        return $html;
    }

    /**
     * Hírlevél teszt e-mail küldés a simple_mail class-szal
     *
     * @param	string	$címzett: a címzett e-mail címe
     * @param	string	$subject: a tárgy
     * @param	string	$body: az üzenet tárgya
     * @return	string
     */
    public static function send_newsletter_test_mail($cimzett, $subject, $body) {


        include(LIBS . '/PHPMailer/PHPMailerAutoload.php');

        $mail = new PHPMailer();

        if (Config::get('email.server.use_smtp')) {

            //SMTP beállítások!!
            $mail->isSMTP(); // Set mailer to use SMTP				
            $mail->SMTPDebug = Config::get('email.server.phpmailer_debug_mode'); // Enable verbose debug output
            $mail->Debugoutput = 'html';
            $mail->SMTPAuth = Config::get('email.server.smtp_auth'); // Enable SMTP authentication
            $mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
            // Specify SMTP host server
            $mail->Host = Config::get('email.server.smtp_host');
            $mail->Username = Config::get('email.server.smtp_username'); // SMTP username
            $mail->Password = Config::get('email.server.smtp_password'); // SMTP password
            $mail->Port = Config::get('email.server.smtp_port'); // TCP port to connect to
      //      $mail->SMTPSecure = Config::get('email.server.smtp_encryption'); // Enable TLS encryption, `ssl` also accepted
        } else {
            $mail->IsMail();
        }

        $mail->CharSet = 'UTF-8'; //karakterkódolás beállítása
        $mail->WordWrap = 78; //sortörés beállítása (a default 0 - vagyis nincs)
        $mail->From = Config::get('email.from_email'); //feladó e-mail címe
        $mail->FromName = Config::get('email.from_name'); //feladó neve
        $mail->Subject = $subject; // Tárgy megadása
        $mail->isHTML(true); // Set email format to HTML           

        $mail->Body = $body ;

        $mail->addAddress($cimzett, 'teszt');     // Add a recipient (Name is optional)
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        //$mail->addStringAttachment('image_eleresi_ut_az_adatbazisban', 'YourPhoto.jpg'); //Assumes the image data is stored in the DB
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	
        // final sending and check
        if ($mail->send()) {
            echo '<span class="alert alert-success">Teszt email sikeresen elküldve!</span>';
            return;
        } else {
         

            Message::log($mail->ErrorInfo);
            echo '<span class="alert alert-danger">Hiba történt, próbálja újra!</span>';
            return;
        }



/*

        include('system/libs/simple_mail_class.php');

        $mail = new SimpleMail();
        $mail->setTo($cimzett, 'Freya Szalon');
        $mail->setSubject($subject);
        $mail->setFrom('info@freyaszalon.hu', 'Freyaszalon');
        $mail->addMailHeader('Reply-To', 'info@freyaszalon.hu', 'Freyaszalon');
        $mail->addGenericHeader('MIME-Version', '1.0');
        $mail->addGenericHeader('Content-Type', 'text/html; charset="utf-8"');
        $mail->addGenericHeader('X-Mailer', 'PHP/' . phpversion());
        $mail->setMessage($body);
        $mail->setWrap(100);
        $send = $mail->send();
        if ($send) {

            echo '<span class="alert alert-success">Teszt email sikeresen elküldve!</span>';
            return;
        } else {
            echo '<span class="alert alert-danger">Hiba történt, próbálja újra!</span>';
            return;
        } */
    }

}
?>