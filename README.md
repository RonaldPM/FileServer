# FileServer
Once this code is hosted on a local server, users can access the index page inorder to upload files like photos, videos, music 
and other types of files into the server. This code could be useful for creating a NAS device using an old computer with enough 
storage.

How to:
1) On a windows system, download and install XAMPP/WAMPP or on a Linux system install LAMPP and then copy these files into the 
HTDOCS folder. Also make sure that max upload file size have been set to a high enough value in your PHP config file inorder to
allow uploading of large files.
2) Connect to the home network and set a static IP for you computer.
3) Once it is done make sure you have enabled in-bound and out-bound rules to enable.
4) Now if you type in the IP address of the now created server on the web browser on any of the devices connected to the LAN,
you will be able to see the web interface and will be able to upload and manage files on the server.

**On Linux based distributions, you might have to manually enable write permissions on the uploads folder for this application to work.**
