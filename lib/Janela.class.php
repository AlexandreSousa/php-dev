<?php
class Janela extends GtkWindow
{
    private $vbox;
    protected $bufferr;     // the corresponding text buffer
    protected $gtksource; // sourceview
    protected $clipboard;  // clipboard
    protected $filename;   // filename
	protected $vieww;       // buffer
    function __construct($w,$h)
    {
        parent::__construct();
        parent::set_size_request($w,$h);
        parent::set_position(Gtk::WIN_POS_CENTER);
        parent::set_title('Editor');
        
        
         $this->vbox = new GtkVBox;
         $this->vbox->set_border_width(3);
         parent::add($this->vbox);
        
    }
    
    public function addPanel()
    {
        $hbox = new GtkHBox;
    
        $vbox = new GtkVBox;
        $vpane = new GtkHPaned();
        $vpane->set_border_width(5);
         
        $left = new GtkFrame();
        $left->add(new GtkLabel('Left'));
        $left->set_size_request(200, -1);
        $left->set_shadow_type(Gtk::SHADOW_IN);
        
        
        $vpane->add1($left);
         
        $right = new GtkFrame();
        $edit = new GtkScrolledWindow;
        $edit->set_policy(Gtk::POLICY_AUTOMATIC, Gtk::POLICY_AUTOMATIC);
        $edit->set_border_width(1);
        //CRIANDO AQUI O EDITOR
        $this->buffer = new GtkSourceBuffer();
        $gtksource = new GtkSourceView;
        $lang_m = new GtkSourceLanguagesManager();
        $lang = $lang_m->get_language_from_mime_type("application/x-php");
        $this->gtksourcebufferl = $this->buffer->new_with_language($lang);
        $bufferr = $this->gtksourcebufferl;
        $this->gtksource = $gtksource->new_with_buffer($bufferr); 
        $vieww = $this->gtksource;
        $bufferr->set_text('<?php 
        ');
        $vieww->set_show_line_numbers(1);
        $vieww->set_auto_indent(1);
        $bufferr->set_highlight(1);
        $bufferr->set_check_brackets(1);
        $this->view = $vieww;
        $this->filename = '';
        $this->set_title();
        $this->clipboard = new GtkClipboard($this->view->get_display(), Gdk::atom_intern('CLIPBOARD'));
        $edit->add_with_viewport($vieww);

        $label = new GtkLabel('Tab01');
        $ntb = new GtkNotebook;
        $ntb->append_page(new GtkLabel('This is the first child'),$edit);
        $ntb->append_page($edit, $label);
   
        
        $right->add($edit);
        
        $this->gtksourcebufferl->connect('modified-changed',  'on_modified_changed');
        
        $vpane->add2($ntb);
        
        //return $vpane;       
 
        $hbox->pack_start($vpane);
        $this->add($this->vbox->pack_start($hbox));
    }
    public function addTollBar()
    {
    
        //Our separators
        $vsep = new GtkVSeparator();
        
        
        $hbox = new GtkHBox;
        
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
        
        
        
        $hbox->pack_start($tb,false,false);
        
        $this->add($this->vbox->pack_start($hbox,false));

    }

}
