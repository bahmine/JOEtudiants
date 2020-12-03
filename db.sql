--creation des tables

CREATE TABLE LesSportifs (nSportif number(4), nomS varchar2(20), prenomS varchar(20), pays varchar2(20), 
						  categorieS varchar2(20), dateNais DATE,
						  constraint sport1 primary key (nSportif),
						  constraint sport2 check (nSportif >0),
						  constraint sport3 check (categorieS in ('feminin', 'masculin'))
						  );

CREATE TABLE LesEquipes (nEquipe number(4), nSportif number(4), 
						 constraint equipe1 primary key (nEquipe, nSportif),
						 constraint equipe4 foreign key (nSportif) references LesSportifs (nSportif) on delete cascade,
						 constraint equipe2 check (nSportif>0),
						 constraint equipe3 check (nEquipe > 0)
						 );

CREATE TABLE LesDisciplines (discipline varchar2(20),
							 constraint disc1 primary key (discipline)
							);

CREATE TABLE LesEpreuves (nEpreuve number(3), nomE varchar2(20), forme varchar2(13), discipline varchar2(25), 
						  categorieE varchar2(10), nbs number(2), dateEpreuve DATE, prix number(4,2),
						  constraint epr1 primary key (nEpreuve),
						  constraint epr2 check (forme in ('par equipe', 'individuelle', 'par couple')),
						  constraint epr3 foreign key (discipline) references LesDisciplines (discipline) on delete cascade,
						  constraint epr4 check (categorieE in ('feminin', 'masculin', 'mixte')),
						  constraint epr5 check (nEpreuve>0),
						  constraint epr6 check (nbs>0),
						  constraint epr7 check (prix >=0)
						 );
						 
CREATE TABLE LesInscriptions (nInscrit number(4), nEpreuve number(4),
							  constraint inscr1 primary key (nInscrit, nEpreuve),
							  constraint inscr2 foreign key (nEpreuve) references LesEpreuves (nEpreuve) on delete cascade,
							  constraint inscr3 check(nInscrit>0)
							 );

CREATE TABLE LesResultats (nEpreuve number(4), gold number(4), silver number(4), bronze number(4),
							constraint res1 primary key (nEpreuve),
							constraint res2 foreign key (nEpreuve) references LesEpreuves (nEpreuve) on delete cascade
						  );
						  
CREATE TABLE LesBatiments (nomBat varchar2(20), num number(4), rue varchar2(40), ville varchar2(40),
							constraint bat1 primary key (nomBat), 
							constraint bat2 check (num>0)
						  );
						
CREATE TABLE LesLogements (nLogement number(3), capacite number(3), nomBat varchar2(20),
							constraint loge1 primary key (nLogement, nomBat),
							constraint loge2 foreign key (nomBat) references LesBatiments (nomBat),
							constraint loge3 check (capacite>0)
						  );
						
CREATE TABLE LesLocataires (nSportif number(4), nLogement number(3), nomBat varchar2(20),
							 constraint loca1 primary key (nSportif),
							 constraint loca3 foreign key (nLogement, nomBat) references LesLogements (nLogement, nomBat) on delete cascade,
							 constraint loca2 foreign key (nSportif) references LesSportifs (nSportif) on delete cascade
						   );						

CREATE TABLE LesDossiers_base(nDossier number(38), nUtil number(38), dateEmission DATE,
							   constraint db1 primary key (nDossier),
							   constraint db2 check (nUtil>0)		
							 );

CREATE TABLE LesBillets(nBillet number(38), nDossier number(38), nEpreuve number(3),
						 constraint billet1 primary key (nBillet, nDossier),
						 constraint billet2 foreign key (nDossier) references LesDossiers_base(nDossier) on delete cascade,
						 constraint billet3 foreign key (nEpreuve) references LesEpreuves (nEpreuve) on delete cascade
					   );


--insertion des donnees dans la nouvelle db

INSERT INTO LesSportifs SELECT * from JO_INF245.LesSportifs;
INSERT INTO LesEquipes SELECT * from JO_INF245.LesEquipes;
INSERT INTO LesDisciplines SELECT * from JO_INF245.LesDisciplines;
INSERT INTO LesEpreuves SELECT * from JO_INF245.LesEpreuves;
INSERT INTO LesInscriptions SELECT * from JO_INF245.LesInscriptions;
INSERT INTO LesResultats SELECT * from JO_INF245.LesResultats;
INSERT INTO LesBatiments SELECT * from JO_INF245.LesBatiments;
INSERT INTO LesLogements SELECT * from JO_INF245.LesLogements;
INSERT INTO LesLocataires SELECT * from JO_INF245.LesLocataires;
INSERT INTO LesDossiers_base SELECT * from JO_INF245.LesDossiers_base;
INSERT INTO LesBillets SELECT * from JO_INF245.LesBillets;

/* 
drop table LesBillets;
drop table LesDossiers_base;
drop table LesLocataires;	
drop table LesLogements;				  
drop table LesBatiments;
drop table LesResultats;
drop table LesInscriptions;	
drop table LesEquipes;			  			  
drop table LesEpreuves;	
drop table LesSportifs;					 
drop table LesDisciplines;
*/
						   
