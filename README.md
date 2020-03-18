#Setup
<br>
Please change the values found in config.json to values which you use. This should be the only configuration required, no configuration is required within the different frameworks' configuration themselves.
<br><i>config.json</i>
<br>Please ensure that the host is set to either A) webserver dns B) webserver ip address or C) localhost. No slashes.
<br>The path variable should be changed to the relative document root within the webserver itself.
<br>The port should be the port with which the webserver is listening on
<br>Index page should be index.php, unless a different index is defined or the webserver automatically routes requests here
<br>The Node_host configuration value contains the url with which the FRONT END will connect to, feel free to change the port.
<br>Ensure that the mysql user/pass is correct, along with the database, which defaults to gamereview, & port.