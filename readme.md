# Slack server reporting

## Installation

1. Git clone the repo `git clone git@github.com:lucien144/slack-alerts.git`
2. Create files `touch slack-alerts/du.txt` and `touch slack-alerts/config.php`
3. Make the `du.txt` file readable: `chmod 0777 slack-alerts/du.txt`
5. Create Slack's webhook at [https://slack.com/apps/A0F7XDUAZ-incoming-webhooks](https://slack.com/apps/A0F7XDUAZ-incoming-webhooks)
6. Set the configuration to `config.php`

	```
	<?php
	// URL webhook endpoint. Required.
	define('SLACK_ENDPOINT', 'https://hooks.slack.com/services/***/***/***');

	// Set custom warning threshold in GB. Optional.
	define('WARNING_TRESHOLD', 5);
	```
7. Create cron jobs - **Don't forget to change the paths!**
   1. for sending alerts every hour when we are close to reach the server limit
   2. for filling the `du.txt` file and run it once a day:
   3. for sending reports every Monday
	
		`0	*	*	*	*	php ~/slack-alerts/free-space.php`
		
		`0 3 * * * du -h --max-depth=1 /var/www/vhosts/ 2>/dev/null | sort -hr > ~/slack-alerts/du.txt`
		
		`0	4	*	*	1	php ~/slack-alerts/du.php`
