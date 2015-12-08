<?php
class Formulario
{

    public function addField($nome,$text,$size,$object)
    {
        $vbox = new GtkVBox;
        //$vbox->set_border_width(10);
        $vbox->add($vbox);
        
        $hbox = new GtkHBox;
        $label = new GtkLabel($text);
        
        $label->set_size_request(140, -1);
        $hbox->pack_start($label,false,false);
        $hbox->pack_start($object,false,false);
        $hbox->set_size_request($size, -1);
        
        
        $vbox->pack_start($hbox,false,false);
        
    
    }
    
   public function addAction()
    {
        $hbox = new GtkHBox;
        $vbox = new GtkVBox;
        
        $label = new GtkLabel($text);
        $label->set_size_request(140, -1);
        $hbox->pack_start($label,false,false);
        $hbox->pack_start($object,false,false);
        $hbox->set_size_request($size, -1);
        
        
        $vbox->pack_start($hbox,false,false);
        
    }
    public function addTollbar(){
    
        //Create a new toolbar widget
        $tb = new GtkToolbar();
        //Let the toolbar take the space it needs
        $tb->set_show_arrow(false);
         
        //"New" toolbar button with stock icon
        $new    = GtkToolButton::new_from_stock(Gtk::STOCK_NEW);
        //Connect the "clicked" signal so we know when the user
        // clicks the button
        $new->connect_simple('clicked', 'onClickedToolButton', 'new');
        //Append the button to the toolbar (-1 means end of the toolbar)
        $tb->insert($new, -1);
         
        //Add another button, "open"
        $open   = GtkToolButton::new_from_stock(Gtk::STOCK_OPEN);
        $open->connect_simple('clicked', 'onClickedToolButton', 'open');
        $tb->insert($open, -1);
         
        //Separate new/open from save/saveas
        $tb->insert(new GtkSeparatorToolItem(), -1);
         
        //And a third one
        $save   = GtkToolButton::new_from_stock(Gtk::STOCK_SAVE);
        $save->connect_simple('clicked', 'onClickedToolButton', 'save');
        $tb->insert($save, -1);
         
        //The last one
        $saveas = GtkToolButton::new_from_stock(Gtk::STOCK_SAVE_AS);
        $saveas->connect_simple('clicked', 'onClickedToolButton', 'saveas');
        $tb->insert($saveas, -1);
        $window = new GtkWindow;
        $window->add($tb);
        }

}