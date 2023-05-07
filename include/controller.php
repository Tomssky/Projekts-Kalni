<?
class controller
{

    var $contentmode = "pages";
    var $include = "home";

    function __construct()
    { }

    function contentloader()
    {
        global $auth, $db;


        if (empty(url_segment(0))) {
            $this->include = 'home';
        } else {
	        $this->include = url_segment(0);
        }

        if(url_segment(0) == 'logout'){
            return $auth->logout();
        }

          if(url_segment(0) == 'admin'){
           $this->contentmode = "admincontent";
           $this->include = (empty(url_segment(1)) ? 'admin' : url_segment(1));
        }

        $include = $this->contentmode . '/' . $this->include . '.php';
        //echo $include;
        if (file_exists($include)) {
            include_once $include;
        }

        return '';
    }

    
}
