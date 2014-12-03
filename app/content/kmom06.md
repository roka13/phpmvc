Redovisning
====================================
Kmom06: Verktyg och CI 
------------------------------------
Jag har ingen som helst tidigare erfarenhet av Phpunit,Travis och Scrutinizer.
Att starta upp konton på Travis och Scrutinizer och få integreringen att fungera var nog det minsta bekymret med kursmomentet.
När man väl fått till ett godkännande av Scrutinizer så får man tillgång till en massa tips och analyser som pekar på alla
dubbleringar av kod och även av outnyttjad kod mm. Det verkar vara en bra genväg för att effektivisera ens kodskrivande och 
känns riktigt bra att arbeta med. I detta moment har jag inte lagt ned någon större möda med att förbättra min kod men 
verktyget ger mycket för att på ett lätt sätt gå vidare.

Phpunit fungerar alldeles utmärkt på BTH-servern men hemmavid har det tagit mycket tid att hjälpligt få till det.
De anvisningar som lämnats för windowssystem är mycket knapphändiga och ger inga entydiga svar på hur man skall få
allt att fungera på ett enkelt sätt. Jag körde igenon Guiden *Börja skriva testfall*
på BTH servern och den uppträdde exakt som guiden gjorde gällande. Däremot fick jag aldrig till ett OK lokalt utan 
det slutade med  
 >*FAILURES!  
Tests: 2, Assertions: 2, Errors: 1.*   
Uppenbart är det något i den tredje testen  testValidationRuleNotFound()   
som inte fungerar som det skall. Det blir även helt olika resultat Code via Coverage  i phpunit på bägge ställena.  
Däremot fungerar det bra mot mina egna tester i min modul.
 
Vid början av testerna för min databasmodul insåg jag att den är tight kopplad till Anax. Det ställde 
till en massa problem vid testerna då hela mitt tillämpningspaket med Anax måste vara med för att få till några tester.
Jag gjorde en egen test på ett modifierat paket där all koppling till ANAX togs bort och där testerna kan köras separat
på en modiferad DbTablesController och en fejk-databas. De tester som utförts är egentligen bara en test att kopplingen till databasen 
fungerar och att all kod täcks in. Resultatet av de här testerna gav ett hyggligt resultat.
  
[Mitt paket på Packagist: ]( https://packagist.org/packages/roka/dbtable )   
[Mitt paket på Github: ](https://github.com/roka13/roka.git)  
[Scrutinzer:](https://scrutinizer-ci.com/g/roka13/roka/)  

Extrauppgift
---------------
Sporrad av att första biten gick bra så integrerade jag  mina tester med hela phpmvc-paketet. Här blev det att tänka efter en hel del
för att initiera erforderliga delar av Anax dels i config-filen samt även i testfilen. Hemmavid fungerade phpunit utan fel men på
Travis gick det sämre. Den hittade inte *\Mos\Database\CDatabaseBasic();* med mindre än att jag fick kopiera upp mos-database paketet
till min mapp app/src.
 Code coverage för min Dbtable i det totala paketet är lika högt som i det enkla testet ovan men totalt dras det ned eftersom
hela Anax är inkluderat med sin 60-talet tester. Här finns mer att göra !

[Denna webplats på Github](https://github.com/roka13/phpmvc.git)  
[Travis](https://travis-ci.org/roka13/phpmvc)  
[Scrutinizer](https://scrutinizer-ci.com/g/roka13/phpmvc/)


