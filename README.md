Kurulum
============

## Yerel Makine

Sırasıyla aşağıdaki yazılımlar kurulmalı ve github token üretilmelidir.

1. Apache, Php, MySQL, PhpMyAdmin ([XAMMP](apachefriends.org), [WAMP](wampserver.com) vb.)
2. [Composer](https://getcomposer.org/)
3. [Git](https://git-scm.com/)
4. [GitHub API token](https://github.com/blog/1509-personal-api-tokens)

Apache sunucusu DocumentRoot (XAMMP => c:\xammp\htdocs, WAMP => c:\wamp\www) dizini içerisinde yönetici yetkileriyle terminal (komut satırı) açılarak aşağıdaki direktifler uygulanmalıdır.
```bash
git clone https://github.com/kouosl/portal.git kouosl-app
cd kouosl-app
composer global require "fxp/composer-asset-plugin:^1.3.0"
composer update
```

Proje bağımlılıkları "kouosl-app/vendor" dizini altında yüklenecektir. Bu adımda sistem github api token talep edecektir. Başlangıçta üretilen token terminale kopyalanarak yapıştırılmalıdır. Yapıştırıldığında gizlilik nedeniyle token gözükmeyecektir. Onaylayarak (Enter) devam edilmelidir. Yükleme teyit edildikten sonra aşağıdaki direktifler ile Development (geliştirme) modunda proje ayar dosyaları oluşturulur ve yetkileri düzenlenir.
```bash
php init --env=Development --overwrite=All
```

Boş bir veritabanı oluşturulmalıdır. Veritabanı terminal veya http://localhost/phpmyadmin adresinden erişilebilen web tabanlı veritabanı yönetim sistemi ile oluşturulabilir. Oluşturulan veritabanına ait veriler aşağıdaki ayar dosyasında tanımlanmalıdır.
```
@kouosl-app/common/config/main-local.php 
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
    ServerName kouosl-app.dev
       
    ServerAdmin webmaster@localhost
    DocumentRoot "$DocumentRoot/kouosl-app"
       
    ErrorLog logs/kouosl-error.log
    CustomLog logs/kouosl.log combined	
       
    <Directory "$DocumentRoot/kouosl-app">
        AllowOverride All
    </Directory>
</VirtualHost>
```

Yerel makine üzerinde kouosl-app.dev şeklinde erişim için hosts dosyasına geliştirme alan adı tanımlanmalıdır.

- Windows: `c:\Windows\System32\Drivers\etc\hosts`
- Linux: `/etc/hosts`

```
127.0.0.1   kouosl-app.dev
```

Kurulumu tamamlandıktan sonra aşağıdaki bağlantılardan uygulamaya erişilebilir.
* frontend: http://kouosl-app.dev
* backend: http://kouosl-app.dev/admin
* api: http://kouosl-app.dev/api

## Sanal Makine (Vagrant)

Sırasıyla aşağıdaki yazılımlar kurulmalı ve github token üretilmelidir.

1. [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. [Vagrant](https://www.vagrantup.com/downloads.html)
3. [Git](git-scm.com)
4. [GitHub API token](https://github.com/blog/1509-personal-api-tokens)
5. Yönetici yetkileriyle terminal (komut satırı) açılarak aşağıdaki direktifler uygulanmalıdır.
   
```bash
vagrant plugin install vagrant-hostmanager
git clone https://github.com/kouosl/portal.git kouosl-app
```

6. Aşağıdaki diinde bulunan vagrant-local.example.yml dosyasının vagrant-local.yml adıyla kopyası oluşturulmalıdır. 
```
@kouosl-app/vagrant/config
```

7. GitHub api tokenı `vagrant-local.yml` dosyasında aşağıdaki şekilde tanımlanmalıdır.
```
....
github_token: qy6uuqııq8ııqooqwuw78qııqowksjjeoow9oowlw
....
```

8. Vagrant makina çalıştırılarak kurulum başlatlır.
```bash
vagrant up
```
   
Vagrant makina kurulumu tamamlandıktan sonra aşağıdaki bağlantılardan uygulamaya erişilebilir.
* frontend: http://kouosl-app.dev
* backend: http://kouosl-app.dev/admin
* api: http://kouosl-app.dev/api

Terminal'den (komut satırı) sanal makinaya SSH erişimi için;
```bash
vagrant ssh
```
   
Hariçi bir programla (putty vb.) ssh bağlantısı için bilgiler;
* ip : 192.168.83.137
* user : vagrant
* password : vagrant
