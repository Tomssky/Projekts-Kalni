<?
class controller
{

    var $page;
    function __construct()
    {
        $this->page = url_segment(0);
    }

    function page()
    {
        global $auth, $db;


        if (empty($this->page)) {
            $this->page = 'home';
        }

        if($this->page == 'logout'){
            return $auth->logout();
        }

        $include = 'pages/' . $this->page . '.php';

        if (file_exists($include)) {
            include_once $include;
        }

        return '';
    }


}
