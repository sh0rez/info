# Content Management Systeme

HTML hat sich als Auszeichnungssprache für Webbrowser etabliert, da sich in
Kombination mit CSS und JavaScript nahezu alle Anwendungsbereiche abdecken
lassen. Nichtsdestotrotz ist HTML für den herkömmlichen Verfasser von Texten
eher schlecht als recht geeignet, da es sehr technisch orientiert ist und für
weniger versierte Nutzer nur schwer zugänglich ist.

Die folgenden deutlichen Schwachpunkte weist HTML auf:

- Technisch orientiert: HTML ähnelt eher einer Programmiersprache (auch wenn es
  keine ist) als geschriebenem Text. Dies ist eine Hürde für viele Nutzer.
- HTML erlaubt keine Trennung von technischem Code, welchen der Webmaster
  verwaltet und dem eigentlichen Inhalt, welcher von den eigentlichen Autoren
  geschaffen wird.
- Es ist nicht direkt möglich, vom HTML auf die Optik des fertigen Ergebnisses
  zu schließen. Dazu bedarf es genaue Kenntnisse der verschiedenen HTML Tags,
  außerdem ist eine Basiswissen in CSS erforderlich

Um diese Schwachstellen anzugehen haben sich im Laufe der Zeit sogenannte
Content Management Systeme entwickelt. Diese lagern in erster Linie den Inhalt
der Seite an einen gesonderten Ort, wie etwa eine Datenbank aus.  
Der Webmaster verwaltet nach wie vor den technischem Teil der Internetpräsenz,
während der Inhalt in der Datenbank davon unabhängig verändert werden kann. Um
dem Konsumenten dennoch dieselbe Nutzererfahrung zu ermöglichen, wird vor
Auslieferung der Webseite der Inhalt _dynamisch_ in den HTML Quelltext
integriert.

Dazu haben sich im Laufe der Zeit insbesondere folgende Technik durchgesetzt:

Sobald der Webbrowser des Nutzers eine Anfrage an den Webserver stellt
(`HTTP GET`) würde dieser üblicherweise die angeforderter Ressource (z.B.
`/index.html`) von seinem Dateisystem laden und mit dem Inhalt ebendieser
Antworten.

Um jedoch die oben genannten Beschränkungen zu umgehen, ist ein weiterer Schritt
nötig: Zwischen dem Laden der Datei und der Antwort an den Nutzer findet ein
weiterer Schritt statt, das Preprocessing, also eine Vorbearbeitung, welche im
Folgenden am Beispiel von PHP erläurtert wird:

Der Webserver erhält die Anfrage von Nutzer und erkennt anhand der Dateiendung
(`.php`), dass es sich **nicht** um eine reguläre HTML Datei handelt, sondern
der besage Zwischenschritt notwendig ist.

Im Anschluss wird die PHP Umgebung aufgerufen, welche PHP Code in HTML Code
übersetzt. Dazu wird das PHP Skript ausgeführt und das resultierende HTML als
Antwort gesendet.  
Bei PHP handelt es sich um eine vollständige und objektorientierte
Programmiersprache, in diesem Skripten sind also quasi keine Grenzen gesetzt.
Insbesondere die Unterstützung für MySQL Datenbanken sind hervorragend, wodurch
diese Kombination oft gewählt wurde: Der Inhalt beim Seitenaufruf aus der
Datenbank geladen, in die dafür vorgesehene Stelle im HTML eingesetzt und der
fertige Seitenquelltext an den Nutzer übermittelt.

Die Möglichkeiten solches _serverseitigen Renderings_ gehen jedoch erheblich
weiter: Nicht nur das zusammenfügen von Bausteinen ist möglich, auch das
Erstellen von sehr funktionsreichen Webanwendungen die es mit herkömmlichen
Desktopanwendungen aufnehmen können ist problemlos machbar.  
Dies erlaubt es, insbesondere den Autoren das Leben weiter zu vereinfachen:
Durch übersichtliche Oberflächen zur Verwaltung der Inhalte und WYSIWYG Editoren
die dem Komfort von Microsoft Word entsprechen gibt es keine Kontaktfläche
zwischen dem Ersteller des Inhalts und HTML mehr.

Um Anwendern Arbeit zu ersparen haben sich inzwischen Werkzeuge wie Wordpress,
Joomla oder Typo3 durchgesetzt: Sie funktionieren technisch ähnlich zu dem hier
beschriebenen Verfahren, erlauben jedoch sehr einfache Erweiterung durch Plugins
und Themes. Der verwaltende Nutzer muss nicht mehr unbedingt tiefe technische
Kenntnisse haben.

Ein sehr deutlicher Nachteil dieses Konzepts ist jedoch die mangelnde
Recheneffizienz und damit einhergehende geringe Geschwindigkeit: Für jeden
Seitenaufruf muss der Inhalt erstens erneut aus der Datenbank geladen werden,
zweitens das Skript ausgeführt und drittens der fertige Quelltext übermittelt
werden. Das sind zwei Schritte mehr als vorher.  
Außerdem gibt es erheblich mehr Aufrufe einer Seite als Änderungen, was
bedeutet, dass ein großteil der Skriptausführungen sogar im selben Ergebnis
resultieren.

Dies kostet Zeit und dauert, wodurch letztendlich der Nutzer länger warten muss.
Insbesondere bei mobilen Verbindungen ist das ein Problem, da diese häufig
langsam sind und lange Wartezeiten Nutzer abwandern lassen. Auch prominente
Suchmaschinen wie Google räumen schnellen Seiten inzwischen höhere Punkte im
Ranking ein, worduch es nötig wird auf die Seitengeschwindigkeit zu achten.
