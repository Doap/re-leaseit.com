#!/bin/bash
#mkdir -p /var/www/html/convectek.com/wp-content/themes
#mkdir -p /var/www/html/convectek.com/wp-content/plugins
ln -s /srv/www/uploads/sinkjuice/convectek.com/uploads/ /var/www/html/convectek.com/wp-content/uploads
ln -s /srv/www/uploads/sinkjuice/convectek.com/themes/ /var/www/html/convectek.com/wp-content/themes
ln -s /srv/www/uploads/sinkjuice/convectek.com/plugins/ /var/www/html/convectek.com/wp-content/plugins
#cp -f /startup/footer.php.convectek.com /var/www/html/convectek.com/wp-content/themes/AandP-Child/footer.php 
/startup/genvhost.sh convectek.com
/startup/make-wp-configs convectek.com
echo "/startup/RunResourceTest-convectek.com.sh just ran on `curl -s http://169.254.169.254/latest/meta-data/public-ipv4`." | tee /tmp/startup.log
