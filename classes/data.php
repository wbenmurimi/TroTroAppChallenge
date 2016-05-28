<?php
/**
*@author Benson Wachira
*@version 1.0
*/
include "../model/base.php";

class data extends base{


//fetching routes
  function fetchFares()
  {

    $str_query = "SELECT fare_attributes.Price , routes.route_long_name
     FROM Fare_rules,Fare_attributes,Routes 
     where fare_attributes.Fare_id=fare_rules.Fare_id 
     AND fare_rules.Route_id= routes.Route_id 
     ORDER BY routes.route_long_name ASC";

    return $this->query($str_query);
  }

//fetching stops
    function fetchStops()
  {

    $str_query = "SELECT stops.*
     FROM stops 
     ORDER BY stop_name ASC";

    return $this->query($str_query);
  }

//fetching buses
 
  function fetchBuses($by)
  {

    $str_query = "SELECT Agency.agency_name , driver.driver_name,bus.b_id, bus.bus_number
     FROM bus,driver,Agency 
     where bus.driver_id=driver.driver_id 
     AND bus.agency_id= Agency.agency_id 
     AND bus.added_by='$by'
     ORDER BY agency_name ASC";

     return $this->query($str_query);
   }

  //adding a bus

  function addBus($bid,$did,$aid,$by)
  {
    $str_query = "INSERT INTO bus(bus_number, driver_id, agency_id,added_by) 
    VALUES('$bid','$did','$aid',$by)";

    return $this->query($str_query);
  }

  function fetchDrivers($by)
  {

    $str_query = "SELECT driver.*
     FROM driver
     where driver .added_by='$by'
     ORDER BY driver_name ASC";

     return $this->query($str_query);
   }

   //adding a bus

  function addDriver($dn,$de,$dp,$by)
  {
    $str_query = "INSERT INTO driver(driver_name, driver_email, driver_phone,added_by) 
    VALUES('$dn','$de','$dp',$by)";

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
