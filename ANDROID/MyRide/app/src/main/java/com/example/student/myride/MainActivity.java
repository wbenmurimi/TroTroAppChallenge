package com.example.student.myride;

import android.Manifest;
import android.annotation.TargetApi;
import android.app.Activity;
import android.app.Notification;
import android.app.Service;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.Uri;
import android.os.Build;
import android.os.IBinder;
import android.preference.PreferenceManager;
import android.support.annotation.Nullable;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.Html;
import android.text.TextWatcher;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;
import android.widget.Toolbar;

import com.google.android.gms.appindexing.Action;
import com.google.android.gms.appindexing.AppIndex;
import com.google.android.gms.common.api.GoogleApiClient;

import java.text.DateFormat;
import java.util.Date;

import static java.lang.System.*;

public class MainActivity extends Activity implements LocationListener {
    private Toolbar title;
    private ToggleButton track_toggle_button;
    //private GPSTracker gpsTracker;
    private TextView netWorkStatus, GPSstatus, running_since, server_response;
    private EditText urlTxt;


    /**
     * ATTENTION: This was auto-generated to implement the App Indexing API.
     * See https://g.co/AppIndexing/AndroidStudio for more information.
     */
    // private GoogleApiClient client;
    private final static String CONNECTIVITY = "android.net.com.CONNECTIVITY_CHANGE";// ACTION TO BE BRAODCASTED WHEN CONNECTIVITY CHANGES

    private LocationManager locationManager;
    private ConnectivityManager connectivityManager;

    SharedPreferences sharedPreferences;

    private BroadcastReceiver broadcastReceiver = new BroadcastReceiver() {
        @Override
        public void onReceive(Context context, Intent intent) {
            String action = intent.getAction();
            if (action.equals(MyRideService.NOTIFICATION)) {
                String extra = intent.getStringExtra(MyRideService.NOTIFICATION);
                if (extra != null) {
                    updateServerResponse();
                } else {
                    updateServiceStatus();
                }

            }
            if (action.equals(CONNECTIVITY)) {
                updateNetworkStatus();
            }

        }
    };
    /**
     * ATTENTION: This was auto-generated to implement the App Indexing API.
     * See https://g.co/AppIndexing/AndroidStudio for more information.
     */
    private GoogleApiClient client;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        //  title = (Toolbar)findViewById(R.id.toolbar);
        // gpsTracker = new GPSTracker(MainActivity.this);
        track_toggle_button = (ToggleButton) findViewById(R.id.trackBTN);
        netWorkStatus = (TextView) findViewById(R.id.network);
        GPSstatus = (TextView) findViewById(R.id.gps);
        urlTxt = (EditText) findViewById(R.id.urlServer);
        running_since = (TextView) findViewById(R.id.runningSinceTXT);
        server_response = (TextView) findViewById(R.id.serverResponse);

        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this);
        if (sharedPreferences.contains("URL") && sharedPreferences.getString("URL", "").equals("")) {
            urlTxt.setText(sharedPreferences.getString("URL", getString(R.string.url_hint)));
            urlTxt.clearFocus();
        } else {
            urlTxt.requestFocus();
        }
        urlTxt.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {

            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {

            }

            @Override
            public void afterTextChanged(Editable s) {
                SharedPreferences.Editor editor = sharedPreferences.edit();
                editor.putString("URL", s.toString().trim());
                editor.commit();

            }
        });


        registerReceiver(broadcastReceiver, new IntentFilter(MyRideService.NOTIFICATION));
        registerReceiver(broadcastReceiver, new IntentFilter(MainActivity.CONNECTIVITY));

        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        connectivityManager = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);

        int gps_updates = Integer.parseInt((sharedPreferences.getString("gps_updates", "5")));//seconds
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
        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 3*1000*60,1,this);
        System.out.println("updates after every: " + gps_updates);





        client = new GoogleApiClient.Builder(this).addApi(AppIndex.API).build();
    }

    @Override
    public void onResume() {
        super.onResume();

        if (locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER)) {
            onProviderEnabled(LocationManager.GPS_PROVIDER);
        } else {
            onProviderDisabled(LocationManager.GPS_PROVIDER);
        }

        updateNetworkStatus();
        updateServiceStatus();
        updateServerResponse();

        if (MyRideService.running) {
            urlTxt.setEnabled(false);
        } else {
            urlTxt.setEnabled(true);
        }
    }

    @Override
    public void onPause() {
        super.onPause();
    }

    public void onToggleClicked(View view){
        Intent intent = new Intent(this,MyRideService.class);
        if(((ToggleButton)view).isChecked()){
            startService(intent);
            urlTxt.setEnabled(false);
        }
        else{
            stopService(intent);
            urlTxt.setEnabled(true);
        }
    }


    @Override
    public void onDestroy() {
        super.onDestroy();
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
        unregisterReceiver(broadcastReceiver);
    }



    @Override
    public void onLocationChanged(Location location) {


    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {
        GPSstatus.setText((getString(R.string.gps_enabled)));
        GPSstatus.setTextColor(Color.GREEN);

    }

    @Override
    public void onProviderDisabled(String provider) {
        GPSstatus.setText((getString(R.string.gps_disabled)));
        GPSstatus.setTextColor(Color.RED);

    }

    private void updateServiceStatus() {
        if (MyRideService.running) {
            Toast.makeText(this, getString(R.string.running), Toast.LENGTH_SHORT).show();
            track_toggle_button.setChecked(true);
            running_since.setText(getString(R.string.Myride_running_since) + " "
                    + DateFormat.getDateInstance().format(MyRideService.runningFrom.getTime()));

        } else {
            Toast.makeText(this, getString(R.string.stopped_service), Toast.LENGTH_SHORT).show();
            track_toggle_button.setChecked(false);
            if (sharedPreferences.contains("stopped")) {
                long stopped = sharedPreferences.getLong("stopped", 0);
                if (stopped > 0) {
                    running_since.setText(getString(R.string.stopped_on) + " "
                            + DateFormat.getDateTimeInstance().format(new Date(stopped)));
                } else {
                    running_since.setText(getText(R.string.MyRide_killed));
                }
            }
        }

    }

    private void updateNetworkStatus() {
        NetworkInfo networkInfo = connectivityManager.getActiveNetworkInfo();
        if (networkInfo != null && networkInfo.isConnectedOrConnecting()) {
            netWorkStatus.setText(getString(R.string.network_enabled));
            netWorkStatus.setTextColor(Color.GREEN);
        } else {
            netWorkStatus.setText(getString(R.string.network_disabled));
            netWorkStatus.setTextColor(Color.RED);
        }

    }

    private void updateServerResponse() {
        if (MyRideService.lastOfResponseFromServer != null) {
            server_response.setText(Html.fromHtml(MyRideService.lastOfResponseFromServer));
        }

    }

    @Override
    public void onStart() {
        super.onStart();

        // ATTENTION: This was auto-generated to implement the App Indexing API.
        // See https://g.co/AppIndexing/AndroidStudio for more information.
        client.connect();
        Action viewAction = Action.newAction(
                Action.TYPE_VIEW, // TODO: choose an action type.
                "Main Page", // TODO: Define a title for the content shown.
                // TODO: If you have web page content that matches this app activity's content,
                // make sure this auto-generated web page URL is correct.
                // Otherwise, set the URL to null.
                Uri.parse("http://host/path"),
                // TODO: Make sure this auto-generated app deep link URI is correct.
                Uri.parse("android-app://com.example.student.myride/http/host/path")
        );
        AppIndex.AppIndexApi.start(client, viewAction);
    }

    @Override
    public void onStop() {
        super.onStop();

        // ATTENTION: This was auto-generated to implement the App Indexing API.
        // See https://g.co/AppIndexing/AndroidStudio for more information.
        Action viewAction = Action.newAction(
                Action.TYPE_VIEW, // TODO: choose an action type.
                "Main Page", // TODO: Define a title for the content shown.
                // TODO: If you have web page content that matches this app activity's content,
                // make sure this auto-generated web page URL is correct.
                // Otherwise, set the URL to null.
                Uri.parse("http://host/path"),
                // TODO: Make sure this auto-generated app deep link URI is correct.
                Uri.parse("android-app://com.example.student.myride/http/host/path")
        );
        AppIndex.AppIndexApi.end(client, viewAction);
        client.disconnect();
    }



}
