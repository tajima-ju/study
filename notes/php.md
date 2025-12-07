## 文字をためる  
複数行書く場合
```php
file_put_contents("test.txt", "Hello");
file_put_contents("test.txt", "World");
```
これでは上書きになる。  
よって
```php
$text = "Hello";
$text .= "World";
file_put_contents("test.txt", $text);
```
内部に文字を格納（貯める）するのに.+をもちいる
---