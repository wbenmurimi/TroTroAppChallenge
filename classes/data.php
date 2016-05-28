<?php
/**
*@author Benson Wachira
*@version 1.0
*/
include "../model/base.php";

class data extends base{
	
function logGPSValues($bus_id, $latitude,$longitude){
    
        $str_query = "INSERT INTO gpsdevice (bus_id,lon,lat) VALUES('$bus_id','$longitude','$latitude') ON DUPLICATE KEY UPDATE lat='$latitude', lon='$longitude';";
        $str_query.= "INSERT INTO track_the_bus (Device_id,lon,lat) VALUES('$bus_id','$longitude','$latitude')";
        
        if($this->multiple_query_connection($str_query)){
            return true;
        }
        else{
             echo "Multi query failed: (" . $this->errno . ") " . $this->error;
            return false;
        }
}


    /**
     * function to fetch the GPS coordinates from the database
     * @return boolean
     */
    
    function fetch_GPS_Coordinates(){
      
        $str_query="SELECT gpsdevice.lat,gpsdevice.lon, bus.Bus_number FROM gpsdevice INNER JOIN bus ON gpsdevice.bus_id=bus.device_id";
        if($this->query($str_query)){
          
            return true;
        }
        else{
            return false;
        }
    }


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

   //adding a driver

  function addDriver($dn,$de,$dp,$by)
  {
    $str_query = "INSERT INTO driver(driver_name, driver_email, driver_phone,added_by) 
    VALUES('$dn','$de','$dp',$by)";

    return $this->query($str_query);
  }

    //adding a bus

  function addTraffic($desc,$lev,$long,$lati)
  {
    $str_query = "INSERT INTO traffic_jam(jam_statement, level_of_traffic, longitude,latitude) 
    VALUES('$desc','$lev','$long',$lati)";

    return $this->query($str_query);
  }

//fetching traffic
    function getAllTraffic()
  {

    $str_query = "SELECT traffic_jam.*
     FROM traffic_jam 
     ORDER BY   jam_Update_Time ASC";

    return $this->query($str_query);
  }










}

?>
