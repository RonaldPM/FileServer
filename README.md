# FileServer
An open source PHP/HTML Code that can run on a local server which can be used for file sharing over it's network.
Once this code is hosted on a local server, users can access it inorder to upload files like photos, videos, music 
and other types of files into the server.

How to:

WINDOWS PC
1) Download and install XAMPP/WAMPP and then copy these files into the HTDOCS folder. 

LINUX PC
1) Install LAMP (https://linode.com/docs/web-servers/lamp/ ) or XAMPP (https://www.wikihow.com/Install-XAMPP-on-Linux).
2) If LAMP collection is installed, copy the files to /var/www/html and if it is XAMPP copy the files to /opt/lampp/htdocs
3) Give rights to the respective folder using the command 
    
    sudo chmod -R 777 location-where-the-files-are-placed
    
Make sure that max upload file size have been set to a high enough value in your PHP config file inorder to allow uploading of large files.

Connect to the home network and set a static IP for you computer.

(Windows) Once it is done make sure you have enabled in-bound and out-bound rules to enable.

Now if you type in the IP address of the now created server on the web browser on any of the devices connected to the LAN,
you will be able to see the web interface and will be able to upload files to the server.


-----------------------------------------------

AUTOMATED SETUP FOR LINUX DEBIAN DISTROS

This is a python script which sets up everything required for the FileServer. 

Using this script:
Open terminal in the folder FileServer (after Cloning or downloading and extracting the zip) and execute the python script. That's it.

-----------------------------------------------

ACCESSING DEVELOPER MODE

To the right top, there is a link to get info or server statistics. There, on the host machine, will be a option to switch between normal mode and develper mode.

-----------------------------------------------

Developed by : @RonaldPM

Contribution : @ucatt
