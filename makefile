all:
	sudo mkdir -p /home/web/htdocs/dota
	sudo rm -rf /home/web/htdocs/dota/protected
	sudo mkdir -p /home/web/htdocs/dota/protected/runtime
	sudo cp -r * /home/web/htdocs/dota
	sudo find /home/web/htdocs/dota -name "*.php" -exec sed -i 's/__BUILD_VERSION__/1.1.0/g' {} \;
	sudo chown -R web.deploy /home/web/htdocs/dota
	sudo chmod 777 /home/web/htdocs/dota/assets
	sudo chmod 777 /home/web/htdocs/dota/protected/runtime
