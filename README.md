# FlyWeb

Progetto di Tecnologie Web A.A. 2020/2021


# How to run
Per far partire l'ambiente di sviluppo eseguire il comando `make up` dalla root del progetto.

Ci si potra' connettere al database all'indirizzo `localhost:3307`, e al webserver all'indirizzo `localhost:8080`.

> Purtoppo la creazione del db non l'ho automatizzata, bisogna aprire dbeaver, aprire una console sql e incollare li il file flyweb.sql e poi eseguirlo per creare le tabelle. (E' sufficiente farlo la prima volta, poi i dati dovrebbero rimanere persistenti)

# Directory structure
## Database
Inserire qui dentro le cose relative al database

## Pages
Inserire qui dentro gli script che creano le pagine finali che poi verranno visualizzate dall'utente

## Html
Inserire qui dentro ogni parte di pagina che si crea (deve esserci un file `.php` dentro la cartella `Pages`)

## Html/Components
Creare una cartella per ogni componente che contiene la struttura html e il codice php per "compilarla".

> Dentro a questa cartella devono starci solamente "componenti" ovvero delle parti che non possono fare pagina a se'. Quindi i file qui dentro non conterrano i vari tag `<html>`, `<head>`, `<body>`, ecc. , ma solamente tag interni.

> Esempio: per la "componente" login creo i file `header.html` e `header.php` dentro alla cartella `html/components/header`

## Js
Inserire qui dentro il codice JavaScript

## Img
Inserire qui dentro le immagini

## CSS
Inserire qui dentro i file css


# Colori Palette
- arancio #c53020
- blu     #0a3150
- verde   #618d34
- grigio  #b9bcb7
- giallo  #e49d44
