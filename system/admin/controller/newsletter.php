<?php

class Newsletter extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->loadModel('newsletter_model');
    }

    public function index() {

        $this->view = new View();
        $this->view->title = 'Hírlevél oldal';
        $this->view->description = 'Hírlevél oldal description';

        $this->view->add_links(array('datatable', 'vframework', 'bootbox', 'select2', 'newsletter_eventsource'));

        $this->view->newsletters = $this->newsletter_model->newsletter_query();

//$this->view->debug(true);	
        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_newsletter');
    }

    public function new_newsletter() {
        if ($this->request->has_post('submit_new_newsletter')) {
            $this->newsletter_model->new_newsletter();
            Util::redirect('newsletter');
        }
        $this->view = new View();
        $this->view->title = 'Hírlevél hozzáadása';
        $this->view->description = 'Hírlevél oldal description';

        $this->view->add_links(array('ckeditor', 'new_newsletter'));

        $this->view->ckeditor = true;
        $this->view->template_list = $this->newsletter_model->load_template_list();

        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_new_newsletter');
    }

    public function edit_newsletter() {
        if ($this->request->has_post('submit_edit_newsletter')) {
            $this->newsletter_model->edit_newsletter($this->request->get_params('id'));
            Util::redirect('newsletter');
        }
        $this->view = new View();
        $this->view->title = 'Hírlevél szerkesztése';
        $this->view->description = 'Hírlevél oldal description';

        $this->view->add_links(array('ckeditor', 'edit_newsletter'));

        $this->view->newsletter = $this->newsletter_model->newsletter_query($this->request->get_params('id'));


        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_edit_newsletter');
    }

    public function delete_newsletter() {
        if (Util::is_ajax()) {
            $this->newsletter_model->delete_newsletter_AJAX();
        }
   //     Util::redirect('newsletter');
    }

    /**
     * 	Hírlevél törlése AJAX-al
     * 	Az echo $result megy vissza a javascriptnek
     */
    public function delete_template_AJAX() {

        if (Util::is_ajax()) {
            $result = $this->newsletter_model->delete_template_AJAX();
            echo $result;
        }
    }

    /**
     * 	Hírlevél csoportos törlése
     * 	
     */
    public function delete_template() {
        $this->newsletter_model->delete_template();
        Util::redirect('newsletter/templates');
    }

    /**
     * 	Hírlevél id session változóba írása
     */
    public function setid() {
        if (isset($_POST['newsletter_id'])) {
            Session::set('newsletter_id', (int) $this->request->get_post('newsletter_id'));
            echo json_encode(array('status' => 'done'));
        } else {
            echo json_encode(array('status' => 'fail'));
        }
    }

    public function setid_2() {
        if (isset($_POST['newsletter_id'])) {
            echo json_encode(array('status' => 'letezik POST newsletter_id: ' . $this->request->get_post('newsletter_id')));
        } else {
            echo json_encode(array('status' => 'NEM letezik POST newsletter_id: ' . $this->request->get_post('newsletter_id')));
        }
    }

    /* --------- EVENTSOURCE -------------------- */

    public function send_newsletter() {
        header('Content-Type: text/event-stream');
        // recommended to prevent caching of event data.
        header('Cache-Control: no-cache');
        // Setting this header instructs Nginx to disable fastcgi_buffering and disable
        // gzip for this request.
        header('X-Accel-Buffering: no');

        set_time_limit(0);
        // ob_implicit_flush(true);

        $this->newsletter_model->send_newsletter();
    }

    /* --------- EVENTSOURCE END-------------------- */

    public function newsletter_stats() {


        $this->view = new View();
        $this->view->title = 'Elküldött hírlevelek oldal';
        $this->view->description = 'Elküldött hírlevél oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'select2', 'newsletter_stats'));


        $this->view->newsletters = $this->newsletter_model->newsletter_stats_query();


        //$this->view->debug(true);	
        $this->view->set_layout('tpl_layout');
        $this->view->render('newsletter/tpl_newsletter_stats');
    }

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