<?php

class feliratkozas_model extends Site_model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * 	új felhasználó regisztrálása a site_users táblába
     * 	(hírlevélre feliratkozás!!)
     */
    public function register_user() {
        $error_counter = 0;

        // User név ellenőrzés
        if (empty($_POST['name'])) {
            Message::set('error', 'A név nem lehet üres!');

            $error_counter += 1;
        }
        if (strlen($_POST['name']) > 64 OR strlen($_POST['name']) < 2) {
            Message::set('error', 'A felhasználónév 2-64 karakter hosszú lehet!');
            $error_counter += 1;
        }
        /* 		if (!preg_match('/^[a-záöőüűóúéíÁÖŐÜŰÓÚÉÍ\d]{2,64}$/i', $_POST['name'])) {
          $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN;
          $error_counter += 1;
          } */
        /* 		
          // Vezetéknév ellenőrzés
          if(empty($_POST['first_name'])) {
          $_SESSION["feedback_negative"][] = FEEDBACK_USERFIRSTNAME_FIELD_EMPTY;
          $error_counter += 1;
          }
          if (strlen($_POST['first_name']) > 64 OR strlen($_POST['first_name']) < 2) {
          $_SESSION["feedback_negative"][] = FEEDBACK_USERFIRSTNAME_TOO_SHORT_OR_TOO_LONG;
          $error_counter += 1;
          }
          if (!preg_match('/^[a-záöőüűóúéíÁÖŐÜŰÓÚÉÍ]{2,64}$/i', $_POST['first_name'])) {
          $_SESSION["feedback_negative"][] = FEEDBACK_USERFIRSTNAME_DOES_NOT_FIT_PATTERN;
          $error_counter += 1;
          }

          // Utónév ellenőrzés
          if(empty($_POST['last_name'])) {
          $_SESSION["feedback_negative"][] = FEEDBACK_USERLASTNAME_FIELD_EMPTY;
          $error_counter += 1;
          }
          if (strlen($_POST['last_name']) > 64 OR strlen($_POST['last_name']) < 2) {
          $_SESSION["feedback_negative"][] = FEEDBACK_USERLASTNAME_TOO_SHORT_OR_TOO_LONG;
          $error_counter += 1;
          }
          if (!preg_match('/^[a-záöőüűóúéíÁÖŐÜŰÓÚÉÍ]{2,64}$/i', $_POST['last_name'])) {
          $_SESSION["feedback_negative"][] = FEEDBACK_USERLASTNAME_DOES_NOT_FIT_PATTERN;
          $error_counter += 1;
          }

          // Jelszó ellenőrzés

          if (empty($_POST['password']) OR empty($_POST['password_again'])) {
          $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
          $error_counter += 1;
          }
          if (strlen($_POST['password']) < 6) {
          $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_TOO_SHORT;
          $error_counter += 1;
          }
          if ($_POST['password'] !== $_POST['password_again']) {
          $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_REPEAT_WRONG;
          $error_counter += 1;
          }
         */
        // E-mail ellenőrzés
        if (empty($_POST['email'])) {
            Message::set('error', 'Adja meg az email címét!');
            $error_counter += 1;
        }
        if (strlen($_POST['email']) > 64) {
            Message::set('error', 'Az email cím túl hosszú!');
            $error_counter += 1;
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            Message::set('error', 'Érvényes email címet adjon meg!');
            $error_counter += 1;
        }

        // végrehajtás, ha nincs hiba	
        if ($error_counter == 0) {

            // clean the input
            $user_name = $_POST['name'];
            //$first_name = htmlentities($_POST['first_name'], ENT_QUOTES, "UTF-8");
            //$last_name = htmlentities($_POST['last_name'], ENT_QUOTES, "UTF-8");
            $user_email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
            $user_newsletter = 1;
            //$img_url = htmlentities($_POST['img_url'], ENT_QUOTES, "UTF-8");
            // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character
            // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4,
            // by the password hashing compatibility library. the third parameter looks a little bit shitty, but that's
            // how those PHP 5.5 functions want the parameter: as an array with, currently only used with 'cost' => XX
            //$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
            //$user_password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
            // lekérdezzük, hogy létezik-e már ilyen felhasználói név 
            /*         $query = $this->connect->prepare("SELECT * FROM site_users WHERE user_name = :user_name");
              $query->execute(array(':user_name' => $user_name));
              $count = $query->rowCount();
              if ($count == 1) {
              Message::set('error', 'E megadott felhasználónév már foglalt!');
              return false;
              } */

            // lekérdezzük, hogy létezik-e már ilyen e-mail cím
            $query = $this->connect->prepare("SELECT user_id FROM site_users WHERE user_email = :user_email");
            $query->execute(array(':user_email' => $user_email));
            $count = $query->rowCount();
            if ($count == 1) {
                Message::set('error', 'E megadott email cím már foglalt!');
                return false;
            }

            // generálunk egy kódot ami majd a leiratkozáshoz kell (40 char string)
            $user_unsubscribe_code = sha1(uniqid(mt_rand(), true));

            // generate random hash for email verification (40 char string)
            $user_activation_hash = sha1(uniqid(mt_rand(), true));
            $user_active = 0;

            //felhasználó hatásköre
            $user_role_id = 1;

            // generate integer-timestamp for saving of account-creating date
            $user_creation_timestamp = time();

            // write new users data into database
            $sql = "INSERT INTO site_users (user_name, user_email, user_active, user_role_id, user_creation_timestamp, user_activation_hash, user_provider_type, user_newsletter, user_unsubscribe_code)
                    VALUES (:user_name, :user_email, :user_active, :user_role_id, :user_creation_timestamp, :user_activation_hash, :user_provider_type, :user_newsletter, :user_unsubscribe_code)";

            $query = $this->connect->prepare($sql);

            $query->execute(array(':user_name' => $user_name,
                ':user_email' => $user_email,
                ':user_active' => $user_active,
                ':user_role_id' => $user_role_id,
                ':user_creation_timestamp' => $user_creation_timestamp,
                ':user_activation_hash' => $user_activation_hash,
                ':user_provider_type' => 'DEFAULT',
                ':user_newsletter' => $user_newsletter,
                ':user_unsubscribe_code' => $user_unsubscribe_code
            ));
            $count = $query->rowCount();
            if ($count != 1) {
                Message::set('error', 'Nem sikerült a feliratkozás!');
                return false;
            }

            // get user_id of the user that has been created, to keep things clean we DON'T use lastInsertId() here
            $query = $this->connect->prepare("SELECT user_id FROM site_users WHERE user_email = :user_email");
            $query->execute(array(':user_email' => $user_email));
            if ($query->rowCount() != 1) {
                Message::set('error', 'Hiba történt!');
                return false;
            }


            // Ezután jön az ELLENÖRZŐ E-MAIL küldés 
            $result_user_row = $query->fetch(PDO::FETCH_OBJ);
            $user_id = $result_user_row->user_id;

            // send verification email, if verification email sending failed: instantly delete the user
            if ($this->sendVerificationEmail($user_name, $user_id, $user_email, $user_activation_hash)) {
                return true;
            } else {
                $query = $this->connect->prepare("DELETE FROM site_users WHERE user_id = :last_inserted_id");
                $query->execute(array(':last_inserted_id' => $user_id));
                Message::set('error', 'Hiba történt! Nem tudtuk a visszaigazoló emailt elküldeni !');
                return false;
            }
        } else {
            // ha valamilyen hiba volt a form adataiban
            return false;
        }
// $_SESSION["feedback_negative"][] = FEEDBACK_UNKNOWN_ERROR;
    }

    /**
     * sends an email to the provided email address
     * @param int $user_id user's id
     * @param string $user_email user's email
     * @param string $user_activation_hash user's mail verification hash string
     * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
     */
    private function sendVerificationEmail($user_name, $user_id, $user_email, $user_activation_hash) {
        // Email kezelő osztály behívása
        include(LIBS . '/simple_mail_class.php');

        // Létrehozzuk a SimpleMail objektumot
        $mail = new SimpleMail();
        $mail->setTo($user_email, 'Recipient 1')
                ->setSubject('Feliratkozás hírlevélre visszaigazolása')
                ->setFrom('info@freyaszalon.hu', 'Freya szalon')
                ->addMailHeader('Reply-To', 'info@freyaszalon.hu', 'Freya szalon')
                ->addGenericHeader('MIME-Version', '1.0')
                ->addGenericHeader('Content-Type', 'text/html; charset="utf-8"')
                ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
                ->setMessage('<html><body><h3>Kedves ' . $user_name . '!</h3><p>Ön a ' . $user_email . ' e-mail címmel feliratkozott a Freya Szalon hírlevelére. A feliratkozás akkor történik meg, ha az alábbi linkre kattint:</p><a href="' . BASE_URL . 'feliratkozas/ellenorzes/' . urlencode($user_id) . '/' . urlencode($user_activation_hash) . '">' . 'Visszaigazolás' . '</a></body></html>')
                ->setWrap(78);

        // final sending and check
        if ($mail->send()) {
            Message::set('success', 'Visszaigazoló email sikeresen elküldve! A feliratkozáshoz kattintson az emailben található linkre!');
            return true;
        } else {
            Message::set('error', 'A visszaigazoló emailt nem sikerült elküldeni!');
            return false;
        }
    }

    /**
     * checks the email/verification code combination and set the user's activation status to true in the database
     * @param int $user_id user id
     * @param string $user_activation_verification_code verification token
     * @return bool success status
     */
    public function verifyNewUser($user_id, $user_activation_verification_code) {

        $data['user_active'] = 1;
        $data['user_activation_hash'] = null;

        $this->query->set_table(array('site_users'));
        $this->query->set_where('user_id', '=', $user_id);
        $this->query->set_where('user_activation_hash', '=', $user_activation_verification_code);
        $result = $this->query->update($data);

        if ($result) {
            Message::set('success', 'Sikeres aktiválás!');
            return true;
        } else {
            Message::set('error', 'Az aktiválás nem sikerült!');
            return false;
        }
    }

}

?>