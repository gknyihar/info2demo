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

Hozzunk létre egy új mappát `pages` néven, és másoljuk át a php fájlokat ebbe a mappába! Így a kapott struktúra a következő lesz:

```
htdocs
 │ .gitignore
 │ db.sql 
 │ README.md
 └─pages
    │ index.php
    │ tasks.php
    └ users.php
```

Hozzunk létre egy új index.php fájlt a projekt gyökerében, és másoljuk be a következő kódrészletet:
```php
<?php

// Define routes
$routes = [
    '/' => './pages/index.php',
    '/users' => './pages/users.php',
    '/tasks' => './pages/tasks.php'
];

// Determine current root
//      $_SERVER["REQUEST_URI"] contains the requested uri, eg.: /tasks?user=1
//      strtok(...) removes the query string
//      trim(....) removes the '/' characters from the beginning and in the end
$path = '/' . trim(strtok($_SERVER["REQUEST_URI"],'?'), '/');

// Check if route exists
// If not exists, then return with "404 - Not found" error message
if(!array_key_exists($path, $routes)){
    http_response_code(404);
    die("404 - Not found");
}

// Return with the requested page
require $routes[$path];
```

Ahhoz, hogy a kód működjön, szükség van arra, hogy minden kérést az `index.php`-ra dolgozzon fel. Hozzunk létre a projekt gyökerében egy `.htaccess` fájlt és másoljuk be a következő kódrészletet:
```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /index.php [NC,L,QSA]
```

Cseréljük ki az összes fájlban az `index.php`, `users.php` és `tasks.php` linkeket `/`, `/users` és `/tasks` linkekre.

### Válasszuk szét a logikai és megjelenítési réteget!

- Nevezzük át a `pages` mappát `controllers` névre, és frissítsük ennek megfelelően az `index.php`-t is.
- Hozzunk létre egy `views` mappát és abban `layout.view.php`, `index.view.php`, `users.view.php` és `tasks.view.php` fájlokat! Az így kapott struktúra a következő:
```
htdocs
 │ .gitignore
 │ .htaccess
 │ db.sql 
 │ index.php
 │ README.md
 ├ controllers
 │  │ index.php
 │  │ tasks.php
 │  └ users.php
 └ views
    │ index.view.php
    │ tasks.view.php
    └ users.view.php
```
- Másoljuk az `index.php` tartalmát a `layout.view.php` fájlba!
- Cseréljük ki a `div.container.my-4.flex-grow-1` elemet a fájlban a `<?php require $view; ?>` elemre!
- Másoljuk át  az egyes view fájlokba az eredeti fájlokból a `div.container.my-4.flex-grow-1` elemet és tartalmát!
- Az eredeti fájlokban törüljük ki a teljes html tartalmat és másoljuk be a fájlok végére a megfelelő sorokat: 
```php
// index.php
$view = 'views/index.view.php';
require 'views/layout.view.php';

// users.php
$view = 'views/users.view.php';
require 'views/layout.view.php';

// tasks.php
$view = 'views/tasks.view.php';
require 'views/layout.view.php';
```

### Elemezzük a framework branchen található projektet!

Nézzük át részletesen az egyes funkciók működését!

### Implementáljuk a szerkesztés funkciót!

A `TaskController` osztályba vegyük fel az `edit` és `update` új metódust!

```php
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ], [], [
            'title' => 'cím',
            'description' => 'leírás'
        ]);

        $task->update($request->input());
        $task->save();

        return redirect()->route('tasks.index', $task->user);
    }
 ```

Készítsük el a megfelelő route-okat a két új metódusra:
```php
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}/edit', [TaskController::class, 'update'])->name('tasks.update');
```

Illesszünk be egy linket a szerkesztő nézetre a `tasks.blade.php` fájlba:
```html
...
@if($task->status == 'new')
    <div class="d-flex gap-2">
        <a href="{{route('tasks.edit', $task)}}" class="btn btn-outline-warning">
            <i class="bi bi-pencil"></i>
        </a>
        ...
    </div>
@endif
...
```

Végül készítsünk egy `edit.blade.php` view fájlt:
```html
@extends('layout')

@section('content')
    <div class="container my-4 flex-grow-1">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Kezdőlap</a></li>
                <li class="breadcrumb-item"><a href="{{route('users')}}">Felhasználók</a></li>
                <li class="breadcrumb-item"><a href="{{route('tasks.index', $task->user)}}">{{$task->user->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$task->title}}</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    Feladat szerkesztése
                </h5>
                <form method="post" action="{{route('tasks.update', $task)}}">
                    @csrf
                    @method("put")
                    <div class="mb-3">
                        <label for="title" class="form-label">Cím</label>
                        <input type="text" id="title" name="title" value="{{old('title') ? old('title') : $task->title}}"
                               class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Leírás</label>
                        <textarea id="description" name="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="10">{{old('description') ? old('description') : $task->description}}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Mentés</button>
                </form>
            </div>
        </div>

    </div>
@endsection

```

