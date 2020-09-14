<?php

$servername = env("DB_HOST");
$username = env("DB_USERNAME");
$password = env("DB_PASSWORD");
$dbname = env("DB_DATABASE");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM master_settings WHERE key_name = '__GOOGLE_DRIVE_CLIENT_ID__' AND key_value!=NULL ";
$result = $conn->query($sql);

if (is_array($result) && $result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $googleClientId = $row["key_value"];
    }
} else {
    $googleClientId = env('GOOGLE_DRIVE_CLIENT_ID');
}

$sql = "SELECT * FROM master_settings WHERE key_name = '__GOOGLE_DRIVE_CLIENT_SECRET__' AND key_value!=NULL  ";
$result = $conn->query($sql);

if (is_array($result) && $result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $googleClientSecret = $row["key_value"];
    }
} else {
    $googleClientSecret = env('GOOGLE_DRIVE_CLIENT_SECRET');
}
$sql = "SELECT * FROM master_settings WHERE key_name = '__GOOGLE_DRIVE_REFRESH_TOKEN__' AND key_value!=NULL ";
$result = $conn->query($sql);

if (is_array($result) && $result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $googleRefreshToken = $row["key_value"];
    }
} else {
    $googleRefreshToken = env('GOOGLE_DRIVE_REFRESH_TOKEN');
}

$sql = "SELECT * FROM master_settings WHERE key_name = '__GOOGLE_DRIVE_FOLDER_ID__' AND key_value!=NULL ";
$result = $conn->query($sql);

if (is_array($result) && $result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $googleDriveFolder = $row["key_value"];
    }
} else {
    $googleDriveFolder = env('GOOGLE_DRIVE_FOLDER_ID');
}
$conn->close();


return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],
        'google' => [
            'driver' => 'google',
            'clientId' => $googleClientId,
            'clientSecret' => $googleClientSecret,
            'refreshToken' => $googleRefreshToken,
            'folderId' => $googleDriveFolder,
        ],

    ],

];
