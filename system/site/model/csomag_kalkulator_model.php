<?php

class Csomag_kalkulator_model extends Site_model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * A csomag lekérdezése
     *
     * @return string a csomag html kódként
     */
    public function get_package() {
        $code = $_POST['gender'] . $_POST['weight_loss'] . $_POST['training'];

        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->reset();
        $this->query->set_table(array('offers'));
        $this->query->set_columns(array('package'));
        $this->query->set_where('code', '=', $code);
        $result = $this->query->select();
        $offer = $result[0]['package'];

        ob_start();
        include ("system/site/view/csomag_kalkulator/kontakt_form.php");
        $kontakt_form = ob_get_contents();
        ob_end_clean();

        if ($result) {
            $response = array(
                "status" => 'success',
                "offer" => $offer,
                "kontakt_form" => $kontakt_form,
                "code" => $code
            );
            echo json_encode($response);
        }
    }

}

?>