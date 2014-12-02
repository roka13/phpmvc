Redovisning
====================================
Kmom06: Verktyg och CI 
------------------------------------
Phpunit fungerar alldeles utmärkt på BTH-servern men hemmavid har det tagit mycket tid att hjälpligt få till det.
De anvisningar som lämnats för windowssystem är mycket knapphändiga och ger inga entydiga svar på hur man skall få
allt att fungera på ett enkelt sätt. Jag körde igenon Giuden Börja skriva testfall på BTH servern och den uppträdde exakt
som guiden gjorde gällande. Däremot fick jag aldrig till ett OK lokalt utan det slutade med FAILURES och med
> PHPUnit 4.3.5 by Sebastian Bergmann.
.E  
Time: 72 ms, Memory: 2.25Mb  
There was 1 error:  
1) Mos\HTMLForm\CFormElementTest::testValidationRuleNotFound  
Missing argument 2 for Mos\HTMLForm\CFormElement::validate(),  
 called in C:\wamp\www\phpmvc\unitttests\cform\test\HTMLForm\CFormElementTest.php on line 47 and defined  
C:\wamp\www\phpmvc\vendor\mos\cform\src\HTMLForm\CFormElement.php:325  
C:\wamp\www\phpmvc\unitttests\cform\test\HTMLForm\CFormElementTest.php:47  
FAILURES!  
Tests: 2, Assertions: 2, Errors: 1.  
Uppenbart är det något i den tredje testen  
> testValidationRuleNotFound()   
 som inte fungerar under windows. Det blir även helt olika resultat Code via Coverage på bägge ställena.
 
Vid början av testerna för min databasmodul insåg jag at den är på tok för tight kopplad till Anax. Det ställde 
till en massa problem vid testerna då hela mitt tillämpnignpaket med Anax måste vara med för att få till några tester.
Övervägar därför att göra om modulen till en självständig sådan som i sin tur kan utnyttjaas av Anax.
  

[Mitt paket på Packagist: ]( https://packagist.org/packages/roka/dbtable ) 

[Mitt paket på Github: ](https://github.com/roka13/roka.git)

[Denna webplats på Github](https://github.com/roka13/phpmvc.git)


