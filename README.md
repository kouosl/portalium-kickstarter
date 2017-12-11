Kurulum
============

## Yerel Makine

Sırasıyla aşağıdaki yazılımlar kurulmalıdır.

1. Apache, Php, MySQL, PhpMyAdmin (XAMMP, WAMP vb.)
2. Composer (getcomposer.org)
3. Git (git-scm.com)

Apache sunucusu DocumentRoot (XAMMP => c:\xammp\htdocs, WAMP => c:\wamp\www) dizini içerisinde yönetici yetkileriyle terminal (komut satırı) açılarak aşağıdaki direktifler uygulanmalıdır.
   ```
   git clone https://github.com/kouosl/app.git kouosl-app
   ```

Proje klon dizinine geçiş yapıpılarak composer eklentileri ve proje bağımlılıkları indirilmelidir.
   ```
   cd kouosl-app
   composer global require "fxp/composer-asset-plugin:^1.3.0"
   composer update
   ```

Proje bağımlılıkları "kouosl-app/vendor" dizini altında yüklenecektir. 
Yükleme teyit edildikten sonra aşağıdaki direktifler ile Development (geliştirme) modunda proje ayar dosyaları oluşturulur ve yetkileri düzenlenir.
   ```
   php init --env=Development --overwrite=All
   ```

Boş bir veritabanı oluşturulmalıdır. Veritabanı terminal veya http://localhost/phpmyadmin adresinden erişilebilen web tabanlı veritabanı yönetim sistemi ile oluşturulabilir. Oluşturulan veritabanına ait veriler aşağıdaki ayar dosyasında tanımlanmalıdır.
   ```
   kouosl-app/common/config/main-local.php 
   ```

Veritabanı ayarları düzenlendikten sonra migration (veritabanı aktarım) işlemleri gerçekleştirilmelidir.
   ```
   php yii migrate --migrationPath=@vendor/kouosl/user/migrations --interactive=0
   php yii migrate --migrationPath=@vendor/kouosl/sample/migrations --interactive=0
   ```

Apache sunucusunun  @apache_kurulum_dizini/conf/extra/ dizini altındaki ilgili vhosts dosyası
Proje kurulumundan sonra apachenin vhost dosyasının sonuna aşağıdaki direktifler eklenerek apache tekrar başlatılmalıdır. "$DocumentRoot" bölümüne apache server kök dizinini yazınız.

    - XAMMP => `c:/xammp/htdocs`
    - WAMP  => `c:/wamp/www`
   ```
    ...
    NameVirtualHost *:80
    ...
   <VirtualHost *:80>
       ServerName kouosl-app.dev
       
       ServerAdmin webmaster@localhost
       DocumentRoot "/$DocumentRoot/kouosl-app"
       
       ErrorLog /logs/kouosl-error.log
       CustomLog /logs/kouosl.log combined	
       
       <Directory "/$DocumentRoot/kouosl-app">
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

Tarayıcıya http://kouosl-app.dev yazıldığı zaman projenin önyüz(frontend), 
http://kouosl-app.dev/admin yazıldığı zaman ise yönetim paneli (backend),
http://kouosl-app.dev/api yazıldığında ise de api ye erişim sağlanmaktadır.

## Sanal Makine (Vagrant)

Sırasıyla aşağıdaki yazılımlar kurulmalıdır.

1. [VirtualBox](https://www.virtualbox.org/wiki/Downloads) (Son Sürüm)
2. [Vagrant](https://www.vagrantup.com/downloads.html) (Son sürüm)
3. GitHub [personal API token](https://github.com/blog/1509-personal-api-tokens) Oluşturulması
3. Yönetici yetkileriyle terminal (komut satırı) açılarak aşağıdaki direktifler uygulanmalıdır.
   
   ```bash
   vagrant plugin install vagrant-hostmanager
   git clone https://github.com/kouosl/app.git kouosl-app
   cd kouosl-app/vagrant/config
   cp vagrant-local.example.yml vagrant-local.yml
   ```
   
4. GitHub personal API tokenı `vagrant-local.yml` dosyasındaki yerine yapıştırın.
    ```
    ....
    github_token: qy6uuqııq8ııqooqwuw78qııqowksjjeoow9oowlw
    ....
    ```

5. Proje dizinine tekrar gelin
   ```bash
   cd kouosl-app
   ```

5. Vagrant makinayı çalıştırın
   ```bash
   vagrant up
   ```
   
Vagrant makina kurulumu tamamlandıktan sonra
* frontend: http://kouosl-app.dev
* backend: http://kouosl-app.dev/admin
* api: http://kouosl-app.dev/api

ile erişilebilir

Cmd ile makinaya SSH erişimi için
   ```bash
   vagrant ssh
   ```
   
Hariçi bir programla ssh bağlantısı için bilgiler
* ip : 192.168.83.137
* user : vagrant
* password : vagrant
