DROP SCHEMA si_comptable;


CREATE SCHEMA si_comptable;

CREATE  TABLE si_comptable.code_journaux ( 
	code                 VARCHAR(3)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
 ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.devise ( 
	code                 VARCHAR(3)  NOT NULL     PRIMARY KEY,
	name                 VARCHAR(100)       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.devise_equivalence ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	devise1              VARCHAR(3)  NOT NULL     ,
	devise2              VARCHAR(3)  NOT NULL     ,
	parite               DOUBLE  NOT NULL DEFAULT '1'    ,
	date_parite          DATE       ,
	CONSTRAINT fk_devise_equivalence_devise FOREIGN KEY ( devise1 ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_devise_equivalence_devise_0 FOREIGN KEY ( devise2 ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

CREATE INDEX fk_devise_equivalence_devise ON si_comptable.devise_equivalence ( devise1 );

CREATE INDEX fk_devise_equivalence_devise_0 ON si_comptable.devise_equivalence ( devise2 );

CREATE  TABLE si_comptable.document ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	name                 VARCHAR(100)       ,
	intitule             VARCHAR(100)       
 ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.exercice ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	debut                DATE       ,
	fin                  DATE       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.plan_comptable ( 
	code                 VARCHAR(5)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.reference_piece ( 
	ref                  VARCHAR(2)       ,
	name                 VARCHAR(50)       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.type_tiers ( 
	id                   INT  NOT NULL     PRIMARY KEY,
	name                 VARCHAR(100)       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.utilisateur ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	nom                  VARCHAR(35)  NOT NULL     ,
	mdp                  VARCHAR(20)  NOT NULL     
 ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE  TABLE si_comptable.detail_company ( 
	nif                  VARCHAR(25)       ,
	ns                   VARCHAR(15)       ,
	rcs                  VARCHAR(15)       ,
	devise               VARCHAR(3)  NOT NULL     ,
	debut_exercise       DATE       ,
	fin_exercice         DATE       ,
	CONSTRAINT fk_detail_company_devise FOREIGN KEY ( devise ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_detail_company_devise ON si_comptable.detail_company ( devise );

CREATE  TABLE si_comptable.plan_tiers ( 
	code                 VARCHAR(13)  NOT NULL     PRIMARY KEY,
	intitule             VARCHAR(100)  NOT NULL     ,
	type_tiers           INT  NOT NULL     ,
	CONSTRAINT fk_plan_tiers_type_tiers FOREIGN KEY ( type_tiers ) REFERENCES si_comptable.type_tiers( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_plan_tiers_type_tiers ON si_comptable.plan_tiers ( type_tiers );

CREATE  TABLE si_comptable.journal ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	debit                DOUBLE   DEFAULT '0'    ,
	credit               DOUBLE   DEFAULT '0'    ,
	date_journal         DATE  NOT NULL     ,
	code_journal         VARCHAR(3)   DEFAULT 'AN'    ,
	numero_piece         INT       ,
	compte               VARCHAR(5)  NOT NULL     ,
	libelle              VARCHAR(35)  NOT NULL     ,
	reference_piece      VARCHAR(100)       ,
	compte_tierce        VARCHAR(13)       ,
	echeance             DATE       ,
	devise               VARCHAR(3)   DEFAULT 'AR'    ,
	quantite             DOUBLE  NOT NULL     ,
	idexercice           INT  NOT NULL     ,
	CONSTRAINT fk_journal_code_journaux FOREIGN KEY ( code_journal ) REFERENCES si_comptable.code_journaux( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_devise FOREIGN KEY ( devise ) REFERENCES si_comptable.devise( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_exercice FOREIGN KEY ( idexercice ) REFERENCES si_comptable.exercice( id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_plan_comptable FOREIGN KEY ( compte ) REFERENCES si_comptable.plan_comptable( code ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_journal_plan_tiers FOREIGN KEY ( compte_tierce ) REFERENCES si_comptable.plan_tiers( code ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

CREATE INDEX fk_journal_plan_tiers ON si_comptable.journal ( compte_tierce );

CREATE INDEX fk_journal_code_journaux ON si_comptable.journal ( code_journal );

CREATE INDEX fk_journal_plan_comptable ON si_comptable.journal ( compte );

CREATE INDEX fk_journal_devise ON si_comptable.journal ( devise );

CREATE INDEX fk_journal_exercice ON si_comptable.journal ( idexercice );

CREATE VIEW si_comptable.balance AS select `pc`.`code` AS `code`,`pc`.`intitule` AS `intitule`,`j`.`debit` AS `debit`,`j`.`credit` AS `credit`,`j`.`solde` AS `solde`,`j`.`idexercice` AS `idexercice` from (`si_comptable`.`plan_comptable` `pc` join (select `si_comptable`.`journal`.`compte` AS `compte`,sum(`si_comptable`.`journal`.`debit`) AS `debit`,sum(`si_comptable`.`journal`.`credit`) AS `credit`,(sum(`si_comptable`.`journal`.`debit`) - sum(`si_comptable`.`journal`.`credit`)) AS `solde`,`si_comptable`.`journal`.`idexercice` AS `idexercice` from `si_comptable`.`journal` group by `si_comptable`.`journal`.`compte`,`si_comptable`.`journal`.`idexercice`) `j` on((`pc`.`code` = `j`.`compte`)));

CREATE VIEW si_comptable.grand_livre AS select `si_comptable`.`journal`.`code_journal` AS `code_journal`,`si_comptable`.`journal`.`date_journal` AS `date_journal`,`si_comptable`.`journal`.`numero_piece` AS `numero_piece`,`si_comptable`.`journal`.`reference_piece` AS `reference_piece`,`si_comptable`.`journal`.`compte` AS `compte`,`si_comptable`.`journal`.`libelle` AS `libelle`,`si_comptable`.`journal`.`debit` AS `debit`,`si_comptable`.`journal`.`credit` AS `credit`,`si_comptable`.`journal`.`idexercice` AS `idexercice` from `si_comptable`.`journal`;

INSERT INTO si_comptable.code_journaux( code, intitule ) VALUES ( 'AC', 'Achat');
INSERT INTO si_comptable.code_journaux( code, intitule ) VALUES ( 'AN', 'A NOUVEAU');
INSERT INTO si_comptable.code_journaux( code, intitule ) VALUES ( 'BN', 'BANQUE BNI');
INSERT INTO si_comptable.code_journaux( code, intitule ) VALUES ( 'VE', 'VENTES');
INSERT INTO si_comptable.company( name, address_social, tel, objet, leader, logo, address_exploitation, telecopie ) VALUES ( 'DIMPLEX', 'ENCEINTE ITU ANDOHARANOFOTSY BP 1960 Antananarivo 101', '22 770 99', 'La DIMPEX  (Dago Import Export) a pour objet social la production d''articles industriels et la vente de marchandises auprès de ces clients locaux et étrangers', 'Tiavina', '4819038.png', 'ENCEINTE ITU ANDOHARANOFOTSY BP 1960 Antananarivo 101', null);
INSERT INTO si_comptable.devise( code, name ) VALUES ( 'AR', 'Ariary');
INSERT INTO si_comptable.devise( code, name ) VALUES ( 'EUR', 'Euro');
INSERT INTO si_comptable.devise( code, name ) VALUES ( 'USD', 'Dollars');
INSERT INTO si_comptable.devise( code, name ) VALUES ( 'YEN', 'Yen-chinois');
INSERT INTO si_comptable.devise_equivalence( devise1, devise2, parite, date_parite ) VALUES ( 'AR', 'EUR', 4000.0, null);
INSERT INTO si_comptable.devise_equivalence( devise1, devise2, parite, date_parite ) VALUES ( 'AR', 'USD', 3000.0, null);
INSERT INTO si_comptable.devise_equivalence( devise1, devise2, parite, date_parite ) VALUES ( 'AR', 'AR', 1.0, null);
INSERT INTO si_comptable.devise_equivalence( devise1, devise2, parite, date_parite ) VALUES ( 'AR', 'YEN', 0.003, null);
INSERT INTO si_comptable.document( name, intitule ) VALUES ( 'selection1.pdf', 'selection');
INSERT INTO si_comptable.document( name, intitule ) VALUES ( 'Madagascar-Loi-2003-36-societes-commerciales.pdf', 'Status');
INSERT INTO si_comptable.document( name, intitule ) VALUES ( 'selection2.pdf', 'nif');
INSERT INTO si_comptable.exercice( debut, fin ) VALUES ( '2023-03-21', null);
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '10100', 'CAPITAL');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '10610', 'RESERVE LEGALE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '11000', 'REPORT A NOUVEAU');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '11010', 'REPORT A NOUVEAU SOLDE CREDITEUR');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '11200', 'AUTRES PRODUITS ET CHARGES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '11900', 'REPORT A NOUVEAU SOLDE DEBITEUR');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '12800', 'RESULTAT EN INSTANCE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '13300', 'IMPOTS DIFFERES ACTIFS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '16110', 'EMPRUNT A LT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '16510', 'ENMPRUNT A MOYEN TERME');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '20124', 'FRAIS DE REHABILITATION');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '20800', 'AUTRES IMMOB INCORPORELLES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21100', 'TERRAINS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21200', 'CONSTRUCTION');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21300', 'MATERIEL ET OUTILLAGE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21510', 'MATERIEL AUTOMOBILE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21520', 'MATERIEL MOTO');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21600', 'AGENCEMENT. AM .INST');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21810', 'MATERIELS ET MOBILIERS DE BUREAU');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21819', 'MATERIELS INFORMATIQUES ET AUTRES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21820', 'MAT. MOB DE LOGEMENT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '21880', 'AUTRES IMMOBILISATIONS CORP');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '23000', 'IMMOBILISATION EN COURS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '28000', 'AMORT IMMOB INCORP');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '28120', 'AMORTISSEMENT DES CONSTRUCTIONS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '28130', 'AMORT MACH-MATER-OUTIL');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '28150', 'AMORT MAT DE TRANSPORT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '28160', 'AMORT A.A.I');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '28181', 'AMORT MATERIEL&MOB');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '28182', 'AMORTISSEMENTS MATERIELS INFORMATIQ');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '28183', 'AMORT MATER & MOB LOGT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '32110', 'STOCK MATIERES PREMIERES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '35500', 'STOCK PRODUITS FINIS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '37000', 'STOCK MARCHANDISES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '39700', 'PROVISIONS/DEPRECIATIONS STOCKS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '40110', 'FOURNISSEURS DEXPLOITATIONS LOCAUX');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '40120', 'FOURNISSEURS DEXPLOITATIONS ETRANGERS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '40310', 'FOURNISSEURS D''IMMOBILISATION');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '40810', 'FRNS: FACTURE A RECEVOIR');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '40910', 'FRNS:AVANCES&ACOMPTES VERSER');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '40980', 'FRNS: RABAIS A OBTENIR');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '41110', 'CLIENTS LOCAUX');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '41120', 'CLIENTS ETRANGERS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '41400', 'CLIENTS DOUTEUX');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '41800', 'CLIENTS FACTURE A RETABLIR');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '42100', 'PERSONNEL: SALAIRES A PAYER');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '42510', 'PERSONNEL: AVANCES QUINZAINES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '42520', 'PERSONNEL: AVANCES SPECIALES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '42860', 'PERS:CHARGES  A PAYER');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '43100', 'CNAPS ');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '43120', 'OSTIE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '44200', 'ETAT IBS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '44210', 'ACOMPTE IBS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '44321', 'TVA … IMPUTER:DEC ULTERIEURE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '44500', 'ETAT:IRSA VERSER');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '44560', 'ETAT: TVA DEDUCTIBLE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '44570', 'ETAT: TVA COLLECTEE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '44571', 'TVA A VERSER');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '45100', 'COMPTE  COURANT ASSOC');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '46700', 'DEB/CRED DIVERS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '46800', 'CHARGES A PAYER DEB/CRED DIVERS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '48610', 'CHARGE CONSTATES D''AVANCE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '49100', 'PERTE/CLIENTS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '51200', 'BOA ANKORONDRANO');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '51201', 'BOA DOLLARS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '51202', 'BNI MADAGASCAR');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '51203', 'BNI DOLLARS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '53100', 'CAISSE ');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '58110', 'VIREMENTINTERNE:BANQ/CAISSE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '58130', 'VIREMENT INTERNE:BANQ/BANQ');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '58140', 'VIREMENT INTERNE CAISSE/CAISSE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60100', 'ACHAT MATIERES PREMIERESS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60200', 'FOURNIT DE MAGASIN');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60210', 'FOURNIT BUR ');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60220', 'FOURNIT DE LOGT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60230', 'EMBALLAGES(PLAST-CARTON....');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60240', 'PIEC RECH VOITURES ADMINISTRATIVES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60241', 'PIEC RECH CAMIONS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60242', 'PIEC RECH MOTO');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60250', 'AUTRES ACHATS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60300', 'VARIATION  STOCK MAT PREM');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60610', 'EAU ET ELECTRICITE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '60620', 'GAZ,COMBUST,CARBURANT,LUBRIF');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '61300', 'LOC IMMOBILIERES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '61380', 'AUTRES LOCATIONS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '61550', 'ENTRET & REP VEHICULE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '61560', 'MAINTENANCE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '61610', 'ASSURANCE GLOBALE DOMMAGES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '61611', 'ASSURANCE FLOTTE AUTOMOBILE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '61800', 'PHOTOCOPIE ET ASSIMILES ');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '61810', 'ENVOI COLIS(LETTRE&DOC...');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62100', 'PERSONNEL EXTER');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62210', 'HONORAIRE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62220', 'REMUNERATION DES TRANSITAIRES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62230', 'CATALOGUES ET IMPRIMES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62240', 'PUBLICATION');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62250', 'SPONSORING-MECENAT...');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62260', 'TS DOUANE ET ASSIMILES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62400', 'FRAIS DE TRANSPORT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62510', 'VOYAGES   ET DEPLACEMENT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62520', 'MISSION(DEPL+HEBERGT+RESTø)');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62530', 'RECEPTION');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62610', 'SERVICES POSTAUX');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62620', 'TEL&FAX');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62630', 'INTERNET TANA');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62740', 'COMMISSIONS BANCAIRE INTERNATIONALE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62760', 'COMMISSIONS BNI');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62770', 'COMMISSIONS BOA');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '62880', 'AUTRES  CHARGES EXTERNES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '63680', 'AUTRES IMPOTS/TAXES/DROITS DIV');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '64100', 'REMUNERATION PERSONNEL');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '64120', 'DROIT DE CONGES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '64511', 'CNAPS:COTISATION  PATRONALE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '64512', 'OSTIE : COTISATION PATRONALE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '64750', 'MED ET ASSIM PERS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '65800', 'AUTRES CHARGES DIVERSES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '65810', 'ECART/PAIEMENT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '65811', 'PERTE/TVA NON RECUPERABLE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '66200', 'INTERETS  BANCAIRES BNI');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '66300', 'INTERETS  BANCAIRES BOA');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '66600', 'DIFFF  DE  CHANGE  PERTE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '66680', 'AGIOS/TRAITES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '68110', 'D.A.P  IMMO INCORPORELLES');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '68120', 'D.A.P  IMMO  CORPORELLE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '70110', 'VENTE LOCALE');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '70120', 'VENTES  A  L EXPORTATION');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '70800', 'AUTRES PROD  DES ACT ANNEX&ACS');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '71300', 'VARIATION DE STOCK  P.F');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '75800', 'AUTRES PRODUITS D EXPLOITATION');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '75810', 'ECART/ENCAISSEMENT');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '76200', 'INTERET CREDITEUR BANQUES BNI');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '76300', 'INTERET CREDITEUR BANQUES BOA');
INSERT INTO si_comptable.plan_comptable( code, intitule ) VALUES ( '76600', 'DIFFERENCE DE  CHANGE:PROFIT');
INSERT INTO si_comptable.reference_piece( ref, name ) VALUES ( 'FF', 'Facture');
INSERT INTO si_comptable.reference_piece( ref, name ) VALUES ( 'PC', 'Piece de caisse');
INSERT INTO si_comptable.reference_piece( ref, name ) VALUES ( 'CH', 'Cheque');
INSERT INTO si_comptable.type_tiers( id, name ) VALUES ( 1, 'Fournisseur');
INSERT INTO si_comptable.type_tiers( id, name ) VALUES ( 2, 'Client');
INSERT INTO si_comptable.type_tiers( id, name ) VALUES ( 3, '');
INSERT INTO si_comptable.utilisateur( nom, mdp ) VALUES ( 'Tiavina', 'TTT');
INSERT INTO si_comptable.detail_company( nif, ns, rcs, devise, debut_exercise, fin_exercice ) VALUES ( '1265055951', '88126059599', '845132815', 'AR', '2023-01-01', '2023-12-31');
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( '', '', 3);
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( 'LOVASOA', 'FRNS | LOVASOA', 1);
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( 'NORO', 'CLI | NORO', 1);
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( 'ORIMBATO', 'FRNS | ORIMBATO', 1);
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( 'PAPANGO', 'FRNS | PAPANGO', 1);
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( 'RABE', 'CLI | RABE', 1);
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( 'RAVINALA', 'FRNS | RAVINALA', 1);
INSERT INTO si_comptable.plan_tiers( code, intitule, type_tiers ) VALUES ( 'SOLO', 'CLI | SOLO', 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 1400000.0, '2023-01-01', 'AN', null, '10100', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 27920.0, '2023-01-01', 'AN', null, '10610', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 177080.0, '2023-01-01', 'AN', null, '11000', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 322480.0, '2023-01-01', 'AN', null, '12800', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 1819280.0, '2023-01-01', 'AN', null, '16110', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 180720.0, '2023-01-01', 'AN', null, '16510', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 71600.0, 0.0, '2023-01-01', 'AN', null, '20124', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 86500.0, 0.0, '2023-01-01', 'AN', null, '20800', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 450000.0, 0.0, '2023-01-01', 'AN', null, '21100', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 846200.0, 0.0, '2023-01-01', 'AN', null, '21200', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 1265500.0, 0.0, '2023-01-01', 'AN', null, '21300', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 1346400.0, 0.0, '2023-01-01', 'AN', null, '21510', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 783800.0, 0.0, '2023-01-01', 'AN', null, '21810', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 121800.0, 0.0, '2023-01-01', 'AN', null, '21880', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 120000.0, 0.0, '2023-01-01', 'AN', null, '23000', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 94500.0, '2023-01-01', 'AN', null, '28000', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 186600.0, '2023-01-01', 'AN', null, '28120', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 597250.0, '2023-01-01', 'AN', null, '28130', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 681480.0, '2023-01-01', 'AN', null, '28150', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 459660.0, '2023-01-01', 'AN', null, '28181', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 276130.0, 0.0, '2023-01-01', 'AN', null, '32110', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 1075600.0, 0.0, '2023-01-01', 'AN', null, '35500', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 1173180.0, 0.0, '2023-01-01', 'AN', null, '37000', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 346580.0, '2023-01-01', 'AN', null, '39700', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 865400.0, '2023-01-01', 'AN', null, '40110', 'A NOUVEAU 2023', 'AN2023', 'RAVINALA', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 1236300.0, '2023-01-01', 'AN', null, '40110', 'A NOUVEAU 2023', 'AN2023', 'LOVASOA', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 748000.0, '2023-01-01', 'AN', null, '40110', 'A NOUVEAU 2023', 'AN2023', 'PAPANGO', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 750850.0, '2023-01-01', 'AN', null, '40110', 'A NOUVEAU 2023', 'AN2023', 'ORIMBATO', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 288650.0, '2023-01-01', 'AN', null, '40810', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 26450.0, 0.0, '2023-01-01', 'AN', null, '40980', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 418000.0, 0.0, '2023-01-01', 'AN', null, '41110', 'A NOUVEAU 2023', 'AN2023', 'SOLO', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 1012500.0, 0.0, '2023-01-01', 'AN', null, '41110', 'A NOUVEAU 2023', 'AN2023', 'RABE', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 852900.0, 0.0, '2023-01-01', 'AN', null, '41110', 'A NOUVEAU 2023', 'AN2023', 'NORO', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 720000.0, 0.0, '2023-01-01', 'AN', null, '41120', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 160000.0, 0.0, '2023-01-01', 'AN', null, '41400', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 57500.0, 0.0, '2023-01-01', 'AN', null, '41800', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 455560.0, '2023-01-01', 'AN', null, '42100', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 42380.0, '2023-01-01', 'AN', null, '43100', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 28260.0, '2023-01-01', 'AN', null, '43120', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 270000.0, '2023-01-01', 'AN', null, '44200', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 203370.0, '2023-01-01', 'AN', null, '44560', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 26700.0, 0.0, '2023-01-01', 'AN', null, '44571', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 172500.0, 0.0, '2023-01-01', 'AN', null, '46700', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 80000.0, '2023-01-01', 'AN', null, '49100', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 300300.0, 0.0, '2023-01-01', 'AN', null, '51200', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 0.0, 119560.0, '2023-01-01', 'AN', null, '51202', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);
INSERT INTO si_comptable.journal( debit, credit, date_journal, code_journal, numero_piece, compte, libelle, reference_piece, compte_tierce, echeance, devise, quantite, idexercice ) VALUES ( 18320.0, 0.0, '2023-01-01', 'AN', null, '53100', 'A NOUVEAU 2023', 'AN2023', '', null, 'AR', 0.0, 1);


 update exercice set fin='2023-12-31' where id=1;

