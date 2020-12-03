create view LesDossiers (nDossier,nUtil,dateEmission,prix) as
	         select nDossier,nUtil,dateEmission,sum(prix) as prix from JO_INF245.LesDossiers_base
             natural join JO_INF245.LesBillets natural join JO_INF245.LesEpreuves group by nDossier,nUtil,dateEmission;
             
SELECT D.dateEmission,E.nEpreuve, E.nomE, E.forme, E.categorie, to_char(dateEpreuve, 'Day, DD Month, YYYY'), count(*)
		FROM LesDossiers D join JO_INF245.LesBillets B on (B.nDossier = D.nDossier) join JO_INF245.LesEpreuves E on (E.nEpreuve = B.nEpreuve)
		WHERE nDossier = :
        group by dateEmission, nEpreuve, nomE, forme, categorie, dateEpreuve
        order by 1;
