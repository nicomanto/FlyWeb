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
	Nome varchar(128) null,
	Descrizione text null,
	Durata int default 0 null,
	Prezzo int default 0 null
);

create or replace table CarrelloIntegrazione
(
	ID_Carrello int not null,
	ID_Integrazione int not null,
	primary key (ID_Carrello, ID_Integrazione),
	constraint CarrelloIntegrazione_ibfk_1
		foreign key (ID_Carrello) references Carrello (ID_Carrello),
	constraint CarrelloIntegrazione_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione)
);


create or replace table Ordine
(
	ID_Ordine int auto_increment
		primary key,
	ID_Utente int not null,
	Via varchar(256) null,
	Cap varchar(5) null,
	Provincia varchar(2) null,
	Note text null,
	Comune text null,
	MetodoPagamento ENUM('Paypal','CartaDiCredito','CardaDiDebito') not null,
	Totale int not null,
	constraint Ordine_ibfk_1
		foreign key (ID_Utente) references Ordine (ID_Ordine)
);

create or replace table OrdineIntegrazione
(
	ID_Ordine int not null,
	ID_Integrazione int not null,
	primary key (ID_Ordine, ID_Integrazione),
	constraint OrdineIntegrazione_ibfk_1
		foreign key (ID_Ordine) references Ordine (ID_Ordine),
	constraint OrdineIntegrazione_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione)
);

create or replace table Preferiti
(
	ID_Preferiti int not null,
	ID_Utente int not null,
	primary key (ID_Preferiti, ID_Utente),
	constraint ID_Utente
		unique (ID_Utente)
);

create or replace table PreferitiIntegrazione
(
	ID_Preferiti int not null,
	ID_Integrazione int not null,
	primary key (ID_Preferiti, ID_Integrazione),
	constraint PreferitiIntegrazione_ibfk_1
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione),
	constraint PreferitiIntegrazione_ibfk_2
		foreign key (ID_Preferiti) references Preferiti (ID_Preferiti)
);

create or replace table Tag
(
	ID_Tag int auto_increment
		primary key,
	Nome varchar(64) not null
);

create or replace table TagIntegrazioni
(
	ID_Tag int not null,
	ID_Integrazione int not null,
	primary key (ID_Tag, ID_Integrazione),
	constraint TagIntegrazioni_ibfk_1
		foreign key (ID_Tag) references Tag (ID_Tag),
	constraint TagIntegrazioni_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione)
);

create or replace table Utente
(
	ID_Utente int auto_increment
		primary key,
	Username varchar(128) not null,
	Password varchar(128) not null,
	Nome varchar(128) not null,
	Cognome varchar(128) not null,
	Propic TEXT null,
	Email varchar(256) not null,
	DataNascita date not null,
	DataRegistrazione date not null,
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
		foreign key (ID_Carrello) references Carrello (ID_Carrello),
	constraint Utente_ibfk_2
		foreign key (ID_Preferiti) references Preferiti (ID_Preferiti)
);

alter table Carrello
	add constraint Carrello_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente);

alter table Preferiti
	add constraint Preferiti_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente);

create or replace table Recensione
(
	ID_Recensione int auto_increment
		primary key,
	Titolo varchar(256) not null,
	Valutazione int default 0 null,
	Descrizione text null,
	ID_Utente int null,
	`Mod` TINYINT(1) default 0 null,
	constraint Recensione_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente)
);

create or replace table RecensioneIntegrazione
(
	ID_Recensione int not null,
	ID_Integrazione int not null,
	primary key (ID_Recensione, ID_Integrazione),
	constraint RecensioneIntegrazione_ibfk_1
		foreign key (ID_Recensione) references Recensione (ID_Recensione),
	constraint RecensioneIntegrazione_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione)
);

create or replace table Viaggio
(
	ID_Viaggio int auto_increment
		primary key,
	Titolo varchar(64) not null,
	DataInizio date null,
	DataFine date null,
	Prezzo int default 0 null,
	Descrizione text null,
	DescrizioneBreve varchar(128) null,
	Stato varchar(256) null,
	Localita varchar(256) null,
	Citta varchar(256) null
);

create or replace table CarrelloViaggio
(
	ID_Carrello int not null,
	ID_Viaggio int not null,
	primary key (ID_Carrello, ID_Viaggio),
	constraint CarrelloViaggio_ibfk_1
		foreign key (ID_Carrello) references Carrello (ID_Carrello),
	constraint CarrelloViaggio_ibfk_2
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio)
);

create or replace table OrdineViaggio
(
	ID_Ordine int not null,
	ID_Viaggio int not null,
	primary key (ID_Ordine, ID_Viaggio),
	constraint OrdineViaggio_ibfk_1
		foreign key (ID_Ordine) references Ordine (ID_Ordine),
	constraint OrdineViaggio_ibfk_2
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio)
);


create or replace table PreferitiViaggio
(
	ID_Preferiti int not null,
	ID_Viaggio int not null,
	primary key (ID_Preferiti, ID_Viaggio),
	constraint PreferitiViaggio_ibfk_1
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio),
	constraint PreferitiViaggio_ibfk_2
		foreign key (ID_Preferiti) references Preferiti (ID_Preferiti)
);

create or replace table RecensioneViaggio
(
	ID_Recensione int not null,
	ID_Viaggio int not null,
	primary key (ID_Recensione, ID_Viaggio),
	constraint RecensioneViaggio_ibfk_1
		foreign key (ID_Recensione) references Recensione (ID_Recensione),
	constraint RecensioneViaggio_ibfk_2
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio)
);


create or replace table TagViaggio
(
	ID_Tag int not null,
	ID_Viaggio int not null,
	primary key (ID_Tag, ID_Viaggio),
	constraint TagViaggio_ibfk_1
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio),
	constraint TagViaggio_ibfk_2
		foreign key (ID_Tag) references Tag (ID_Tag)
);

create or replace table ViaggioIntegrazione
(
	ID_Viaggio int not null,
	ID_Integrazione int not null,
	primary key (ID_Viaggio, ID_Integrazione),
	constraint ViaggioIntegrazione_ibfk_1
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio),
	constraint ViaggioIntegrazione_ibfk_2
		foreign key (ID_Integrazione) references Integrazione (ID_Integrazione)
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
