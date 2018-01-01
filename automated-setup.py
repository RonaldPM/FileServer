#automated-install.py
#only for debian distros
import os
import webbrowser
if(os.path.exists("/opt/lampp") or os.path.exists("/var/www")):
    print "Your PC has a local server software installed. Files are to be copied to respective locations"
    choic=raw_input("Wish to continue(y/n)? ")
    if(choic=="y"):
        if(os.path.exists("/opt/lampp")):
            os.system('sudo cp -r ../FileServer /opt/lampp/htdocs && cd /opt/lampp/ && sudo ./xampp start && sudo chmmod -R 777 /opt/lampp/htdocs/FileServer')
            print "Files copied.\nNavigating to http://localhost/FilerServer"
            webbrowser.open('http://localhost/FileServer')
        else:
            os.system('sudo cp -r ../FileServer /var/www/html && sudo service apache2 start && sudo chmmod -R 777 /var/www/html/FileServer')
            print "Files copied.\nNavigating to http://localhost/FilerServer"
            webbrowser.open('http://localhost/FileServer')
    else:
        print "Dropped"
else:
    print "LAMP is not currently installed.."
    choic=raw_input("Wish to install LAMP (y/n)? ")
    if(choic=="y"):
        os.system('wget https://www.apachefriends.org/xampp-files/7.2.0/xampp-linux-x64-7.2.0-0-installer.run')
        os.system('sudo chmod +x xampp-linux*.run')
        os.system('sudo ./xampp-linux*.run')
        print "\nInstallation complete...\nCopying files....\n"
        os.system('sudo cp -r ../FileServer /opt/lampp/htdocs && cd /opt/lampp/ && sudo ./xampp start')
        print "Files copied.\nNavigating to http://localhost/FilerServer"
        webbrowser.open('http://localhost/FileServer')
    else:
        print "Fine. FileServer V1.0 won't work without LAMP running. Dropping the procedure.."
