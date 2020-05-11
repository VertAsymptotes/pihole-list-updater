# pihole-list-updater
A simple script to insert new lists into Pi-hole v.5+.

With the release of Pi-hole version 5, they changed the way adlists are stored - instead of a human-readable flat file, it's now a SQLite database. This script will automatically insert the ticked lists on [https://firebog.net/](https://firebog.net/), as well as the OISD list referenced in this [linked reddit post](https://www.reddit.com/r/oisd_blocklist/comments/dwxgld/dbloisdnl_internets_1_domain_blocklist/).

I threw this script together very, very quickly and for my environment. That said, I figured other people might get some decent use out of it :)

# Requirements
If you have Pi-hole already installed, you should already have all the dependencies that this script uses. The only one that might be iffy is the SQLite3 library, but can be fairly easily installed by installing the php-sqlite3 package with your distro's package manager (e.g. `sudo apt-get install php-sqlite3`).

# Installation
You can either directly copy the script from the repository or clone it. Either way, you must put the script in a place where the user that actually runs the pihole application (i.e. if you used the standard installation, user should be pihole) can see the file. I put the file in the pihole home directory (i.e. `/home/pihole/update_pihole_lists.php`).

# Configuration
At this point, you can either run the script manually (but if you want to do that, may as well use the GUI :P) or set up a crontab to run the updater on a set schedule. I would highly recommend [reading up on cron](https://opensource.com/article/17/11/how-use-cron-linux) so you can configure it, but I've included some quick instructions to set up a cronjob to run this script daily at midnight.

1. Run `sudo crontab -e -u <pihole username>` (e.g. `sudo crontab -e -u pihole`)

2. Insert the following line:
```
0 0 * * * php /home/pihole/update_pihole_lists.php
```

3. Save and exit.

# Disclaimer
You completely and without question in saecula saeculorum assume responsibility for whatever happens when running this script on your system - just because it works on mine, there is no guarantee that your system won't immediately catch fire / open a portal to the other side of the Upside Down. Just don't blame me if that happens :)
