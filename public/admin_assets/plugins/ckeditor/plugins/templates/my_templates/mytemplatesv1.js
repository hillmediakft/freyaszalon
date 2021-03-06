/*
 Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
CKEDITOR.addTemplates("default",
{
	imagesPath:CKEDITOR.getUrl(CKEDITOR.plugins.getPath("templates")+"my_templates/images/"),
	
	templates:
		[
			                      
        {
        title:"Szöveg dobozban",
	image:"well.jpg",
	description:"Szöveg dobozban",
	html: '<div class="well">Nullam tincidunt gravida erat, vel faucibus ligula luctus a.</div>'
        },
        
        {
        title:"Idézet dobozban",
	image:"blockquote.jpg",
	description:"Idézett szöveg kiemelése nagyobb méretben",
	html: '<blockquote>Lorem ipsum dolor sit amet, consectetur elit mauris sed sem purus nunc eros congue.</blockquote>'
        },        

{
        title:"Lista elem",
	image:"list_with_arrow.jpg",
	description:"Nyíllall ellátott lista",
	html: '<ul class="list-type1-small flaticon-eye8"><li>Lorem ipsus lures</li><li>Lorem ipsus lures</li><li>Lorem ipsus lures</li><li>Lorem ipsus lures</li><li>Lorem ipsus lures</li><li>Lorem ipsus lures</li></ul>'
        },          

{
        title:"Gomb linkkel",
	image:"button_with_link.jpg",
	description:"Linket tartalmazó gomb",
	html: '<div class="martop20 marbot20"><a href="#" class="btn btn-type1 btn-sm">Tovább</a></div>'
        },          
       
{
        title:"Link",
	image:"link_with_arrow.jpg",
	description:"Egyszerű link nyíllal",
	html: '<p class="martop15 marbot20"><a href="#"><i class="fa fa-arrow-right"></i> További információ</a></p>'
        },    
        
{
        title:"Kép szöveggel",
	image:"text_with_image.jpg",
	description:"Szöveg megjelenítése képpel",
	html: '<div class="row"><div class="clearfix marbot20"><div class="col-md-8 col-sm-12"><div class="clearfix"><h3>Lorem ipsum</h3><p class="fontresize marbot30"> Lorem ipsum dolor sit amet, consectetur elit mauris sed sem purus nunc eros congue. Lorem ipsum dolor sit amet, consectetur elit mauris sed sem purus nunc eros congue.</p></div></div><div class="col-md-4 col-sm-12"><div class="grid image-effect2 marbot30"><figure><img src="http://placehold.it/800x600" alt=" " class="img-responsive fullwidth"></figure></div></div></div></div>'
        },   
{
        title:"Táblázat",
	image:"table.jpg",
	description:"Táblázat",
	html: '<table class="table table-striped table-responsive<thead><tr><th>Lorem ipsum</th><th>lepere icuets</th></tr></thead><tbody><tr><td>Lorem ipsum</td><td>lepere icuets</td></tr><tr><td>Lorem ipsum</td><td>lepere icuets</td></tr><tr><td>Lorem ipsum</td><td>lepere icuets</td></tr><tr><td>Lorem ipsum</td><td>lepere icuets</td></tr><tr><td>Lorem ipsum</td><td>lepere icuets</td></tr></tbody></table>'
        }         
		]
});