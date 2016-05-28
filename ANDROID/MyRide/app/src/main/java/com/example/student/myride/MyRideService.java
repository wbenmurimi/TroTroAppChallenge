package com.example.student.myride;

import android.Manifest;
import android.app.IntentService;
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.NotificationCompat;

import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.SocketTimeoutException;
import java.net.URL;
import java.net.UnknownHostException;
import java.text.DateFormat;
import java.util.Calendar;
import java.util.Date;

/**
 * Created by Student on 3/8/2016.
 */
public class MyRideService extends IntentService implements LocationListener {
    public static final String NOTIFICATION = "com.example.student.myride";
    public static boolean running;
    public static String lastOfResponseFromServer;
    public static Calendar runningFrom;

    public Calendar stopped;

    private final static String MY_TAG = "MyRideServiceSrv";

    private SharedPreferences sharedPreferences;
    private String urlTxt;
    private LocationManager locationManager;
    private int gps_updates;
    private long latestUpdate;
    private int maximimRunningTime;
    private boolean timestamp;

    /**
     * constructor
     */
    public MyRideService() {
        super("MyRideService");
    }

    @Override
    public void onCreate() {
        super.onCreate();


        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);//reference to the system location manager
        if (locationManager.isProviderEnabled(locationManager.GPS_PROVIDER)) {
            onProviderEnabled(LocationManager.GPS_PROVIDER);
        } else {
            onProviderDisabled(LocationManager.GPS_PROVIDER);
        }

        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putLong("stoppedOn", 0);
        editor.commit();
        gps_updates = Integer.parseInt(sharedPreferences.getString("gps_updates", "3"));//seconds
        maximimRunningTime = Integer.parseInt(sharedPreferences.getString("maximumRunningTime", "24"));//time in hours

        timestamp = sharedPreferences.getBoolean("timestamp", false);
        urlTxt = sharedPreferences.getString("URL", "");
        if(urlTxt.contains("?")){
            urlTxt = urlTxt+"&";
        }else{
            urlTxt = urlTxt+"?";
        }

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
           //    public void onRequestPermissionsResult(int requestCode, String[] permissions,
             //                                         int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            return;
        }
        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, gps_updates * 1000, 1, this);

        lastOfResponseFromServer = getResources().getString(R.string.waiting_for_server_response);
        Intent notification = new Intent(NOTIFICATION);
        notification.putExtra(NOTIFICATION, "START");
        sendBroadcast(notification);


    }

    @Override
    protected void onHandleIntent(Intent intent) {
        running = true;
        runningFrom = Calendar.getInstance();
        Intent notificationIntent = new Intent(NOTIFICATION);
        sendBroadcast(notificationIntent);


        NotificationCompat.Builder notificationBuilder = new NotificationCompat.Builder(this)
                .setContentTitle("MyRide log Running")
                .setSmallIcon(R.drawable.ic_launcher)
                .setWhen(System.currentTimeMillis());
        //creates an explicit intent for an activity
        Intent notifIntent =  new Intent(this,MainActivity.class);
        PendingIntent pendingIntent = PendingIntent.getActivity(this,0,notifIntent,0);
        notificationBuilder.setContentIntent(pendingIntent);

        int notificationId = 001; //set an ID for the notification
        NotificationManager notificationManager = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);//GETS AN INSTANCE OF THE NOTIFICATION and issues it
        notificationManager.notify(notificationId, notificationBuilder.build());

        long durationTime = System.currentTimeMillis() + maximimRunningTime * 60 * 60 * 1000;
        while (System.currentTimeMillis() < durationTime) {
            try {
                Thread.sleep(60 * 1000);
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }


    }

    /**
     * function to stop the application from running
     */
    @Override
    public void onDestroy() {
        new MyRideTrackerRequest().start("tracker=stop");


        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            return;
        }
        locationManager.removeUpdates(this);
        running = false;
        stopped = Calendar.getInstance();

        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putLong("stopped", stopped.getTimeInMillis());
        editor.commit();

        Intent intent = new Intent(NOTIFICATION);
        sendBroadcast(intent);

    }

    /**
     * function to get longitude and latitude on location change
     * @param location
     */

    @Override
    public void onLocationChanged(Location location){
        long currentTime = System.currentTimeMillis();
        //tolerate devices which send information one minute early
        if((currentTime-latestUpdate)<(gps_updates-1)*1000){
            return;
        }

        latestUpdate = currentTime;
        new MyRideTrackerRequest().start(
                "lon=" + location.getLongitude()
                        + "&lat=" + location.getLatitude()
                        + (timestamp ? "&timestamp=" + currentTime : "")
        );
    }

    @Override
    public void onProviderDisabled (String provider){

    }

    @Override
    public void onProviderEnabled(String provider){

    }
    @Override
    public void onStatusChanged(String provider,int status,Bundle extras){

    }


    //tracker request private class
    private class MyRideTrackerRequest extends Thread{
        private final static String MY_TAG = "MyRideTrackerRequest";
        private String parameter;

        public void run(){
            String message=" ";
            int code = 0;

            try{
                URL url = new URL(urlTxt+parameter);
                HttpURLConnection connection = (HttpURLConnection) url.openConnection();
                connection.setReadTimeout(10000);//milliseconds
                connection.setConnectTimeout(15000);//milliseconds
                connection.setRequestMethod("GET");
                connection.setDoInput(true);
                connection.connect();
                code = connection.getResponseCode();
                message = "HTTP"+code;

            }
            catch(MalformedURLException e){
                message=getResources().getString(R.string.malformed_URL);

            }
            catch (UnknownHostException e){
                message=getResources().getString(R.string.unknownhostException);

            }
            catch (SocketTimeoutException e){
                message = getResources().getString(R.string.ssl_erroe);
            }
            catch (Exception e){

            }

            if(!parameter.startsWith("tracker=")){
                lastOfResponseFromServer = getResources().getString(R.string.waiting_for_server_response)
                +" "+ DateFormat.getTimeInstance().format(new Date())+" ";
            }
            if(code==200){
                lastOfResponseFromServer +="<font color='#ffff'><b>"
                        + getResources().getString(R.string.connection_status)
                +"</b></font>";
            }
            else{
                lastOfResponseFromServer += "<font color='#fff'><b>"
                        +getResources().getString(R.string.http_failed)
                        +"</b></font>"
                        +"<br>"+"("+message+")";
            }

            Intent notificationIntent = new Intent(NOTIFICATION);
            notificationIntent.putExtra(NOTIFICATION,"HTTP");
            sendBroadcast(notificationIntent);
        }

        public void start(String params){
            this.parameter = params;
            super.start();
        }
    }
}



