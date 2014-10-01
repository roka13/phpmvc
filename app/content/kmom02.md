Redovisning
====================================
Kmom02: Kontroller och Modeller
------------------------------------
Började detta moment med att läsa igenom alla hänvisningar till Artiklar och blev kanske lite klokare av det.  
Att köra PHP via MSDOSprompten påminner om den gamla tiden med Programmering i basic för MS-dos samt de övriga kommandon man använde då.  
Installationen på den egna servern fungerade lätt om man följde anvisningarna i tutorialen.
Att köra Composer via putty på studentservern efter anvisningarna fungerade utmärkt. Däremot blev det en del problem då det saknades en del i min wampserver.
 Men efter att ha följt trådarna i diskussionsforumet och öppnat för ssl samt hittat och ändrat i min globala PHP.ini-fil under windows fick jag det att
 fungera även med Packagist och composer.json. Det kändes smidigt att så lätt få in  ett helt paket i projektet. Jag har bara ägnat en kort stund till att se igenom innehållet
 i Packagist. Det tycks ju finnas hur mycket som helst som är användbart. Det kräver nog lite mer tid att se vad som kan vara vettigt att inkludera.   
 Att använda klasser som kontroller var inte helt främmande men det är inte lätt att följa trådarna i ramverket än även om det börjar lossna lite grann.  
 Det svåraste är att hålla rätt på namngivningen så att länkningen skall fungera. Det är lite svårt att greppa att själva ramverket ändrar och lägger  till 
 på filnamnen. Det är väl bara att lära sig hur.  
Jag skapade själv två nya klasser under app/src/Comments. CommentsController.php samt CommentsSession.php 
 I dessa har jag fångat upp de metoder som saknades i de inkluderade under vendor/phpmvc. Skälet är att jag inte ville ändra i de ordinarie filerna om man 
 i framtiden vill uppdatera dem via composer. Då skrivs mina egna tillägg över. Jag försökte först att de skulle ärva från orginalen men lyckades inte riktigt
 med det så istället fick det bli så att de initierades  i index.php med ytterligare en $di->set(CommentsController), etc utöver den ursprungliga.  
 Här vet jag nog inte riktigt vad jag gjorde men jag fick det att fungera fullt ut på  alla sidor. Det sämsta var nog att jag valt snarlika namn på controllerna.
 Det blir lite svårt att skilja på comment och comments i Templatefilerna.  
 Så får man då så småningom allt att fungera bra på hemmaservern men på BTH dyker det omedelbart upp ett felmeddelande om Header already sent etc. Letar då   
 igenom samtliga filer och kollar sluttaggar mm men lyckats inte se felet. Ett nödrop på forumet ger den enkla förklaringen 'Du har kodat i UTF med BOM'  
 Javisst hade jag det i några filer efter en uppdatering av Notepad som ändrat min inställning.  Felet var löst men kostade en hel del tid i felsökning.  
 Det är på sånt här man ser att man fortfarande är ganska grön på programmering.
 
 
Mitt arbete finns även på Github https://github.com/roka13/phpmvc.git

 

 

 
.