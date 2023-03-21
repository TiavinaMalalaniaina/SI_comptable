drop schema si_comptable;
CREATE SCHEMA si_comptable;

CREATE  TABLE si_comptable.code_journaux ( 
	code                 VARCHAR(3)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     
 );

CREATE  TABLE si_comptable.company ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	name                 VARCHAR(100)       ,
	address_social       VARCHAR(100)       ,
	tel                  VARCHAR(15)       ,
	objet                TEXT       ,
	leader               VARCHAR(100)       ,
	logo                 VARCHAR(100)       ,
	address_exploitation VARCHAR(100)       ,
	telecopie            VARCHAR(15)       
 );

CREATE  TABLE si_comptable.devise ( 
	code                 VARCHAR(3)  NOT NULL     PRIMARY KEY,
	name                 VARCHAR(100)       
 );

CREATE  TABLE si_comptable.devise_equivalence ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	devise1              VARCHAR(3)  NOT NULL     ,
	devise2              VARCHAR(3)  NOT NULL     ,
	parite               DOUBLE  NOT NULL DEFAULT '1'    ,
	date_parite          DATE       ,
	CONSTRAINT fk_devise_equivalence_devise FOREIGN KEY ( devise1 ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_devise_equivalence_devise_0 FOREIGN KEY ( devise2 ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE  TABLE si_comptable.document ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	name                 VARCHAR(100)       ,
	intitule             VARCHAR(100)       
 );

CREATE  TABLE si_comptable.exercice ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	debut                DATE       ,
	fin                  DATE       
 ) ;

CREATE  TABLE si_comptable.plan_comptable ( 
	code                 VARCHAR(5)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     
 );

CREATE  TABLE si_comptable.type_tiers ( 
	id                   INT  NOT NULL     PRIMARY KEY,
	name                 VARCHAR(100)       
 );

CREATE  TABLE si_comptable.detail_company ( 
	nif                  VARCHAR(25)       ,
	ns                   VARCHAR(15)       ,
	rcs                  VARCHAR(15)       ,
	devise               VARCHAR(3)  NOT NULL     ,
	debut_exercise       DATE       ,
	fin_exercice         DATE       ,
	CONSTRAINT fk_detail_company_devise FOREIGN KEY ( devise ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE INDEX fk_detail_company_devise ON si_comptable.detail_company ( devise );

CREATE  TABLE si_comptable.plan_tiers ( 
	code                 VARCHAR(13)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     ,
	type_tiers           INT  NOT NULL     ,
	CONSTRAINT fk_plan_tiers_type_tiers FOREIGN KEY ( type_tiers ) REFERENCES si_comptable.type_tiers( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE INDEX fk_plan_tiers_type_tiers ON si_comptable.plan_tiers ( type_tiers );

CREATE INDEX fk_plan_tiers_type_tiers ON si_comptable.plan_tiers ( type_tiers );

CREATE  TABLE si_comptable.journal ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	debit                DOUBLE   DEFAULT '0'    ,
	credit               DOUBLE   DEFAULT '0'    ,
	date_journal         DATE  NOT NULL     ,
	code_journal         VARCHAR(3)       ,
	numero_piece         VARCHAR(100)  NOT NULL     ,
	compte               VARCHAR(5)  NOT NULL     ,
	libelle              VARCHAR(35)  NOT NULL     ,
	reference_piece      VARCHAR(100)       ,
	compte_tierce        VARCHAR(13)       ,
	echeance             DATE       ,
	devise               VARCHAR(3)       ,
	quantite             DOUBLE  NOT NULL     ,
	idexercice           INT  NOT NULL     ,
	CONSTRAINT fk_journal_code_journaux FOREIGN KEY ( code_journal ) REFERENCES si_comptable.code_journaux( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_devise FOREIGN KEY ( devise ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_plan_comptable FOREIGN KEY ( compte ) REFERENCES si_comptable.plan_comptable( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_plan_tiers FOREIGN KEY ( compte_tierce ) REFERENCES si_comptable.plan_tiers( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_exercice FOREIGN KEY ( idexercice ) REFERENCES si_comptable.exercice( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE INDEX fk_journal_plan_tiers ON si_comptable.journal ( compte_tierce );

CREATE INDEX fk_journal_code_journaux ON si_comptable.journal ( code_journal );

CREATE INDEX fk_journal_plan_comptable ON si_comptable.journal ( compte );

CREATE INDEX fk_journal_devise ON si_comptable.journal ( devise );

CREATE VIEW si_comptable.balance AS

SELECT pc.*, j.debit, j.credit, j.solde, j.idexercice
FROM plan_comptable pc
JOIN (
	SELECT compte, sum(debit) debit, sum(credit) credit, (sum(debit)-sum(credit)) solde, idexercice
	FROM journal
	GROUP BY compte, idexercice
) j
ON pc.code=j.compte;

CREATE VIEW si_comptable.grand_livre AS
SELECT code_journal, date_journal, numero_piece, reference_piece, compte, libelle, debit, credit, idexercice
FROM journal;

INSERT INTO si_comptable.code_journaux( code, intitule ) VALUES ( 'AC', 'Achat');
INSERT INTO si_comptable.code_journaux( code, intitule ) VALUES ( 'BN', 'BANQUE BNI');
INSERT INTO si_comptable.code_journaux( code, intitule ) VALUES ( 'VE', 'VENTES');
INSERT INTO si_comptable.company( name, address_social, tel, objet, leader, logo, address_exploitation, telecopie ) VALUES ( 'DIMPLEX', 'ENCEINTE ITU ANDOHARANOFOTSY BP 1960 Antananarivo 101', '22 770 99', 'La DIMPEX  (Dago Import Export) a pour objet social la production d''articles industriels et la vente de marchandises auprès de ces clients locaux et étrangers', 'Tiavina', '4819038.png', 'ENCEINTE ITU ANDOHARANOFOTSY BP 1960 Antananarivo 101', null);
INSERT INTO si_comptable.devise( code, name ) VALUES ( 'AR', 'Ariary');
INSERT INTO si_comptable.devise( code, name ) VALUES ( 'EUR', 'Euro');
INSERT INTO si_comptable.devise( code, name ) VALUES ( 'USD', 'Dollars');
INSERT INTO si_comptable.devise_equivalence( devise1, devise2, parite, date_parite ) VALUES ( 'AR', 'EUR', 4000.0, null);
INSERT INTO si_comptable.devise_equivalence( devise1, devise2, parite, date_parite ) VALUES ( 'AR', 'USD', 3000.0, null);
INSERT INTO si_comptable.devise_equivalence( devise1, devise2, parite, date_parite ) VALUES ( 'AR', 'AR', 1.0, null);
INSERT INTO si_comptable.document( name, intitule ) VALUES ( 'selection1.pdf', 'selection');
INSERT INTO si_comptable.document( name, intitule ) VALUES ( 'Madagascar-Loi-2003-36-societes-commerciales.pdf', 'Status');
INSERT INTO si_comptable.type_tiers( id, name ) VALUES ( 1, 'Fournisseur');
INSERT INTO si_comptable.type_tiers( id, name ) VALUES ( 2, 'Client');
INSERT INTO si_comptable.detail_company( nif, ns, rcs, devise, debut_exercise, fin_exercice ) VALUES ( '1265055951', '88126059599', '845132815', 'AR', '2023-01-01', '2023-12-31');
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( '400000000', 'TIAVINA', 2);
INSERT INTO exercice values(null,'2023-01-01','2023-12-31');

-- 
create table reference_piece(
	ref varchar(2),
	name varchar(50)
);
insert into reference_piece values('FF','Facture');
insert into reference_piece values('PC','Piece de caisse');
insert into reference_piece values('CH','Cheque');