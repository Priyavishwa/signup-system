<?php
/**
 * Author: Priya V
 * Date: 22/05/2021
 */

class ModSignup extends CI_Model
{
    //rceiving the associative array $data from controller to model
    public function checkUser($data)
    {
        //It takes two parameter table name and associative array
        return $this->db->get_where('users',array('uEmail'=>$data['uEmail']));
        //select * from users where uEmail="abc"
    }

    public function addNewUser($data)
    {
        return $this->db->insert('users',$data);

    }

    public function checkLink($link)
    {
        return $this->db->get_where('users',array('uLink'=>$link));
    }

    public function activateTheLink($link)
    {
        $this->db->where('uLink',$link);
        return $this->db->update('users',array('uStatus'=>1,'uLink'=>$link.'ok'));
    }

    public function checkUserByPassword($data)
    {
        return $this->db->get_where('users',$data)->result_array();
    }


}

?>