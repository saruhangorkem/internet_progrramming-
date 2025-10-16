# Bölüm 1: Genel İnternet Programlama Soruları
### 1. İnternetin temel çalışma prensibini kısaca açıklayınız.

İnternet, cihazlar arasında veri alışverişini sağlayan küresel bir ağ sistemidir.
Veriler, TCP/IP protokolü aracılığıyla küçük paketler halinde gönderilir ve alıcıda tekrar birleştirilir.
Temel mantık: istemci (client) bir istekte bulunur, sunucu (server) bu isteğe yanıt verir.

### 2. IP adresi ve DNS arasındaki farkı açıklayınız.

IP Adresi: Cihazların internetteki sayısal kimliğidir (örnek: 192.168.1.1 veya 2001:db8::1).

DNS (Domain Name System): Alan adlarını IP adreslerine çevirir.
Örneğin, www.google.com → 142.250.74.14.

### 3. TCP ve UDP arasındaki farkları belirtiniz.
Özellik	TCP	UDP
Bağlantı Türü	Bağlantı tabanlı	Bağlantısız
Güvenilirlik	Verinin tamamı doğru ulaştırılır	Paket kaybı olabilir
Hız	Daha yavaş	Daha hızlı
Kullanım Alanı	Web, e-posta	Oyunlar, canlı yayınlar
4. HTTP protokolü hangi katmanda çalışır ve temel özellikleri nelerdir?

Katman: Uygulama katmanında çalışır.

Özellikleri:

İstemci-sunucu modelini kullanır.

Statelesstir (her istek bağımsızdır).

Temel komutları: GET, POST, PUT, DELETE.

5. Web tarayıcıları nasıl çalışır? Bir web sayfasını yükleme sürecini adım adım açıklayınız.

Kullanıcı adres çubuğuna bir URL yazar.

Tarayıcı DNS üzerinden alan adının IP adresini çözer.

Tarayıcı, HTTP isteği gönderir.

Sunucu isteğe yanıt verir (HTML, CSS, JS dosyaları).

Tarayıcı bu dosyaları işler, DOM ağacını oluşturur.

Sayfa render edilir ve kullanıcıya gösterilir.

6. Frontend ve Backend arasındaki fark nedir? Örneklerle açıklayınız.

Frontend: Kullanıcının gördüğü arayüz kısmıdır. (HTML, CSS, JavaScript)
Örnek: Butonlar, formlar, menüler.

Backend: Sunucu tarafıdır; veri işlemleri, veritabanı yönetimi yapılır. (PHP, Python, Node.js)
Örnek: Kullanıcı giriş sistemi, veri kaydetme işlemleri.

7. JSON ve XML arasındaki farkları açıklayınız.
Özellik	JSON	XML
Biçim	Daha sade, okunabilir	Daha karmaşık, etiket bazlı
Veri Türleri	Sayı, string, boolean	Tümü metin tabanlı
Kullanım	Modern API’lerde yaygın	Eski sistemlerde yaygın
Örnek	{ "ad": "Ali" }	<ad>Ali</ad>
8. Restful API nedir? Ne amaçla kullanılır?

RESTful API, HTTP üzerinden veri alışverişi yapan bir web servis türüdür.
Veriler genellikle JSON formatında taşınır.
Amaç: Farklı sistemler arasında standart, hızlı ve basit iletişim kurmaktır.

9. Güvenli internet iletişimi için kullanılan HTTPS protokolünün avantajlarını açıklayınız.

Veriler SSL/TLS ile şifrelenir.

Kimlik doğrulama yapılır, sahte sitelere karşı koruma sağlar.

Veri bütünlüğü korunur, manipülasyon engellenir.

10. Çerezler (Cookies) nedir? Web sitelerinde nasıl kullanılır?

Kullanıcının tarayıcısında saklanan küçük veri dosyalarıdır.
Amaçları:

Oturum bilgisini hatırlamak

Kullanıcı tercihlerini kaydetmek

Analitik veya reklam takibi yapmak

# Bölüm 2: HTML ve CSS Örnek Soruları
### 1. Aşağıdaki HTML kodunun çıktısını tahmin ediniz.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Örnek Sayfa</title>
</head>
<body>
    <h1>Merhaba Dünya!</h1>
    <p>Bu bir paragraf.</p>
    <a href="https://www.google.com">Google'a git</a>
</body>
</html>
```


Çıktı:

Başlıkta: “Örnek Sayfa”

Sayfa içinde:

Büyük yazıyla “Merhaba Dünya!”

Altında “Bu bir paragraf.”

Ve “Google’a git” yazan bir bağlantı.

### 2. <div> ve <span> etiketleri arasındaki farkı açıklayınız.

<div>: Blok düzeyinde elementtir; tüm satırı kaplar.

<span>: Satır içi (inline) elementtir; yalnızca içerdiği kadar yer kaplar.
Örnek:

<div>Bu bir blok</div>
<span>Bu satır içi</span>

### 3. HTML’de form elemanlarından en az 5 tanesini açıklayınız.
Eleman	Açıklama

`<input>`	Kullanıcıdan veri girişi alır.

`<textarea>`	Çok satırlı metin kutusu.

`<select>`	Açılır liste oluşturur.

`<option>`	Liste içindeki seçeneklerdir.

`<button>`	Buton oluşturur.

### 4. CSS’te ID ve Class seçicilerinin farkı nedir? Örnek kod veriniz.

ID (#): Sayfada tekil öğeler için kullanılır.

Class (.): Birden fazla öğede kullanılabilir.
```html 
#baslik { color: blue; }
.kutu { background-color: gray; }
```

Aşağıdaki CSS kodu hangi elementlere uygulanır?
```html
p {
    color: red;
    font-size: 16px;
}
```


 Bu kod tüm `<p>` etiketlerine uygulanır. Yazı kırmızı olur, font boyutu 16 piksel olur.

### 5. HTML5’te yeni gelen en az 3 etiketi açıklayınız.

`<header>` → Sayfa başlığı alanı

`<section>` → İçerik bölümü

`<article>` → Bağımsız içerik yazısı

`<footer>` → Alt bilgi bölümü

`<nav>` → Menü veya gezinme çubuğu

### 6. CSS Flexbox ile bir div öğesini yatay ve dikey olarak nasıl ortalarsınız?
```html 
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
 ```
### 7. Responsive web tasarım nedir? Örnek bir CSS media query yazınız.

Responsive tasarım, sitenin farklı ekran boyutlarına uyum sağlamasıdır.
 ```html 
@media (max-width: 768px) {
  body {
    background-color: lightgray;
  }
}
``` 

### 8. HTML tablolarında satır ve sütunları birleştirmek için hangi etiketler kullanılır?

Satır birleştirme → rowspan

Sütun birleştirme → colspan
```html 
<td rowspan="2">Birleşik Hücre</td>
```

### 9. CSS ile bir butona hover efekti nasıl eklenir? Örnek kod yazınız.
```html
button:hover {
  background-color: blue;
  color: white;
}
```



 Fare butonun üzerine gelince arka plan mavi, yazı beyaz olur.

# Bölüm 3: Ağ Protokolleri ile İlgili Sorular
### 1. HTTP ve HTTPS arasındaki temel farkları açıklayınız.
Özellik	HTTP	HTTPS
Güvenlik	Şifreleme yok	SSL/TLS ile şifreli
Port	80	443
Kullanım	Normal veri aktarımı	Güvenli veri aktarımı
### 2. FTP nedir? Hangi amaçlarla kullanılır?

FTP (File Transfer Protocol): Dosya aktarım protokolüdür.
Amaç: Sunucuya dosya yüklemek veya indirmek (örnek: web site dosyaları).

### 3. SMTP ve POP3 protokolleri arasındaki farkı açıklayınız.
Özellik	SMTP	POP3
Görevi	E-posta gönderme	E-posta alma
Çalışma	Sunucudan başka bir sunucuya iletir	Sunucudan kullanıcıya indirir
### 4. DNS nedir? Çalışma mantığını kısaca anlatınız.

DNS (Domain Name System), alan adlarını IP adresine dönüştürür.
Kullanıcı google.com yazdığında, DNS sunucusu bu adresin IP’sini bulur ve tarayıcıya iletir.

### 5. DHCP protokolü ne işe yarar?

DHCP (Dynamic Host Configuration Protocol), cihazlara otomatik IP adresi atar.
Manuel ayarlamaya gerek kalmaz.

### 6. HTTP 404 ve HTTP 500 hata kodları ne anlama gelir?

404: İstenen sayfa bulunamadı.

500: Sunucu hatası (sunucu isteği işleyemedi).

### 7. Telnet ve SSH arasındaki farkı açıklayınız.
Özellik	Telnet	SSH
Güvenlik	Şifresiz	Şifreli (güvenli)
Kullanım	Eski sistemlerde	Modern sistemlerde
Port	23	22
### 8. VPN nedir ve hangi amaçlarla kullanılır?

VPN (Virtual Private Network), internet trafiğini şifreli tünel üzerinden yönlendirir.
Amaç: Güvenli bağlantı kurmak, IP gizlemek, yasaklı sitelere erişmek.

### 9. WebSockets nedir? Nasıl çalışır?

WebSocket, istemci ile sunucu arasında çift yönlü (real-time) iletişim kuran bir protokoldür.
HTTP’den farkı: Sürekli açık bir bağlantı sağlar (örneğin canlı sohbet, oyunlar).

### 10. CDN (Content Delivery Network) nedir? Web sitelerinde nasıl kullanılır?

CDN, içeriği coğrafi olarak dağıtılmış sunucularda barındırır.
Kullanıcıya en yakın sunucudan içerik gönderilir → yüklenme hızı artar, gecikme azalır.