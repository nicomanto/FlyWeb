
drop database if exists flyweb;
create or replace schema flyweb collate utf8mb4_general_ci;
use flyweb;


create or replace table Carrello
(
	ID_Carrello int not null,
	ID_Utente int not null,
	primary key (ID_Carrello, ID_Utente),
	constraint ID_Utente
		unique (ID_Utente)
);

create or replace table Integrazione
(
	ID_Integrazione int auto_increment
		primary key,
	Nome TEXT null,
	Descrizione TEXT null,
	Durata int default 0 null,
	Prezzo int default 0 null
);

create or replace table CarrelloIntegrazione
(
	ID_Carrello int not null,
	ID_Integrazione int not null,
	primary key (ID_Carrello, ID_Integrazione),
	constraint CarrelloIntegrazione_ibfk_1
		foreign key (ID_Carrello) references Carrello (ID_Carrello) ON DELETE CASCADE,
	constraint CarrelloIntegrazione_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione) ON DELETE CASCADE
);

create or replace table Preferiti
(
	ID_Preferiti int not null,
	ID_Utente int not null,
	primary key (ID_Preferiti, ID_Utente),
	constraint ID_Utente
		unique (ID_Utente)
);

create or replace table Utente
(
	ID_Utente int auto_increment
		primary key,
	Username VARCHAR(128) not null ,
	Password TEXT not null,
	Nome TEXT not null,
	Cognome TEXT not null,
	Propic TEXT null,
	Email TEXT not null,
	DataNascita date not null,
	DataRegistrazione timestamp not null default current_timestamp(),
	Admin TINYINT(1) default 0 null,
	EvilBit TINYINT(1) default 0 null,
	ID_Carrello int null,
	ID_Preferiti int null,
	constraint Utente_ID_Carrello_uindex
		unique (ID_Carrello),
	constraint Utente_ID_Preferiti_uindex
		unique (ID_Preferiti),
	constraint Utente_Username_uindex
		unique (Username),
	constraint Utente_ibfk_1
		foreign key (ID_Carrello) references Carrello (ID_Carrello) ON DELETE CASCADE,
	constraint Utente_ibfk_2
		foreign key (ID_Preferiti) references Preferiti (ID_Preferiti) ON DELETE CASCADE
);

create or replace table Ordine
(
	ID_Ordine int auto_increment
		primary key,
	ID_Utente int not null,
	Via TEXT null,
	Cap varchar(5) null,
	Provincia varchar(2) null,
	Note TEXT null,
	Comune TEXT null,
	DataOrdine timestamp not null default current_timestamp(),
	MetodoPagamento ENUM('Paypal','Carta') not null,
	Totale int not null,
	constraint Ordine_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente) ON DELETE CASCADE
);

create or replace table OrdineTemporaneo
(
	ID_Ordine int auto_increment
		primary key,
	ID_Utente int not null,
	Via TEXT null,
	Cap varchar(5) null,
	Provincia varchar(2) null,
	Note TEXT null,
	Comune TEXT null,
	DataOrdine timestamp not null default current_timestamp(),
	MetodoPagamento ENUM('Paypal','Carta') not null,
	Totale int not null,
	constraint OrdineTemporaneo_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente) ON DELETE CASCADE
);

create or replace table OrdineIntegrazione
(
	ID_Ordine int not null,
	ID_Integrazione int not null,
	primary key (ID_Ordine, ID_Integrazione),
	constraint OrdineIntegrazione_ibfk_1
		foreign key (ID_Ordine) references Ordine (ID_Ordine) ON DELETE CASCADE,
	constraint OrdineIntegrazione_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione) ON DELETE CASCADE
);

create or replace table PreferitiIntegrazione
(
	ID_Preferiti int not null,
	ID_Integrazione int not null,
	primary key (ID_Preferiti, ID_Integrazione),
	constraint PreferitiIntegrazione_ibfk_1
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione) ON DELETE CASCADE,
	constraint PreferitiIntegrazione_ibfk_2
		foreign key (ID_Preferiti) references Preferiti (ID_Preferiti) ON DELETE CASCADE
);

create or replace table Tag
(
	ID_Tag int auto_increment
		primary key,
	Nome TEXT not null,
	Immagine TEXT
);

create or replace table TagIntegrazioni
(
	ID_Tag int not null,
	ID_Integrazione int not null,
	primary key (ID_Tag, ID_Integrazione),
	constraint TagIntegrazioni_ibfk_1
		foreign key (ID_Tag) references Tag (ID_Tag) ON DELETE CASCADE,
	constraint TagIntegrazioni_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione) ON DELETE CASCADE
);

alter table Carrello
	add constraint Carrello_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente) ON DELETE CASCADE;

alter table Preferiti
	add constraint Preferiti_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente) ON DELETE CASCADE;

create or replace table Recensione
(
	ID_Recensione int auto_increment
		primary key,
	Titolo TEXT not null,
	Valutazione int default 0 null,
	Descrizione TEXT null,
	ID_Utente int null,
	`Mod` TINYINT(1) default 0 null,
	Lingua TEXT,
	Data date,
	constraint Recensione_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente) ON DELETE CASCADE
);

create or replace table RecensioneIntegrazione
(
	ID_Recensione int not null,
	ID_Integrazione int not null,
	primary key (ID_Recensione, ID_Integrazione),
	constraint RecensioneIntegrazione_ibfk_1
		foreign key (ID_Recensione) references Recensione (ID_Recensione) ON DELETE CASCADE,
	constraint RecensioneIntegrazione_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione) ON DELETE CASCADE
);

create or replace table Viaggio
(
	ID_Viaggio int auto_increment
		primary key,
	Titolo TEXT not null,
	DataInizio date null,
	DataFine date null,
	Prezzo int default 0 null,
	Descrizione TEXT null,
	DescrizioneBreve TEXT null,
	Stato TEXT,
	Localita TEXT,
	Citta TEXT,
	Immagine TEXT
);

create or replace table CarrelloViaggio
(
	ID_Carrello int not null,
	ID_Viaggio int not null,
	primary key (ID_Carrello, ID_Viaggio),
	constraint CarrelloViaggio_ibfk_1
		foreign key (ID_Carrello) references Carrello (ID_Carrello) ON DELETE CASCADE,
	constraint CarrelloViaggio_ibfk_2
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio) ON DELETE CASCADE
);

create or replace table OrdineViaggio
(
	ID_Ordine int not null,
	ID_Viaggio int not null,
	primary key (ID_Ordine, ID_Viaggio),
	constraint OrdineViaggio_ibfk_1
		foreign key (ID_Ordine) references Ordine (ID_Ordine) ON DELETE CASCADE,
	constraint OrdineViaggio_ibfk_2
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio) ON DELETE CASCADE
);


create or replace table PreferitiViaggio
(
	ID_Preferiti int not null,
	ID_Viaggio int not null,
	primary key (ID_Preferiti, ID_Viaggio),
	constraint PreferitiViaggio_ibfk_1
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio) ON DELETE CASCADE,
	constraint PreferitiViaggio_ibfk_2
		foreign key (ID_Preferiti) references Preferiti (ID_Preferiti) ON DELETE CASCADE
);

create or replace table RecensioneViaggio
(
	ID_Recensione int not null,
	ID_Viaggio int not null,
	primary key (ID_Recensione, ID_Viaggio),
	constraint RecensioneViaggio_ibfk_1
		foreign key (ID_Recensione) references Recensione (ID_Recensione) ON DELETE CASCADE,
	constraint RecensioneViaggio_ibfk_2
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio) ON DELETE CASCADE
);


create or replace table TagViaggio
(
	ID_Tag int not null,
	ID_Viaggio int not null,
	primary key (ID_Tag, ID_Viaggio),
	constraint TagViaggio_ibfk_1
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio) ON DELETE CASCADE,
	constraint TagViaggio_ibfk_2
		foreign key (ID_Tag) references Tag (ID_Tag) ON DELETE CASCADE
);

create or replace table ViaggioIntegrazione
(
	ID_Viaggio int not null,
	ID_Integrazione int not null,
	primary key (ID_Viaggio, ID_Integrazione),
	constraint ViaggioIntegrazione_ibfk_1
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio) ON DELETE CASCADE,
	constraint ViaggioIntegrazione_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione) ON DELETE CASCADE
);

create or replace index ID_Integrazione
	on ViaggioIntegrazione (ID_Integrazione);

create or replace index ID_Integrazione
	on CarrelloIntegrazione (ID_Integrazione);

create or replace index ID_Utente
	on Ordine (ID_Utente);

create or replace index ID_Integrazione
	on OrdineIntegrazione (ID_Integrazione);

create or replace index ID_Integrazione
	on PreferitiIntegrazione (ID_Integrazione);

create or replace index ID_Integrazione
	on TagIntegrazioni (ID_Integrazione);

create or replace index ID_Utente
	on Recensione (ID_Utente);

create or replace index ID_Integrazione
	on RecensioneIntegrazione (ID_Integrazione);

create or replace index ID_Viaggio
	on CarrelloViaggio (ID_Viaggio);

create or replace index ID_Viaggio
	on OrdineViaggio (ID_Viaggio);

create or replace index ID_Viaggio
	on PreferitiViaggio (ID_Viaggio);

create or replace index ID_Viaggio
	on RecensioneViaggio (ID_Viaggio);

create or replace index ID_Viaggio
	on TagViaggio (ID_Viaggio);