Kurulum
============

## Yerel Makine

Sırasıyla aşağıdaki yazılımlar kurulmalı ve github token üretilmelidir.

1. Apache, Php, MySQL, PhpMyAdmin ([XAMMP](https://www.apachefriends.org), [WAMP](http://www.wampserver.com/en/) vb.)
2. [Composer](https://getcomposer.org/)
3. [Git](https://git-scm.com/)
4. [GitHub API token](https://github.com/settings/tokens) Generate new token'a tıklayarak yeni bir token oluşturulmalıdır. 

Apache sunucusu DocumentRoot (XAMMP => c:\xammp\htdocs, WAMP => c:\wamp\www) dizini içerisinde yönetici yetkileriyle terminal (komut satırı) açılarak aşağıdaki direktifler uygulanmalıdır.
```bash
git clone https://github.com/kouosl/portal.git portal
cd portal
composer global require "fxp/composer-asset-plugin:^1.3.0"
composer update
```

Proje bağımlılıkları "portal/vendor" dizini altında yüklenecektir. Bu adımda sistem github api token talep edecektir. Başlangıçta üretilen token terminale kopyalanarak yapıştırılmalıdır. Yapıştırıldığında gizlilik nedeniyle token gözükmeyecektir. Onaylayarak (Enter) devam edilmelidir. Yükleme teyit edildikten sonra aşağıdaki direktifler ile Development (geliştirme) modunda proje ayar dosyaları oluşturulur ve yetkileri düzenlenir.
```bash
php init --env=Development --overwrite=All
```

Boş bir veritabanı oluşturulmalıdır. Veritabanı terminal veya http://localhost/phpmyadmin adresinden erişilebilen web tabanlı veritabanı yönetim sistemi ile oluşturulabilir. Oluşturulan veritabanına ait veriler aşağıdaki ayar dosyasında tanımlanmalıdır.
```
@portal/common/config/main-local.php 
```

Veritabanı ayarları düzenlendikten sonra migration (veritabanı aktarım) işlemleri gerçekleştirilmelidir.
```
php yii migrate --migrationPath=@vendor/kouosl/user/migrations --interactive=0
php yii migrate --migrationPath=@vendor/kouosl/sample/migrations --interactive=0
```

Apache sunucusunun dizini altındaki httpd-vhosts.conf dosyası
Proje kurulumundan sonra apachenin vhost dosyasında "NameVirtualHost *:80" ifadesinin yorum satırı kaldırılmalı ve  sonuna aşağıdaki direktifler eklenerek apache tekrar başlatılmalıdır. VirtualHost ayarlarında "$DocumentRoot" bölümüne apache server kök dizini yazılmalıdır.

- XAMMP => `c:/xammp/htdocs`
- WAMP  => `c:/wamp/www`
   
```
...
NameVirtualHost *:80
...
<VirtualHost *:80>
    ServerName portal.kouosl
       
    ServerAdmin webmaster@localhost
    DocumentRoot "$DocumentRoot/portal"
       
    ErrorLog logs/kouosl-error.log
    CustomLog logs/kouosl.log combined	
       
    <Directory "$DocumentRoot/portal">
        AllowOverride All
    </Directory>
</VirtualHost>
```

Yerel makine üzerinde portal.kouosl şeklinde erişim için hosts dosyasına geliştirme alan adı tanımlanmalıdır.

- Windows: `c:\Windows\System32\Drivers\etc\hosts`
- Linux: `/etc/hosts`

```
127.0.0.1   portal.kouosl
```

Kurulumu tamamlandıktan sonra aşağıdaki bağlantılardan uygulamaya erişilebilir.
* frontend: http://portal.kouosl/ 
* backend: http://portal.kouosl//admin
* api: http://portal.kouosl/api

## Sanal Makine (Vagrant)

Sırasıyla aşağıdaki yazılımlar kurulmalı ve github token üretilmelidir.

1. [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. [Vagrant](https://www.vagrantup.com/downloads.html)
3. [Git](https://www.git-scm.com)
4. [GitHub API token](https://github.com/settings/tokens) Generate new token'a tıklayarak yeni bir token oluşturulmalıdır. 
5. Yönetici yetkileriyle terminal (komut satırı) açılarak aşağıdaki direktifler uygulanmalıdır.
   
```bash
vagrant plugin install vagrant-hostmanager
git clone https://github.com/kouosl/portal.git portal 
```

6. Aşağıdaki diinde bulunan vagrant-local.example.yml dosyasının vagrant-local.yml adıyla kopyası oluşturulmalıdır. 
```
@portal/vagrant/config 
```

7. GitHub api tokenı `vagrant-local.yml` dosyasında aşağıdaki şekilde tanımlanmalıdır.
```
....
github_token: qy6uuqııq8ııqooqwuw78qııqowksjjeoow9oowlw
....
```

8. Vagrant makina çalıştırılarak kurulum başlatlır. Komut portal dizininin içinde çalıştırılmalıdır.
```bash
vagrant up
```
   
Vagrant makina kurulumu tamamlandıktan sonra aşağıdaki bağlantılardan uygulamaya erişilebilir.
* frontend: http://portal.kouosl/ 
* backend: http://portal.kouosl//admin
* api: http://portal.kouosl/api

Terminal'den (komut satırı) sanal makinaya SSH erişimi için;
```bash
vagrant ssh
```
   
Hariçi bir programla (putty vb.) ssh bağlantısı için bilgiler;
* ip : 192.168.83.137
* user : vagrant
* password : vagrant
