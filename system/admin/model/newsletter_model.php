<?php

class Newsletter_model extends Model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * 	Visszaadja a newsletter tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param  Integer $id - ha van bejövő paraméter, akkor a hírlevél id-je 
     *  @return array a hírlevelek tömbje 
     */
    public function newsletter_query($id = null) {
        $this->query->reset();
        $this->query->set_table(array('newsletters'));
        $this->query->set_columns('*');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('newsletter_id', '=', $id);
        }
        $this->query->set_orderby('newsletter_id', 'DESC');
        return $this->query->select();
    }

    /**
     * 	Visszaadja az email_templates tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param  Integer ha van bejövő paraméter, akkor a sablon id-je
     *  @return array a hírlevelek tömbje 
     */
    public function template_query($id = null) {
        $this->query->reset();
        $this->query->set_table(array('email_templates'));
        $this->query->set_columns('*');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('template_id', '=', $id);
        }
        $this->query->set_orderby('template_id', 'DESC');
        return $this->query->select();
    }

    /**
     * 	Visszaadja a site_users tábla tartalmát - e-mail küldéshez a címzettek adatai
     * 	
     * 	@return array a site userek tömbje 
     */
    public function user_email_query() {
        $this->query->reset();
        $this->query->set_table(array('site_users'));
        $this->query->set_columns(array('user_id', 'user_name', 'user_email', 'user_unsubscribe_code'));
        $this->query->set_where('user_newsletter', '=', 1);
        $this->query->set_where('user_active', '=', 1);
        return $this->query->select();
    }

    /**
     * 	Új hírlevél létrehozása
     * 	
     * 	@return boolean - true: ha sikeres, false, ha nem 
     */
    public function new_newsletter() {
        $data['newsletter_name'] = $_POST['newsletter_name'];
        $data['newsletter_subject'] = $_POST['newsletter_subject'];
        $data['newsletter_body'] = $_POST['newsletter_body'];
        $data['newsletter_status'] = (int) $_POST['newsletter_status'];
        $data['newsletter_create_date'] = date('Y-m-d-G:i');

        $this->query->reset();
        $this->query->set_table(array('newsletters'));
        $result = $this->query->insert($data);

        // ha sikeres az insert visszatérési érték true
        if ($result) {
            Message::set('success', 'Új hírlevél hozzáadva!');
            return true;
        } else {
            Message::set('error', 'Hiba történt!');
            return false;
        }
    }

    /**
     * 	Hírlevél szerkesztése
     * 
     * 	@param  integer $id a szerkesztendő hírlevél id-je 
     * 	@return boolean - true: ha sikeres, false, ha nem 
     */
    public function edit_newsletter($id) {
        $id = (int) $id;

        $data['newsletter_name'] = $_POST['newsletter_name'];
        $data['newsletter_subject'] = $_POST['newsletter_subject'];
        $data['newsletter_body'] = $_POST['newsletter_body'];
        $data['newsletter_status'] = (int) $_POST['newsletter_status'];
        //$data['newsletter_create_date'] = date('Y-m-d-G:i');

        $this->query->reset();
        $this->query->set_table(array('newsletters'));
        $this->query->set_where('newsletter_id', '=', $id);
        $result = $this->query->update($data);

        // ha sikeres az insert visszatérési érték true
        if ($result >= 0) {
            Message::set('success', 'Hírlevél sablon módosítva!');
            return true;
        } else {
            Message::set('error', 'Hiba történt!');
            return false;
        }
    }

    /**
     * 	Hírlevél törlése, a törlendő hírlevél id POST adatként érkezik
     * 
     * 	@return boolean - true: ha sikeres, false, ha nem 
     */
    public function delete_newsletter() {
        // a sikeres törlések számát tárolja
        $success_counter = 0;
        // a sikertelen törlések számát tárolja
        $fail_counter = 0;

        // Több user törlése
        if (isset($_POST['delete_newsletter'])) {
            $data_arr = $_POST;

            //eltávolítjuk a tömbből a felesleges elemeket	
            if (isset($data_arr['delete_newsletter'])) {
                unset($data_arr['delete_newsletter']);
            }
            if (isset($data_arr['newsletter_table_length'])) {
                unset($data_arr['newsletter_table_length']);
            }
        } else {
            // egy user törlése (nem POST adatok alapján)
            if (!($this->request->has_post('newsletter_id'))) {
                throw new Exception('Nincs id-t tartalmazo parameter az url-ben (ezert nem tudunk torolni id alapjan)!');
                return false;
            }
           
        }
         //berakjuk a $data_arr tömbbe a törlendő felhasználó id-jét
            $data_arr = array($this->request->get_post('newsletter_id'));
        // bejárjuk a $data_arr tömböt és minden elemen végrehajtjuk a törlést
        foreach ($data_arr as $value) {
            //átalakítjuk a integer-ré a kapott adatot
            $value = (int) $value;

            //felhasználó törlése	
            $this->query->reset();
            $this->query->set_table(array('newsletters'));
            //a delete() metódus integert (lehet 0 is) vagy false-ot ad vissza
            $result = $this->query->delete('newsletter_id', '=', $value);

            if ($result !== false) {
                // ha a törlési sql parancsban nincs hiba
                if ($result > 0) {
                    //sikeres törlés
                    $success_counter += $result;
                } else {
                    //sikertelen törlés
                    $fail_counter += 1;
                }
            } else {
                // ha a törlési sql parancsban hiba van
                throw new Exception('Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!');
                return false;
            }
        }

        // üzenetek eltárolása
        if ($success_counter > 0) {
            Message::set('success', $success_counter . ' ' . 'hírlevél törlése sikerült!');
        }
        if ($fail_counter > 0) {
            Message::set('success', $fail_counter . ' ' . 'hírlevél törlése nem sikerült!');
        }

        // default visszatérési érték (akkor tér vissza false-al ha hibás az sql parancs)	
        return;
    }

    /**
     * Hírlevél törlése AJAX-al, a törlendő hírlevél id-je $POST adatként érkezik
     *
     * @return boolean - true: ha sikeres, false, ha nem 
     */
    public function delete_newsletter_AJAX() {
        // a sikeres törlések számát tárolja
        $success_counter = 0;
        // a sikertelen törlések számát tárolja
        $fail_counter = 0;

        // Több user törlése
        if (isset($_POST['newsletter_id'])) {
            $data_arr = $_POST;

            //eltávolítjuk a tömbből a felesleges elemeket	
            if (isset($data_arr['delete_newsletter'])) {
                unset($data_arr['delete_newsletter']);
            }
            if (isset($data_arr['newsletter_table_length'])) {
                unset($data_arr['newsletter_table_length']);
            }
        } else {
            return false;
        }

        // bejárjuk a $data_arr tömböt és minden elemen végrehajtjuk a törlést
        foreach ($data_arr as $value) {
            //átalakítjuk a integer-ré a kapott adatot
            $value = (int) $value;

            //felhasználó törlése	
            $this->query->reset();
            $this->query->set_table(array('newsletters'));
            //a delete() metódus integert (lehet 0 is) vagy false-ot ad vissza
            $result = $this->query->delete('newsletter_id', '=', $value);

            if ($result !== false) {
                // ha a törlési sql parancsban nincs hiba
                if ($result > 0) {
                    //sikeres törlés
                    $success_counter += 1;
                } else {
                    //sikertelen törlés
                    $fail_counter += 1;
                }
            } else {
                // ha a törlési sql parancsban hiba van
                throw new Exception('Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!');
                return false;
            }
        }

        // üzenetek eltárolása
        if ($success_counter > 0) {
            $response = array(
                "status" => 'success',
                "message" => 'Hírlevél törölve.'
            );

            echo json_encode($response);
        }
        if ($fail_counter > 0) {
            $response = array(
                "status" => 'error',
                "message" => 'Hírlevél törlése nem sikerült!'
            );
            echo json_encode($response);
        }

    }

    public function set_progress($value) {
        $this->query->reset();
        $this->query->set_table(array('newsletter_progress'));
        $this->query->set_where('id', '=', 1);
        //$this->query->set_column(array('percent'));
        $this->query->update(array('percent' => $value));
    }

    public function get_progress() {
        $this->query->reset();
        $this->query->set_table(array('newsletter_progress'));
        $this->query->set_columns(array('percent'));
        $this->query->set_where(array('id', '=', 1));
        return $this->query->select();
    }

    private function send_msg($id, $message, $progress) {

        $d = array('message' => $message, 'progress' => $progress);

        echo "id: $id" . PHP_EOL;
        echo "data: " . json_encode($d) . PHP_EOL;
        echo PHP_EOL;

        //ob_flush(); // Sends output data from PHP to Apache. 
        flush(); // Sends output from Apache to browser.
    }

    /**
     * 	Hírlevelek elküldése
     *
     * 	$_POST['message_id']
     *
     */
    public function send_newsletter() {die('kuldes teszt');
        $debug = true;

        $x = Session::get('newsletter_id');
        $id = (isset($x)) ? $x : NULL;

        /*
          if(isset($_POST['newsletter_id'])){
          $id = $_POST['newsletter_id'];
          } else {
          $id = 'nincsen!!!';
          }
         */


        if ($debug) {

            $success = 0;
            $fail = 0;

            $max = 20;

            for ($i = 1; $i <= $max; $i++) {

                $number = rand(1000, 11000);

                $progress = round(($i / $max) * 100); //Progress
                //Hard work!!
                sleep(1);

                if ($number > 4000) {
                    $success += 1;
                    $this->send_msg($i, 'Sikeres   | id:' . $id . '|   küldés a ' . $number . '@mail.hu címre', $progress);
                } else {
                    $fail += 1;
                    $this->send_msg($i, 'Sikertelen   | id: ' . $id . '|   küldés a ' . $number . '@mail.hu címre', $progress);
                }
            }

            sleep(1);


            // adatok beírása a stats_newsletters táblába
            $data['sent_date'] = date('Y-m-d-G:i');
            $data['newsletter_id'] = $id;
            $data['recepients'] = $success + $fail;
            $data['send_success'] = $success;
            $data['send_fail'] = $fail;

  /*          $this->query->reset();
            $this->query->set_table(array('stats_newsletters'));
            $this->query->insert($data);
*/

            //utolsó válasz
            $this->send_msg('CLOSE', '<br />Sikeres küldések száma: ' . $success . '<br />' . 'Sikertelen küldések száma: ' . $fail . '<br />', $progress);
        } // debug vége
        else {
            $error = array();
            $success = array();

            // id megadása	
            $x = Session::get('newsletter_id');
            $newsletter_id = (isset($x)) ? $x : null;
            //$newsletter_id = (int)$_POST['newsletter_id'];


            $data['newsletter_id'] = $newsletter_id;
            $data['sent_date'] = time();
            $data['error'] = 1;

            $this->query->reset();
            $this->query->set_table(array('stats_newsletters'));
            $result = $this->query->insert($data);

            $this->query->reset();
            $this->query->set_table(array('stats_newsletters'));
            $this->query->set_columns('statid');
            $this->query->set_orderby('statid', 'DESC');
            $this->query->set_limit(1);
            $result = $this->query->select();

            $statid = (int) $result[0]['statid'];


            // elküldendő hírlevél eleminek lekérdezése	
            $newsletter_temp = $this->newsletter_query((int) $newsletter_id);
            // e-mail címek, és hozzájuk tartozó user nevek (akiknek küldeni kell)
            $email_temp = $this->user_email_query();

            foreach ($newsletter_temp as $value) {
                $subject = $value['newsletter_subject'];
                $body = $value['newsletter_body'];
            }

            $body_temp = $body;

            foreach ($email_temp as $value) {
                $user_emails[] = $value['user_email'];
                $user_names[] = $value['user_name'];
                $user_ids[] = $value['user_id'];
                $user_unsubs[] = $value['user_unsubscribe_code'];
            }

            //az összes email_cím száma
            $all_email_address = count($user_emails);


            /* ----- Email-ek küldése ------- */

            // küldés simple mail-el történjen
            $simple_mail = false;

            // küldés simple mail-el
            if ($simple_mail === true) {
                // Email kezelő osztály behívása
                include(LIBS . '/simple_mail_class.php');

                // Létrehozzuk a SimpleMail objektumot
                $mail = new SimpleMail();

                //a ciklusok számát fogja számolni (vagyis hogy éppen mennyi emailt küldött el)	
                $progress_counter = 0;

                foreach ($user_emails as $key => $mail_address) {

                    $body = $body_temp;
                    //Since the tracking URL is a bit long, I usually put it in a variable of it's own
                    $tracker_url = BASE_URL . 'track_open/' . $user_ids[$key] . '/' . $statid;

                    //Add the tracker to the message.
                    $tracker = '<img alt="" src="' . $tracker_url . '" width="1" height="1" border="0" />';
                    $unsubscribe_url = BASE_URL . 'leiratkozas/' . $user_ids[$key] . '/' . $user_unsubs[$key] . '/' . $statid;
                    $unsubscribe = '<p>Leiratkozáshoz kattintson a következő linkre: <a href="' . $unsubscribe_url . '">Leiratkozás</a></p>';

                    $body = $this->replace_links($body, $user_ids[$key], $statid);

                    $body = str_replace('{$name}', $user_names[$key], $body);
                    $body = str_replace('{$unsubscribe}', $unsubscribe, $body);
                    $body = str_replace('</body>', $tracker . '</body>', $body);
                    $body = str_replace('{$subject}', $subject, $body);
                    $body = str_replace('{$email}', $mail_address, $body);
                    $body = str_replace('{$date}', date("Y-m-d"), $body);



                    $progress_counter += 1;
                    //küldés állapota %-ban
                    $progress = round(($progress_counter / $all_email_address) * 100);

                    $mail->setTo($mail_address, $user_names[$key])
                            ->setSubject($subject)
                            ->setFrom('info@freyaszalon.hu', 'Freyaszalon')
                            ->addMailHeader('Reply-To', 'info@freyaszalon.hu', 'Freyaszalon')
                            ->addGenericHeader('MIME-Version', '1.0')
                            ->addGenericHeader('Content-Type', 'text/html; charset="utf-8"')
                            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
                            ->setMessage($body)
                            ->setWrap(78);

                    // final sending and check
                    if ($mail->send()) {
                        $success[] = $mail_address;

                        //üzenet küldése	
                        $this->send_msg($progress_counter, 'Sikeres küldés a ' . $mail_address . ' címre', $progress);
                    } else {
                        $error[] = $mail_address;
                        //üzenet küldése				
                        $this->send_msg($progress_counter, 'Sikertelen küldés a ' . $mail_address . ' címre', $progress);
                    }

                    $mail->reset();
                }
            } else {
                // küldés PHPMailer-el
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

                //email-ek elküldés ciklussal
                foreach ($user_emails as $key => $mail_address) {

                    $body = $body_temp;
                    //Since the tracking URL is a bit long, I usually put it in a variable of it's own
                    $tracker_url = BASE_URL . 'track_open/' . $user_ids[$key] . '/' . $statid;

                    //Add the tracker to the message.
                    $tracker = '<img alt="" src="' . $tracker_url . '" width="1" height="1" border="0" />';
                    $unsubscribe_url = BASE_URL . 'leiratkozas/' . $user_ids[$key] . '/' . $user_unsubs[$key] . '/' . $statid;
                    $unsubscribe = '<p>Leiratkozáshoz kattintson a következő linkre: <a href="' . $unsubscribe_url . '">Leiratkozás</a></p>';

                    $body = $this->replace_links($body, $user_ids[$key], $statid);

                    $body = str_replace('{$name}', $user_names[$key], $body);
                    $body = str_replace('{$unsubscribe}', $unsubscribe, $body);
                    $body = str_replace('</body>', $tracker . '</body>', $body);
                    $body = str_replace('{$subject}', $subject, $body);
                    $body = str_replace('{$email}', $mail_address, $body);
                    $body = str_replace('{$date}', date("Y-m-d"), $body);


                    $progress_counter += 1;
                    //küldés állapota %-ban
                    $progress = round(($progress_counter / $all_email_address) * 100);

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
                        $this->insert_email_log($mail_address, 0, '', $statid);
                        $this->send_msg($progress_counter, 'Sikeres küldés a ' . $mail_address . ' címre', $progress);
                    } else {
                        $error[] = $mail_address;
                        $this->insert_email_log($mail_address, 1, $mail->ErrorInfo, $statid);
                        Message::log($mail->ErrorInfo);
                        $this->send_msg($progress_counter, 'Hiba: ' . $mail->ErrorInfo, $progress);
                        $this->send_msg($progress_counter, 'Sikertelen küldés a ' . $mail_address . ' címre', $progress);
                    }

                    $mail->clearAddresses();
                    $mail->clearAttachments();
                }
            }

            // adatbázisba írjuk az elküldés dátumát
            
                // az adatbázisban módosítjuk az utolsó küldés mező tartalmát
                $lastsent_date = date('Y-m-d-G:i');
                $this->query->reset();
                $this->query->set_table(array('newsletters'));
                $this->query->set_where('newsletter_id', '=', $newsletter_id);
                $this->query->update(array('newsletter_lastsent_date' => $lastsent_date));
            
            // adatok beírása a stats_newsletters táblába
            $data['recepients'] = count($success) + count($error);
            $data['send_success'] = count($success);
            $data['send_fail'] = count($error);
            $data['error'] = 0;

            $this->query->reset();
            $this->query->set_table(array('stats_newsletters'));
            $this->query->set_where('statid', '=', $statid);
            $result = $this->query->update($data);

            // utolsó válasz		
            $this->send_msg('CLOSE', '<br />Sikeres küldések száma: ' . count($success) . '<br />' . 'Sikertelen küldések száma: ' . count($fail) . '<br />', $progress);
        } // email küldés vége
    }

    /**
     * 	Visszaadja a newsletter_stats tábla tartalmát
     * 	
     *
     * 	@param 
     */
    public function newsletter_stats_query($newsletter_id = false) {
        $this->query->reset();
        $this->query->set_table('stats_newsletters');
        $this->query->set_columns(array('statid', 'stats_newsletters.newsletter_id', 'sent_date', 'recepients', 'send_success', 'send_fail', 'email_opens', 'unique_email_opens', 'email_clicks', 'unique_email_clicks', 'unsubscribe_count', 'error', 'newsletters.newsletter_name', 'newsletters.newsletter_subject'));

        $this->query->set_join('left', 'newsletters', 'stats_newsletters.newsletter_id', '=', 'newsletters.newsletter_id');
        if ($newsletter_id) {
            $this->query->set_where('statid', '=', $newsletter_id);
        }
        $this->query->set_orderby('statid', 'DESC');
        $result = $this->query->select();


        return $result;
    }

    /**
     * 	Hírlevél sablon törlése 
     *
     */
    public function delete_template() {
        // a sikeres törlések számát tárolja
        $success_counter = 0;
        // a sikertelen törlések számát tárolja
        $fail_counter = 0;

        // Több user törlése
        if (isset($_POST['delete_template'])) {
            $data_arr = $_POST;

            //eltávolítjuk a tömbből a felesleges elemeket	
            if (isset($data_arr['delete_template'])) {
                unset($data_arr['delete_template']);
            }
            if (isset($data_arr['template_table_length'])) {
                unset($data_arr['template_table_length']);
            }
        } else {
            // egy user törlése (nem POST adatok alapján)
            if (!isset($this->registry->params['id'])) {
                throw new Exception('Nincs id-t tartalmazo parameter az url-ben (ezert nem tudunk torolni id alapjan)!');
                return false;
            }
            //berakjuk a $data_arr tömbbe a törlendő felhasználó id-jét
            $data_arr = array($this->registry->params['id']);
        }

        // bejárjuk a $data_arr tömböt és minden elemen végrehajtjuk a törlést
        foreach ($data_arr as $value) {
            //átalakítjuk a integer-ré a kapott adatot
            $value = (int) $value;

            //felhasználó törlése	
            $this->query->reset();
            $this->query->set_table(array('email_templates'));
            //a delete() metódus integert (lehet 0 is) vagy false-ot ad vissza
            $result = $this->query->delete('template_id', '=', $value);

            if ($result !== false) {
                // ha a törlési sql parancsban nincs hiba
                if ($result > 0) {
                    //sikeres törlés
                    $success_counter += $result;
                } else {
                    //sikertelen törlés
                    $fail_counter += 1;
                }
            } else {
                // ha a törlési sql parancsban hiba van
                throw new Exception('Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!');
                return false;
            }
        }

        // üzenetek eltárolása
        if ($success_counter > 0) {
            Message::set('success', $success_counter . ' ' . 'sablon törlése sikerült!');
        }
        if ($fail_counter > 0) {
            Message::set('error', $fail_counter . ' ' . 'sablon törlése nem sikerült!');
        }

        // default visszatérési érték (akkor tér vissza false-al ha hibás az sql parancs)	
        return true;
    }

    /**
     * 	Hírlevél sablon törlése AJAX-szal
     *
     */
    public function delete_template_AJAX() {
        // a sikeres törlések számát tárolja
        $success_counter = 0;
        // a sikertelen törlések számát tárolja
        $fail_counter = 0;

        // Több template törlése
        if (isset($_POST['template_id'])) {
            $data_arr = $_POST;

            //eltávolítjuk a tömbből a felesleges elemeket	
            if (isset($data_arr['delete_template'])) {
                unset($data_arr['delete_template']);
            }
            if (isset($data_arr['template_table_length'])) {
                unset($data_arr['template_table_length']);
            }
        } else {
            return false;
        }

        // bejárjuk a $data_arr tömböt és minden elemen végrehajtjuk a törlést
        foreach ($data_arr as $value) {
            //átalakítjuk a integer-ré a kapott adatot
            $value = (int) $value;

            //felhasználó törlése	
            $this->query->reset();
            $this->query->set_table(array('email_templates'));
            //a delete() metódus integert (lehet 0 is) vagy false-ot ad vissza
            $result = $this->query->delete('template_id', '=', $value);

            if ($result !== false) {
                // ha a törlési sql parancsban nincs hiba
                if ($result > 0) {
                    //sikeres törlés
                    $success_counter += $result;
                } else {
                    //sikertelen törlés
                    $fail_counter += 1;
                }
            } else {
                // ha a törlési sql parancsban hiba van
                throw new Exception('Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!');
                return false;
            }
        }

        // üzenetek eltárolása
        if ($success_counter > 0) {
            $response = array(
                "status" => 'success',
                "message" => 'Hírlevél sablon törölve.'
            );
            return json_encode($response);
        }
        if ($fail_counter > 0) {
            $response = array(
                "status" => 'error',
                "message" => 'Hírlevél sablon törlése nem sikerült!'
            );
            return json_encode($response);
        }

        // default visszatérési érték (akkor tér vissza false-al ha hibás az sql parancs)	
        return true;
    }

    /**
     * 	Új hírlevél sablon létrehozása
     * 	
     * 	@return boolean - true: ha sikeres, false, ha nem 
     */
    public function new_template() {
        $data['name'] = $_POST['template_name'];
        $data['description'] = $_POST['template_description'];
        $data['html_body'] = $_POST['template_body'];
        $data['create_date'] = date('Y-m-d-G:i');

        $this->query->reset();
        $this->query->set_table(array('email_templates'));
        $result = $this->query->insert($data);

        // ha sikeres az insert visszatérési érték true
        if ($result) {
            Message::set('success', 'Új sablon hozzáadva!');
            return true;
        } else {
            Message::set('error', 'Hiba történt!');
            return false;
        }
    }

    /**
     * 	Hírlevél sablon szerkesztése
     * 
     * 	@param  integer $id a szerkesztendő sablon id-je 
     * 	@return boolean - true: ha sikeres, false, ha nem 
     */
    public function edit_template($id) {
        $id = (int) $id;

        $data['name'] = $_POST['template_name'];
        $data['description'] = $_POST['template_description'];
        $data['html_body'] = $_POST['template_body'];

        $this->query->reset();
        $this->query->set_table(array('email_templates'));
        $this->query->set_where('template_id', '=', $id);
        $result = $this->query->update($data);

        // ha sikeres az insert visszatérési érték true
        if ($result) {
            Message::set('success', 'Sablon módosítva!');
            return true;
        } else {
            Message::set('error', 'Hiba történt!');
            return false;
        }
    }

    /**
     * 	Hírlevél sablon betöltése
     * 
     * 	@param  integer $id a szerkesztendő sablon id-je 
     * 	@return boolean - true: ha sikeres, false, ha nem 
     */
    public function load_template_AJAX() {

        $id = (int) $_POST['template_id'];

        $this->query->reset();
        $this->query->set_table(array('email_templates'));
        $this->query->set_columns(array('html_body'));
        $this->query->set_where('template_id', '=', $id);
        $result = $this->query->select();

        return $result[0]['html_body'];
    }

    /**
     * 	Hírlevél sablon lista betöltése
     * 
     * 	@return array 
     */
    public function load_template_list() {

        $this->query->reset();
        $this->query->set_table(array('email_templates'));
        $this->query->set_columns('*');
        $result = $this->query->select();

        return $result;
    }

    /**
     * 	Hírlevél teszt küldése 
     * 
     * 	@return array 
     */
    public function send_test_email() {

        $id = (int) $_POST['newsletter_id'];
        $email = $_POST['email'];


        $this->query->reset();
        $this->query->set_table(array('newsletters'));
        $this->query->set_columns(array('newsletter_subject', 'newsletter_body'));
        $this->query->set_where('newsletter_id', '=', $id);
        $result = $this->query->select();


        Util::send_newsletter_test_mail($email, $result[0]['newsletter_subject'], $result[0]['newsletter_body']);
        exit();
    }

    /**
     * 	Linkek kicserélése az email template-ben tracking linkre 
     * 
     * 	@return array 
     */
    public function replace_links($body, $user_id, $newsletter_id) {

        $reallink = BASE_URL . 'track_link?';

        $matches = array();
        $templinkid = 1;

        //	$basehref = $this->_GetBaseHref();

        preg_match_all('%<a.+(href\s*=\s*(["\']?[^>"\']+?))\s*.+>%isU', $body, $matches);
        $links_to_replace = $matches[2];
        $link_locations = $matches[1];

        arsort($link_locations);
        reset($links_to_replace);
        reset($link_locations);

//        echo '$link_locations<br>';
//        var_dump($link_locations);

        foreach ($link_locations as $tlinkid => $url) {

            //         echo 'ez az url: ' . $url . '<br>';
            // so we know whether we need to put quotes around the replaced url or not.
            $singles = false;
            $doubles = false;

            // make sure the quotes are matched up.
            // ie there is either 2 singles or 2 doubles.
            $quote_check = substr_count($url, "'");
            if (($quote_check % 2) != 0) {
                $url .= "'";
                $singles = true;
            }

            $quote_check = substr_count($url, '"');
            if (($quote_check % 2) != 0) {
                $url .= '"';
                $doubles = true;
            }

            // Ignore Mail Link
            if (preg_match('%^href\s*?=\s*?["|\']mailto%i', $url)) {
                continue;
            }

            $string = "~" . rtrim(preg_quote(BASE_URL), '/') . "~";
//            echo "string: " . $string . '<br>';

            if (!preg_match($string, $url)) {
                continue;
            }
            /*
              // Ignore Web Version Link
              if (preg_match('~^href\s*?=\s*?["|\'](http://)*?(%%webversion%%/*?)["|\']$~i', $url)) {
              continue;
              }
             */

            /*


              // facebook, twitter és linkedin url-ek kiszűrése
              if (preg_match("~/(facebook\.com|www\.facebook\.com|twitter\.com|www\.twitter\.com|www\.linkedin\.com|linkedin\.com)~", $url)) {
              echo 'nem url:' . $url . '<br>';
              continue;
              }
             */
            // if there is a "#" as the first or second char, ignore it. Could be second if it is quoted: '#' or "#"
            $check = str_replace('href=', '', $url);
            if ($check{0} == '#' || $check{1} == '#') {
                continue;
            }



            $check = str_replace(array('"', "'"), '', $check);
            if ($check == '') {
                continue;
            }



            $origurl = $url;

            $url = str_replace('href=', '', $url);

            if ($singles) {
                $url = str_replace("'", '', $url);
            }

            if ($doubles) {
                $url = str_replace('"', '', $url);
            }
            // link elmentése az email_links táblába

            $data['link_url'] = $url;
            //           echo 'link:<br>';
            //           var_dump($url);
            // megnézzüük, hogy az url szerepel-e már az email_links táblában
            $this->query->reset();
            $this->query->set_table(array('email_links'));
            $this->query->set_columns('link_id');
            $this->query->set_where('link_url', '=', $url);
            $result = $this->query->select();
            //ha már van ilyen klink az adatbázisban
            if ($result) {
                $link_id = (int) $result[0]['link_id'];
            }
            // ha nem szerepel az adatbázisban, akkor beírjuk 
            if (!$result) {
                $this->query->reset();
                $this->query->set_table(array('email_links'));
                $result = $this->query->insert($data);
                //az új rekord id-jét adja vissza
                $link_id = (int) $result;
            }

            $newlink = 'href=';
            if ($singles) {
                $newlink .= "'";
            }
            if ($doubles) {
                $newlink .= '"';
            }

            $newlink .= $reallink . 'link=' . $link_id . '&u=' . $user_id . '&n=' . $newsletter_id;

            if ($singles) {
                $newlink .= "'";
            }
            if ($doubles) {
                $newlink .= '"';
            }
            $body = str_replace($origurl, $newlink, $body);
        }
        return $body;
    }

    /**
     * Megnyitások lekérdezése
     * 	
     * @param 	int 	$id	ajánlat id-je
     * @return 	string 	üzenet
     */
    public function get_email_opens($newsletter_id) {
        $this->query->reset();
        $this->query->set_table(array('stats_emailopens'));
        $this->query->set_columns('open_time');
        $this->query->set_where('campaign_id', '=', $newsletter_id);
        $this->query->set_orderby('open_time', 'ASC');
        $result = $this->query->select();
        return $result;
    }

    /**
     * Kattintások lekérdezése
     * 	
     * @param 	int 	$id	ajánlat id-je
     * @return 	string 	üzenet
     */
    public function get_email_clicks($newsletter_id) {
        $this->query->reset();
        $this->query->set_table(array('stats_emailclicks'));
        $this->query->set_columns('click_time');
        $this->query->set_where('campaign_id', '=', $newsletter_id);
        $this->query->set_orderby('click_time', 'ASC');
        $result = $this->query->select();
        return $result;
    }

    /**
     * 	Email log insert
     */
    public function insert_email_log($email, $error, $error_message, $campaign_id) {
        $data = array(
            'email' => $email,
            'error' => $error,
            'error_message' => $error_message,
            'campaign_id' => $campaign_id
        );

        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('emails_sent'));
        $this->query->insert($data);
    }

}

?>