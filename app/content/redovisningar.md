Kmom06
=
**Var du bekant med några av dessa tekniker innan du började med kursmomentet?**

Nej detta var helt nytt för mig.

**Hur gick det att göra testfall med PHPUnit?**

När jag väl fått det att fungera så gick det bra! Jag kunde först inte installera xdebug och även om det kanske inte var ett krav så kändes det trevligt att ha för framtiden. Lyckligtvis hittade jag en youtube video som gjorde att jag kunde installera xdebug och då fungerade allt som det skulle. 
Jag hade inte så många metoder att testa så mitt test var relativt smidigt att få ihop. Jag använder mig av Anax-MVC till min modul så jag gjorde den guiden. Till min förvåning så lyckades testet efter 2-3 rättning av koden. Jag hade förväntat mig en hel del strul med detta men det gick som sagt smidigt. 

**Hur gick det att integrera med Travis?**

Det gick bra efter en del snedsteg i början. Jag flummade runt i git bash med olika kommandon när jag skulle tagga och checkouta mitt test vilket orsakade en del error som jag inte förstod mig på. Efter en del googling så lyckades jag lösa felen och allt dök upp på travis. 

**Hur gick det att integrera med Scrutinizer?**

Det gick bra nästan direkt, förutom att den inte hittade external code coverage i början. Minns faktiskt inte hur jag löste det men jag tror att det hade med synken med travis att göra.  

**Hur känns det att jobba med dessa verktyg, krångligt, bekvämt, tryggt? Kan du tänka dig att fortsätta använda dem?**

Det kändes som alltid med nya verktyg, avancerat och krångligt i början. Mest var det installationerna som satte käppar i hjulet. När jag kom vidare från dem så kändes det lättare att sätta sig in i verktygen. Jag kommer behöva studera dem mer för att förstå bättre hur de fungerar och används men helheten greppar jag.
Jag kommer satsa på att använda dem i framtiden, de känns som riktigt bra verktyg att ha med sig. Inte bara för att de visar error i koden utan också metoder eller variabler som inte används, de brukar vara svåra att lokalisera ibland. I mitt fall hade jag t.ex. två metoder som jag inte hade skrivit på rätt sätt och de hade jag inte upptäckt om inte någon hade testat sidan live och sagt till mig.

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick?**

Ingen extrauppgift för mig den här gången. 


Kmom05
=
**Var hittade du inspiration till ditt val av modul och var hittade du kodbasen som du använde?**
Jag fastnade för flashmessages då jag tyckte att det verkade vara en lagom uppgift för min nivå. Det känns också som en bra sak att använda sig av särskillt i kombination med exempelvis CForm eller andra formulärer där man ofta använder olika meddelanden. Kodbasen fick jag dels från Phalcons exempel och genom att kika lite på hur andra hade gjort. 



**Hur gick det att utveckla modulen och integrera i ditt ramverk?**
Det gick upp och ner för mig, det gick relativt enkelt att skapa modulen och integrera med mitt Anax. Jag skapade en Flashcontroller som har stöd för 4 olika meddelanden: godkänt, information, error och varning. Det finns också stöd för att kunna skapa sitt eget meddelande.

**Hur gick det att publicera paketet på Packagist?**
Det gick relativt bra. Jag använde mig av github desktop som var väldigt smididgt att använda. Jag hade en del problem med att få upp filerna till github eftersom jag hade ignorerat min composer fil i gitignore filen. När det väl var löst så kunde jag publicera mitt paket på packgist utan några större problem. Jag ville få igång auto-update men det var rörigt att hitta rätt på github och det fanns inga guider direkt, så jag la ner det. 

**Hur gick det att skriva dokumentationen och testa att modulen fungerade tillsammans med Anax MVC?**
Det gick bra att skriva dokumentationen, det var roligt att få lägga upp något eget på github och känna på hur det fungerar. Integrationen med Anax var problematisk för mig då jag inte förstod hur jag skulle göra med autoload filerna. Jag fick bra hjälp på forumet och i chatten så tillslut löste det sig. Jag ville att man skulle kunna testa modulen direkt från vendor mappen men det innebar att jag fick lägga till delar av anax för att det skulle fungera, jag fick bla.lägga till en config mapp och errortesting.php. Slutligen så löste det sig och nu ska det räcka med en installation via composer och sen peka på flashtest.php i webbläsaren för att det ska fungera. 

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**
Det blev ingen extrauppgift för mig den här gången eftersom jag redan ligger efter i tidsplanen. 

Kmom04
=

**Vad tycker du om formulärhantering som visas i kursmomentet?**

Det är ett smidigt sätt att snabbt skapa mer avancerade formulärer som kan återanvändas i hela ramverket. Jag tyckte att det var klurigt att implementera formuläret men efter att jag hade fått det att fungera med att lägga till en användare så kändes det lättare att genomföra de andra uppgifterna. Jag gillade att det fanns stöd för validering även om den var lite kinkig med internetadressen som var tvungen att börja med http://. Om jag hade haft tiden så hade jag nog lagt till så att man kunde lägga till http:// automatiskt om användaren inte skrev http:// utan angav www först. Jag saknade möjligheten att kunna ändra designen på formulären med CSS, det kanske finns men jag kunde inte hitta det i koden.  
** Vad tycker du om databashanteringen som visas, föredrar du kanske traditionell SQL? **
Jag gillade användningen av databasmodellen, det var enkelt att ställa frågor och utföra dem. Det var stor skillnad på hur mycket kod det blev i funktionerna, i tidigare kursmoment hade jag ofta många sql satser i en och samma funktion medan nu var det betydligt färre vilket gav en mer överskådlig kod. Det var väldigt bra att man kunde återanvända databasen för kommentarerna. 
 
** Gjorde du några vägval, eller extra saker, när du utvecklade basklassen för modeller? **

Nej inget speciellt. Jag följde övningen och behöll User och Comment tomma. Såhär i efterhand kanske jag skulle kunna lägga några av metoderna som ställer frågor till databasen i user eller comment klassen. Det känns lite onödigt att ha en tom basklass som refererar till cdatabasemodel. Jag hade lika gärna kunnat använda exempelvis cdatabase->save istället för user->save eller comment->save. Samtidigt är det mer läsbart och lättare att förstå när man använder user eller comment.

** Beskriv vilka vägval du gjorde och hur du valde att implementera kommentarer i databasen?**

Jag återanvände det mesta från UserController och formulären CFormAddUser och CFormUpdateUser. I tillägg så skapade jag en tom comment basklass som användes för att skicka frågor till databasen.  Koden för att uppdatera och ta bort kommentarer la jag i formulären eftersom jag inte kunde klura ut hur jag skulle skriva koden för detta i respektive controller. Därmed blev det ett extra steg eftersom koden för t.ex. update går från view->controller->formulär->databas istället för view->controller->databas. 

**Extrauppgift**

Det blev ingen extrauppgift för mig pga. tidsbrist. 

**Allmänt om kursmomentet**

Det var ett intressant och givande kursmoment om än lite för mastigt i mina ögon. 
Jag hade en hel del problem i början att få igång cdatabasemodel, jag fick använda mig av flera olika forumtrådar för att få igång den. Det vore bra om det fanns lite mer info om detta i guiden, t.ex. påminnelse om filrättigheterna på mapparna (jag var tvungen att ha 777 på webroot i tillägg till 777 på config mappen)  och kanske tips att installera paketen via studentservern med composer istället för lokalt som jag gjorde först. Sen hade jag uppskattat om det stod i vilken fil man jobbade med kodsnuttarna som finns i guiden. Det kanske är tänkt som en övning i sig att klura ut men det känns som att jag hade gått snabbare att komma igång med de tyngre bytarna som strukturen och vad koden gör om det var mer tydligt. Nu känns det i alla fall som att jag har mer koll på ramverkets struktur även om det inte är 100 %. Jag ser fram emot nästa kursmoment! 



Kmom03
=

**Allmänt om kursmomentet**

Detta var ett roligt och givande kursmoment. Jag har länge varit intresserad av att lära mig mer om responsiv design och hur man kan bygga det från grunden. Jag tyckte att kursmomentet gav en bra inblick i hur det kan gå till. 

**Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?**

Jag har använt bootsrap i ett projekt tididgare och jag tyckte att det fungerade bra. Min ambition är att bli duktig på ett css-ramverk eftersom jag anser att de är helt nödvändiga för att få snygg, effektiv och överskådlig kod. Jag hade tänkt börja med SASS eftersom jag har läst att det har en del fördelar som jag tror kan vara avgörande i längden men LESS verkar lättare att lära sig och passar därför perfekt att börja med.  

**Vad tycker du om LESS, lessphp och Semantic.gs?**

Jag tyckte att LESS var rätt enkelt att förstå och använda. Det är smididgt med variabler som man kan återanvända och få en tydligare kod. Lessphp fungerade bra förutom att jag tyckte att felmeddelandena var lite krångliga att tyda i början men sedan gick det bättre. Överlag kändes det som att det var svårare att lokalisera fel eftersom all css sparades i en enda fil. Det gäller att ha koll på var koden ligger i övriga .less filer om man ska hitta felet snabbt. Semantic.gs var ett smiddigt sätt att ha koll på kolumner och att få en bra grundstruktur. Jag funderade på hur bra semantic är om man ska göra mer komplexa designer men den frågan besvaras nog när jag har jobbat mer med det. 

**Vad tycker du om gridbaserad layout, vertikalt och horisontellt?**

Jag tycker det är ett bra sätt att skapa symetri på sidan och att separera innehållet på ett enkelt sätt. 

**Har du några kommentarer om Font Awesome, Bootstrap, Normalize?**

Alla är bra att använda för att komma igång snabbt med en design på sidan. Font-Awsome är enkelt att använda och har ett bra utbud av ikoner som man kan skala. Bootsrap kräver mer inlärning från min sida innan jag kan säga mer om det. Normalize används på många sidor och verkar vara ett bra tillskott för att hantera olika webläsare. 

**Beskriv ditt tema, hur tänkte du när du gjorde det, gjorde du några utsvävningar?**

Jag utgick från det tema som vi skapade i guiden. Jag fokuserade mer på att lära mig om less och uppbyggnaden så mitt tema skiljer sig inte så mycket från ursprungsdesignen. Temat ändrar sig lite när man skalar ner webläsaren, jag gömmer b.la feature kolumnerna och ändrar färger på font-awsome ikonerna. Min navbar la jag lite mer tid på eftersom den inte var designad för att ha en drop-down meny. Slutligen fungerade allt efter en del trial and error med border-bottom som orsakade problem i min dropdownmeny. Jag använde också @fontSizeH2 variablerna för att ändra storlek på min siteslogan när man skalar webläsaren.  

**Antog du utmaningen som extra uppgift?**

Nej jag kände att tiden inte räckte till men jag ska försöka lägga upp nästa kursmoment på github för att lära mig mer om det. 



Kmom02
=

**Allmänt om kursmomentet**

Detta var ett svårt och klurigt moment tyckte jag. Stundtals kändes det som att jag inte hade någon koll på vad som hände. Jag tog ett steg i taget och frågade runt i chatten, läste guiden och kollade på forumet för att få en bättre bild av hur allt hängde ihop. Det svåraste för mig var att följa med på alla steg som hände i exemeplvis en funktion i controller klassen. När det blir många steg så rör jag ofta till det och fastnar. Det var lite ovant att använda sig av färdiga kommandon som exempelvis: $this->request->getPost. Det tog lång tid för mig att förstå hur jag skulle göra för att få två separata kommentarssidor men sedan började jag förstå parameter i dispatchen och användningen av en nyckel för att hitta rätt sida. Trots svårigheter så var det ett intressant kursmoment som gav mig en inblick i hur det är att jobba med ett ramverk.    

**Hur känns det att jobba med Composer?**

Composer guiden gick bra att följa, jag hade några mindre problem med kommandona men det löste sig snabbt. Jag behöver arbeta mer med composer för att få en känsla för hur det fungerar och hur jag kan använda det för framtida projekt. Jag funderade på varför man inte lika gärna kan ladda ner filerna manuellt direkt från github men jag kom fram till att composer är ett bättre alternativ då man kan uppdatera flera projekt med några rader kod och även ha en överskådlig lista över projekt man kan tänkas använda.

**Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?**

Jag kikade runt bland paketen och där finns en hel del paket som verkar underlätta kodandet, de hade också olika ramverk som t.ex. laravel som jag har tänkt lära mig i framtiden.    

**Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?**

Både jag och nej skulle jag säga. För mig var det mest kopplingen mellan de två kontrollerna commentController och commentSession som var förvirrande. Jag var mer inne i tänket att samla allt i en klass men sen insåg jag att commentsInSession fungerar lite som en stor $_POST eller $_GET klass och 
att commentsController hanterar datan. Kopplingarna mellan klasserna är däremot fortfarande lite rörigt, det känns som att det händer en del "osynliga" saker i bakgrunden som jag inte har koll på men 
det brukar klarna med tiden.  

**Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?**

Nej, jag tyckte att det fungerade bra. 


Kmom01
=
Då var det tillbaka till studierna efter sommarlovet, känns bra att börja igen!
Detta kursmoment var väldigt intressant från början till slut. Det gick bra att följa med i guiden och jag tycker mig förstå uppbyggnaden av det uppgraderade Anax relativt bra. 
Erfarenheten från tidigare kurser säger mig dock att det brukar ta en stund innan jag greppar arbetsflödet och funktionerna, men det verkar vara ett spännande ramverk att lära sig!

Jag tyckte att vyerna var smidiga att använda. Det var bra att mos påpekade att de bör användas som just *vy* och inte för att innehålla *content*(indirekt så gör dem ju det fast koden för content bör hållas separerad).

Det tog en liten stund innan jag förstod kopplingen mellan $app->views->add('me/hem' och att använda mig av hem.tpl.php. Först trodde jag att jag skulle länka till hem.php men det behövs ju inte i och med att 
Anax själv laddar in .tpl.php filerna.

Det var kul att jobba med markdown, mycket smidigt att använda för större texter. Jag använder mig av sublime text 3 och där finns en del kommandon för enklar textredigering men markdown är överlag snabbare.   

Jag har jobbat på min egen onlineportfolio i sommar och då har jag använt mig av twitter bootstrap men i övrigt är jag nybörjare när det kommer till ramverk. Jag har läst en del om laravel som många använder. Planen är att ge mig på det när jag är mer erfaren. 
Det fanns en del nya begrepp som jag inte kände till sedan tidigare som t.ex. routes, vyer och frontcontroller men i övrigt så kände jag igen det mesta. 

Överlag känns Anax-Mvc lite komplicerat på sina ställen men det finns också en logisk struktur och det verkar vara ett bra ramverk när man jobbar objektorienterat. 
Jag ser fram emot nästa kursmoment!