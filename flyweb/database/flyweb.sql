
drop database if exists flyweb;
create or replace schema flyweb collate utf8mb4_general_ci;
use flyweb;


create or replace table Carrello
(
	ID_Carrello int auto_increment
		primary key,
	ID_Utente int not null,
	ID_Viaggio int not null
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
	constraint Utente_Username_uindex
		unique (Username)
);

create or replace table Ordine
(
	ID_Ordine int auto_increment
		primary key,
	ID_Utente int not null,
	Via TEXT null,
	Cap varchar(5) null,
	Provincia TEXT null,
	Note TEXT null,
	Comune TEXT null,
	DataOrdine timestamp not null default current_timestamp(),
	MetodoPagamento ENUM('Paypal','Carta') not null,
	Totale int not null,
	constraint Ordine_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente) ON DELETE CASCADE
);

create or replace table Tag
(
	ID_Tag int auto_increment
		primary key,
	Nome TEXT not null,
	Immagine TEXT,
	AltImmagine VARCHAR(50) not null
);

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
	Immagine TEXT,
	AltImmagine VARCHAR(50) not null
);

alter table Carrello
	add constraint Carrello_ibfk_1
		foreign key (ID_Utente) references Utente (ID_Utente) ON DELETE CASCADE,
	add constraint Carrello_ibfk_2
		foreign key (ID_Viaggio) references Viaggio (ID_Viaggio) ON DELETE CASCADE;


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

create or replace index ID_Utente
	on Ordine (ID_Utente);

create or replace index ID_Utente
	on Recensione (ID_Utente);

create or replace index ID_Viaggio
	on OrdineViaggio (ID_Viaggio);

create or replace index ID_Viaggio
	on RecensioneViaggio (ID_Viaggio);

create or replace index ID_Viaggio
	on TagViaggio (ID_Viaggio);