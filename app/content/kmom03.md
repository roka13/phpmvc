Redovisning
====================================
Kmom03: Bygg ett tema
------------------------------------
CSS ramverk vet jag bara lite om sedan tidigare. Eftersom jag bytte kursordning blev jag tvungen att titta en del på LESS 
i föregångaren av denna kurs för att kunna tillämpa det i Javascriptdelen. Det blev mycket enklare när man kan slå ihop
många Less'filer och skapa en egen ny CSS med hjälp av lessphp och style.less. Risken är som också påpekades att man råkar
ut för en massa motstridiga inställningar i de olika filerna. Det blev en hel del kontroll och upprättning av sådana fel
för att få det som jag ville.   
   
Det är bra att kunna samla alla grundinställningarna i en egen fil 'variables'.  Det är då mycket lätt att ändra de 
övergripande inställningarna. Men sedan har man två filer med likartad innehåll 'typography' och 'structure'. De innehåller
delvis samma inställningar och borde kunna slås samman som en enhetlig fil med allt innehåll.  
Det blir enkelt att få till en bra layout om den görs gridbaserad. Man kan lägga ut innehåll i de olika delarna på ett enkelt
sätt. Tidigare användes frames och senare även tabeller för att få till en struktur men den blev ofta ganska begränsad
och krävde en hel del trixande för att få till det bra.  
Jag har bara sneglat lite på Font Awesome, Bootstrap och Normalize.  Normalize kan vara bra för att få till ett likartat
utseende i olika webläsare.  Font Awesome har en del kul detaljer men det är nog inget som jag kommer att använda i 
någon större omfattning. Delar av Bootstrap är redan inkluderat i mixins, med flera av lessfilerna i vårt övningsunderlag.
Det finns en del till man kan ha nytta av men inget är inlagt ännu.   
I mitt eget tema har jag lekt lite med inplacering av en del egna foton bara för att kunna se hur de går att få in i webbsidan.
Jag la ett ID på  'body' för att lägga in en bakgrund på hela webbsidan. För att lätt kunna ändra upplägget på denna sida har 
jag skapat en egen stylefil 'svalbard.less' eftersom bildena är därifrån. I den har varje region fått sin egen bakgrund och 
slutlig höjdinställning för att det skall rimma med bildernas storlek.  Denna Lessfil läggs in i Index.php under den flik där 
jag vill ha det temat. ($app->theme->addStylesheet('css/anax-grid/svalbard.less'); ).  Denna metod ger emellertid inget utrymme
för att utnyttja grundinställningarna i variables.less, då den inte implementeras i less.css. Om man istället lägger till den
som en import i style.less kan man utnyttja variables.less grundinställningar. Då kommer samtliga sidor som använder index.tpl.php
att få samma grundtema.  
Min tanke var att styla om hela min webbplats efter detta och då använda en gemensam 'config/theme.php'-fil. Men vid testkörning med 
det såg jag så mycket som måste fixas till så jag nöjde mig med att ge Tema-filen detta utseende.   
Så var det dags att ladda upp på BTH och efter lite trassel med filrättigheter gick det bra. Däremot validerar inte sidorna på grund
av fel i de nedladdade grid och mixins-filerna. Det gick lätt att korrigera men de fel i valideringen i FontAwesomefilerna ger jag mig
inte på utan de får vara kvar. sidorna fungerar ju.  


Mitt arbete finns även på Github https://github.com/roka13/phpmvc.git

 

 

 
.