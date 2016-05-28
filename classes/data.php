<?php
/**
*@author Benson Wachira
*@version 1.0
*/
include "../model/base.php";

class data extends base{



  function fetchFares()
  {

    $str_query = "SELECT Fare_attributes.Price ,Fare_attributes.Fare_id, Fare_rules.Fare_id,Fare_rules.Route_id, Routes.Route_long_name, Routes.Route_id 
    FROM Fare_rules,Fare_attributes,Routes
    where Fare_attributes.Fare_id=Fare_rules.Fare_id ANDFare_rules.Route_id= Routes.Route_id 
    ORDER BY Routes.Route_long_name ASC";

    return $this->query($str_query);
  }









  function addOrder($name,$qty,$cost, $userId,$pick,$deliver,$service)
  {
    $str_query = "INSERT INTO _orders(item_names, item_quantities, total_cost,user_id, pick_up_day, delivery_day,service) 
    VALUES('$name','$qty','$cost', '$userId','$pick','$deliver','$service')";

    return $this->query($str_query);
  }

  function getMyOrders($userId)
  {
    $str_query = "SELECT *,Date_Format(date_posted,'%Y-%m-%d') As start_date FROM _orders where user_id='$userId' ORDER BY date_posted DESC";

    return $this->query($str_query);
  }




  function details($id)
  {

    $str_query = "SELECT _orders.* FROM _orders where order_id='$id' ";

    return $this->query($str_query);
  }

  function deleteOrder($id)
  {
    $str_query="DELETE FROM _orders WHERE   order_id='$id'";
    return $this->query($str_query);
  }

  function complete($id)
  {
    $str_query="UPDATE _orders SET order_status='Complete'  WHERE   order_id='$id'";
    return $this->query($str_query);
  }

  function getItems()
  {
    $str_query = "SELECT * FROM _cost ";

    return $this->query($str_query);
  }
  function getOneItem($postId){
    $str_query = "SELECT * FROM _cost where cost_id='$postId'";

    return $this->query($str_query);
  }

  function allPrices()
  {
    $str_query="SELECT * FROM _cost";
    return $this->query($str_query);
  }
  function addPrice($name,$full,$half, $cat)
  {
    $str_query = "INSERT INTO _cost(item_name, full_laundry, starch_iron,category) 
    VALUES('$name','$full','$half', '$cat')";

    return $this->query($str_query);
  }

  function addTip($desc,$tit)
  {
    $str_query = "INSERT INTO _tip(tip_title, tip_desc) 
    VALUES('$tit','$desc')";

    return $this->query($str_query);
  }
  function allTips()
  {
    $str_query="SELECT * FROM _tip order by tip_date desc";
    return $this->query($str_query);
  }

}

?>
