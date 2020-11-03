# FlyWeb

Progetto di Tecnologie Web A.A. 2020/2021


# How to run
Per far partire l'ambiente di sviluppo eseguire il comando `make up` dalla root del progetto.

Ci si potra' connettere al database all'indirizzo `localhost:3307`, e al webserver all'indirizzo `localhost:8080`.

> Purtoppo la creazione del db non l'ho automatizzata, bisogna aprire dbeaver, aprire una console sql e incollare li il file flyweb.sql e poi eseguirlo per creare le tabelle. (E' sufficiente farlo la prima volta, poi i dati dovrebbero rimanere persistenti)

# Directory structure
## Components
Inserire qui dentro ogni parte di pagina che si crea (componente). Creare una cartella per ogni componente che contiene la struttura html e il codice php per "compilarla".

> Esempio: per la "componente" login creo i file `loginComponent.html` e `loginComponent.php` dentro alla cartella `components/login`

## Pages
Inserire qui dentro gli script che creano le pagine finali che poi verranno visualizzate dall'utente

## Js
Inserire qui dentro il codice JavaScript

## Img
Inserire qui dentro le immagini


# Colori Palette
- arancio #c53020
- blu     #0a3150
- verde   #618d34
- grigio  #b9bcb7
- giallo  #e49d44

# Idee

- redigere itinerari per piu' giorni per varie citta'
- integrazioni tra cui poter scegliere i.e. trasporto, esperienze 
  - ogni integrazione e' carat. da durata (variabile) e costo
- Itinerari certificati per disabili (controllare se c'e' un ente che certifica)
- possibilita di registrarsi
- utente - acquirente
  - carrello 
  - recensioni - !solo se hai fatto il viaggio!
  - preferiti
- amministrazione
  - gestire gli utenti (ban)
  - gestire gli itinerari e le integrazioni (aggiungere, eliminare, modificare)
- tagging itinerari e integrazioni


# Interfaccia
- ricerca filtrabile in prima pagina in primo piano
- menu sopra per [altre pagine](<#altre-pagine>)
- icona utente per signin e signup
- pagina per contatti (about)
- newsletter in fondo alla pagina
- 50X da backend in determinate pagine che compromettono il funzionamento totale -> visualizza pagina di errore
- pagina per prenotazione + pagamento (wizard)
- pagina risultati ricerca
- pagina dettagli elemento dinamica 
- pagina amministratore

Colori: 
Blue Nile – #0A3150
Brick Red – #C52F21
Golden Syrup – #E39D45
Ash Gray – #BABCB7
Jungle Green – #628D34


# Setup DB

## Tabelle

### Utenti
- nome: varchar
- cognome: varchar
- eta: number
- tipo: admin/user

### attivita
- id
- nome

### viaggio-attivita

### Viaggio
- nome
- attivita
- 
  
### Integrazioni
- nome
- costo
- durata

### Viaggio-integrazioni


### Tags
- id
- nome

### Tags integrazioni/viaggi
- id
- integrazioni/viaggi

### Ordine
- id

### ordine-integrazione
