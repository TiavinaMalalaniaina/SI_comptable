CREATE SCHEMA si_comptable;

CREATE  TABLE si_comptable.code_journaux ( 
	code                 VARCHAR(3)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.company ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	name                 VARCHAR(100)       ,
	leader               VARCHAR(100)       ,
	address_social       VARCHAR(100)       ,
	address_exploitation VARCHAR(100)       ,
	tel                  VARCHAR(15)       ,
	telecopie            VARCHAR(15)       ,
	objet                TEXT       ,
	logo                 VARCHAR(100)       
 ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.devise ( 
	code                 VARCHAR(3)  NOT NULL     PRIMARY KEY,
	name                 VARCHAR(100)       
 ) engine=InnoDB;

CREATE  TABLE si_comptable.devise_equivalence ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	devise1              VARCHAR(3)  NOT NULL     ,
	devise2              VARCHAR(3)  NOT NULL     ,
	parite               DOUBLE  NOT NULL DEFAULT 1    ,
	date_parite          DATE       ,
	CONSTRAINT fk_devise_equivalence_devise FOREIGN KEY ( devise1 ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_devise_equivalence_devise_0 FOREIGN KEY ( devise2 ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE  TABLE si_comptable.document ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	name                 VARCHAR(100)       ,
	intitule             VARCHAR(100)       ,
	idcompany            INT  NOT NULL     ,
	CONSTRAINT fk_document_company FOREIGN KEY ( idcompany ) REFERENCES si_comptable.company( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE  TABLE si_comptable.plan_comptable ( 
	code                 VARCHAR(5)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.type_tiers ( 
	id                   INT  NOT NULL     PRIMARY KEY,
	name                 VARCHAR(100)       
 ) engine=InnoDB;

CREATE  TABLE si_comptable.detail_company ( 
	idcompany            INT  NOT NULL     ,
	nif                  VARCHAR(25)       ,
	ns                   VARCHAR(15)       ,
	rcs                  VARCHAR(15)       ,
	devise               VARCHAR(3)  NOT NULL     ,
	debut_exercise       DATE       ,
	fin_exercice         DATE       ,
	CONSTRAINT fk_detail_company_devise FOREIGN KEY ( devise ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_detail_company_company FOREIGN KEY ( idcompany ) REFERENCES si_comptable.company( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE  TABLE si_comptable.plan_tiers ( 
	code                 VARCHAR(13)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     ,
	type_tiers           INT  NOT NULL     ,
	CONSTRAINT fk_plan_tiers_type_tiers FOREIGN KEY ( type_tiers ) REFERENCES si_comptable.type_tiers( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.journal ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	code_journal         VARCHAR(3)       ,
	date_journal         DATE  NOT NULL     ,
	numero_piece         INT  NOT NULL     ,
	reference_piece      VARCHAR(100)       ,
	compte               VARCHAR(5)  NOT NULL     ,
	compte_tierce        VARCHAR(13)       ,
	libelle              VARCHAR(100)  NOT NULL     ,
	echeance             DATE       ,
	devise               VARCHAR(3)       ,
	quantite             DOUBLE   DEFAULT 1    ,
	debit                DOUBLE   DEFAULT 0    ,
	credit               DOUBLE   DEFAULT 0    ,
	CONSTRAINT fk_journal_plan_tiers FOREIGN KEY ( compte_tierce ) REFERENCES si_comptable.plan_tiers( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_code_journaux FOREIGN KEY ( code_journal ) REFERENCES si_comptable.code_journaux( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_plan_comptable FOREIGN KEY ( compte ) REFERENCES si_comptable.plan_comptable( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_devise FOREIGN KEY ( devise ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

INSERT INTO si_comptable.code_journaux( code, intitule ) VALUES ( 'AC', 'Achat');
INSERT INTO si_comptable.code_journaux( code, intitule ) VALUES ( 'VE', 'VENTES');
INSERT INTO si_comptable.company( name, leader, address_social, address_exploitation, tel, telecopie, objet, logo ) VALUES ( 'DIMPLEX', 'TIAVINA', 'ENCEINTE ITU ANDOHARANOFOTSY BP 1960 Antananarivo 101', 'ENCEINTE ITU ANDOHARANOFOTSY BP 1960 Antananarivo 101', '22 770 99', '22 230 66', 'La DIMPEX  (Dago Import Export) a pour objet social la production d''articles industriels et la vente de marchandises auprès de ces clients locaux et étrangers', '');
INSERT INTO si_comptable.company( name, leader, address_social, address_exploitation, tel, telecopie, objet, logo ) VALUES ( 'DIM', 'Tinak', '', 'fdksldkfakefn', '023153', '156154', 'f,sdk,nfeinvlsksijcezvhdiv', '');
INSERT INTO si_comptable.company( name, leader, address_social, address_exploitation, tel, telecopie, objet, logo ) VALUES ( 'DIM', 'Tinak', '', 'fdksldkfakefn', '023153', '156154', 'f,sdk,nfeinvlsksijcezvhdiv', '4819031.png');
INSERT INTO si_comptable.company( name, leader, address_social, address_exploitation, tel, telecopie, objet, logo ) VALUES ( 'DIM', 'Tinak', 'kq,slqk', 'fdksldkfakefn', '023153', '156154', 'f,sdk,nfeinvlsksijcezvhdiv', '4819032.png');
INSERT INTO si_comptable.devise( code, name ) VALUES ( 'AR', 'Ariary');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '10000', 'CAPITAL');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '10200', 'CAPIT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '20000', 'IMMOBILISATION');
INSERT INTO si_comptable.type_tiers( id, name ) VALUES ( 1, 'Fournisseur');
INSERT INTO si_comptable.type_tiers( id, name ) VALUES ( 2, 'Client');
INSERT INTO si_comptable.detail_company( idcompany, nif, ns, rcs, devise, debut_exercise, fin_exercice ) VALUES ( 2, '1121-561', '126285451', '1536452', 'AR', '2022-01-01', '2022-12-31');
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( '400000000', 'TIAVINA', 2);
