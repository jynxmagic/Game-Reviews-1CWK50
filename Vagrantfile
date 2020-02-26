# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  #machine settings 
  config.vm.box = "hashicorp/bionic64" #this box works with all providers, i use hyperv but it should also work with virtualbox, untested
  config.vm.network "public_network"
  config.vm.synced_folder ".", "/var/www/html", owner: "www-data", group: "www-data", type: "smb",  mount_options: ["vers=3.02","mfsymlinks","dir_mode=0776","file_mode=0775"]
  config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1", id: 'http'


  #speed!!!
  config.vm.provider 'hyperv' do |hyperv|
    hyperv.ip_address_timeout = 600
    hyperv.memory = 1024
    hyperv.maxmemory = 2048
    hyperv.linked_clone = true #speeds up the initial install
    hyperv.cpus = 4 # i have 16 cores now :p (hurray for student loans!)
  end

  ## run vagrant provision to re-run this script ##
  ## this is the install script ran when the machine is first created, or provisioned. install everything we need + extras (i will probably reuse this script) ##
  CONFIGSCRIPT = <<-CONFIGSCRIPT

  sudo killall apt apt-get #if someone restarted the script we need to kill anything they just tried to do

  echo "Replacing ubuntu default mirror with uk mirror..."
  sudo sed -i "s/archive.ubuntu.com/uk.archive.ubuntu.com/" /etc/apt/sources.list ##See https://github.com/Microsoft/WSL/issues/2477

  echo ""
  echo "Updating packages... (might take a while)"
  sudo apt-get update > /dev/null

  echo ""
  echo "Installing git..."
  sudo apt-get install git --fix-missing -y
  echo ""
  echo "Done!"
  
  echo ""
  echo "Installing Nginx..."
  sudo apt-get install nginx --fix-missing -y
  echo ""
  echo "Done!"

  echo ""
  echo "Installing PHP..."
  sudo apt-get install php php-fpm php-mysqlnd --fix-missing -y
  echo ""
  echo "Done!"

  echo ""
  echo "Configuring Nginx to run with PHP-FPM"
  sudo cp /var/www/html/default.conf /etc/nginx/sites-available/default -f
  sudo nginx -t
  sudo service nginx reload
  echo ""
  echo "Done!"

  echo ""
  echo "Install MySql..."
  wget https://dev.mysql.com/get/mysql-apt-config_0.8.10-1_all.deb
  sudo apt install mysql-server --fix-missing -y
  sudo systemctl status mysql
  sudo su #need to be root to run mysql commands - let ubuntu handle auth
  sudo mysql --execute="CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password'"
  sudo mysql --execute="GRANT ALL PRIVILEGES ON *.* TO 'newuser'@'localhost'"
  sudo mysql --execute="FLUSH PRIVILEGES"
  echo ""
  echo "Done!"

  echo ""
  echo "Install NodeJS..."
  sudo apt-get install curl -y
  curl -sL https://deb.nodesource.com/setup_13.x | sudo -E bash -
  sudo apt-get install nodejs
  echo ""
  echo "Done!"

  echo ""
  echo "Configuring firewall..."
  sudo ufw allow http
  sudo ufw allow https
  sudo ufw allow 8080
  sudo ufw allow 1111 #nodejs port :P
  sudo ufw allow 1111/tcp
  sudo ufw allow ssh
  sudo ufw allow ftp
  sudo ufw enable
  sudo ufw reload
  echo ""
  echo "Done!"

  echo "Replacing Apache2 with Nginx on startup >:( ...."
  systemctl disable apache2
  systemctl stop apache2
  systemctl enable nginx
  systemctl start nginx


  echo "You should now find the website at:"

  hostname -I

  echo ""
  echo "No need to add port on the end :P"
  echo "Local changes update vm!"
  
  CONFIGSCRIPT
  
  #provision
  config.vm.provision "shell", inline: CONFIGSCRIPT

end
