Redovisning
====================================
Kmom05: Bygg ut ramverket. 
------------------------------------
Det tog lite tid att komma på vad jag ville göra. Men så fick jag iden att det skulle vara bra att ha en app som  
 kan visa alla mina databasfiler och då även dess fältnamn och innehåll. En sådan här applikation bör nog vara lösenordsskyddad
i en allmänn webplats. Man kan komma åt allt i datafilerna även lösenord och andra känsliga data. 
 Delar av koden kommer från tidigare kurs
 i OOPHP där jag tittat på sättet att ta hem och ställa upp data för att få till det i tabellform. Resten av koden knåpade 
 jag ihop själv, delvis med hjälp av Sqlite-manualen.   
 Jag började även med lite kod för att skapa nya datafiler men övergav det då jag insåg att tiden 
 inte skulle räcka till. Det får bli ett framtidsprojekt.
På sikt kan den då även användas för att ändra data i filerna samt att skapa nya datafiler med valfria fältnamn. Jag har
 begränsat mig till de förstnämnda funktionerna just nu. 

 
Ett av problemen med att läsa innehållet från databasen var att CdatabaseBasic mm filer i föregående
moment var inriktade på att läsa från en enda datafil vars namn hämtades anonymt från filsystemets namngivning.
Det är nog inte en helt lyckad lösning i ett ramverk som skall vara flexibelt. Jag fick instället använda traditionella SQL-frågor för
att få till det hela. 
  
Gränsnittet lämnar mycket övrigt att önska beträffande design mm men det var väl inte det som var målet med 
detta kursavsnitt.
Paketet är lite förberett för de ovan nämnda utvidgningarna såtillvida att jag vill ha med både
paketen mos/Cform och Database för att få det att funka framöver.  
Det var inte helt enkelt att få till publiceringen men så småningom föll det på sin plats. Att därefter 
uppdatera när jag kompletterade mina filer gick desto lättare.
Det går att testa mot de av mig upplagda extra datafilerna via min navigationsmeny med rubriken Datatabeller. 

Så var det dags att testa genom att ladda hem paketet via Composer. Det gick lätt. På köpet fick jag då med en hel del 
annat i min vendormapp.

[Mitt paket på Packagist: ]( https://packagist.org/packages/roka/dbtable ) 

[Mitt paket på Github: ](https://github.com/roka13/roka.git)

[Denna webplats på Github](https://github.com/roka13/phpmvc.git)