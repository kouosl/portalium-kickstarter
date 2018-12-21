Otomatik Kurulum (Ubuntu 18.04)
============

## Kuruluma başlamadan önce

1. https://github.com/settings/tokens adresinden Generate new token'a tıklayarak yeni bir token oluşturulmalıdır.
2. Oluşturulan token bilgisayara istenilen konumda istenilen isimde .txt uzantılı olarak kayıt edilmedilir (.txt içinde sadece key olması gerekli)
3. Kurulum için kouslPortal.sh doyası ve Github api token'i kaydettiğiniz dosyanın konumu gereklidir.

## Kurulum için

github api key'i key.txt olarak /home/UserName/Desktop/key.txt konumuna kaydettiyseniz aşağıdaki komutu kouslPortal.sh dosyasının bulunduğu konumda çalıştırmanız yeterli olucaktır.

```bash
./kouslPortal.sh /home/UserName/Desktop/key.txt
```
