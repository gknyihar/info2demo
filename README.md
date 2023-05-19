# Info2 Demo

A feladat, hogy a kiinduló szkriptet refaktoráljuk, hogy egy fenntarthatóbb és átláthatóbb kódot kapjunk.

## Repository felépítése

### 2023 tavaszi félév
- **[kiindulo](https://github.com/gknyihar/info2demo/tree/kiindulo)**: Kiinduló állapot
- **[refactor](https://github.com/gknyihar/info2demo/tree/refactor)**: Refaktorált állapot
- **[framework](https://github.com/gknyihar/info2demo/tree/framework)**: Refaktorálva keretrendszer segítségével
- **[demo2023](https://github.com/gknyihar/info2demo/tree/master)**: Végső állapot

### 2022 tavaszi félév
- **[kiindulo2022](https://github.com/gknyihar/info2demo/tree/kiindulo2022)**: Kiinduló állapot
- **[demo2022](https://github.com/gknyihar/info2demo/tree/demo2022)**: Végső állapot

## Feladatok

- Vizsgáljuk meg, hogy mitől nehezen fenntartható a kiinduló projekt!
- Refaktoráljuk a kódot, és készítsünk egy routert!
- Válasszuk szét a logikai és megjelenítési réteget!
- Elemezzük a framework branchen található projektet!
- Implementáljuk a szerkesztés funkciót!


### Vizsgáljuk meg, hogy mitől nehezen fenntartható a kiinduló projekt!

#### 1. Kód duplikáció

A projektben található php fájlok számos duplikációt tartalmaznak. Láthatjuk, hogy ugyanazt az alap html-t használja mindegyik, pl.: fejléc. Ez azt jelenti, ha szeretnénk egy újabb menüpontot felvenni, akkor minden fájlban módosítani kell ezt a részt, ami sok fájlnál nehezen karbantartható.

A logikai részben is látható számos duplikáció. Például mindegyik fájl elején kapcsolódunk az adatbázishoz. Tegyük fel a projektünk életében eljön a pillanat, hogy más típusú adatbázis kapcsolatot is szeretnénk támogatni. Ebben az esetben minden fájlban módosítani kell az adatbázis kapcsolathoz kapcsolódó kódrészleteket, ami szintén sok veszélyt rejt önmagába.

#### 2. Több funkció egy fájlon belül

Ha vizsgáljuk a `tasks.php` fájlt, láthatjuk hogy egy kódblokkban található a listázás, az új elem beszúrás, a módosítás és a törlés is. Az egymástól független funkciók befolyásolhatják a többi funkció működését ezért már a kódolásnál figyelembe kell vennünk, hogy ezek milyen hatással vannak egymásra. Ez azt eredményezi, hogy nem tudunk csak a lényegre koncentrálni és a kódunk hamar nehezen átláthatóvá válik. Egy esetleges módosítás során sok időt vehet igénybe, mire megtaláljuk a kérdéses kódrészletet.
#### 3. Új funkcióknak nincs egyértelmű helye

Az előző problémából következően az új funkcióknak sincs hely. Egy esetleges új funkció implementálása során a meglévő kódsorok közé kell beszúrni új kódot, ami potenciálisan elronthatja a meglévő kódot is. Egy komplex alkalmazás esetében nehéz lehet átlátni, hogy hova kell beszúrni a kérdéses új funkciót. Arról nem is beszélve, ha nem a saját kódunkat kell kiegészíteni, hanem valaki más kódját.


### Refaktoráljuk a kódot, és készítsünk egy routert!
### Válasszuk szét a logikai és megjelenítési réteget!