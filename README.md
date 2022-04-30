# php-mail-sender

![screenshot](screenshot.PNG)

## Setup

- Install xampp server [Download XAMPP](https://www.apachefriends.org/download.html)
- copy content of `htdocs` directory to XAMPP htdocs directory.
- Check below configuration in `php.ini` file

```
[mail function]
; For Win32 only.
; https://php.net/smtp
SMTP=smtp.gmail.com
; https://php.net/smtp-port
smtp_port=587

sendmail_from = <email_id>

sendmail_path ="\"C:\xampp\sendmail\sendmail.exe\" -t"
```

- Check below configuration in `sendmail.ini`

```
[sendmail]

smtp_server=smtp.gmail.com
smtp_port=25

smtp_ssl=auto


error_logfile=error.log

auth_username=<email_id>
auth_password=<generated_password>
```

- configure `less secure app` setting in google account.
- generate password for gmail and add to `sendmail.ini`

## References

[how-to-send-mail-from-localhost-xampp](https://www.thapatechnical.com/2020/03/how-to-send-mail-from-localhost-xampp.html)
