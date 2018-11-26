/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here.
    // For the complete reference:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config


    config.toolbar = [['Bold', 'Italic', '-', 'RemoveFormat', '-', 'BulletedList', 'NumberedList', '-', 'PasteText', '-', 'Undo', 'Redo', '-', 'Link', 'Unlink', 'SpecialChar', 'Styles', 'Format', '-', 'Source']];

    /*
     config.toolbar = [
     { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline' ] },
     { name: 'clipboard', items: [ 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
     { name: 'document', items: [ 'Source' ] },
     { name: 'styles', items: [ '' ] }
     ];
     */

// true: nem távolítja el a html, head és body tag-eket, false nem rak be html, head és body tag-eket
    config.fullPage = false;
// szöveg bemásolásakor csak paraagrafusok és linkek maradnak meg
    config.pasteFilter = 'p; a[!href]';
    // Gombok eltávolítása az eszköztárból
    //config.removeButtons = 'Underline,Subscript,Superscript,Templates';
    config.removeButtons = 'Underline,Subscript,Superscript';
    // Youtube plug-in beépítése
//	config.extraPlugins = 'youtube';
    // minden html elem engedélyezése (nem távolít el semmit)
    config.allowedContent = true;
    // Az ékezetes és speciális karaktereket nem alakítja át html entity-vé
    config.htmlEncodeOutput = false;
    config.entities = false;
    config.basicEntities = false;
    // szövegeket, img tageket nem csomagol automatikusan <p> tagekbe
    config.autoParagraph = false;
    // engedélyezi az üres tageket
    config.fillEmptyBlocks = false;
    // nem távolítja el a <i ... </i> közé zárt tartalmat - font ikon megjelenítés
    config.protectedSource.push(/<i[^>]*><\/i>/g);
    // nem jeleníti meg egyáltalán a {} közötti tartalmat pl.: {$slider}
    config.protectedSource.push(/{[\s\S]*?}/g);
    // nem távolítja el az üres span tag-eket
    CKEDITOR.dtd.$removeEmpty['span'] = false;





    // Remove some buttons, provided by the standard plugins, which we don't
    // need to have in the Standard(s) toolbar.
//config.removeButtons = 'Underline,Subscript,Superscript' ;

    // Se the most common block elements.
//config.format_tags = 'p;h1;h2;h3;h4;pre';

    // Make dialogs simpler.
    config.removeDialogTabs = 'image:advanced;link:advanced';

    //az editor színét lehet beállítani:
//config.uiColor = '#01379B';

    // szélesség és magasság beállítása
    config.height = 300;
    // config.width = 700;

    //config.removePlugins = 'elementspath,save,font';
};
