# Coding Challenge
Unsere Redakteure müssen Tabellen mit Produktvergleichen verwalten (z.B. https://widget.vgl.org/?comparisonId=2907). 
Dazu müssen sie unter anderem in der Lage sein, einzelne Produkte anlegen, bearbeiten und löschen zu können. 
Immer wenn ein Produkt angelegt, bearbeitet oder gelöscht worden ist, müssen verschiedene Prozesse angestoßen und durchlaufen werden, 
z.B. müssen Vergleichstabellen mit den neuen Daten aktualisiert werden. 
Da diese Prozesse sehr umfangreich werden können, dürfen diese nicht direkt an den redaktionellen Vorgang gebunden sein, 
sondern müssen unabhängig davon passieren.

Du sollst eine Software entwickeln, die die oben beschriebenen Geschäftsprozesse in einer vereinfachten Version wiederspiegeln.

## Anforderungen:
- Ein Produkt besteht aus einer Id, einen Namen und einem Preis
- Produkte müssen anlegt, bearbeitet und gelöscht werden können. Hierfür soll jeweils ein cli-script als Einstiegspunkt genutzt werden
- Wenn ein Produkt angelegt/bearbeitet/gelöscht worden ist, muss ein Event in eine Queue geschrieben werden
- Die Events sollen anschließend aus der Queue gelesen und abgearbeitet werden
- Bei der Abarbeitung der Events soll je nach Event-Auslöser eine Nachricht in folgendem Format in der console ausgegeben werden:
    - Produkt angelegt: `Product created: {id} {name} {price}`
    - Produkt löschen: `Product deleted: {id}`
    - Produkt bearbeiten: `Product updated: {changed fields}`
- Wenn am Ende noch etwas Zeit übrig ist, bitte noch Unit-Tests für 2 Klassen deiner Wahl erstellen

*Anmerkungen zur Abarbeitung der Events:*
- In den Nachrichten soll `{field}` durch den jeweiligen Wert ersetzt werden, z.B.: `Product created: 1 Stuhl 10,00`
- In den Nachrichten für Produkt Updates sollen nur Felder die sich tatsächlich beim update geändert haben ausgegeben werden. 
Wir gehen davon aus, dass ein Redakteur beim Bearbeiten immer nur ein einziges Feld ändert und nie mehrere auf einmal.

## Implementation Details

- Fork dieses Repository und erstelle einen Pull Request mit deiner Lösung
- Benutze php 7.1 oder höher
- Das `src` directory soll für die Business Logik genutzt werden
- Die Skripte im `cli` directory sind die Einstiegspunkte deiner Applikation 
- Zum Persistieren von Daten `App\Storage\Writer` verwenden (persistiert die Daten im `storage` directory)
- Zum Lesen von Daten `App\Storage\Reader` verwenden
- Für Unit-Test ein `test` directory erstellen (mit `composer test` können die Tests ausgeführt werden)

## Ziel
Wenn du fertig bist sollte man `php test_run.php` ausführen können und `It works!` in der console ausgegeben werden. 
Schau dir die Datei `test_run.php` genau an, dort siehst du, wie deine Applikation aufgerufen wird.

Es ist in Ordnung, falls du die Aufgabe nicht vollständig im gegeben Zeitraum lösen kannst oder mit der Qualität deiner Lösung nicht zu Frieden bist.
Bitte kommentiere dann deinen Pull Request mit Verbesserungsvorschlägen und Hinweisen auf potenzielle Problemen die du in deiner Lösung siehst.
