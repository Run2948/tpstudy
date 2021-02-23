<?php
namespace app\controller\group;
use think\Controller;

class Address extends Controller
{
    public function index()
    {
        echo $_GET['flag'].'<br/>';
        echo $this->request->param('flag').'<br/>';
        return "group.Address Index";
    }

    public function details($id)
    {
        return "group.Address Details " . $id;
    }

    public static function stat($id)
    {
        return 'group.Address::stat '.$id;
    }
}