<?php

class Newsletter extends Admin_controller {

    function __construct() {
        parent::__construct();
        //Auth::handleLogin();
        $this->loadModel('newsletter_model');
    }

    /**
     * Hírlevelek listája oldal
     */
    public function index()
    {

        $this->view = new View();
        $this->view->title = 'Hírlevél oldal';
        $this->view->description = 'Hírlevél oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'select2', 'datetimepicker', 'vframework', 'newsletter_eventsource'));
        // lekérdezés a newsletters és a stats_newsletters táblákból
        $this->view->newsletters = $this->newsletter_model->newsletter_query();

        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_newsletter');
    }

    /**
     * AJAX hírlevél küldésének regisztrálása az adatbázisban
     */
    public function sendNewletterRegister()
    {
        if (Util::is_ajax()) {

            $newsletter_id = $this->request->get_post('newsletter_id', 'integer');
            $statid = $this->request->get_post('statid', 'integer');
            $date = $this->request->get_post('date');

            // Akkor lesz helyes timestamp, ha az óra és perc előtt csak egy space van és nem "-" jel!
            $timestamp = strtotime($date);

            // Ez megy a stats_newsletter táblába
            // Az 1-es azt jelenti, hogy a küldés folyamatban van
            $progress_status = 1;

            //Adatok a stats_newsletter, vagy nesletter táblába
            $result = $this->newsletter_model->updateProgressStatus($newsletter_id, $statid, $progress_status, $timestamp);
            
            if ($result !== false) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => ''
                ));
            } else {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Ismeretlen hiba!'
                ));                
            }

            exit;
        }
    }



    /**
     * Hírlevél létrehozása oldal megjelenítése és feldolgozása is.
     */
    public function new_newsletter()
    {
        // Létrehozás
        if ($this->request->has_post('submit_new_newsletter')) {
            
            $data['newsletter_name'] = $_POST['newsletter_name'];
            $data['newsletter_subject'] = $_POST['newsletter_subject'];
            $data['newsletter_body'] = $_POST['newsletter_body'];
            $data['newsletter_template'] = empty($_POST['newsletter_templates']) ? null : (int)$_POST['newsletter_templates'];
            //$data['newsletter_status'] = (int)$_POST['newsletter_status'];
            $data['newsletter_create_date'] = date('Y-m-d-G:i');

            // Új rekord a newsletter táblába
            $last_insert_id = $this->newsletter_model->insertNewsletter($data);

            if ($last_insert_id) {
                // Insert rekord a stats_newsletter táblába!
                $this->newsletter_model->insertStat(array(
                    'newsletter_id' => $last_insert_id,
                ));

                Message::set('success', 'Új hírlevél hozzáadva!');
            } else {
                Message::set('error', 'Hiba történt!');
            }

            // Átirányítás
            Util::redirect('newsletter');
        }
    
        // Létrehozás oldal megjelenítés    
        $this->view = new View();
        $this->view->title = 'Hírlevél hozzáadása';
        $this->view->description = 'Hírlevél oldal description';

        $this->view->add_links(array('ckeditor', 'new_newsletter'));

        $this->view->ckeditor = true;
        $this->view->template_list = $this->newsletter_model->load_template_list();

        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_new_newsletter');
    }

    /**
     * Hírlevél módosítása
     * @return [type] [description]
     */
    public function edit_newsletter()
    {
        $id = (int)$this->request->get_params('id');
        
        // Hírlevél módosítása feldolgozó
        if ($this->request->has_post('submit_edit_newsletter')) {
            

            $data['newsletter_name'] = $_POST['newsletter_name'];
            $data['newsletter_subject'] = $_POST['newsletter_subject'];
            $data['newsletter_body'] = $_POST['newsletter_body'];
//            $data['newsletter_status'] = (int) $_POST['newsletter_status'];
            //$data['newsletter_create_date'] = date('Y-m-d-G:i');

            $result = $this->newsletter_model->edit_newsletter($id, $data);

            // ha sikeres az insert visszatérési érték true
            if ($result !== false) {
                Message::set('success', 'Hírlevél sablon módosítva!');
            } else {
                Message::set('error', 'Hiba történt!');
            }

            Util::redirect('newsletter');
        }

        // Hírlevél módosítása oldal
        $this->view = new View();
        $this->view->title = 'Hírlevél szerkesztése';
        $this->view->description = 'Hírlevél oldal description';

        $this->view->add_links(array('ckeditor', 'edit_newsletter'));

        $this->view->newsletter = $this->newsletter_model->newsletter_query($id);

        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_edit_newsletter');
    }

    /**
     * Hírlevél törlése
     */
    public function delete_newsletter()
    {
        if (Util::is_ajax()) {
            $this->newsletter_model->delete_newsletter_AJAX();
        }
    }

    /**
     * 	Hírlevél törlése AJAX-al
     * 	Az echo $result megy vissza a javascriptnek
     */
    public function delete_template_AJAX()
    {
        if (Util::is_ajax()) {
            $result = $this->newsletter_model->delete_template_AJAX();
            echo $result;
        }
    }

    /**
     * 	Hírlevél csoportos törlése
     * 	
     */
    public function delete_template()
    {
        $this->newsletter_model->delete_template();
        Util::redirect('newsletter/templates');
    }



    /* --------- EVENTSOURCE -------------------- */

    public function send_newsletter()
    {
        header('Content-Type: text/event-stream');
        // recommended to prevent caching of event data.
        header('Cache-Control: no-cache');
        // Setting this header instructs Nginx to disable fastcgi_buffering and disable
        // gzip for this request.
        header('X-Accel-Buffering: no');

        set_time_limit(0);
        // ob_implicit_flush(true);

        $newsletter_id = (int)$this->request->get_query('newsletter_id');
        $this->newsletter_model->send_newsletter($newsletter_id);
    }

    /* --------- EVENTSOURCE END-------------------- */


    /* --------- HÍRLEVÉL KÜLDÉS; CRON JOB; FOLYAMAT KÖVETÉS NÉLKÜL; IDŐLIMITTEL -------------------- */
    public function send_newsletter_timelimit()
    {
        if ($this->request->has_query('cronkey')) {
            $cronkey = $this->request->get_query('cronkey');
            if ($this->request->get_query('cronkey') != 'DH7AVdT0uGeN-WfZLkgfutDfDeYrqELjjTZrnulm3RY') {
                exit;
            }
        } else {
            exit;
        } 

        // A script futásának az időlimitje (másodpercben)
        $time_limit = Config::get('newsletter_send_timelimit');

        // Az jelzi, hogy a folyamatot időlimit miatt kellett-e leállítani (true)
        $time_limit_expired = false;

        // start_time meghatározása (lebegőpontos számot ad vissza)
        $start_time = microtime(true);

        // Hibás küldések
        $error = array();
        
        // Sikeres küldések
        $success = array();

        // Jelenlegi timestamp
        $actual_time = time();


        ///////////////////////////////////////////////////////////////////////////////////////////////
        // Küldéshez szükséges adatok lekérdezése, beállítása; Új rekord a stats_newsletter táblába  //
        ///////////////////////////////////////////////////////////////////////////////////////////////

        // Az összes hírlevél kampány, amik folyamatban vannak (stats_newsletter táblában 1 es!)
        $in_progress_campaigns = $this->newsletter_model->findInProgressCampaign();

            // Ha nincsenek függőben lévő kampányok
            if (empty($in_progress_campaigns)) {
                exit;
            }


        // Annak a hírlevél kampánynak az id-it fogják tartalmazni, amit ténylegesen küldünk
        $newsletter_id = null;
        $statid = null;

        // Az első kampány lesz küldve, aminél a küldési timestamp kisebb, mint a jelenlegi timestamp
        foreach ($in_progress_campaigns as $campaign) {
            // ha a megadott timestamp kisebb, mint a jelenlegi timestamp
            if ($campaign['sent_date'] <= $actual_time) {
                $statid = $campaign['statid'];
                $newsletter_id = $campaign['newsletter_id'];
                break;
            }
        }

            // Ha a függőben lévő kampányok közül nincs egy sem, amit jelen pillanatban már küldeni kell
            if (empty($newsletter_id) || empty($statid)) {
                exit;
            } 


        // elküldendő hírlevél elemeinek lekérdezése 
        $newsletter_temp = $this->newsletter_model->newsletter_query((int) $newsletter_id);
        // az összes e-mail cím, és hozzájuk tartozó user név (akiknek küldeni kell)
        $email_temp = $this->newsletter_model->user_email_query();
        // A megadott kampányhoz tartozó, már elküldött email címek lekérdezése az emails_sent táblából
        $sent_emails = $this->newsletter_model->findSentEmails($statid);


        // Email tárgy és törzs változóhoz rendelése
        foreach ($newsletter_temp as $value) {
            $subject = $value['newsletter_subject'];
            $body = $value['newsletter_body'];
        }

        $body_temp = $body;

        // User adatok külön tömbökbe helyezése
        // A MÁR ELKÜLDÖTT EMAIL CÍMEKET KIHAGYJA!
        foreach ($email_temp as $value) {
            // Ha az email cím már szerepel az elküldöttek listáján akkor ugorja át
            if (in_array($value['user_email'], $sent_emails)) {
               continue;
            }

            $user_emails[] = $value['user_email'];
            $user_names[] = $value['user_name'];
            $user_ids[] = $value['user_id'];
            $user_unsubs[] = $value['user_unsubscribe_code'];
        }

        // A jelenleg küldendő email címek száma
        $all_email_address = count($user_emails);



// TESZT
if (true) {
        
        echo 'newsletter_id: ' . $newsletter_id . '<br>';
        echo 'statid: ' . $statid . '<br>';
        echo 'Osszes email cim a site_users tablaban ami aktiv: ' . count($email_temp) . '<br>';


        $progress_counter = 0;

            // Email-ek elküldése
            foreach ($user_emails as $mail_address) {

                $number = rand(1000,11000);
                // Várakozás
                time_nanosleep(0, 10000000);

                if($number > 2000){
                    $success[] = $mail_address;
                    $this->newsletter_model->insert_email_log($mail_address, 0, '', $statid);
                    
                } else{
                    $error[] = $mail_address;
                    $this->newsletter_model->insert_email_log($mail_address, 1, 'hiba', $statid);
                }

                $progress_counter++;


                ////////////////////////////////////////////
                // Az aktuális email küldése befejeződött //
                ////////////////////////////////////////////

                // időpont meghatározása (lebegőpontos számot ad vissza)
                $end_time = microtime(true);

                // Megvizsgáljuk, hogy lejárt-e az időlimit
                if (($end_time - $start_time) >= $time_limit) {

                    // Megnézzük, hogy nem ez volt-e az utolsó küldendő email (mert akkor nem járt le az idő és minden email elment)
                    if ($all_email_address == $progress_counter) {
                        // Az időlimit lejárt, de nem volt már több elküldendő email
                        $time_limit_expired = false;
                    } else {
                        // Az időlimit lejárt, és volt még elküldendő email
                        $time_limit_expired = true;
                    }

                    // Kilépés a cikusból;
                    break;
                }
                
            }

        echo 'Eddig osszesen elkuldott email-ek szama: ' . (count($sent_emails) + $progress_counter) . '<br>';
        echo 'A fennmarado email cimek szama: ' . ($all_email_address - $progress_counter) . '<br>';
        echo 'Ebben a menetben elkuldott emailek szama: ' . $progress_counter . '<br><br><hr>';    



} else {



            /////////////////////////
            // Küldés PHPMailer-el //
            /////////////////////////

            include(LIBS . '/PHPMailer/PHPMailerAutoload.php');

            $mail = new PHPMailer();

            if (Config::get('email.server.use_smtp')) {

                //SMTP beállítások!!
                $mail->isSMTP(); // Set mailer to use SMTP              
                $mail->SMTPDebug = Config::get('email.server.phpmailer_debug_mode'); // Enable verbose debug output
                $mail->Debugoutput = 'html';
                $mail->SMTPAuth = Config::get('email.server.smtp_auth'); // Enable SMTP authentication
                $mail->SMTPKeepAlive = false; // SMTP connection will not close after each email sent, reduces SMTP overhead
                // Specify SMTP host server
                $mail->Host = Config::get('email.server.smtp_host');
                $mail->Username = Config::get('email.server.smtp_username'); // SMTP username
                $mail->Password = Config::get('email.server.smtp_password'); // SMTP password
                $mail->Port = Config::get('email.server.smtp_port'); // TCP port to connect to
                //     $mail->SMTPSecure = Config::get('email.server.smtp_encryption'); // Enable TLS encryption, `ssl` also accepted
            } else {
                $mail->IsMail();
            }

            $mail->CharSet = 'UTF-8'; //karakterkódolás beállítása
            $mail->WordWrap = 78; //sortörés beállítása (a default 0 - vagyis nincs)
            $mail->AddReplyTo(Config::get('email.from_email'), Config::get('email.from_name'));
            $mail->From = Config::get('email.from_email'); //feladó e-mail címe
            $mail->FromName = Config::get('email.from_name'); //feladó neve
            $mail->Subject = $subject; // Tárgy megadása
            $mail->isHTML(true); // Set email format to HTML                                  
            
            //a ciklusok számát fogja számolni (vagyis hogy éppen mennyi emailt küldött el) 
            $progress_counter = 0;

            // Email-ek elküldése
            foreach ($user_emails as $key => $mail_address) {

                $body = $body_temp;
                //Since the tracking URL is a bit long, I usually put it in a variable of it's own
                $tracker_url = BASE_URL . 'track_open/' . $user_ids[$key] . '/' . $statid;

                //Add the tracker to the message.
                $tracker = '<img alt="" src="' . $tracker_url . '" width="1" height="1" border="0" />';
                $unsubscribe_url = BASE_URL . 'leiratkozas/' . $user_ids[$key] . '/' . $user_unsubs[$key] . '/' . $statid;
                $unsubscribe = '<p>Leiratkozáshoz kattintson a következő linkre: <a href="' . $unsubscribe_url . '">Leiratkozás</a></p>';

                $body = $this->newsletter_model->replace_links($body, $user_ids[$key], $statid);

                $body = str_replace('{$name}', $user_names[$key], $body);
                $body = str_replace('{$unsubscribe}', $unsubscribe, $body);
                $body = str_replace('</body>', $tracker . '</body>', $body);
                $body = str_replace('{$subject}', $subject, $body);
                $body = str_replace('{$email}', $mail_address, $body);
                $body = str_replace('{$date}', date("Y-m-d"), $body);


                $mail->Body = '<html><body>' . $body . '</body></html>';

                $mail->addAddress($mail_address, $user_names[$key]);     // Add a recipient (Name is optional)
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');
                //$mail->addStringAttachment('image_eleresi_ut_az_adatbazisban', 'YourPhoto.jpg'); //Assumes the image data is stored in the DB
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';  
                
                // final sending and check
                if ($mail->send()) {
                    $success[] = $mail_address;
                    $this->newsletter_model->insert_email_log($mail_address, 0, '', $statid);
                
                } else {
                    $error[] = $mail_address;
                    $this->newsletter_model->insert_email_log($mail_address, 1, $mail->ErrorInfo, $statid);
                    Message::log($mail->ErrorInfo);
                
                }

                $mail->clearAddresses();
                $mail->clearAttachments();

                $progress_counter++;


            ////////////////////////////////////////////
            // Az aktuális email küldése befejeződött //
            ////////////////////////////////////////////

            // időpont meghatározása (lebegőpontos számot ad vissza)
            $end_time = microtime(true);

            // Megvizsgáljuk, hogy lejárt-e az időlimit
            if (($end_time - $start_time) >= $time_limit) {

                // Megnézzük, hogy nem ez volt-e az utolsó küldendő email (mert akkor nem járt le az idő és minden email elment)
                if ($all_email_address == $progress_counter) {
                    // Az időlimit lejárt, de nem volt már több elküldendő email
                    $time_limit_expired = false;
                } else {
                    // Az időlimit lejárt, és volt még elküldendő email
                    $time_limit_expired = true;
                }

                // Kilépés a cikusból;
                break;
            }

        } // END foreach 



} // TESZT ELSE


        ////////////////////////////////////////////////////////
        // Adatbázisba írjuk a küldéssel kapcsolatos adatokat //
        ////////////////////////////////////////////////////////
        
        // Adatok beírása a stats_newsletters táblába
        $recepients = count($success) + count($error);
        $send_success = count($success);
        $send_fail = count($error);
        // Azok az oszlopok, amiknél értéket kell növelni
        $quantity_increase = array(
            'recepients' => 'recepients+' .  $recepients,
            'send_success' => 'send_success+' .  $send_success,
            'send_fail' => 'send_fail+' .  $send_fail
        );

        // Ha időlimit miatt áll le a script futása 
        if ($time_limit_expired) {
            $data['progress_status'] = 1; // 1 - folyamatban; 2 - kész
            $data['error'] = 1;
        } else {
            // Ha minden email elküldve időlimiten belül 
            $data['progress_status'] = 2; // 1 - folyamatban; 2 - kész
            $data['error'] = 0;
        }

        // Adatok frissítése (UPDATE) a stats_newsletter táblában
        $this->newsletter_model->updateStat($statid, $data, $quantity_increase);

        // Script futásának a befejezése
        exit;
                
    }
    /* --------- SIMA KÜLDÉS, FOLYAMAT KÖVETÉSE NÉLKÜL END-------------------- */










    /**
     * Hírlevél kampányok statisztika lista oldal
     */
    public function newsletter_stats()
    {
        $this->view = new View();
        $this->view->title = 'Elküldött hírlevelek oldal';
        $this->view->description = 'Elküldött hírlevél oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'select2', 'newsletter_stats'));

        $this->view->newsletters = $this->newsletter_model->newsletter_stats_query();

        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_newsletter_stats');
    }

    /**
     * Egy kampány statisztikája oldal
     */
    public function newsletter_stat() {

        $newsletter_id = (int) $this->request->get_params('id');

        $this->view = new View();
        $this->view->title = 'Hírlevelek statisztika';
        $this->view->description = 'Hírlevél statisztika description';

        $this->view->add_links(array('datatable', 'bootbox', 'flot', 'newsletter_stat'));

        $this->view->newsletter_stat = $this->newsletter_model->newsletter_stats_query($newsletter_id);
        $this->view->newsletter_stat = $this->view->newsletter_stat[0];


        $stat_data = array(
            array(
                'label' => 'Megnyitott',
                'data' => $this->view->newsletter_stat['unique_email_opens']
            ),
            array(
                'label' => 'Nem megnyitott',
                'data' => $this->view->newsletter_stat['recepients'] - $this->view->newsletter_stat['unique_email_opens']
            )
        );
        /*         * ************ email megnyitások ****************** */
        $opens_data = $this->newsletter_model->get_email_opens($newsletter_id);


        $days = array();
        $data = array();

        foreach ($opens_data as $key => $value) {

            //     echo date('Y-m-d H:i:s', $value['open_time']) . '<br>';
            $days[] = date('m-d', $value['open_time']);
            //         $opens_data_mod[$key] = array($value['open_time'] . '000', 1);
        }

        $days = array_count_values($days);

        foreach ($days as $key => $value) {
            $data[] = array($key, $value);
        }


        /*      echo 'Magnyitások napi lebontásban: <br>'; 
          var_dump($days);
          echo 'Magnyitások napi lebontásban javascript<br>';
          var_dump($data);
          die();
         */

        /*         * ************ kattintások email-ben ************* */
        $clicks_data = $this->newsletter_model->get_email_clicks($newsletter_id);


        $days_clicks = array();
        $data_clicks = array();

        foreach ($clicks_data as $key => $value) {

            //     echo date('Y-m-d H:i:s', $value['open_time']) . '<br>';
            $days_clicks[] = date('m-d', $value['click_time']);
            //         $opens_data_mod[$key] = array($value['open_time'] . '000', 1);
        }

        $days_clicks = array_count_values($days_clicks);

        foreach ($days_clicks as $key => $value) {
            $data_clicks[] = array($key, $value);
        }


        $this->view->add_js_var('<script> var data =' . json_encode($stat_data) . '; var opens_data =' . json_encode($data) . '; var clicks_data =' . json_encode($data_clicks) . '</script>');

        //$this->view->debug(true);	
        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_newsletter_stat');
    }

    public function templates() {

        $this->view = new View();

        $this->view->title = 'Hírlevél sablonok oldal';
        $this->view->description = 'Hírlevél sablonok oldal description';


        $this->view->add_links(array('datatable', 'bootbox', 'select2', 'newsletter_templates'));

        $this->view->templates = $this->newsletter_model->template_query();

//$this->view->debug(true);	
        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_templates');
    }

    public function new_template() {
        if ($this->request->has_post('submit_new_template')) {
            $this->newsletter_model->new_template();
            Util::redirect('newsletter/templates');
        }

        $this->view = new View();

        $this->view->title = 'Hírlevél sablon hozzáadása';
        $this->view->description = 'Hírlevél sablon oldal description';

        $this->view->add_links(array('ckeditor', 'newsletter_template_new'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_new_template');
    }

    public function edit_template() {
        if ($this->request->has_post('submit_edit_template')) {
            $this->newsletter_model->edit_template($this->request->get_params('id'));
            Util::redirect('newsletter/templates');
        }

        $this->view = new View();

        $this->view->title = 'Hírlevél sablon szerkesztése';
        $this->view->description = 'Hírlevél sablon description';

        $this->view->add_links(array('ckeditor', 'newsletter_template_edit'));

        $this->view->template = $this->newsletter_model->template_query($this->request->get_params('id'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_edit_template');
    }

    public function load_template_prewiew_AJAX() {

        if (Util::is_ajax()) {
            $result = $this->newsletter_model->load_template_AJAX();
            echo $result;
        }
    }


    /**
     * A megadott id-jű hírlevél html-t adja vissza a javascriptnek
     */
    public function preview()
    {
        if (Util::is_ajax()) {
            $id = $this->request->get_post('newsletter_id', 'integer');    
            $result = $this->newsletter_model->findNewsletterHTML($id);
            // html body visszaküldése a javascript-nek
            echo $result[0]['newsletter_body'];
        }
    }


    public function send_test_newsletter_AJAX() {

        if (Util::is_ajax()) {

            $result = $this->newsletter_model->send_test_email();
            echo $result;
        }
    }

    public function test() {

        $body = 'html>
<head>
	<title>Freya Szalon hírlevél</title>
</head>
<body>
<h1 style="background-color:#ffffff;font-size:100%;font-family:Tahoma, Geneva, Kalimati, sans-serif;color:#8a8a8a;text-align:center"></h1>

<table border="0" cellpadding="0" cellspacing="0" style="text-align: left; margin: auto; width: 560px;">
	<tbody>
		<tr>
			<td height="10">
			<p><img alt="fejléc" src="http://freyaszalon.hu/uploads/images/hirlevel/bor2015-11.jpg" style="border: 0px none; width: 850px; height: 265px;" /></p>
			</td>
		</tr>
		<tr>
			<td bgcolor="#fbfbf7" valign="top" width="496">
			<p><span style="font-size: x-large;"><span style="font-family: palatino;">Kedves {$name}!</span></span></p>

			<p></p>

			<table align="center" border="0" cellpadding="0" cellspacing="0" class="button" height="48" style="border-collapse: collapse; margin: auto; color: rgb(102, 102, 102); font-family: sans-serif; font-size: 15px; line-height: 19.5px; text-align: center; border-spacing: 0px !important; background-color: rgb(255, 255, 255);" width="113">
				<tbody>
					<tr>
						<td style="border-radius: 3px; background: rgb(34, 34, 34);"><a href="http://freyaszalon" style="color: rgb(255, 255, 255); border: 15px solid rgb(149, 82, 81); padding: 0px 10px; line-height: 1; text-decoration: none; display: block; border-radius: 3px; background: rgb(149, 82, 81);"><b>Részletek</b> </a></td>
					</tr>
				</tbody>
			</table>
<a href="http://www.freyaszalon"></a>
<a href="http://freyaszalon/link1"></a>
<a href="http://freyaszalon/link2"></a>
<a href="freyaszalon"></a>
			<p style="text-align: center;"><strong style="color: #800000; font-family: palatino; font-size: xx-large; text-align: center; background-color: #fbfbf7;">Freya - a siker benned van!</strong></p>

			<table border="0">
				<tbody>
					<tr>
						<td><a href="http://freyaszalon/kicsi" style="background-color: #fbfbf7;" target="_blank"><span style="font-size: large;">www.freyaszalon.hu</span></a></td>
						<td style="text-align: right;"><span style="color: #ffffff;">aaaaaaaaaaaaaaaa</span><a href="elerhetoseg"><span style="font-size: large;">info@freyaszalon.hu</span></a></td>
						<td style="text-align: center;"><a href="http://www.facebook.com/pages/Freya-Szalon/125402360858733?ref=hl"><img alt="faceboook" src="http://freyaszalon.hu/uploads/images/hirlevel/facebook_logo_1_nagy.jpg" style="border: 0px none; width: 130px; height: 72px;" /></a></td>
					</tr>
					<tr>
						<td>{$unsubscribe}</td>
						<td style="text-align: right;"><span style="font-size: medium;">{$date}</span></td>
						<td><span style="color: #ffffff;">aaaaaa</span>Adatkezelési nyilvántartási szám: NAIH-54067/2012</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr style="line-height: 0px;">
			<td><img src="http://freyaszalon.hu/uploads/images/hirlevel/page-footer.png" style="border-width: 0px; border-style: solid;" /></td>
		</tr>
	</tbody>
</table>

<div><span style="color: rgb(255, 255, 255); font-family: sans-serif; font-size: 15px; line-height: 15px; text-align: center; background-color: rgb(149, 82, 81);"></span></div>
</body>
</html>';

        $this->newsletter_model->replace_links($body, 3, 1);
    }

    public function test2() {
        $this->newsletter_model->insert_email_log('laci@gmail.com', 1, 'Hiba üzenet', 9);
    }

}
?>