<?php

return [

    /**
     * Storage Driver where backup files will be stored
     */
    'database_storage_driver' => env('BACKUP_STORAGE_DRIVER', 's3'),

    /**
     * Main bucket folder name where all the backups for this project will go.
     */
    'database_folder_name' => 'Documents/Backups/' . env('BACKUP_FOLDER_NAME', env('DB_DATABASE')),

    /**
     * This is the file name which is going to be used to create the backup
     * file after the mysql dump is taken.
     */
    'database_file_name' => env('BACKUP_DB_FILENAME', env('DB_DATABASE')),

    /**
     * This is the database which will be backed up.
     */
    'database_name' => env('DB_DATABASE', ''),

    /**
     * Defined the username which will be used to connect to the datbase.
     */
    'dabase_username' => env('DB_USERNAME', 'root'),

    /**
     * This is the password which will be used to connect to the database.
     */
    'database_password' => env('DB_PASSWORD', ''),

];
