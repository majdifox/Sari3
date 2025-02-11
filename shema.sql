////////////////////////////////////////////////////////////////////////////////////////////
CREATE TYPE role_enum AS ENUM ('Conducteur', 'Expediteur', 'Administrateur');
CREATE TYPE etat_enum AS ENUM('Normal', 'Banne');

CREATE TABLE utilisateurs (
    ID SERIAL PRIMARY KEY,
	CNI varchar(25) UNIQUE,
    Nom varchar(25) NOT NULL,
    Prenom varchar(25) NOT NULL,
    Photo BYTEA NOT NULL,
    Telephone varchar(15) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Mot_de_passe VARCHAR(255) NOT NULL,
    Role role_enum NOT NULL,
    Etat etat_enum NOT NULL
);
/////////////////////////////////////////////////////////////////////////////////////////

CREATE TYPE statut_enum AS ENUM('En préparation', 'En transit', 'Livré');

CREATE TABLE colis (
    ID SERIAL PRIMARY KEY,                         
    Expediteur_id INT NOT NULL,                        
    Destination varchar(50) NOT NULL,
    Volume NUMERIC NOT NULL,
    Poids NUMERIC NOT NULL,
    Date_depart TIMESTAMP,
    Date_arriver TIMESTAMP,
    Statut statut_enum NOT NULL DEFAULT 'En préparation',
    FOREIGN KEY (Expediteur_id) REFERENCES utilisateurs(ID) ON DELETE CASCADE 
);


////////////////////////////////////////////////////////////////////////////////////////

CREATE TABLE vehicule (
    ID SERIAL PRIMARY KEY,                         
    Matricule varchar(50) NOT NULL,
	Model varchar(50) NOT NULL,
	Volume NUMERIC NOT NULL
	
);

/////////////////////////////////////////////////////////////////////////////////////////////

CREATE TYPE track_enum AS ENUM('En préparation', 'En transit', 'Arrivé');

CREATE TABLE itineraire (
    ID SERIAL PRIMARY KEY,                         
    Conducteur_id INT NOT NULL, 
    Vehicule_id INT NOT NULL,
    Date_depart TIMESTAMP NOT NULL,
    Date_arriver TIMESTAMP,
    Statut track_enum NOT NULL DEFAULT 'En préparation',
    FOREIGN KEY (Conducteur_id) REFERENCES utilisateurs(ID) ON DELETE CASCADE,
	FOREIGN KEY (Vehicule_id) REFERENCES vehicule(ID) ON DELETE CASCADE 
);

//////////////////////////////////////////////////////////////////////////////////////////////

CREATE TYPE ville_enum AS ENUM('True', 'False');

CREATE TABLE details_itineraire (
        ID SERIAL PRIMARY KEY, 
    Itineraire_id INT NOT NULL,
        Orders INT NOT NULL, 
    Ville varchar(50) NOT NULL,
        Statut ville_enum NOT NULL DEFAULT 'False',
    FOREIGN KEY (Itineraire_id) REFERENCES itineraire(ID) ON DELETE CASCADE 
);

////////////////////////////////////////////