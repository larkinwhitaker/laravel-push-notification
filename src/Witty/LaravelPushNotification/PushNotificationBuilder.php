<?php 

namespace Witty\LaravelPushNotification;

use Illuminate\Support\Facades\Config;
use Witty\LaravelPushNotification\PushNotifier;

class PushNotificationBuilder 
{
	/**
	 * @param mixed $platform_name
	 * @return \Witty\LaravelPushNotification\PushNotifier
	 */
    public function app($platform_name)
    {
    	$config = [];

    	if ( is_string($platform_name) )
    	{
    		$config = Config::get('pushnotification.' . $platform_name);
    	}
    	else if ( is_array($platform_name) )
    	{
    		$config = $platform_name;
    	}

        return new PushNotifier( $config );
    }

    /**
	 * @return \Sly\NotificationPusher\Model\Message
	 */
    public function Message()
    {
		return $this->sly_class_instance('Sly\NotificationPusher\Model\Message', func_get_args());
    }

    /**
	 * @return \Sly\NotificationPusher\Model\Device
	 */
    public function Device()
    {
		return $this->sly_class_instance('Sly\NotificationPusher\Model\Device', func_get_args());
    }

    /**
	 * @return \Sly\NotificationPusher\Collection\DeviceCollection
	 */
    public function DeviceCollection()
    {
		return $this->sly_class_instance('Sly\NotificationPusher\Collection\DeviceCollection', func_get_args());
    }

    /**
	 * @return \Sly\NotificationPusher\PushManager
	 */
    public function PushManager()
    {
		return $this->sly_class_instance('Sly\NotificationPusher\PushManager', func_get_args());
    }

    /**
	 * @return \Sly\NotificationPusher\Model\ApnsAdapter
	 */
    public function ApnsAdapter()
    {
		return $this->sly_class_instance('Sly\NotificationPusher\Model\ApnsAdapter', func_get_args());
    }

    /**
	 * @return \Sly\NotificationPusher\Model\GcmAdapter
	 */
    public function GcmAdapter()
    {
		return $this->sly_class_instance('Sly\NotificationPusher\Model\GcmAdapter', func_get_args());
    }

    /**
	 * @return \Sly\NotificationPusher\Model\Push
	 */
    public function Push()
    {
		return $this->sly_class_instance('Sly\NotificationPusher\Model\Push', func_get_args());
    }

    /**
	 * @param string $class_name
	 * @return mixed
	 */
    private function sly_class_instance($class_name, $args)
    {
		$instance = new \ReflectionClass( $class_name );

		return $instance->newInstanceArgs( $args );
    }

}