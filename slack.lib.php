<?php

class slack
{

	public static $endpoint;


	private static function curl($payload)
	{
		$data = "payload=" . json_encode($payload);

		$ch = curl_init(self::$endpoint);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	// (string) $message - message to be passed to Slack
	// (string) $channel - room in which to write the message, too
	// (string) $icon - You can set up custom emoji icons to use with each message
	public static function alert($message, $channel = NULL)
	{
		$payload = ["text" => $message];

		if ($channel !== NULL) {
			$payload["channel"] = "#{$channel}";
		}

		return self::curl($payload);
	}


	public static function report($header, $footer, $leftColumn, $rightColumn, $channel = NULL)
	{
		$payload = [
			"blocks" => [
				[
					"type" => "header",
					"text" => [
						"type" => "plain_text",
						"text" => $header,
					],
				],
				[
					"type" => "divider",
				],
				[
					"type" => "section",
					"text" => [
						"type" => "mrkdwn",
						"text" => $leftColumn,
					],
				], [
					"type" => "section",
					"text" => [
						"type" => "mrkdwn",
						"text" => $rightColumn,
					],
				],
				[
					"type"     => "context",
					"elements" => [
						[
							"type"  => "plain_text",
							"text"  => $footer,
							"emoji" => TRUE,
						],
					],
				],
			],
		];

		if ($channel !== NULL) {
			$payload["channel"] = "#{$channel}";
		}

		return self::curl($payload);
	}

}