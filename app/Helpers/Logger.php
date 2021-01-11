<?php namespace App\Helpers;

use App\Models\Cms\LogMessage;

/***
 * Class Logger
 * @package App\Helpers
 */
class Logger{

    // log levels
    const LOG_LEVEL_CRITICAL    = 0;
    const LOG_LEVEL_ERROR       = 1;
    const LOG_LEVEL_WARNING     = 2;
    const LOG_LEVEL_INFORMATION = 3;

    // log types
    const SYS_SYSTEM        = 1;
    const CLIENT_MODEL      = 2;
    const RESOURCE_MODEL    = 3;
    const CONTACT_POINT     = 5;
    const USER_LOGIN        = 7;
    const API               = 8;

    // log system
    const LOG_TYPE_SYSTEM   = 1;
    const LOG_CLIENT_SYSTEM = 0;
    const LOG_USER_SYSTEM   = 0;

    /**
     * Logs a critical message.
     *
     * @param int $clientId Id of client.
     * @param int $typeId Type (section) of log message.
     * @param string|array|object $content Content of message.
     * @param int $userId Id of user (0 for system)
     */
    public static function logCritical( $typeId, $content, $userId = self::LOG_USER_SYSTEM ) {
        self::logMessage( $typeId, $content, $userId, self::LOG_LEVEL_CRITICAL );
    }

    /**
     * Logs an error message
     *
     * @param int $clientId Id of client.
     * @param int $typeId Type (section) of log message.
     * @param string|array|object $content Content of message.
     * @param int $userId Id of user (0 for system)
     */
    public static function logError( $typeId, $content,$userId = self::LOG_USER_SYSTEM ){
        self::logMessage( $typeId, $content, $userId, self::LOG_LEVEL_ERROR );
    }

    /**
     * Logs a warning message
     *
     * @param int $clientId Id of client.
     * @param int $typeId Type (section) of log message.
     * @param string|array|object $content Content of message.
     * @param int $userId Id of user (0 for system)
     */
    public static function logWarning( $typeId, $content,$userId = self::LOG_USER_SYSTEM ){
        self::logMessage( $typeId, $content, $userId, self::LOG_LEVEL_WARNING );
    }

    /**
     * Logs an Info message
     *
     * @param int $clientId Id of client.
     * @param int $typeId Type (section) of log message.
     * @param string|array|object $content Content of message.
     * @param int $userId Id of user (0 for system)
     */
    public static function logInfo( $typeId, $content, $userId = self::LOG_USER_SYSTEM){
        self::logMessage( $typeId, $content, $userId, self::LOG_LEVEL_INFORMATION );
    }

    /**
     * Logs a message
     *
     * @param int $clientId Id of client.
     * @param int $typeId Type (section) of log message.
     * @param string|array|object $content Content of message.
     * @param int $userId Id of user (0 for system)
     * @param int $level Level of message
     */
    public static function logMessage( $typeId, $content, $userId, $level ){

        $log = new LogMessage();

        $log->log_type_id = $typeId;
        $log->created_at  = date('Y-m-d H:i:s' );
        $log->user_id     = $userId;
        $log->level       = $level;

        if( is_object( $content ) || is_array($content) ){
            $log->content = json_encode( $content );
        } else {
            $log->content = $content;
        }

        $log->save();
    }

}
