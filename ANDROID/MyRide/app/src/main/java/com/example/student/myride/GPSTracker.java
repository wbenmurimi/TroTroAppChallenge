package com.example.student.myride;

import android.Manifest;
import android.app.AlertDialog;
import android.app.IntentService;
import android.app.Service;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.net.ConnectivityManager;
import android.os.Build;
import android.os.Bundle;
import android.os.IBinder;
import android.preference.PreferenceManager;
import android.provider.Settings;
import android.support.annotation.Nullable;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.util.Log;

import java.security.Provider;

/**
 * Created by Student on 2/27/2016.
 */
public class GPSTracker extends IntentService implements LocationListener {
    boolean GPSEnabled = false;
    boolean NetworkEnabled = false;
    Location location;
    double latitude;
    double longitude;


    Context mContext;
    // Flag for GPS status
    boolean canGetLocation = false;
    private SharedPreferences preference;
    private LocationManager locationManager;
    private long maximum_update_time;
    private long maximum_run_time;
    String urlText;//server and the particular details on where to push the location details
    private final static String TAG = "MyRideGPSLogService";

    private ConnectivityManager connectivity_manager;




    //MINIMUM DISTANCE BETWEEN UPDATES
    private static final long DISTANCE_BW_UPDATES = 100; //100 meters

    //MINIMUM TIME TO PROVIDE UPDATES
    private static final long TIME_BW_UPDATES = 1000 * 60 * 3; //3 MINUTES

    /**
     * function to broad the result of intent after it receives the current loaction
     * details
     */
    private BroadcastReceiver broadcast_receiver = new BroadcastReceiver() {
        @Override
        public void onReceive(Context context, Intent intent) {
            String action = intent.getAction();
            //if(action.equals((GPSTracker.NOTIFICATION)));
        }
    };
    
    public GPSTracker() {
        super(GPSTracker.class.getName());
        //this.mContext = context;
        //getLocation();
    }

    @Override
    public void onCreate(){
        super.onCreate();
        preference = PreferenceManager.getDefaultSharedPreferences(this);
        SharedPreferences.Editor editor = preference.edit();



    }

    public Location getLocation() {
        if ( Build.VERSION.SDK_INT >= 23 &&
                ContextCompat.checkSelfPermission( mContext, android.Manifest.permission.ACCESS_FINE_LOCATION ) != PackageManager.PERMISSION_GRANTED &&
                ContextCompat.checkSelfPermission(mContext, android.Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return null;
        }
        try {
            locationManager = (LocationManager) mContext.getSystemService(LOCATION_SERVICE);
            //GPS status
            GPSEnabled = locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER);

            //Network status
            NetworkEnabled = locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);

            if (!GPSEnabled && !NetworkEnabled) {
                //display that on the status
            } else {
                this.canGetLocation = true;
                if (NetworkEnabled) {
                    locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER,
                            TIME_BW_UPDATES, DISTANCE_BW_UPDATES, this);

                    if(locationManager != null){
                        location = locationManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
                        if(location != null){
                            latitude = location.getLatitude();
                            longitude = location.getLongitude();

                        }
                    }
                }

                //if GPS is enabled,get Latitude and longitude using GPS services
                if(GPSEnabled){
                    if(location == null){
                        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER,TIME_BW_UPDATES,DISTANCE_BW_UPDATES,this);

                        if(locationManager != null){
                            location = locationManager.getLastKnownLocation(LocationManager.GPS_PROVIDER);
                            if(location != null){
                                latitude = location.getLatitude();
                                longitude = location.getLongitude();
                            }
                        }
                    }
                }
            }

        }
        catch(Exception e){
            e.printStackTrace();
        }

        return location;
    }

    /**
     * function to get the GPS status
     * @return
     */
    public boolean getGPSStatus(){
        return this.GPSEnabled;
    }

    /**
     * function to get the status of the network service
     * @return
     */

    public boolean getNetworkStatus(){
        return this.NetworkEnabled;
    }

    public boolean canGetLocation(){
        return this.canGetLocation;
    }

    /**
     * function to getLatityude and return latitude value
     * @return
     */

   public double getLatitude(){
       if(location != null) latitude = location.getLatitude();
       return latitude;
   }

    /**
     * function to fet the longitude of a location
     * @return
     */
    public double getLongitude(){
        if(location != null){
            longitude = location.getLongitude();
        }
        return longitude;
    }

    /**
     * function to show settings alert dialog
     * @param
     */

    public void showSettingsAlert(){
        AlertDialog.Builder alertDialog= new AlertDialog.Builder(mContext);
        alertDialog.setTitle("GPS SETTINGS");

        //setting Dialog message
        alertDialog.setMessage("GPS is not enabled. Do you want to go top settings to enable?");

        //on pressing the settings button
        alertDialog.setPositiveButton("settings", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                Intent intent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                mContext.startActivity(intent);
            }
        });

        alertDialog.show();
    }


    @Override
    public void onLocationChanged(Location location) {


    }

    @Override
    protected void onHandleIntent(Intent intent) {

    }


    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {

    }

    @Override
    public void onProviderDisabled(String provider) {

    }

    @Nullable
    @Override
    public IBinder onBind(Intent intent) {
        return null;
    }
}
