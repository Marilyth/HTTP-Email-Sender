# HTTP-Email-Sender
Send emails via an HTTP call through a gmail account, useful for sending backend emails from a frontend website  
Needs [less secure apps access](https://myaccount.google.com/lesssecureapps) to be active for the sendTo email address!

1. Put this script in a place reachable through HTTP, e.g. in your apache `/var/www/html` directory
    ```
    cd /var/www/html
    sudo git clone https://github.com/Marilyth/HTTP-Email-Sender.git
    cd HTTP-Email-Sender
    ```
    
2. Replace the `EmailAddress` and `EmailPassword` within the emailSender.php with your gmail credentials
   ```
   sudo sed -i 's/EmailAddress/email@gmail.com/' emailSender.php
   sudo sed -i 's/EmailPassword/1234/' emailSender.php
   ```

2. If using apache, make sure to install the php mod
    ```
    sudo apt install php libapache2-mod-php -y
    ```

3. Clone PHPMailer into the repo for it to work
    ```
    sudo git clone https://github.com/PHPMailer/PHPMailer
    ```

4. You can now send emails via a POST request, e.g.
    ```
    curl -X POST http://192.168.0.104/HTTP-Email-Sender/emailSender.php -H "Content-Type: application/json" --data \
    '{"sendTo": "baermay98@gmail.com",
     "subject": "Test",
     "body": "Some text within the email"}'
    ```
    Make sure to replace the url with your one
