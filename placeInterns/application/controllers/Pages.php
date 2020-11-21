<?php
/**
 * @author Oliver Mensah <https://omensah.github.io/resume>
 * @link https://github.com/OMENSAH/barePHP
 * Controller Class
 */
  class Pages extends BaseController{
    public function __construct(){
      
    }
    /**
     * Home Page //  sitename/index or sitename
     * @return void
     */
    public function index(){
        $this->loadView('pages/index');
    }
  }
