<?php

/**
 * Routes
 * 
 * További lehetséges URL minták:
 * 
 * hirek/2014/10/22/ez-egy-hir-cime (opcionális / jel)
 * 'hirek/:year/:month/:day/:title/?' => array('news/get_news_by_id', 'year', 'month', 'day', 'title')
 * 
 * felhasznalok/kereses/param1/val1/param2/val2 (opcionális / jel)
 * 'felhasznalok/kereses/:any/:any/:any/:any/?' => array('users/search')
 *
 * felhasznalok/barmi (opcionális /)
 * 'felhasznalok/:any/?' => array('users/index', 'status'),
 * 
 */
$routes = array(
    '(send_email)/(init)/:title/?' => array('send_email/init', 'type'),
    //leratkozas hirlevelről
    '(leiratkozas)/:id/:hash/:id/?' => array('$1', 'user_id', 'newsletter_unsubscribe_code', 'newsletter_id'),
    //felhasználó regisztráció
    '(feliratkozas)/(ellenorzes)/:id/:hash/?' => array('$1/$2', 'user_id', 'user_activation_verification_code'),
    //email megnyitás követés (track email open)
    '(track_open)/:id/:id/?' => array('$1', 'user_id', 'newsletter_id'),
    '(akciok)/:title/:id/?' => array('akciok/reszletek', 'id'),
    '(hirek)/(kategoria)/:id/?' => array('hirek/kategoria', 'id'),
    '(hirek)/:title/:id/?' => array('hirek/reszletek', 'id'),
    '(hirek)/?' => array('$1'),
    '(munkatars)/:title/:id?' => array('csapatunk/munkatars', 'id'),
    '(szolgaltatasok)/(kategoria)/:title/?' => array('szolgaltatasok/szolgaltatas_kategoria', 'category'),
    '(szolgaltatasok)/:title/:title/?' => array('szolgaltatasok/szolgaltatas', 'title'),
    // /controller/action/param1/val1/param2/val2 (opcionális / jel)
    ':controller/:action/:any/:any/:any/:any/?' => array('$1/$2'),
    // /controller/action/param1/val1 (opcionális / jel)
    ':controller/:action/:any/:any/?' => array('$1/$2'),
    ':controller/:action/:id/:any/:any/?' => array('$1/$2', 'id'),
    // /controller/action/id (opcionális / jel)
    ':controller/:action/:id/?' => array('$1/$2', 'id'),
    // /controller/action/valami (opcionális / jel)
    ':controller/:action/:any/?' => array('$1/$2', 'id'),
    // /controller/action (opcionális /)
    ':controller/:action/?' => array('$1/$2'),
    // /controller (opcionális / jel, "index" action)
    ':controller/?' => array('$1'),
    // base url	
    '' => array('home/index'),
    // nem létező oldal	
    '_error' => array('error/index')
);
?>