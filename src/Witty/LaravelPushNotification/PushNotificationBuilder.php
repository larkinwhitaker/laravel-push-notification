<?php namespace Witty\LaravelPushNotification;

class PushNotificationBuilder {

    public function app($appName)
    {
        return new PushNotifier( \Config::get('pushnotification.' . $appName) );
    }

    public function Message()
    {
    	return $this->getInstance( 'Sly\NotificationPusher\Model\Message' );
    }

    public function Device()
    {
    	return $this->getInstance( 'Sly\NotificationPusher\Model\Device' );
    }

    public function DeviceCollection()
    {
    	return $this->getInstance( 'Sly\NotificationPusher\Collection\DeviceCollection' );
    }

    public function PushManager()
    {
    	return $this->getInstance( 'Sly\NotificationPusher\PushManager' );
    }

    public function ApnsAdapter()
    {
    	return $this->getInstance( 'Sly\NotificationPusher\Adapter\ApnsAdapter' );
    }

    public function GcmAdapter()
    {
    	return $this->getInstance( 'Sly\NotificationPusher\Model\GcmAdapter' );
    }

    public function Push()
    {
    	return $this->getInstance( 'Sly\NotificationPusher\Model\Push' );
    }

    private function getInstance( $reflectionClassName )
    {
		$instance = ( new \ReflectionClass( $reflectionClassName ) );
        return $instance->newInstanceArgs( func_get_args() );
    }

}