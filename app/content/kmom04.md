Redovisning
====================================
Kmom04: Databasdrivna modeller. 
------------------------------------

Länk till Användare: http://www.student.bth.se/~roka13/phpmvc/webroot/Users/list  

 Jag följde tutorialen för formulär och det var inga större problem. De dök istället upp då jag ville modifiera
 texten på knapparna. Helt plötsligt ville ingenting fungera men genom att gå igenom källkoden gick det så småningom
 upp ett ljus hur man skulle göra. Jag använde det sedan då jag ordnade till ett formulär för uppdatering av kommentarerna.  
 Ibland känns det lättare att själv göra formulären direkt men det kan ju vara att man är ovan på det här sättet. Det finns
 en tröskel man måste över innan det går någorlunda smärtfritt.   
 Det där med att installera paket via composer är inte helt lätt. Det gäller ju att få till composer.json-filen rätt 
med alla kommatecken på rätt plats mm. Det tog några försök innan det satt som det skulle utan att några 
gamla paket försvann.  
Jag har samlat några tester av CForm under min meny Extrauppgifter.
Det är ganska lätt att få till Query:s med det visade gränssnittet. Jag skapade och testade databashanteringern lokalt med både
SQLite och MySql men valde sedan att gå vidare med SQLite. Databaserna lade jag in ovanför webroot i en egen DATA-katalog.
CDatabaseModel kompletterades med en OrderBy-function. Min modell för Users verkade vara bra att placera under app/src.  
I stort var det bara att följa anvisningarna för att skapa och ordna klasserna för användare. Utmaningen var att få till  
vyerna. Här ville jag att istället för direkta länkar få knappar att trycka på för länkningen.  Det verkade lätt till början.
jag lade bara in en button innanför en a-tagg. Det funkar bra i praktiken men validerar inte när det är dags för det.
Så det blev att tänka om. Det är tur att google finns, där fann jag lösningen direkt utan att dyka ner i litteraturen. Lösningen blev
att varje knapp bakades in innanför en form-tagg med action= url samt method =get. Användarna kan vad jag förstod ha följande
status: Aktiv, Avaktiverad ,softdeleted(dvs i papperskorg) eller definitivt borttagen(ej återvinningsbar).  Istället för att köra 
en massa tester på om de har ett datum eller inte så tillfördes ett databasfält status som visar de tre kategorierna. Då blev det lätt
att i redigeringsmenyn visa bara de knappar som kan var aktuella beroende på status genom en switch-case sats. Villkor för ett 
slutligt borttag ur databasen är att användaren redan ligger i papperskorgen.  
För kommentarena blev det en total ombearbetning av min CommentsController. Här lade jag in ett Cform -formulär  för uppdatering 
av en befintlig kommentar och även skapandet av en ny tabell comments.Det här innebar att den gamla CommentController i föregånde kursmoment
blev helt överflödig tillsammans med CommentSession.php. De dubbla kontrollerna i Index-filen kan då också slopas. I databastabellen lagras
vilken sida kommentaren härrör ifrån under 'page'. Då kan man lätt sortera ut de kommentarer som tillhör en viss websida.  
Någon extrauppgift med Scaffolding räcker tiden inte till för.

Mitt arbete finns även på Github https://github.com/roka13/phpmvc.git

 

 

 
.