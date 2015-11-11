<?php 

namespace Witty\LaravelPushNotification;

use Sly\NotificationPusher\PushManager,
    Sly\NotificationPusher\Model\Device,
    Sly\NotificationPusher\Model\Message,
    Sly\NotificationPusher\Model\Push;

class PushNotifier 
{
	/**
	 * @param array $config
	 */
    public function __construct($config)
    {
    	$environment = $config['environment'] == "development" ? PushManager::ENVIRONMENT_DEV : PushManager::ENVIRONMENT_PROD;

        $this->push_manager = new PushManager( $environment );

        $adapter_class_name = 'Sly\\NotificationPusher\\Adapter\\' . ucfirst( $config['service'] );

        $adapter_config = $config;
        unset( $adapter_config['environment'], $adapter_config['service'] );

        $this->adapter = new $adapter_class_name( $adapter_config );
    }

    /**
	 * @param mixed $addressee
	 * @return \Witty\LaravelPushNotification\PushNotifier
	 */
    public function to($addressee)
    {
        $this->addressee = is_string( $addressee ) ? new Device( $addressee ) : $addressee;

        return $this;
    }

    /**
	 * @param mixed $message
	 * @param array $options
	 * @return \Witty\LaravelPushNotification\PushNotifier
	 */
    public function send($message, $options = []) 
    {
        $push = new Push( $this->adapter, $this->addressee, ($message instanceof Message) ? $message : new Message($message, $options) );

        $this->push_manager->add($push);
        
        $this->push_manager->push();

        return $this;
    }

    /**
	 * @return mixed
	 */
    public function getFeedback() 
    {
        return $this->push_manager->getFeedback( $this->adapter );
    }
}