<?php

class slack {

	public static $endpoint;

	// (string) $message - message to be passed to Slack
	// (string) $channel - room in which to write the message, too
	// (string) $icon - You can set up custom emoji icons to use with each message
	public static function alert($message, $channel = NULL, $icon = NULL)
	{
		$settings = ["text" => $message];

		if ($channel !== NULL) {
			$settings["channel"] = "#{$channel}";
		}
		if ($icon !== NULL) {
			$settings["icon_emoji"] = "#{$icon}";
		}

		$data = "payload=" . json_encode($settings);

		$ch = curl_init(self::$endpoint);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

}