INSTALLATION:
------------

- Upload the addon to  admin/addons/
- Install the addon under: Interspire > Control Panel > Addons
- Setup Cron

	a) Populate the SendScore and Blacklist Data (DNSBL's):
	
		run: php /path/to/iem/admin/addons/mta/api/cli.php --populate-ipguard
	
	b) Setup the CRON for Reputation and Blacklist Monitor:
	
		run: php /path/to/iem/admin/addons/mta/api/cli.php --check-ipguard --type=reputation          # (you can run manually under Shell or setup cron to run each 30 minutes [0,30 * * * *] )
		run: php /path/to/iem/admin/addons/mta/api/cli.php --check-ipguard --type=blacklist           # (you can run manually under Shell or setup cron to run each 1 hour [0 * * * *] )
		run: php /path/to/iem/admin/addons/mta/api/cli.php --check-ipguard --type=whitelist           # (you can run manually under Shell or setup cron to run each 1 hour [0 * * * *] )

BLACKLIST:
----------

We are using:

blacklist 		226 Services
combined 		6 	Services
informational 	17 	Services
reputation 		5 	Services
whitelist 		29 	Services


REPUTATION:
-----------
Frequently Asked Questions:

https://www.senderscore.org/faq/

Q. What do the numbers in a Sender Score mean?

	All scores are based on a scale of 0 to 100, where 0 is the worst, and 100 is the best possible score.
	A score represents that IP address's rank as measured against other IP addresses, much like a percentile ranking.

Q. How does Return Path know so much about email sending behavior?

	ISPs and filtering companies provide us with aggregate, non-personal data they collect from their subscribers. 
	If someone who receives an email complains about it to their ISP, by hitting the ''Report Spam'' button, for example,
	we get a copy of that report. ISPs and filtering companies also report other metrics about the mail they receive.

Q. What are the scores, and what do they mean?

	In most cases, scores are calculated on a rolling 30-day average

	Sender Score: This score is derived from a proprietary Return Path algorithm, and represents an IP address's overall performance 
	against metrics important to both ISPs and their customers who receive your email. For senders, this score represents the overall 
	health of your email programs as they appear to receiving systems.
	
	The following are Rank based Indices:

    Complaints: This score represents how complaints about that IP address compare to all other IP addresses observed by the Sender Score Reputation Network.
    			Complaint rates are calculated as complaints divided by accepted mail and complaint scores are a rank based on your complaint rates.
    Volume: Volume is not in itself good or bad, but is an important part of the overall reputation algorithm: for example, an IP address which sends 100
    			messages and receives 99 complaints is problematic, while an IP address which sends 100,000 messages and receives 99 complaints is probably okay.
    			A higher score equates to larger volume monitored by the Sender Score Reputation Network.
    External Reputation: This score shows how the IP address compares to all other IP addresses seen by the Sender Score Reputation Network on a
    			variety of external blacklists and whitelists.
    Unknown Users: This score represents the rank of the IP address's unknown user rate compared to all other IP addresses seen by the Sender Score Reputation
    			Network. Unknown user rates are taken directly from incoming SMTP logs of participating ISPs, tracking how often an IP address attempts to send
    			a message to an address which does not exist.
    Rejected: This represents how often messages are rejected (bounced due to some policy reason, usually spam filtering or blacklisting) compared to other IP
    			addresses seen in the Sender Score Reputation Network.

Q. Is the Sender Score an average of the other scores?

	No. The Sender Score is derived using a formula developed by Return Path based on modeling sending IPs versus their likelihood of engaging in behaviors
	viewed negatively by ISPs and filtering companies. The various individual indices contribute to the overall Sender Score, as well as additional data 
	elements not represented by any individual index.

Q. What does ''Accepted'' mean?

	''Accepted'' is the number of email messages accepted for delivery at our receiving sources. This number is expressed as the number of messages seen minus
	the number of messages rejected (the combination of ''Message Rejected'' and ''Sender Rejected'' minus the number of ''Unknown Users''.

Q. What does ''Accepted Rate'' mean?
	
	''Accepted Rate'' is a ratio of email messages accepted for delivery at our receiving sources, compared to email messages attempted. This is the number
	of messages accepted for delivery, divided by the number of messages seen by our receiving sources.

Q. What is the ''Unknown User Rate''?
	
	''Unknown User Rate'' is a ratio of unknown users, or invalid email addresses, compared to the amount of email seen by our receiving sources. 
	An 'unknown user' or 'no such user' or 'invalid address' is usually a '550 5.1.1' error message that will appear in your smtp logs however, not all
	ISPs use the '5.1.1' extended reply code, and not all '550' replies refer to unknown users. It is often necessary to review the text accompanying that
	SMTP reply to be certain of its meaning.

Q. How is this data being used now?
	
	Receivers use the Sender Score as input to their mail filtering decisions. A simple implementation may be to reject all mail with a Sender Score 
	beneath some level they deem acceptable. A more complicated implementation may be to whitelist IP addresses with Sender Scores above some threshol
	but blacklist senders who have recently hit a spamtrap, or who have generated very high complaint rates. Some ISPs use Sender Score as a guide for how
	many messages to accept from an individual IP address within a set period of time this is often called 'throttling' or 'rate limiting'.
	
	For example, the higher the Sender Score, the more messages that IP address can send to that ISP. A lower Sender Score, or attempts to send more messages
	than are allowed, can mean your messages are rejected (usually as a temporary failure.)
	
	Universally, the higher your Sender Score, the better chance your mail will be accepted by an ISP and delivered to your intended recipient.
	The lower an IP address's Sender Score, the more likely that ISPs & anti-spam systems including those which do not query Sender Score directly will reject or filter the mail.
	
	Senders can use Sender Score data to monitor their own sending behavior, and quickly identify problem spots. For example, identifying sources of 
	complaints or knowing whether mail from your network hits spam traps can allow you to resolve any issues before they begin to impact delivery of all mail from your network.
	
Q. Will removal from the blacklist or improving my Sender Score guarantee my email will be delivered?

	Return Path does not directly block or accept email. Receiving email networks and ISPs may query Sender Score and the Return Path Reputation Network Blacklist
	and use the results as a means for assessing their email traffic and allowing or rejecting email. The lowest scores are often filtered or blocked by email receivers.
	However, only the receiving network can ultimately determine if your email is delivered. Even if the receiving network does not utilize Return Path data directly,
	in most cases they will be looking at similar metrics.
	
	Therefore, the work involved in improving your Sender Score and getting removed from the blacklist will generally improve the chances your email will be delivered everywhere.

