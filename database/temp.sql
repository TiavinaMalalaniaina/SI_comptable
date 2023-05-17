drop table compte_amort;
create table compte_amort(
    id int primary key auto_increment,
    con varchar(5),
    typo varchar(50),
    nom varchar(100),
    cp TEXT,
    ca text
);


insert into compte_amort(con,typo,nom,cp,ca) values('20','actif non courants','immobilisations incorporelles','\'20124\',\'20800\'','\'28000\'');
insert into compte_amort(con,typo,nom,cp,ca) values('21','actif non courants','immobilisations corporelles','\'21100\',\'21200\',\'21300\',\'21510\',\'21520\',\'21600\',\'21810\',\'21819\',\'21820\',\'21880\'','\'28120\',\'28130\',\'28150\',\'28160\',\'28181\',\'28182\',\'28183\'');
insert into compte_amort(con,typo,nom,cp,ca) values('22','actif non courants','immobilisations biologiques','null','null');
insert into compte_amort(con,typo,nom,cp,ca) values('23','actif non courants','immobilisations en cours','\'23000\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('25','actif non courants','immobilisations financieres','null','null');
insert into compte_amort(con,typo,nom,cp,ca) values('13','actif non courants','impots differes ','\'13300\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('3','actif courants','stocks et en cours ','\'32110\',\'35500\',\'37000\'','\'39700\'');
insert into compte_amort(con,typo,nom,cp,ca) values('4...','actif courants','creances et emplois assimiles','null','null');
insert into compte_amort(con,typo,nom,cp,ca) values('41','actif courants','clients et autres debiteurs ','\'41110\',\'41120\',\'41400\',\'41800\',\'42100\',\'42510\',\'42520\',\'42860\',\'43100\',\'43120\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('','actif courants','impots /benefices','\'44200\',\'44210\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('4...','actif courants','autres creances et actifs assimiles','\'45100\',\'46700\',\'46800\',\'48610\',\'49100\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('5...','actif courants','tresorie et equivalentes de tresorie','\'51200\',\'51201\',\'51202\',\'51203\',\'53100\'','null');



-- 
insert into compte_amort(con,typo,nom,cp,ca) values('10','capitaux propres','capitale emis','\'10100\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('11','capitaux propres','reserve legales','\'10610\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('12','capitaux propres','resultat en instance d affectation','\'12800\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('12','capitaux propres','resultat net','null','null');
insert into compte_amort(con,typo,nom,cp,ca) values('11','capitaux propres','autres capitaux propres','null','null');
insert into compte_amort(con,typo,nom,cp,ca) values('13','passif non-courants','impots differes','\'13300\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('161','passif non-courants','emprunts/dettes a LMT part+1an','\'16110\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('161','passif courants','emprunts/dettes a LMT part-1an','\'16510\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('165','passif courants','dettes court terme','null','null');
insert into compte_amort(con,typo,nom,cp,ca) values('4','passif courants','fournisseurs et comptes rattaches','\'40110\',\'40120\',\'40310\',\'40810\',\'40910\',\'40980\'','null');
insert into compte_amort(con,typo,nom,cp,ca) values('4','passif courants','avances recues des clients','null','null');
insert into compte_amort(con,typo,nom,cp,ca) values('4','passif courants','autres dettes','null','null');
insert into compte_amort(con,typo,nom,cp,ca) values('5','passif courants','comptes de tresorie','\'51200\',\'51201\',\'51202\',\'51203\',\'53100\'','null');

insert into compte_amort(con,nom) values('70','chiffre d affaire');
insert into compte_amort(con,nom) values('71','production stockee');
insert into compte_amort(con,nom) values('60','achat consommee');
insert into compte_amort(con,nom) values('61/62','service exterieur et autres consommations');
insert into compte_amort(con,nom) values('64','charge personnel');
insert into compte_amort(con,nom) values('63','impots, taxes er versements assimiles');
insert into compte_amort(con,nom) values('75','autres produits operationnels');
insert into compte_amort(con,nom) values('65','autres charges operationnels');
insert into compte_amort(con,nom) values('68','dotations aux ammortissements, aux provisions et pertes de valeurs');
insert into compte_amort(con,nom) values('78','reprise sur provisions et pertes de valeurs');
insert into compte_amort(con,nom) values('76','prodiuits financiers');
insert into compte_amort(con,nom) values('66','charges financieres');
insert into compte_amort(con,nom) values('695','impots exigibles sur resultats');
insert into compte_amort(con,nom) values('692','impots differes (variations)');
insert into compte_amort(con,nom) values('77','elements extraordinaires(produits)');
insert into compte_amort(con,nom) values('67','elements extraordinaires(charges)');

