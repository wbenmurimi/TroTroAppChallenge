<?php
/**
*@author Benson Wachira
*@version 1.0
*/
include "../model/base.php";

class users extends base{
    /**
     * @method boolean Login($username, $user_password) username and password to enable user to log in
     * @param $username
     * @param $user_password
     * @return bool
     */
    function Login($username, $user_password)
    {
        $str_query = "SELECT xx_username, xx_user_type, xx_user_id ,xx_fname FROM _system_users WHERE xx_username = '$username' AND xx_user_password = md5('$user_password') AND xx_user_status='Enabled'";
        return $this->query($str_query);
    }
    /**
     * @method boolean signUp($fname,$lname,$username,$password,$user_email,$phone,$usertype,
     *$user_status) sign up information of user to be stored in the database
     * @param $fname user first name
     * @param $lname user last name
     * @param $username name user will sign in with
     * @param $password password of user
     * @param $user_email email of user
     * @param $usertype type of the user that is created
     * @param $user_status status of the user account
     * @param $phone phone number of user
     * @return bool
     */
    function signUp($fname,$lname,$username,$password,$user_email,$phone,$usertype,$user_status)
    {
        $str_query = "INSERT INTO _system_users SET xx_fname='$fname',xx_lname='$lname', xx_username='$username', xx_user_password=md5('$password'),xx_user_status='$user_status', xx_user_email='$user_email',xx_user_phone='$phone',xx_user_type='$usertype'";
        return $this->query($str_query);
    }

    /**
     * @method boolean getUsers() fetches all the users in the database
        * @return bool
     */
    function getUsers()
    {
        $str_query = "SELECT xx_fname,xx_lname,xx_location,xx_house_no,xx_user_phone,xx_user_type, Date_Format(xx_created_on,'%Y-%m-%d') As _date,xx_user_status FROM _system_users order by xx_user_type ASC";
        return $this->query($str_query);
    }
    /**
     * @method boolean getUserDetails() fetches all the details of a user in the database
        * @return bool
     */
    function getUserDetail($id)
    {
        $str_query = "SELECT * FROM _system_users where xx_user_id='$id' ";
        return $this->query($str_query);
    }
    /**
     * @method boolean editUserType($user_status,$type,$id) changes the details of the user in the database
     * @param $id the user id in the database
     * @param $usertype type of the user that is created
     * @param $user_status status of the user account
     * @return bool
     */
    function editUserType($user_status,$type,$id)
    {
     $str_query = "UPDATE _system_users SET xx_user_type='$type', xx_user_status='$user_status'
     WHERE xx_user_id='$id'";
     return $this->query($str_query);
 }

   

 }
 ?>
