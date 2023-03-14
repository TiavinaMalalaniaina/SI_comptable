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

CREATE  TABLE si_comptable.plan_comptable ( 
	numero               VARCHAR(5)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.plan_tiers ( 
	numero               VARCHAR(13)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.detail_company ( 
	idcompany            INT  NOT NULL     ,
	nif                  VARCHAR(25)       ,
	num_statistique      VARCHAR(15)       ,
	rcs                  VARCHAR(15)       ,
	devise               VARCHAR(3)  NOT NULL     ,
	debut_exercise       DATE       ,
	CONSTRAINT fk_detail_company_devise FOREIGN KEY ( devise ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_detail_company_company FOREIGN KEY ( idcompany ) REFERENCES si_comptable.company( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

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
	CONSTRAINT fk_journal_plan_tiers FOREIGN KEY ( compte_tierce ) REFERENCES si_comptable.plan_tiers( numero ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_code_journaux FOREIGN KEY ( code_journal ) REFERENCES si_comptable.code_journaux( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_plan_comptable FOREIGN KEY ( compte ) REFERENCES si_comptable.plan_comptable( numero ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_devise FOREIGN KEY ( devise ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

INSERT INTO si_comptable.company( name, leader, address_social, address_exploitation, tel, objet, logo ) VALUES ( null, null, null, null, null, null, null);
